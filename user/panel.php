<?php
$pagina_admin = 0;
$pagina_modificacion = 0;
$pagina = 0;
$video = 0;
$nombre_pagina = "Home";
require_once '../includes/header.php';
require_once '../config/ConexionDB.php';

if (isset($_SESSION['login']) == 1) {
    // echo $_SESSION['login'];
} else {
    header('Location: login.php');
}

if ($_SESSION['idTUsuario'] == 1 || $_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3 || $_SESSION['idTUsuario'] == 4) {
    if ($_SESSION['status'] == 0) {
        $activo = 'Activo';
    } else {
        $activo = 'Inactivo';
    }
}

if ($_SESSION['idTUsuario'] == 1 || $_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3 || $_SESSION['idTUsuario'] == 4) {
    $tickets = 'SELECT * FROM tickets WHERE idCliente =' . $_SESSION['idCliente'];
    $sentencia = $PDO->prepare($tickets);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();
    //contar articulos de nuestra base de datos

    $total_tickets_db = $sentencia->rowCount();

    /**Conteo de facturas solicitadas */

    $tickets = 'SELECT * FROM facturas WHERE idCliente =' . $_SESSION['idCliente'] . " AND status = 1";
    $sentencia = $PDO->prepare($tickets);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();
    //contar articulos de nuestra base de datos

    $total_facturas_db = $sentencia->rowCount();

    /**Conteo de facturas aprobadas */

    $tickets = 'SELECT * FROM facturas WHERE idCliente =' . $_SESSION['idCliente'] . " AND status = 3";
    $sentencia = $PDO->prepare($tickets);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();
    //contar articulos de nuestra base de datos

    $total_facturas_db_aprobadas = $sentencia->rowCount();
} else {
    $Estudiantes = "SELECT * FROM cliente WHERE idEscuela =" . $_SESSION['idEscuela'];
    $queryEstudante = $PDO->prepare($Estudiantes);
    $queryEstudante->execute();

    $total_estudiantes_db = $queryEstudante->rowCount();

/**Alumnos dados de baja */
    $Estudiantes_bajas = "SELECT * FROM cliente WHERE idEscuela =" . $_SESSION['idEscuela'] .' AND status = 1';
    $queryEstudantebaja = $PDO->prepare($Estudiantes_bajas);
    $queryEstudantebaja->execute();

    $total_estudiantes_baja_db = $queryEstudantebaja->rowCount();

    /**Alumnos totales activos */
    $Estudiantes_activos = "SELECT * FROM cliente WHERE idEscuela =" . $_SESSION['idEscuela'] .' AND status = 0';
    $queryEstudanteActivos = $PDO->prepare($Estudiantes_activos);
    $queryEstudanteActivos->execute();

    $total_estudiantes_activos_db = $queryEstudanteActivos->rowCount();
}
?>
<div class="header pie">
    <div class="container">
        <div class="row">
            <div class="clockdate" style="position: <?php echo $_SESSION['idTUsuario'] <5 ? 'fixed' : 'unset' ?>; padding-top: 11px;">
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
            <?php if ($_SESSION['idTUsuario'] == 1 || $_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3 || $_SESSION['idTUsuario'] == 4) {?>
                <p style="text-align:right; padding-right:20px; padding-top: 11px;">Tu status de descuento esta: <span style="color:
            <?php }?>
            <?php
                if ($_SESSION['idTUsuario'] == 1 || $_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3 || $_SESSION['idTUsuario'] == 4) {
                    if ($_SESSION['status'] == 0) {
                        echo '#2778c4';
                    } else {
                        echo 'red';
                    }?>; font-weight: 900;"><?php echo $activo ?></span></p>
            <?php }?>
        </div>
    </div>
</div>
<h1 style="text-align: center; color: black;"><?php
if (isset($_SESSION['sexo'])) {
    if ($_SESSION['sexo'] == 'F') {
        echo 'Bienvenida ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellidos'];
    } else {
        echo 'Bienvenido ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellidos'];
    }
} else {
    echo $_SESSION['nombre'];
}
?></h1>

<?php if ($_SESSION['idTUsuario'] == 1 || $_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3 || $_SESSION['idTUsuario'] == 4) {?>
    <section class="cards-info">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tickets Creados</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tickets_db ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-ticket-detailed fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Facturas Solicitadas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_facturas_db ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-receipt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Facturas Aprobadas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_facturas_db_aprobadas ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-receipt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

            <!-- Pending Requests Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <?php

    $compras = "SELECT * FROM tickets WHERE idCliente =" . $_SESSION['idCliente'] . " ORDER BY fechaC DESC LIMIT 0,5";
    $comprasOld = mysqli_query($conexion, $compras);

    ?>


<div class="container">
    <div class="row">
        <section class="info">
            <div class="compras shadow-lg p-3 mb-5 bg-body rounded scrollspy-example">
                <h1>Recientes Compras</h1>
                <table class="table" style="height: 150px">
                    <thead>
                        <tr>
                            <th scope="col">No.Operacion</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Fecha de Creacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($compras_rows = mysqli_fetch_assoc($comprasOld)) {?>
                            <tr>
                                <td><?php echo $compras_rows['N_Operacion']; ?></td>
                                <td>$<?php echo $compras_rows['costo']; ?> MXN</td>
                                <td><?php echo $compras_rows['fechaC']; ?></td>
                            </tr>
                        <?php }
    mysqli_free_result($comprasOld);?>

                    </tbody>
                </table>
            </div>

            <?php
$messages = "SELECT * FROM messages WHERE idCliente =" . $_SESSION['idCliente'] . " ORDER BY fechaCreacion DESC LIMIT 0,5";
    $resultado_msg = mysqli_query($conexion, $messages);
    ?>

            <div class="alertas shadow-lg p-3 mb-5 bg-body rounded">
                <h1>Messages</h1>
                <div class="contenido-messages" style="text-align: left;">
                    <?php while ($row_messages = mysqli_fetch_assoc($resultado_msg)) {?>
                        <p>System: <?php echo $row_messages['Descripcion'] ?></p>
                    <?php }
    mysqli_free_result($resultado_msg);?>
                </div>
            </div>
        </section>
    </div>
</div>
<!--
    En este partado se visualizara el contenido para las escuelas en su panel donde solo veran el total de estuantes activos en sus
    instalaciones al igual que podran deshabilitarlos de las descuentos y de su panel.
-->

<?php } else {?>
    <section class="cards-info">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total de Alumnos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_estudiantes_db ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Alumonos Inactivos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_estudiantes_baja_db; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-minus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Alumnos Activos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_estudiantes_activos_db; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

            <!-- Pending Requests Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>

<?php }?>
<?php include_once '../includes/footer.php';?>