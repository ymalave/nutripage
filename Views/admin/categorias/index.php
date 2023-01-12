<!-- Conecta con el header del diseño para los administradores -->
<?php include_once 'Views/template/header-admin.php'; ?>

<!-- Boton para agregar categoria nueva -->
<button class="btn btn-primary mb-2" type="button" id="nuevo_registro">Nuevo</button>

<!-- diseño de tabla para mostrar las categorias registradas -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblCategorias">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para registrar categorias nuevas -->
<div id="nuevoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="titleModal"></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="frmRegistro">
                <!-- Campos para el registro de las categorias nuevas -->
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="imagen_actual" name="imagen_actual">
                    <div class="form-group mb-2">
                        <label for="categoria">Nombre</label>
                        <input id="categoria" class="form-control" type="text" name="categoria" placeholder="Categorias">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen (opcional)</label>
                        <input id="imagen" class="form-control" type="file" name="imagen">
                    </div>
                </div>
                <!-- Boton para registrar la categoria nueva -->
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
<script src="<?php echo BASE_URL . 'assets/js/modulos/categorias.js'; ?>"></script>
<!-- End scripts -->

</body>

</html>