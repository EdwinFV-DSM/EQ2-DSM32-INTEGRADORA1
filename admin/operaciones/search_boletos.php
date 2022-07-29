<?php
/*
* Script: Cargar datos de lado del servidor con PHP y MySQL
*/


require '../../config/ConexionDB.php';
require '../../config/parameters.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['N_Operacion', 'fechaC', 'idCliente'];

/* Nombre de la tabla */
$table = "tickets";

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}


/* Consulta */
$sql = "SELECT " . implode(", ", $columns) . "
FROM $table
$where ";
$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;


/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $querycliente = 'SELECT * FROM cliente WHERE `idCliente` = ' . $row['idCliente'];
        $cliente = mysqli_query($conexion, $querycliente);
        $row_cliente = mysqli_fetch_assoc($cliente);
        $html .= '<tr>';
        $html .= '<td>' . $row['N_Operacion'] . '</td>';
        $html .= '<td>' . $row_cliente['nombre'] .' '.$row_cliente['apellidos'] . '</td>';
        $html .= '<td>' . $row['fechaC'] . '</td>';
        $html .= '<td style="
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex-wrap: wrap;
        flex-direction: row;
        align-content: space-between;">
        <a class="btn btn-success" href='.base_url_admin.'/operaciones/modificar_boleto.php?operacion='.$row['N_Operacion'].'><i class="bi bi-pencil-square"></i></a>
        <a class="btn btn-danger" href='.base_url_admin.'/boletos.php?N_Operacion='.$row['N_Operacion'].'><i class="bi bi-trash"></i></a>
        <a class="btn btn-primary" href='.base_url_admin.'/operaciones/consulta.php?operacion='.$row['N_Operacion'].'><i class="bi bi-search"></i></a>
        </td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
