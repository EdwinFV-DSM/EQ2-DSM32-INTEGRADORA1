<?php
session_start();
$pagina_admin = 0;
$pagina_modificacion = 0;
$pagina = 0;
$video = 0;
require_once '../includes/header.php';
require_once '../config/ConexionDB.php';
if (isset($_SESSION['login']) == 1) {
    // echo $_SESSION['login'];
} else {
    header('Location: login.php');
}

if ($_SESSION['status'] == 0) {
    $activo = 'Activo';
} else {
    $activo = 'Inactivo';
}
?>
<div class="header pie">
    <div class="container">
        <div class="row">
            <div class="clockdate" style="
    position: fixed; padding-top: 11px;
">
                <span id="time"></span>
                <span id="date"></span>
            </div>

            <script>
                function startTime() {
                    //declaramos las  variables que nos proporcionaran los datos como la hora, minutos etc.

                    var today = new Date(),
                        hours = today.getHours(),
                        minutes = today.getMinutes(),
                        date = today.getDate(),
                        day = today.getDay(),
                        month = today.getMonth();

                    //utilizaremos operadores ternarios esto nos ayudara a mostrar la hora solo del 1 al 12
                    hours = (hours == 0) ? 12 : hours;
                    hours = (hours > 12) ? hours - 12 : hours;

                    //pasaremos las horas y minutos a una funcion que crearemos mas adelante
                    hours = checkTime(hours);
                    minutes = checkTime(minutes);

                    //primero para los dias y meses crearemos un arreglo esto por que la funcion que nos debuelve
                    //los dias y meses nos los debuelbe en numero
                    var dia = ["Domingo", " Lunes", "Martes", "Miercoles", "Jueves", "viernes", "Sabado"],
                        mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                    //haora solo imprimimos los datos
                    var hr = document.getElementById('time').innerHTML = hours + ":" + minutes,
                        dt = document.getElementById('date').innerHTML = dia[day] + ", " + date + " De " + mes[month];

                    //esta funcion hara que nuestro escript se ejecute constantemente
                    var time = setTimeout(function() {
                        startTime();
                    }, 500);




                }
                //solo falta crear la funcion que nos diga si tine uno o dos dijitos
                //esto para que si solo tiene uno le agrege u  cero a la izquierda
                function checkTime(e) {
                    if (e < 10) {
                        e = "0" + e;
                    }
                    return e;
                }
            </script>
            <p style="text-align:right; padding-right:20px; padding-top: 11px;">Tu status de descuento esta: <span style="color: 
            <?php if ($_SESSION['status'] == 0) {
                echo '#2778c4';
            } else {
                echo 'red';
            } ?>; font-weight: 900;"><?php echo $activo ?></span></p>
        </div>
    </div>
</div>
<h1 style="text-align: center;"><?php if ($_SESSION['sexo'] == 'F') {
                                    echo 'Bienvenida ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellidos'];
                                } else {
                                    echo 'Bienvenido ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellidos'];
                                } ?></h1>

<?php include_once '../includes/footer.php'; ?>