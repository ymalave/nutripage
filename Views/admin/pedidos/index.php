<!-- Conecta con el header del diseño para los administradores -->
<?php include_once 'Views/template/header-admin.php'; ?>

<!-- Tabs para mostrar los pedidos pendientes y completados -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#pedidosPendientes" type="button" role="tab" aria-controls="pedidosPendientes" aria-selected="true">Pendientes</button>
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
                                <th>ID Transacción</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Correo</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Dirección</th>
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
                                <th>ID Transacción</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Correo</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Dirección</th>
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

<!-- Conecta con el footer del diseño para los administradores -->
<?php include_once 'Views/template/footer-admin.php'; ?>

<!-- Start scripts -->
<script src="<?php echo BASE_URL . 'assets/js/modulos/pedidos.js'; ?>"></script>
<!-- End scripts -->

</body>

</html>