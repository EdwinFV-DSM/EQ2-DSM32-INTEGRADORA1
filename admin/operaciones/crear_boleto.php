<?php

$querycliente = 'SELECT * FROM cliente';
$cliente = mysqli_query($conexion, $querycliente);

/**Consulta a la tabla de rutas */

$queryrutas = 'SELECT * FROM rutas';
$rutas = mysqli_query($conexion, $queryrutas);


$queryhorarios = 'SELECT * FROM horarios';
$horarios = mysqli_query($conexion, $queryhorarios);


?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Boleto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="reload()"></button>
            </div>
            <div class="modal-body">
                <form id="crear-boleto">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cliente</label>
                        <select name="cliente" class="form-select" aria-label="Default select example">
                            <option value="" selected>Cliente</option>
                            <?php while ($row_cliente = mysqli_fetch_assoc($cliente)) { ?>
                                <option value="<?php echo $row_cliente['idCliente'] ?>"><?php echo $row_cliente['nombre'] ?> <?php echo $row_cliente['apellidos'] ?></option>
                            <?php }
                            mysqli_free_result($cliente); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Fecha de Creacion</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" name="fechaC">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" name="fechaV">
                    </div>
                    <div class="mb-3">
                        <select name="ruta" class="form-select" aria-label="Default select example">
                            <option value="" selected>Ruta</option>
                            <?php while ($row_cliente = mysqli_fetch_assoc($rutas)) { ?>
                                <option value="<?php echo $row_cliente['idRuta'] ?>"><?php echo $row_cliente['nombre'] ?></option>
                            <?php }
                            mysqli_free_result($rutas); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="horario" class="form-select" aria-label="Default select example">
                            <option value="" selected>Horario</option>
                            <?php while ($row_horarios = mysqli_fetch_assoc($horarios)) { ?>
                                <option value="<?php echo $row_horarios['idHorario'] ?>"><?php echo $row_horarios['TiempoE'] ?></option>
                            <?php }
                            mysqli_free_result($horarios); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Costo</label>
                        <input type="num" class="form-control" id="exampleInputPassword1" name="costo">
                    </div>                    
                    <div class="mb-3">
                        <?php $suma = 0;
                        for ($i = 0; $i < 55; $i++) {
                            $aleatorio = rand(1, 10000);
                            // echo $aleatorio;
                            $suma = $aleatorio + $suma;
                        }
                        ?>
                        
                        <label for="exampleInputPassword1" class="form-label">No. Operacion</label>
                        <input name="operacion" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $suma ?>"readonly >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>