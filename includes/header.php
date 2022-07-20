<?php
if ($pagina == 1) {
    require_once 'config/parameters.php';
    require_once 'config/ConexionDB.php';
}elseif ($pagina_admin == 2) {
    require_once '../config/parameters.php';
    require_once '../config/ConexionDB.php';
    require_once '../admin/operaciones/crear_boleto.php';
    require_once '../admin/operaciones/crear_cliente.php';

}elseif ($pagina_modificacion == 1) {
    require_once '../../config/parameters.php';
}elseif ($pagina_admin == 1) {
    require_once '../../config/parameters.php';
    require_once '../../config/ConexionDB.php';
}else{
    require_once '../config/parameters.php';
    require_once '../config/ConexionDB.php';
}
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>   
    <!-- Bibilioteca de Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
    <!-- Estilos para video -->
    <!-- css -->
    <link href="<?= base_url ?>assets/css/animate.css" rel="stylesheet" />
    <link href="<?= base_url ?>assets/css/style.css" rel="stylesheet" />
    <?php if ($pagina_admin == 2 || $pagina_modificacion == 1 ) {?>
        <link rel="stylesheet" href="<?= base_url_admin ?>/assets/css/style.css">
    <?php } ?>

    <!-- Estilos de iconos -->
    <link href="<?=base_url?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!--Libreria de SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AcEaKT68XPWppkhwxKv_LCXyB-TBKap3rnXGpd6DvA1g7qx13WBzxk6cinqj3jcFPNNdsrx4GU4v8OVH&currency=MXN"></script>

    <!-- Favicon de la pagina -->
    <!-- <link rel="shortcut icon" href="<?= base_url ?>assets/img/Innovative Transport S.A de C.V (1).png" type="image/x-icon"> -->
    <link rel="shortcut icon" href="https://i.postimg.cc/g0H4khWq/Innovative-Transport-S-A-de-C-V-1.png" type="image/x-icon">
    
    <title>Innovative Transport | <?php echo $nombre_pagina ?></title>
</head>
<body onload="startTime()">
    <?php if ($video == 1) { ?>
        <div class="contenido">
            <div class="video">
                <!-- Section: home video -->
                <section id="intro" class="home-video text-light">
                    <div class="home-video-wrapper">

                        <div class="homevideo-container">
                            <div id="P1" class="bg-player" style="display:block; margin: auto; background: rgba(0,0,0,0.5)" data-property="{videoURL:'https://www.youtube.com/watch?v=2kYfClXxu8g',containment:'.homevideo-container', quality: 'hd720', showControls: false, autoPlay:true, mute:true, startAt:0, opacity:1}">
                            </div>
                        </div>
                        <div class="overlay">
                            <div class="text-center video-caption">
                                <div class="wow bounceInDown" data-wow-offset="0" data-wow-delay="0.8s">
                                    <h1 class="big-heading font-light"><span id="js-rotating" style="font-weight: bold;">¿Llevas prisa?, Con Innovative Transport ya no llegarás tarde, a tan solo un click</span></h1>
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
        <?php } else {
    } ?>
        <nav class="navbar navbar-expand-lg bg-light" id="about">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url ?>">
                    <img src="<?= base_url ?>assets/img/Innovative Transport S.A de C.V (1).png" alt="" width="30" height="24">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url ?>">Home</a>
                        </li>
                        <?php if (isset($_SESSION['login']) == 1) { ?>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Services
                                    </a>
                                    <!-- Hacer validacion que identifique los tipos de roles para mostrar determinados servicios -->
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <!-- Primera validacion es donde el cliente Estudiante y usuario tendran las mismas acciones  -->
                                        <?php if ($_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3) { ?>
                                            <li><a class="dropdown-item" href="<?= base_url?>user/facturas.php"><i class="bi bi-receipt"></i>
                                                    Facturas</a>
                                            </li>
                                            <li><a class="dropdown-item" href="<?= base_url?>user/boletos.php?pagina=1"><i class="bi bi-ticket-detailed"></i>
                                                    Boletos</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url?>ususario/horarios.php"><i class="bi bi-clock"></i>
                                                    Horarios</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url?>ususario/rutas"><i class="bi bi-map"></i>
                                                    Rutas</a></li>
                                    <!-- Segunda validacion es donde se valida que el usuario sea trabajador donde tendra acceso a crear boletos -->
                                        <?php } elseif ($_SESSION['idTUsuario'] == 1) { ?>
                                            <li><a class="dropdown-item" href="<?= base_url?>ususario/facturas"><i class="bi bi-ticket-detailed"></i>
                                                    Boletos</a></li>
                                    <!-- Primera validacion es donde se valida que el usuario sea administrador para tener acceso a todos los servicios  -->
                                        <?php } elseif ($_SESSION['idTUsuario'] == 4) { ?>
                                            <li><a class="dropdown-item" href="<?= base_url_admin?>/Facturas.php?pagina=1"><i class="bi bi-receipt"></i>
                                                    Facturas</a>
                                            </li>
                                            <li><a class="dropdown-item" href="<?= base_url_admin?>/Clientes.php?pagina=1"><i class="bi bi-person-circle"></i>
                                                    Clientes</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url_admin?>/facturas"><i class="bi bi-person-circle"></i>
                                                    Trabajadores</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url_admin?>/facturas"><i class="bi bi-mortarboard"></i>
                                                    Escuelas</a>
                                            </li>
                                            <li><a class="dropdown-item" href="<?= base_url_admin?>/horarios"><i class="bi bi-clock"></i>
                                                    Horarios</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url_admin?>/rutas"><i class="bi bi-map"></i>
                                                    Rutas</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url_admin?>/boletos.php?pagina=1"><i class="bi bi-ticket-detailed"></i>
                                                    Boletos</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </div>
                        <?php } else {
                        } ?>
                    </ul>
                    <?php if (isset($_SESSION['login']) == 1) { ?>
                        <li class="nav-item dropdown" style="list-style: none;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="rounded-circle" width="50px" height="auto" src="<?php echo $_SESSION['img']; ?>" alt="">
                                <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellidos']; ?>
                            </a>
                            <!-- Hacer validacion que identifique los tipos de roles para mostrar determinados servicios -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if ($_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3) { ?>
                                    <li><a class="dropdown-item" href="<?= base_url?>user/settings.php"><i class="bi bi-gear"></i>
                                            Setting</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url?>ususario/facturas"><i class="bi bi-question-circle"></i>
                                            Help</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url?>user/panel.php"><i class="bi bi-person-circle"></i>
                                            Your Profile</a>
                                    </li>
                                <?php } elseif ($_SESSION['idTUsuario'] == 1) { ?>
                                    <li><a class="dropdown-item" href="<?= base_url?>user/settings.php"><i class="bi bi-gear"></i>
                                            Setting</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url?>ususario/facturas"><i class="bi bi-question-circle"></i>
                                            Help</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url?>ususario/facturas"><i class="bi bi-person-circle"></i>
                                            Your Profile</a>
                                    </li>
                                <?php } elseif ($_SESSION['idTUsuario'] == 4) { ?>

                                    <li><a class="dropdown-item" href="<?= base_url?>user/settings.php"><i class="bi bi-gear"></i>
                                            Setting</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url?>ususario/facturas"><i class="bi bi-question-circle"></i>
                                            Help</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url?>user/panel.php"><i class="bi bi-person-circle"></i>
                                            Your Profile</a>
                                    </li>
                                    
                                        <hr class="dropdown-divider">
                                    </li>

                                <?php } ?>
                                <li><a class="dropdown-item" href="<?= base_url ?>user/procesos/salir.php"><i class="bi bi-door-open"></i> Sign out</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php
                                if ($_SESSION['idEscuela'] == '') {
                                } else {
                                    $queryescuelas = 'SELECT nombre,img FROM escuelas WHERE idEscuela = ' . $_SESSION['idEscuela'];
                                    $escuelas = mysqli_query($conexion, $queryescuelas);
                                    $row_escuelas = mysqli_fetch_assoc($escuelas);

                                ?>
                                    <li><img src="<?php echo $row_escuelas['img'] ?> " style="width: 152px; padding: 4px;" alt=""></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <div class="user-actions">
                            <li><a href="<?= base_url ?>user/login.php"><i class="bi bi-person-fill"></i> Login</a></li>
                            <li><a href="<?= base_url ?>user/signup.php"><i class="bi bi-person-plus-fill"></i> Sign Up</a></li>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>