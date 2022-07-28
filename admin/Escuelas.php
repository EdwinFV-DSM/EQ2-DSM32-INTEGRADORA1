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

$escuela = 'SELECT * FROM escuelas';
$sentencia = $PDO->prepare($escuela);
$sentencia->execute();

$resultado = $sentencia->fetchAll();

$escuela_x_pagina = 8;

//contar articulos de nuestra base de datos

$total_escuela_db = $sentencia->rowCount();
$paginas = $total_escuela_db / 8;
$paginas = ceil($paginas);

$_POST['campo'] = '';

?>


<div class="contenido-admin">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <h1 style="text-align: center;">Escuelas</h1>
            
            <div class="action-crear-search">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                    + Crear
                </button>                

                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="campo" id="campo">
                    <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>                    
                </form>                
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <!-- En este apartado empieza la parte donde se hace el paginado y se valida que el campo que es el input de busqueda no este lleno  -->
                <?php if ($_REQUEST['campo'] == '') { ?>
                    
                    <?php
                    /**Se valida que si no se esta recibiendo nada por metodo get nos rediriga al apartado que es al apartado de la paginacion */
                    if (!$_GET) {
                        header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/admin/Escuelas.php?pagina=1');
                    }
                    if ($_GET['pagina'] > $paginas || $_GET['pagina'] <= 0) {
                        header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/admin/Escuelas.php?pagina=1');
                    }

                    /** Aqui se realiza una operacion sencilla, esta operacion quiere decir
                     * 
                     * Lo que este recibiendo la variable pagina le voy a resta uno despues lo multiplico por la cantidad de datos que quiero 
                     * mostrar por pantalla.
                     * 
                     * Despues de esa sencilla operacion realizamos una consulta donde usamos limit para limitar los resultados que nos va a retornar la
                     * consulta. las variables :iniciar, :narticulos son metodos de la sentencia PDO, esto para poder estar actualizando la consulta conforme
                     * vamos navegando en el paginado.
                     * 
                     * Despues de realizar la consulta usamos la sentencia execute para poder ejecutar la consulta y poder obtener los datos de la tabla consultada
                     * y todo eso lo extraemos con la palabra reservada fetchAll, y realizamos un foreach para poder mostrar todos los datos.
                     *
                    */

                    $iniciar = ($_GET['pagina'] - 1) * $escuela_x_pagina;
                    // echo '<h1>'.$iniciar.'</h1>';
                    
                    $sql_escuela = 'SELECT * FROM escuelas LIMIT :iniciar,:narticulos';

                    $sentencia_escuela = $PDO->prepare($sql_escuela);
                    $sentencia_escuela->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
                    $sentencia_escuela->bindParam(':narticulos', $escuela_x_pagina, PDO::PARAM_INT);
                    $sentencia_escuela->execute();

                    $resultado_escuela = $sentencia_escuela->fetchAll();
                    foreach ($resultado_escuela as $escuela) : ?>
                    
                        <tr>
                            <th scope="row"><?php echo $escuela['Nombre'] ?></th>
                            <td>
                                <a class="btn btn-success" href="<?= base_url ?>admin/operaciones/modificar_boleto.php?operacion=<?php echo $escuela['idEscuela']; ?>"><i class="bi bi-pencil-square"></i></a>
                                <a class="btn btn-danger" href="<?= base_url ?>admin/Escuelas.php?pagina=<?php echo $_GET['pagina'] ?>&N_Operacion=<?php echo $escuela['idEscuela']; ?>"><i class="bi bi-trash"></i></a>
                                <a class="btn btn-primary" href="<?= base_url ?>admin/operaciones/consulta.php?operacion=<?php echo $escuela['idEscuela']; ?>"><i class="bi bi-search"></i></a>
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
                    <a class="page-link" href="<?= base_url ?>admin/Escuelas.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Previous</a>
                </li>

                <?php for ($i = 0; $i < $paginas; $i++) : ?>
                    <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="<?= base_url ?>admin/Escuelas.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                <?php endfor ?>

                <li class=" page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                    <a class=" page-link" href="<?= base_url ?>admin/Escuelas.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
        </div>
    </div>
</div>

<!-- En este apartado se esta realizando la busqueda en tiempo real de los datos del panel que esta viendo el usuario -->


<script>
    /* Llamando a la función getData() */
    getData()
    /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
    document.getElementById("campo").addEventListener("keyup", getData)
    /* Peticion AJAX */
    function getData() {
        let input = document.getElementById("campo").value
        let content = document.getElementById("content")
        let url = "operaciones/search_escuelas.php"
        let formaData = new FormData()
        formaData.append('campo', input)
        fetch(url, {
                method: "POST",
                body: formaData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }
</script>

<?php
/**
 * 
 * En este codigo se realiza la eliminacion de datos de la tabla obteniedo la variable N_operacion que es la id de los escuela sin
 * esta variable seria nula la eliminacion.
 * 
 * 
 */
if ($_GET['N_Operacion']) {
    $eliminar_boleto = $_GET['N_Operacion'];


    $eliminar_boleto_DB = "DELETE FROM `escuela` WHERE N_Operacion =" . $eliminar_boleto;
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
