<!-- Conecta con el header del diseño para los administradores -->
<?php include_once 'Views/template/header-admin.php'; ?>

<!-- Boton para agregar usuario nuevo -->
<button class="btn btn-primary mb-2" type="button" id="nuevo_registro">Nuevo</button>

<!-- diseño de tabla para mostrar los usuarios registrados -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" style="width: 100%;" id="tblUsuarios">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Foto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para registrar usuarios nuevos -->
<div id="nuevoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="titleModal"></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="frmRegistro">
                <!-- Campos para el registro de los datos del nuevo usuario -->
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-2">
                        <label for="nombre">Nombres</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombres">
                    </div>
                    <div class="form-group mb-2">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" class="form-control" type="text" name="apellido" placeholder="Apellidos">
                    </div>
                    <div class="form-group mb-2">
                        <label for="correo">Correo electrónico</label>
                        <input id="correo" class="form-control" type="email" name="correo" placeholder="Correo electrónico">
                    </div>
                    <div class="form-group mb-2">
                        <label for="clave">Contraseña</label>
                        <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                    </div>
                </div>
                <!-- Boton para registrar al usuario nuevo -->
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Conecta con el footer del diseño para los administradores -->
<?php include_once 'Views/template/footer-admin.php'; ?>

<!-- Start scripts -->
<script src="<?php echo BASE_URL . 'assets/js/modulos/usuarios.js'; ?>"></script>
<!-- End scripts -->

</body>

</html>