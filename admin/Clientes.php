<?php
if (session_start()) {
} else {
    session_start();
}

if ($_SESSION['idTUsuario']==4) {
    
}else{
    header('Location: ../user/panel.php');
}
$pagina = 0;
$pagina_admin = 2;
$video = 0;
require_once '../includes/header.php';

$clientes = 'SELECT * FROM cliente';
$sentencia = $PDO->prepare($clientes);
$sentencia->execute();

$resultado = $sentencia->fetchAll();

$clientes_x_pagina = 8;

//contar articulos de nuestra base de datos

$total_clientes_db = $sentencia->rowCount();
$paginas = $total_clientes_db / 8;
$paginas = ceil($paginas);

$_POST['campo'] = '';

?>


<div class="contenido-admin">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <h1 style="text-align: center;">Clientes</h1>
            <div class="action-crear-search">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    + Crear
                </button>

                <form class="d-flex" role="search2" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="campo" id="campo">
                    <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tipo de usuario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <?php if ($_REQUEST['campo'] == '') { ?>
                    
                    <?php
                    
                    if (!$_GET) {
                        header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/admin/boletos.php?pagina=1');
                    }
                    if ($_GET['pagina'] > $paginas || $_GET['pagina'] <= 0) {
                        header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/admin/boletos.php?pagina=1');
                    }


                    $iniciar = ($_GET['pagina'] - 1) * $clientes_x_pagina;
                    // echo '<h1>'.$iniciar.'</h1>';
                    
                    $sql_clientes = 'SELECT * FROM cliente WHERE idTUsuario IN (2, 3) LIMIT :iniciar,:narticulos ';

                    $sentencia_clientes = $PDO->prepare($sql_clientes);
                    $sentencia_clientes->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
                    $sentencia_clientes->bindParam(':narticulos', $clientes_x_pagina, PDO::PARAM_INT);
                    $sentencia_clientes->execute();

                    $resultado_clientes = $sentencia_clientes->fetchAll();
                    foreach ($resultado_clientes as $clientes) : ?>
                    
                        <tr>
                            
                            <?php $querycliente = 'SELECT * FROM cliente WHERE idCliente =' . $clientes['idCliente'];
                            $cliente = mysqli_query($conexion, $querycliente);
                            $row_cliente = mysqli_fetch_assoc($cliente); ?>
                            <th scope="row"><?php echo $row_cliente['nombre'] ?> <?php echo $row_cliente['apellidos'] ?></th>
                            <th scope="row"><?php echo $clientes['email'] ?></th>
                            <?php 

                            $queryTUsuario = 'SELECT * FROM tipousuario WHERE idTUsuario =' . $clientes['idTUsuario'];
                            $TUsuario = mysqli_query($conexion, $queryTUsuario);
                            $row_TUsuario = mysqli_fetch_assoc($TUsuario);
                            
                            ?>
                            <th scope="row"><?php echo $row_TUsuario['nombreUsuario'] ?></th>
                            <td>
                                <a class="btn btn-success" href="<?= base_url ?>admin/operaciones/modificar_cliente.php?operacion=<?php echo $clientes['idCliente']; ?>"><i class="bi bi-pencil-square"></i></a>
                                <a class="btn btn-danger" href="<?= base_url ?>admin/boletos.php?pagina=<?php echo $_GET['pagina'] ?>&N_Operacion=<?php echo $clientes['idCliente']; ?>"><i class="bi bi-trash"></i></a>
                                <a class="btn btn-primary" href="<?= base_url ?>admin/operaciones/consulta_cliente.php?operacion=<?php echo $clientes['idCliente']; ?>"><i class="bi bi-search"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                    <?php } elseif ($_REQUEST['campo'] != '') {?>
                        <script>console.log("Funcionando");</script>
                        <tbody class="table-group-divider" id="content">
                         <!-- El id del cuerpo de la tabla.  -->
                    </tbody>
                    <?php }else{ ?>
                        
                        <tbody class="table-group-divider" id="content">
                         <!-- El id del cuerpo de la tabla.  -->
                    </tbody>
                    
        <?php } ?>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= base_url ?>admin/Clientes.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Previous</a>
                </li>

                <?php for ($i = 0; $i < $paginas; $i++) : ?>
                    <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="<?= base_url ?>admin/Clientes.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                <?php endfor ?>

                <li class=" page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                    <a class=" page-link" href="<?= base_url ?>admin/Clientes.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
        </div>
    </div>
</div>

<script>
    /* Llamando a la función getData() */
    getData()
    /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
    document.getElementById("campo").addEventListener("keyup", getData)
    /* Peticion AJAX */
    function getData() {
        let input = document.getElementById("campo").value
        let content2 = document.getElementById("content")
        let url = "operaciones/search_clientes.php"
        let formaData = new FormData()
        formaData.append('campo', input)
        fetch(url, {
                method: "POST",
                body: formaData
            }).then(response => response.json())
            .then(data => {
                content2.innerHTML = data
            }).catch(err => console.log(err))
    }
</script>

<?php

if ($_GET['N_Operacion']) {
    $eliminar_boleto = $_GET['N_Operacion'];


    $eliminar_boleto_DB = "DELETE FROM `clientes` WHERE N_Operacion =" . $eliminar_boleto;
    $eliminar_boleto_DB = mysqli_query($conexion, $eliminar_boleto_DB);
    if ($eliminar_boleto_DB) {
        echo "'<script>Swal.fire(
            'Success',
            'Se ha eliminado correctamente el boleto',
            'success'
          )</script>'";
    } else {
        echo "'<script>Swal.fire(
            'Success',
            'Hubo un error al eliminar el boleto',
            'error'
          )</script>'";
    }
}

?>


<?php include_once '../includes/footer.php';
