<?php

include_once '../../config/ConexionDB.php';

if (isset($_POST['id_ruta'])) {
    $id_ruta = $_POST['id_ruta'];
}else{
    $id_ruta = "";
}

if ($id_ruta == '') {
    $html = "<input type='text' class='form-control' id='row_costo' name='costo' value='Seleccione una ruta' readonly>";
    echo $html;
}else{
    $queryCosto = "SELECT costo FROM rutas WHERE idruta =". $id_ruta;
    $costo = mysqli_query($conexion,$queryCosto);
    
    while ($row_costo = mysqli_fetch_assoc($costo)) {
        $html = "<input type='text' class='form-control' id='row_costo' name='costo' value='".$row_costo['costo']."' readonly>";
    } mysqli_free_result($costo);
    
    echo $html;
}

?>