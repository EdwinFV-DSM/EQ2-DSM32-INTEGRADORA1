<?php 
    session_start();
    if(isset($_SESSION['login']) == 1){
        //echo $_SESSION['login'];
        header('Location: panel.php');
    }
    $pagina_admin = 0;
    $pagina_modificacion = 0;
    $pagina = 0;
    $video = 0;
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
                        <h1>Sign Up</h1>
                        <form class="row g-3" id ="formulario-signup">
                            <div class="col-md-4">
                                <label for="inputEmail4" class="form-label">Nombre</label>
                                <input type="text" class="form-control"
                                    id="inputEmail4" name="nombre">
                            </div>
                            <div class="col-md-4">
                                <label for="inputPassword4" class="form-label">Apellido</label>
                                <input type="text" class="form-control"
                                    id="inputPassword4" name="apellido">
                            </div>
                            <div class="col-4">
                                <label for="inputAddress" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control"
                                    id="inputAddress" name="fechaNa">
                            </div>
                            <div class="col-6">
                                <label for="inputAddress2" class="form-label">Email</label>
                                <input type="email" class="form-control"
                                    id="inputAddress2" placeholder="innovative.transport@email.com" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">Password</label>
                                <input type="password" class="form-control"
                                    id="inputCity" name="password">
                            </div>
                            <div class="col-md-6" style="display: flex; flex-wrap: wrap; flex-direction: row; align-items: stretch; justify-content: center; align-content: center;">
                                <label for="exampleInputPassword1" class="form-label">Sexo: </label>
                                <div class="checkbox">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="sexo" value="M">
                                        <label class="form-check-label" for="inlineCheckbox1">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="sexo" value="F">
                                        <label class="form-check-label" for="inlineCheckbox2">Femenino</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </div>
                            <div class="options">
                                <p>Ya tengo cuenta <a href="<?= base_url?>user/login.php">ingresar</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </header>
        </div>


<?php require_once '../includes/footer.php'; ?>