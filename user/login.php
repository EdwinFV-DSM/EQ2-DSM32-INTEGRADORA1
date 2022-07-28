<?php 
    if(isset($_SESSION['login']) == 1){
        //echo $_SESSION['login'];
        header('Location: panel.php');
    }
    $pagina_admin = 0;
    $pagina_modificacion = 0;
    $pagina = 0;
    $video = 0;
    $nombre_pagina = "Login";
    require_once '../includes/header.php';
?>



<style>
    body{
        background-image: url(https://www.eluniversal.com.mx/sites/default/files/2021/06/23/tren-interurbano.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }
  </style>
    <div class="background">  
      <header class="formulario-ingreso">
          <div class="container shadow contenedor">
              <div class="row">
                  <h1>Login</h1>
                  <form class="Formulario" id="formulario-login">
                      <label for="">Email</label>
                      <input type="email" name="email" >
                      <label for="">Password</label>
                      <input type="password" name="password">
                      <div class="login">
                        <input type="submit" value="Ingresar" class="btn btn-success">
                      </div>              
                      <div class="options">
                        <p>Olvide mi <a href="<?= base_url?>user/Password_retrieve.php">contaseña</a></p>
                      <p>¿No tienes una cuenta? <a href="<?= base_url?>user/signup.php">Crear una</a></p>
                      </div>                              
                  </form>
              </div>
          </div>
      </header>
    </div>

    <?php require_once '../includes/footer.php'; ?>