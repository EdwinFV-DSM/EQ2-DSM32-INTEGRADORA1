<?php

$queryTUsuario = "SELECT * FROM tipousuario WHERE idTUsuario IN (2, 3)";
$TUsuario = mysqli_query($conexion, $queryTUsuario);

$queryEscuela = "SELECT * FROM escuelas";
$Escuelas = mysqli_query($conexion, $queryEscuela);


?>

<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Crear Escuela</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" id="crear-escuela" novalidate enctype="multipart/form-data">
                    <div class="col-md-15">
                        <label for="exampleInputEmail1" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="exampleInputPassword1" name="imagen">
                    </div>                    
                    <div class="col-md-15">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nombre">
                    </div>
                    <div class="col-md-15">
                        <label for="exampleInputPassword1" class="form-label">Direccion</label>
                        <textarea name="direccion" id="" class="form-control" cols="30" rows="3"></textarea>
                    </div>
                    <div class="col-md-15">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputPassword1" name="email">
                    </div>
                    <div class="col-md-15">
                        <label for="exampleInputEmail1" class="form-label">Pasword</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="col-12" style="text-align: center;">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>