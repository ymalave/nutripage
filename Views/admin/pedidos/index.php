<!-- Conecta con el header del diseño para los administradores -->
<?php include_once 'Views/template/header-admin.php'; ?>

<!-- Tabs para mostrar los pedidos pendientes, por procesar y completados -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#pedidosPendientes" type="button" role="tab" aria-controls="pedidosPendientes" aria-selected="true">Pendientes</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="proceso-tab" data-bs-toggle="tab" data-bs-target="#pedidosProceso" type="button" role="tab" aria-controls="pedidosProceso" aria-selected="false">Por procesar</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pedidosCompletados" type="button" role="tab" aria-controls="pedidosCompletados" aria-selected="false">Completados</button>
    </li>
</ul>
<!-- Contenido de los tabs para mostrar los pedidos -->
<div class="tab-content" id="myTabContent">
    <!-- diseño de tabla para mostrar los pedidos pendientes-->
    <div class="tab-pane fade show active" id="pedidosPendientes" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblPendientes">
                        <thead class="thead-light">
                            <tr>
                                <th>Tipo de pago</th>
                                <th>ID Transacción</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Correo</th>
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
    <!-- diseño de tabla para mostrar los pedidos por procesar-->
    <div class="tab-pane fade" id="pedidosProceso" role="tabpanel" aria-labelledby="proceso-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblProceso">
                        <thead class="thead-light">
                            <tr>
                                <th>Tipo de pago</th>
                                <th>ID Transacción</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Correo</th>
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
    <!-- diseño de tabla para mostrar los pedidos completados -->
    <div class="tab-pane fade" id="pedidosCompletados" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblCompletados">
                        <thead class="thead-light">
                            <tr>
                                <th>Tipo de pago</th>
                                <th>ID Transacción</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Correo</th>
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
</div>

<!-- Modal que permite ver el detalle de los pedidos -->
<div id="modalPedidos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-white" id="my-modal-title">Productos</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <!-- tabla que muestra el detalle del pedido seleccionado -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="tablePedidos" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Conecta con el footer del diseño para los administradores -->
<?php include_once 'Views/template/footer-admin.php'; ?>

<!-- Start scripts -->
<script src="<?php echo BASE_URL . 'assets/js/modulos/pedidos.js'; ?>"></script>
<!-- End scripts -->

</body>

</html>