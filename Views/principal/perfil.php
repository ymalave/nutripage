<?php include_once 'Views/template/header-principal.php'; ?>

<!-- Start Content -->
<div class="container py-5">
    <!-- Muestra el perfil si el correo ha sido verificado, caso contrario un mensaje -->
    <?php if ($data['verificar']['verify'] == 1) { ?>
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Por pagar</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pendientes-tab" data-bs-toggle="tab" data-bs-target="#pendientes-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Pedidos</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Muestra las compras por pagar -->
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="row">
                    <!-- tabla de productos añadidos al carrito de la cuenta -->
                    <div class="col-md-8">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover align-middle" id="tableListaProductos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
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
                            <div class="card-footer text-end">
                                <h3 id="totalProducto"></h3>
                            </div>
                        </div>
                    </div>
                    <!-- Muestra información de la cuenta del cliente -->
                    <div class="col-md-4">
                        <div class="card shadow-lg">
                            <!-- Permite al cliente cerrar su sesión -->
                            <div class="dropdown" style="padding: 3px;">
                                <a class="nav-link dropdown-toggle float-end" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'clientes/salir'; ?>"><i class="fas fa-times-circle"></i> Cerrar sesión</a></li>
                                </ul>
                            </div>
                            <div class="card-body text-center">
                                <!-- Muestra la foto de perfil de la sesión del cliente -->
                                <img class="img-thumbnail rounded-circle" src="<?php echo BASE_URL . 'assets/images/logo.png'; ?>" alt="" width="150">
                                <hr>
                                <!-- Muestra el nombre y el correo de la sesión del cliente -->
                                <p><?php echo $_SESSION['nombreCliente']; ?></p>
                                <p><i class="fas fa-envelope"></i> <?php echo $_SESSION['correoCliente']; ?></p>
                                <div class="accordion" id="accordionExample">
                                    <!-- Metodos de pago -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                Métodos de pago
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="d-grid gap-2">
                                                    <!-- Pago movil -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPagoMovil">
                                                        Pago móvil
                                                    </button>
                                                    <!-- Transferencia -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTrans">
                                                        Transferencia
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Pago con paypal -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Otros métodos de pago
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Muestra los pedidos -->
            <div class="tab-pane fade" id="pendientes-tab-pane" role="tabpanel" aria-labelledby="pendientes-tab" tabindex="0">
                <div class="col-12">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="table responsive">
                                <table class="table table-bordered table-striped table hover" id="tblPendientes" style="width: 100%;">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
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
        </div>
    <?php } else { ?>
        <!-- Mensaje que señala que el cliente debe verificar el correo-->
        <div class="alert alert-danger text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div class="h3">
                ¡Verifica tu correo electrónico!
            </div>
        </div>
    <?php } ?>
</div>
<!-- End Content -->

<!-- Diseño de modal para ver el detalle de los pagos pendientes -->
<div id="modalPedido" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Estado del pedido</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Para mostrar que el pedido ha sido pagado -->
                    <div class="col-md-6 col-lg-4 pb-5">
                        <div class="h-100 py-5 shadow" id="estadoEnviado">
                            <div class="h1 text-util text-center"><i class="fa fa-truck fa-lg"></i></div>
                            <h2 class="h5 mt-4 text-center">Pagado</h2>
                        </div>
                    </div>
                    <!-- Para mostrar que el pedido esta en proceso -->
                    <div class="col-md-6 col-lg-4 pb-5">
                        <div class="h-100 py-5 shadow" id="estadoProceso">
                            <div class="h1 text-util text-center"><i class="fa fa-exchange-alt"></i></div>
                            <h2 class="h5 mt-4 text-center">En proceso</h2>
                        </div>
                    </div>
                    <!-- Para mostrar que el pedido ha sido completado -->
                    <div class="col-md-6 col-lg-4 pb-5">
                        <div class="h-100 py-5 shadow" id="estadoCompletado">
                            <div class="h1 text-util text-center"><i class="fa fa-percent"></i></div>
                            <h2 class="h5 mt-4 text-center">Completado</h2>
                        </div>
                    </div>
                    <!-- tabla que muestra el detalle del pedido seleccionado -->
                    <div class="col-md-12">
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
    </div>
</div>
<!-- Fin del diseño del modal -->

<!-- Inicio del diseño de modal para pago movil -->
<div id="modalPagoMovil" class="modal fade" tabindex="-1" role="dialog" 
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-money-bill"></i> Pago móvil</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" action="">
                    <!-- Datos del pago movil -->
                    <div class="card text-bg-light text-center" style="margin-bottom: 16px">
                        <div class="card-body" >
                            <b>Teléfono:</b> 0426 3941802 </br>  
                            <b>Cédula:</b> 24119956 </br>
                            <b>Banco:</b> Banesco 0134
                        </div>
                    </div>
                    <!-- Formulario para insertar datos del pago movil -->
                    <div id="frmPagoMovil">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                Número de referencia
                            </span>
                            <input id="referencia" type="number" class="form-control" 
                            placeholder="Número de referencia">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                Monto
                            </span>
                            <input id="monto" type="number" class="form-control" 
                            placeholder="Número de referencia">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                Fecha
                            </span>
                            <input id="fecha" type="date" class="form-control" 
                            placeholder="Número de referencia">
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary btn-lg" type="button" 
                                id="btnRegistrarPago">Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del diseño de modal para pago movil -->

<!-- Inicio del diseño de modal para transferencia -->
<div id="modalTrans" class="modal fade" tabindex="-1" role="dialog" 
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-money-bill"></i> Transferencia</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="get" action="">
                <!-- Datos para la transferencia -->
                <div class="card text-bg-light text-center" style="margin-bottom: 16px">
                    <div class="card-body" >
                        <b>Cuenta:</b> 01340567105673022463 </br>  
                        <b>Cédula:</b> 24119956 </br>
                        <b>Banco:</b> Banesco 0134
                    </div>
                </div>
                <!-- Formulario para insertar datos del pago movil -->
                <div id="frmTrans">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="referencia">
                            Número de referencia
                        </span>
                        <input id="reference" type="number" class="form-control" 
                            placeholder="Número de referencia">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="referencia">
                            Monto
                        </span>
                        <input id="amount" type="number" class="form-control" 
                            placeholder="Monto">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="referencia">
                            Fecha
                        </span>
                        <input id="date" type="date" class="form-control" 
                            placeholder="Número de referencia">
                    </div>
                    <div class="float-end">
                        <button class="btn btn-primary btn-lg" type="button" 
                            id="btnRegistrarTrans">Registrar
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del diseño de modal para transferencia -->

<?php include_once 'Views/template/footer-principal.php'; ?>

<!-- Start Slider Script -->
<script type="text/javascript" src="<?php echo BASE_URL . 'assets/DataTables/datatables.min.js'; ?>"></script>
<script src="<?php echo BASE_URL; ?>assets/js/es-ES.js"></script>
<script src="<?php echo BASE_URL . 'assets/js/clientes.js'; ?>"></script>
<!-- End Slider Script -->

</body>

</html>