
<?php

ob_start();
require_once("Config/db.php");
include("./Config/usuario.php");
$ts = gmdate("D, d M Y H:i:s") . " GMT";
//var_dump($_POST);
session_start();
$user = new Usuario();

if(!isset($_SESSION["token"]))
{
    header("Location: ./");
}

?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/views/css/bootstrap.css">
    <link rel="stylesheet" href="/views/css/animate.css">
    <link rel="stylesheet" href="/views/js/toastr.min.css">
    <title>TICKETS</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Tickets</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/views/nuevoTickets.php">Levantar Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/SeguimientoTickets.php">Seguimiento a tus tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/Reportes.php">Reportes</a>
                </li>
                <li class="nav-item dropdown  my-2 my-lg-0 float-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuario
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./logout.php">Cerrar Sesion</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<hr>
<div class="container">
    <div class="row">
        <h1 class="display-4 font-weight-bold pt-3"> Reportes</h1>
        <div class="col-md-12">
            <form method="post" id="enviartickets"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Motivo del Ticket:</label>
                    <!--                        <input type="text" class="form-control" id="recipient-name">-->
                    <select class="form-control" id="inputSelect" name="motivo" id="motivo">
                        <option value="1">Solicitud 4+1</option>
                        <option value="2">Compra jabonera(rota, robo, vandalismo)</option>
                        <option value="3">Cambio por uso Común</option>
                        <option value="4">Envio etiquetas y ayudas visuales</option>
                        <option value="5">Contenedor para Solucion Sanitizante</option>
                        <option value="6">Guia de Envio de contenedores</option>
                        <option value="7">Tapa oscilante para contenedor</option>
                        <option value="8">Guia de envio de tapas</option>
                        <option value="8">LGS bimestrales</option>
                        <option value="9">Solicitud de portagalones</option>
                        <option value="0" onchange="otromotivo()">Otro</option>
                    </select>
                    <div class="form-group" id="txtoculto">
                        <br>
                        <label for="otromotivo"><strong> Otro Motivo: </strong></label>
                        <textarea class="form-control" name="otromotivo" id="otromotivo" cols="10" rows="2"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Comentarios:</label>
                    <textarea class="form-control" name="comentarios" id="comentarios"></textarea>
                </div>
                <div class="form-group">
                    <label for="evidencia" class="col-form-label">Evidencia</label><br>
                    <small class="text-muted">Nota: Se pueden subir un maximo de 5 fotografias</small>
                    <input class="form-control" type="file" name="Foto1" id="Foto1">
                    <input class="form-control" type="file" name="Foto2" id="Foto2">
                    <input class="form-control" type="file" name="Foto3" id="Foto3">
                    <input class="form-control" type="file" name="Foto4" id="Foto4">
                    <input class="form-control" type="file" name="Foto5" id="Foto5">
                </div>
                <button type="submit" class="btn btn-info" >Enviar</button>
            </div>
        </form>
    </div>
    <div id="miparrafo"></div>
</div>
</body>
<script src="/views/js/jquery-3.1.1.min.js"></script>
<script src="/views/js/popper.min.js"></script>
<script src="/views/js/bootstrap.js"></script>
<script src="/views/js/sweetalert2.all.min.js"></script>
<script src="/views/js/toastr.min.js"></script>
<!--<script src="views/js/axios.min.js"></script>-->

<script>

    $.get({
        url: "/Controllers/todo.php",
        cache: false,
        success: function(data){
            console.log(data);
            $("#miparrafo").html(data);
            toastr["success"]("Ticket Creadoi"+html(data)+"", "Realizado");
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    })

    // axios.get('/Controllers/todo.php')
    //     .then((res) => {
    //         let usuarios = res.data;
    //         console.log(usuarios);
    //     })
    //     .catch(err => {
    //         console.log(err);
    //     });
</script>
    <script>
        $("#txtoculto").hide();

        $("#inputSelect").on('change', function() {
            var selectValue = $(this).val();
            switch (selectValue) {
                case "0":
                    $("#txtoculto").show();
                    break;
                case "1":
                    $("#txtoculto").hide();
                    break;
                case "2":
                    $("#txtoculto").hide();
                    break;
                case "3":
                    $("#txtoculto").hide();
                    break;
                case "4":
                    $("#txtoculto").hide();
                    break;
                case "5":
                    $("#txtoculto").hide();
                    break;
                case "6":
                    $("#txtoculto").hide();
                    break;
                case "7":
                    $("#txtoculto").hide();
                    break;
                case "8":
                    $("#txtoculto").hide();
                    break;
                case "9":
                    $("#txtoculto").hide();
                    break;
                case "10":
                    $("#txtoculto").hide();
                    break;
                default:
                    $("#txtoculto").hide();
            }
        }).change();
    </script>
    <script>
        $("#enviartickets").on("submit", function(e){
            e.preventDefault();
            var formData = new FormData(document.getElementById("enviartickets"));

            $.ajax({
                url: "Controllers/ticketup.php",
                type: "POST",
                dataType: "HTML",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(echo){
                $("#mensaje").html(echo);
                $("#txtoculto").hide();
            });
        });
    </script>
</html>


