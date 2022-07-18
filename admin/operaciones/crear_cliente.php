<?php

$queryTUsuario = "SELECT * FROM tipousuario WHERE idTUsuario IN (2, 3)";
$TUsuario = mysqli_query($conexion, $queryTUsuario);

$queryEscuela = "SELECT * FROM escuelas";
$Escuelas = mysqli_query($conexion, $queryEscuela);


?>

<div class="modal modal-xl fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Crear cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" id="crear-cliente" novalidate>
                    <div class="col-md-4">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nombre">
                    </div>
                    <div class="col-md-4">
                        <label for="exampleInputEmail1" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="apellidos">
                    </div>
                    <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" name="fechaNac">
                </div>
                <div class=" col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Tipo de Usuario</label>
                        <select name="TUsuario" id="" class="form-select" aria-label="Default select example">
                            <option value="0">Seleccionar...</option>
                            <?php while ($row_TUsuario = mysqli_fetch_assoc($TUsuario)) { ?>
                                <option value="<?php echo $row_TUsuario['idTUsuario'] ?>"><?php echo $row_TUsuario['nombreUsuario'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="email">
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="phone">
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="direccion">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputPassword1" class="form-label">Codigo Postal</label>
                        <input name="cp" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputPassword1" class="form-label">Numero Exterior</label>
                        <input name="numExt" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputPassword1" class="form-label">Numero Interior</label>
                        <input name="numInt" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputPassword1" class="form-label">Municipio</label>
                        <input name="municipio" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputPassword1" class="form-label">Unidad Academica</label>
                        <select name="escuela" class="form-select" aria-label="Default select example">
                            <option value="NULL">Seleccionar...</option>
                            <?php while ($row_Escuelas = mysqli_fetch_assoc($Escuelas)) { ?>
                                <option value="<?php echo $row_Escuelas['idEscuela'] ?>"><?php echo $row_Escuelas['Nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>

                    <div class="col-md-3" style="display: flex; flex-wrap: wrap; flex-direction: column; align-items: stretch; justify-content: center; align-content: center;">
                        <label for="exampleInputPassword1" class="form-label">Sexo</label>
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
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Warning!</strong> Si el cliente no es estudiante no seleccione una unidad academica
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <div class="col-12" style="text-align: center;">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>