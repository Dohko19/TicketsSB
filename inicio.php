<?php
require_once("Config/db.php");
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="views/css/bootstrap.css">
    <link rel="stylesheet" href="views/css/animate.css">
    <title>TICKETS</title>
    <style>
        #container {
            min-width: 310px;
            max-width: 800px;
            height: 400px;
            margin: 0 auto
        }

        .buttons {
            min-width: 310px;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 0;
        }

        .buttons button {
            cursor: pointer;
            border: 1px solid silver;
            border-right-width: 0;
            background-color: #f8f8f8;
            font-size: 1rem;
            padding: 0.5rem;
            outline: none;
            transition-duration: 0.3s;
        }

        .buttons button:first-child {
            border-top-left-radius: 0.3em;
            border-bottom-left-radius: 0.3em;
        }

        .buttons button:last-child {
            border-top-right-radius: 0.3em;
            border-bottom-right-radius: 0.3em;
            border-right-width: 1px;
        }

        .buttons button:hover {
            color: white;
            background-color: rgb(158, 159, 163);
            outline: none;
        }

        .buttons button.active {
            background-color: #0051B4;
            color: white;
        }

        .highcharts-figure, .highcharts-data-table table {
            min-width: 320px;
            max-width: 660px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Levantar Ticket</a>
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
        <div class="col-md-4">
        </div>
        <div class="col-md-4 animated fadeInLeftBig">
            <a class="btn btn-outline-info btn-block" data-toggle="modal" data-toggle="modal" data-target="#exampleModalCenter"  href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 16" width="10" height="16"><path fill-rule="evenodd" d="M9 0H1C.27 0 0 .27 0 1v15l5-3.09L10 16V1c0-.73-.27-1-1-1zm-.78 4.25L6.36 5.61l.72 2.16c.06.22-.02.28-.2.17L5 6.6 3.12 7.94c-.19.11-.25.05-.2-.17l.72-2.16-1.86-1.36c-.17-.16-.14-.23.09-.23l2.3-.03.7-2.16h.25l.7 2.16 2.3.03c.23 0 .27.08.09.23h.01z"></path></svg>
                Levanta tu ticket</a>
<!--            <button type="btn btn-outline-info btn-block" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">-->
<!--                Launch demo modal-->
<!--            </button>-->
        </div>
        <div class="col-md-4">
            <div id="mensaje"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pt-4 animated zoomInDown">
            <div class="card ">
                <div class="card-header bg-info text-white">
                    Noticias
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-info">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h1 class="display-4 font-weight-bold pt-3"> Reportes</h1>
        <div class="col-md-12">
            <form method="post" id="enviartickets"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Motivo del Ticket:</label>
                    <!--                        <input type="text" class="form-control" id="recipient-name">-->
                    <select class="form-control" name="motivo" id="motivo">
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
                        <option value="0">Otro</option>
                    </select>
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
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info" data-dismiss="modal">Enviar</button>
        </div>
        </form>
            <form>
                <div class="row">
                    <div class="col">
                        <select name="mes" id="mes" class="form-control">
                            <option value="enero">Enero</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="anio" id="anio" class="form-control">
                            <option value="2020 ">2020</option>
                        </select>
                    </div>
                    <button class="btn btn-warning">Consultar</button>
                </div>
            </form>
        </div>
        <div id="miparrafo"></div>

    <div class="col-md-12">
        <div class='buttons'>
            <button id='2000'>
                2000
            </button>
            <button id='2004'>
                2004
            </button>
            <button id='2008'>
                2008
            </button>
            <button id='2012'>
                2012
            </button>
            <button id='2016' class='active'>
                2016
            </button>
        </div>
        <div id="container"></div>
    </div>
        <div class="col-md-12">
            <figure class="highcharts-figure">
                <div id="container2"></div>
                <p class="highcharts-description">
                    All color options in Highcharts can be defined as gradients or patterns.
                    In this chart, a gradient fill is used for decorative effect in a pie
                    chart.
                </p>
            </figure>
        </div>

    </div>

</div>
</body>
<script src="views/js/jquery-3.1.1.min.js"></script>
<script src="views/js/popper.min.js"></script>
<script src="views/js/bootstrap.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!--<script src="views/js/axios.min.js"></script>-->

<script>

    $.get({
        url: "/Controllers/todo.php",
        cache: false,
        success: function(data){
            console.log(data);
            $("#miparrafo").html(data);
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
    var dataPrev = {
        2016: [
            ['South Korea', 0],
            ['Japan', 0],
            ['Australia', 0],
            ['Germany', 11],
            ['Russia', 24],
            ['China', 38],
            ['Great Britain', 29],
            ['United States', 46]
        ],
        2012: [
            ['South Korea', 13],
            ['Japan', 0],
            ['Australia', 0],
            ['Germany', 0],
            ['Russia', 22],
            ['China', 51],
            ['Great Britain', 19],
            ['United States', 36]
        ],
        2008: [
            ['South Korea', 0],
            ['Japan', 0],
            ['Australia', 0],
            ['Germany', 13],
            ['Russia', 27],
            ['China', 32],
            ['Great Britain', 9],
            ['United States', 37]
        ],
        2004: [
            ['South Korea', 0],
            ['Japan', 5],
            ['Australia', 16],
            ['Germany', 0],
            ['Russia', 32],
            ['China', 28],
            ['Great Britain', 0],
            ['United States', 36]
        ],
        2000: [
            ['South Korea', 0],
            ['Japan', 0],
            ['Australia', 9],
            ['Germany', 20],
            ['Russia', 26],
            ['China', 16],
            ['Great Britain', 0],
            ['United States', 44]
        ]
    };

    var data = {
        2016: [
            ['South Korea', 0],
            ['Japan', 0],
            ['Australia', 0],
            ['Germany', 17],
            ['Russia', 19],
            ['China', 26],
            ['Great Britain', 27],
            ['United States', 46]
        ],
        2012: [
            ['South Korea', 13],
            ['Japan', 0],
            ['Australia', 0],
            ['Germany', 0],
            ['Russia', 24],
            ['China', 38],
            ['Great Britain', 29],
            ['United States', 46]
        ],
        2008: [
            ['South Korea', 0],
            ['Japan', 0],
            ['Australia', 0],
            ['Germany', 16],
            ['Russia', 22],
            ['China', 51],
            ['Great Britain', 19],
            ['United States', 36]
        ],
        2004: [
            ['South Korea', 0],
            ['Japan', 16],
            ['Australia', 17],
            ['Germany', 0],
            ['Russia', 27],
            ['China', 32],
            ['Great Britain', 0],
            ['United States', 37]
        ],
        2000: [
            ['South Korea', 0],
            ['Japan', 0],
            ['Australia', 16],
            ['Germany', 13],
            ['Russia', 32],
            ['China', 28],
            ['Great Britain', 0],
            ['United States', 36]
        ]
    };

    var countries = [{
        name: 'South Korea',
        flag: 197582,
        color: 'rgb(201, 36, 39)'
    }, {
        name: 'Japan',
        flag: 197604,
        color: 'rgb(201, 36, 39)'
    }, {
        name: 'Australia',
        flag: 197507,
        color: 'rgb(0, 82, 180)'
    }, {
        name: 'Germany',
        flag: 197571,
        color: 'rgb(0, 0, 0)'
    }, {
        name: 'Russia',
        flag: 197408,
        color: 'rgb(240, 240, 240)'
    }, {
        name: 'China',
        flag: 197375,
        color: 'rgb(255, 217, 68)'
    }, {
        name: 'Great Britain',
        flag: 197374,
        color: 'rgb(0, 82, 180)'
    }, {
        name: 'United States',
        flag: 197484,
        color: 'rgb(215, 0, 38)'
    }];


    function getData(data) {
        return data.map(function (country, i) {
            return {
                name: country[0],
                y: country[1],
                color: countries[i].color
            };
        });
    }

    var chart = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Summer Olympics 2016 - Top 5 countries by Gold medals'
        },
        subtitle: {
            text: 'Comparing to results from Summer Olympics 2012 - Source: <ahref="https://en.wikipedia.org/wiki/2016_Summer_Olympics_medal_table">Wikipedia</a>'
        },
        plotOptions: {
            series: {
                grouping: false,
                borderWidth: 0
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            shared: true,
            headerFormat: '<span style="font-size: 15px">{point.point.name}</span><br/>',
            pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} medals</b><br/>'
        },
        xAxis: {
            type: 'category',
            max: 4,
            labels: {
                useHTML: true,
                animate: true,
                formatter: function () {
                    var value = this.value,
                        output;

                    countries.forEach(function (country) {
                        if (country.name === value) {
                            output = country.flag;
                        }
                    });

                    return '<span><img src="https://image.flaticon.com/icons/svg/197/' + output + '.svg" style="width: 40px; height: 40px;"/><br></span>';
                }
            }
        },
        yAxis: [{
            title: {
                text: 'Gold medals'
            },
            showFirstLabel: false
        }],
        series: [{
            color: 'rgb(158, 159, 163)',
            pointPlacement: -0.2,
            linkedTo: 'main',
            data: dataPrev[2016].slice(),
            name: '2012'
        }, {
            name: '2016',
            id: 'main',
            dataSorting: {
                enabled: true,
                matchByName: true
            },
            dataLabels: [{
                enabled: true,
                inside: true,
                style: {
                    fontSize: '16px'
                }
            }],
            data: getData(data[2016]).slice()
        }],
        exporting: {
            allowHTML: true
        }
    });

    var years = [2016, 2012, 2008, 2004, 2000];

    years.forEach(function (year) {
        var btn = document.getElementById(year);

        btn.addEventListener('click', function () {

            document.querySelectorAll('.buttons button.active').forEach(function (active) {
                active.className = '';
            });
            btn.className = 'active';

            chart.update({
                title: {
                    text: 'Summer Olympics ' + year + ' - Top 5 countries by Gold medals'
                },
                subtitle: {
                    text: 'Comparing to results from Summer Olympics ' + (year - 4) + ' - Source: <ahref="https://en.wikipedia.org/wiki/' + (year) + '_Summer_Olympics_medal_table">Wikipedia</a>'
                },
                series: [{
                    name: year - 4,
                    data: dataPrev[year].slice()
                }, {
                    name: year,
                    data: getData(data[year]).slice()
                }]
            }, true, false, {
                duration: 800
            });
        });
    });
</script>
<script>
    // Radialize the colors
    Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
    });

    // Build the chart
    Highcharts.chart('container2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Browser market shares in January, 2018'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Share',
            data: [
                { name: 'Chrome', y: 61.41 },
                { name: 'Internet Explorer', y: 11.84 },
                { name: 'Firefox', y: 10.85 },
                { name: 'Edge', y: 4.67 },
                { name: 'Safari', y: 4.18 },
                { name: 'Other', y: 7.05 }
            ]
        }]
    });
</script>

<script>

</script>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Comentanos tu Problema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="enviartickets"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Motivo del Ticket:</label>
<!--                        <input type="text" class="form-control" id="recipient-name">-->
                        <select class="form-control" name="motivo" id="motivo">
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
                            <option value="0">Otro</option>
                        </select>
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
            </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" data-dismiss="modal">Enviar</button>
                    </div>
                </form>
        </div>
</div>
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
            });
        });
    </script>
</html>
