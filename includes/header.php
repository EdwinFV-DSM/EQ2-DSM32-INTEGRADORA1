<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <!-- Bibilioteca de Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
    <!-- Estilos para video -->
    <!-- css -->
    <link href="assets/css/animate.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

    <!--Libreria de SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicon de la pagina -->
    <link rel="shortcut icon" href="assets/img/Innovative Transport S.A de C.V (1).png" type="image/x-icon">
    <title>Heladeria Taca</title>
</head>

<body>
    <div class="contenido">
        <div class="video">
            <!-- Section: home video -->
            <section id="intro" class="home-video text-light">
                <div class="home-video-wrapper">

                    <div class="homevideo-container">
                        <div id="P1" class="bg-player" style="display:block; margin: auto; background: rgba(0,0,0,0.5)"
                            data-property="{videoURL:'https://www.youtube.com/watch?v=2kYfClXxu8g',containment:'.homevideo-container', quality: 'hd720', showControls: false, autoPlay:true, mute:true, startAt:0, opacity:1}">
                        </div>
                    </div>
                    <div class="overlay">
                        <div class="text-center video-caption">
                            <div class="wow bounceInDown" data-wow-offset="0" data-wow-delay="0.8s">
                                <h1 class="big-heading font-light"><span id="js-rotating">Congela y dale sabor, a tus
                                        momentos con, Heladeria Taca!!</span></h1>
                            </div>
                            <div class="wow bounceInUp" data-wow-offset="0" data-wow-delay="1s">
                                <div class="margintop-30">
                                    <a href="#about" class="btn btn-success" id="btn-scroll">Start here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /Section: intro -->
        </div>
        <nav class="navbar navbar-expand-lg bg-light" id="about">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <img src="assets/img/Innovative Transport S.A de C.V (1).png" alt="" width="30" height="24">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Home</a>
                        </li>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Services
                                </a>
                                <!-- Hacer validacion que identifique los tipos de roles para mostrar determinados servicios -->
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="ususario/facturas"><i class="bi bi-receipt"></i>
                                            Facturas</a>
                                    </li>
                                    <li><a class="dropdown-item" href="ususario/facturas"><i
                                                class="bi bi-ticket-detailed"></i>
                                            Boletos</a></li>
                                    <li><a class="dropdown-item" href="ususario/facturas"><i
                                                class="bi bi-person-circle"></i>
                                            Clientes</a></li>
                                    <li><a class="dropdown-item" href="ususario/facturas"><i
                                                class="bi bi-person-circle"></i>
                                            Trabajadores</a></li>
                                    <li><a class="dropdown-item" href="ususario/facturas"><i
                                                class="bi bi-mortarboard"></i> Escuelas</a>
                                    </li>
                                    <li><a class="dropdown-item" href="ususario/horarios"><i class="bi bi-clock"></i>
                                            Horarios</a></li>
                                    <li><a class="dropdown-item" href="ususario/rutas"><i class="bi bi-map"></i>
                                            Rutas</a></li>
                                </ul>
                            </li>
                        </div>
                    </ul>
                    <div class="user-actions">
                        <li><a href=""><i class="bi bi-person-fill"></i> Login</a></li>
                        <li><a href=""><i class="bi bi-person-plus-fill"></i> Sign Up</a></li>
                    </div>
                </div>
            </div>
        </nav>