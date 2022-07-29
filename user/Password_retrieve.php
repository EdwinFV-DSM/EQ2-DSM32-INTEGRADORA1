<?php 
    
    if(isset($_SESSION['login']) == 1){
        //echo $_SESSION['login'];
        header('Location: panel.php');
    }
    $pagina_admin = 0;
    $pagina_modificacion = 0;
    $pagina = 0;
    $video = 0;
    $nombre_pagina ="Retrieve Password";
    require_once '../includes/header.php';
?>

<style> body{
            background-image: url(https://www.eluniversal.com.mx/sites/default/files/2021/06/23/tren-interurbano.jpg);
            background-size:cover;
            Background-repeat:no-repeat;
            }
        </style>
        <div class="background">
            <header class="formulario-registro">
                <div class="container shadow contenedor">
                    <div class="row">
                        <h1>Retrieve Password</h1>
                        <form class="row g-3" id ="formulario-password">
                             <div class="col-md-12">
                                <p>Ingrese su correo electronico.</p>
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="Email" class="form-control"
                                    id="inputEmail4" name="email">
                            </div>                           
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Retrieve Password</button>
                            </div>
                            <div class="options">
                                <p>Ya tengo cuenta <a href="<?= base_url ?>user/login.php">ingresar</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </header>
        </div>


<?php require_once '../includes/footer.php'; ?>