<?php
session_start();
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

if ($_SESSION['status'] == 0) {
    $activo = 'Activo';
} else {
    $activo = 'Inactivo';
}

$tickets = 'SELECT * FROM tickets WHERE idCliente =' . $_SESSION['idCliente'];
$sentencia = $PDO->prepare($tickets);
$sentencia->execute();

$resultado = $sentencia->fetchAll();
//contar articulos de nuestra base de datos

$total_tickets_db = $sentencia->rowCount();

/**Conteo de facturas solicitadas */

$tickets = 'SELECT * FROM facturas WHERE idCliente =' . $_SESSION['idCliente']." AND status = 1";
$sentencia = $PDO->prepare($tickets);
$sentencia->execute();

$resultado = $sentencia->fetchAll();
//contar articulos de nuestra base de datos

$total_facturas_db = $sentencia->rowCount();

/**Conteo de facturas aprobadas */

$tickets = 'SELECT * FROM facturas WHERE idCliente =' . $_SESSION['idCliente']." AND status = 3";
$sentencia = $PDO->prepare($tickets);
$sentencia->execute();

$resultado = $sentencia->fetchAll();
//contar articulos de nuestra base de datos

$total_facturas_db_aprobadas = $sentencia->rowCount();
?>

<?php include_once '../includes/footer.php'; ?>