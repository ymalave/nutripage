<!-- Conecta con el header del diseño para los administradores -->
<?php include_once 'Views/template/header-admin.php'; ?>

<!-- Tabs para mostrar y registrar los productos -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listaProducto" type="button" role="tab" aria-controls="listaProducto" aria-selected="true">Productos</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nuevoProducto" type="button" role="tab" aria-controls="nuevoProducto" aria-selected="false">Nuevo</button>
    </li>
</ul>
<!-- Contenido de los tabs para mostrar y registrar los productos -->
<div class="tab-content" id="myTabContent">
    <!-- diseño de tabla para mostrar los productos registrados -->
    <div class="tab-pane fade show active" id="listaProducto" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblProductos">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
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
    </div>
    <!-- diseño de formulario para registrar y editar productos -->
    <div class="tab-pane fade" id="nuevoProducto" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <div class="card">
            <div class="card-body p-5">
                <form id="frmRegistro">
                    <!-- Campos para el registro de los productos nuevos -->
                    <div class="row">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="imagen_actual" name="imagen_actual">
                        <!-- Permite ingresar el nombre del producto -->
                        <div class="col-md-5">
                            <div class="form-group mb-2">
                                <label for="nombre">Título</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del producto">
                            </div>
                        </div>
                        <!-- Permite ingresar el precio del producto -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio">
                            </div>
                        </div>
                        <!-- Permite ingresar la cantidad del producto -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                        <!-- Muestra todas las categorias en una lista seleccionable -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select id="categoria" class="form-control" name="categoria">
                                    <option value="">Seleccione una opción</option>
                                    <?php foreach ($data['categorias'] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Permite ingresar una descripción del producto -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" class="form-control" name="descripcion" rows="3" placeholder="Descripción del producto"></textarea>
                            </div>
                        </div>
                        <!-- Permite ingresar una imagen del producto -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagen">Imagen (opcional)</label>
                                <input id="imagen" class="form-control" type="file" name="imagen">
                            </div>
                        </div>
                    </div>
                    <!-- Boton para registrar los productos nuevos -->
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Conecta con el footer del diseño para los administradores -->
<?php include_once 'Views/template/footer-admin.php'; ?>

<!-- Start scripts -->
<script src="<?php echo BASE_URL . 'assets/js/modulos/productos.js'; ?>"></script>
<!-- End scripts -->

</body>

</html>