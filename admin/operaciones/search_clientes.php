<?php
/*
* Script: Cargar datos de lado del servidor con PHP y MySQL
*
*/


require '../../config/ConexionDB.php';
require '../../config/parameters.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['nombre', 'apellidos', 'email', 'idTUsuario'];

/* Nombre de la tabla */
$table = "cliente";

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
        $queryTUsuario = 'SELECT * FROM tipousuario WHERE idTUsuario =' . $row['idTUsuario'];
        $TUsuario = mysqli_query($conexion, $queryTUsuario);
        $row_TUsuario = mysqli_fetch_assoc($TUsuario);
        $html .= '<tr>';
        $html .= '<td>' . $row['nombre'].' ' . $row['apellidos'] . '</td>';
        $html .= '<td>' . $row['email'] . '</td>';
        $html .= '<td>' . $row_TUsuario['nombreUsuario'] . '</td>';
        $html .= '<td style="
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex-wrap: wrap;
        flex-direction: row;
        align-content: space-between;">
        <a class="btn btn-success" href=' . base_url_admin . '/operaciones/modificar_boleto.php?operacion=' . $row['idTUsuario'] . '><i class="bi bi-pencil-square"></i></a>
        <a class="btn btn-danger" href=' . base_url_admin . '/boletos.php?N_Operacion=' . $row['idTUsuario'] . '><i class="bi bi-trash"></i></a>
        <a class="btn btn-primary" href=' . base_url_admin . '/operaciones/consulta_cliente.php?operacion=' . $row['idTUsuario'] . '><i class="bi bi-search"></i></a>
        </td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
