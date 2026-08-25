<?php
// /var/www/html/webhook.php

// Configuración del bot
$TELEGRAM_BOT_TOKEN = '8736155859:AAHI77N8wP6_UNpI3RGIerJkLRRKUvVR8iQ';

// Archivo donde se guardan los estados
$estadosFile = __DIR__ . '/estados.json';

// Función para guardar estado
function guardarEstado($solicitudId, $estado) {
    global $estadosFile;
    $estados = [];
    if (file_exists($estadosFile)) {
        $contenido = file_get_contents($estadosFile);
        $estados = json_decode($contenido, true) ?: [];
    }
    $estados[$solicitudId] = [
        'estado' => $estado,
        'timestamp' => time()
    ];
    file_put_contents($estadosFile, json_encode($estados));
}

// Función para obtener estado
function obtenerEstado($solicitudId) {
    global $estadosFile;
    if (!file_exists($estadosFile)) {
        return 'pending';
    }
    $contenido = file_get_contents($estadosFile);
    $estados = json_decode($contenido, true) ?: [];
    return isset($estados[$solicitudId]['estado']) ? $estados[$solicitudId]['estado'] : 'pending';
}

// ============================================
// 1. VERIFICAR ESTADO (GET) - Frontend polling
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['check'])) {
    $solicitudId = $_GET['check'];
    $estado = obtenerEstado($solicitudId);
    header('Content-Type: application/json');
    echo json_encode(['estado' => $estado, 'solicitudId' => $solicitudId]);
    exit;
}

// ============================================
// 2. RECIBIR CALLBACK DE TELEGRAM (POST)
// ============================================
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verificar si es un callback de Telegram
if (isset($data['callback_query'])) {
    $callback = $data['callback_query'];
    $callbackData = $callback['data'];
    $callbackId = $callback['id'];
    $messageId = $callback['message']['message_id'];
    $chatId = $callback['message']['chat']['id'];

    // Extraer solicitudId del callback_data
    // Ejemplo: approve_cc_SOL-1234567890-abc123
    if (preg_match('/(approve_cc_|reject_cc_)(.+)/', $callbackData, $matches)) {
        $accion = $matches[1];
        $solicitudId = $matches[2];
    } else {
        // Si no coincide, responder error
        http_response_code(200);
        echo 'OK';
        exit;
    }

    // Determinar estado
    $estado = strpos($accion, 'approve') !== false ? 'approved' : 'rejected';

    // Guardar estado
    guardarEstado($solicitudId, $estado);

    // ============================================
    // 3. RESPONDER A TELEGRAM (Callback Query)
    // ============================================
    $respuesta = [
        'callback_query_id' => $callbackId,
        'text' => $estado === 'approved' ? '✅ Pago aprobado' : '❌ Pago rechazado',
        'show_alert' => false
    ];

    $url = "https://api.telegram.org/bot{$TELEGRAM_BOT_TOKEN}/answerCallbackQuery";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($respuesta));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // ============================================
    // 4. EDITAR MENSAJE EN TELEGRAM
    // ============================================
    $editText = $callback['message']['text'] . "\n\n" . ($estado === 'approved' ? '✅ **APROBADO**' : '❌ **RECHAZADO**');
    $editUrl = "https://api.telegram.org/bot{$TELEGRAM_BOT_TOKEN}/editMessageText";
    $editData = [
        'chat_id' => $chatId,
        'message_id' => $messageId,
        'text' => $editText,
        'parse_mode' => 'Markdown'
    ];
    $ch = curl_init($editUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($editData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // Responder OK
    http_response_code(200);
    echo 'OK';
    exit;
}

// ============================================
// 5. SI NO ES NINGUNA DE LAS ANTERIORES
// ============================================
http_response_code(200);
echo 'Webhook activo';
?>