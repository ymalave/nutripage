<!-- Conecta con el header del diseño para los administradores -->
<?php include_once 'Views/template/header-admin.php'; ?>
<!-- Estadisticas de los pedidos -->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <!-- total de pedidos pendientes -->
    <div class="col-md-3">
        <div class="card radius-10 border-start border-0 border-3 border-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Pedidos pendientes</p>
                        <h4 class="my-1 text-warning"><?php echo $data['pendientes']['total']; ?></h4>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='fas fa-exclamation-circle'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- total de pedidos por procesar -->
    <div class="col-md-3">
        <div class="card radius-10 border-start border-0 border-3 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Pedidos por procesar</p>
                        <h4 class="my-1 text-danger"><?php echo $data['proceso']['total']; ?></h4>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='fas fa-spinner'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- total de pedidos completados -->
    <div class="col-md-3">
        <div class="card radius-10 border-start border-0 border-3 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Pedidos completados</p>
                        <h4 class="my-1 text-success"><?php echo $data['completados']['total']; ?></h4>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='fas fa-check-circle'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- total de productos -->
    <div class="col-md-3">
        <div class="card radius-10 border-start border-0 border-3 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total de productos</p>
                        <h4 class="my-1 text-info"><?php echo $data['productos']['total']; ?></h4>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='fas fa-box'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- graficos de las estadisticas -->
<div class="row">
    <!-- grafico de los pedidos -->
    <div class="col-12 col-lg-4">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Pedidos</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-2 mt-4">
                    <canvas id="reportePedidos"></canvas>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pendientes <span class="badge bg-warning rounded-pill"><?php echo $data['pendientes']['total']; ?></span>
                </li>
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Por procesar <span class="badge bg-danger rounded-pill"><?php echo $data['proceso']['total']; ?></span>
                </li>
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Completados <span class="badge bg-success rounded-pill"><?php echo $data['completados']['total']; ?></span>
                </li>
            </ul>
        </div>
    </div>
    <!-- grafico de los productos con stock minimo -->
    <div class="col-12 col-lg-4">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Productos con stock mínimo</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="chart4"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- grafico de los productos mas vendidos -->
    <div class="col-12 col-lg-4">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Productos mas vendidos</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="topProductos"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Conecta con el footer del diseño para los administradores -->
<?php include_once 'Views/template/footer-admin.php'; ?>

<!-- start script  -->
<!-- reporte de pedidos, permite que el grafico funcione y muestre las estadisticas -->
<script>
    var ctx = document.getElementById("reportePedidos").getContext('2d');

    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, '#FFD24D');
    gradientStroke1.addColorStop(1, '#ffc107');

    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, '#F47385');
    gradientStroke2.addColorStop(1, '#fd3550');

    var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke3.addColorStop(0, '#42e695');
    gradientStroke3.addColorStop(1, '#15ca20');

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Pendientes", "Por procesar", "Completados"],
            datasets: [{
                backgroundColor: [
                    gradientStroke1,
                    gradientStroke2,
                    gradientStroke3
                ],
                hoverBackgroundColor: [
                    gradientStroke1,
                    gradientStroke2,
                    gradientStroke3
                ],
                data: [<?php echo $data['pendientes']['total']; ?>, 
                        <?php echo $data['proceso']['total']; ?>, 
                        <?php echo $data['completados']['total']; ?>],
                borderWidth: [1, 1, 1]
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 75,
            legend: {
                position: 'bottom',
                display: false,
                labels: {
                    boxWidth: 8
                }
            },
            tooltips: {
                displayColors: false,
            }
        }
    });
</script>
<script src="<?php echo BASE_URL; ?>assets/js/index.js"></script>
<!-- end script -->
</body>

</html>