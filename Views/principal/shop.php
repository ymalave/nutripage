<?php include_once 'Views/template/header-principal.php'; ?>

<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <!-- Muestra todos los productos en el catalogo -->
                <?php foreach ($data['productos'] as $producto) { ?>
                    <div class="col-md-3">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <!-- Muestra las imagenes de los productos en el catalogo -->
                                <img class="card-img rounded-0 img-fluid" src="<?php echo BASE_URL . $producto['imagen']; ?>">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <!-- Muestra la informacion del producto al tocar el icono de ojito -->
                                        <li>
                                            <a class="btn btn-util text-white mt-2" href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>">
                                            <i class="fas fa-eye"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Muestra los nombres de los productos en el catalogo -->
                                <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>" class="h3 text-decoration-none"><?php echo $producto['nombre']; ?></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <!-- Muestra el precio de los productos en el catalogo -->
                                <p class="mb-0">Categoria: <?=$producto['categoria']?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- Paginador del catalogo -->
            <div div="row">
                <ul class="pagination pagination-lg justify-content-end">
                    <!-- Le da funcionamiento a los botones de anterior y siguiente del paginador-->
                    <?php
                    $anterior =  $data['pagina'] - 1;
                    $siguiente =  $data['pagina'] + 1;
                    $url = BASE_URL . 'principal/shop/';
                    if ($data['pagina'] > 1) {
                        echo '<li class="page-item">
                                    <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="' . $url . $anterior . '"
                                        >Anterior</a>
                                </li>';
                    }
                    if ($data['total'] >= $siguiente) {
                        echo '<li class="page-item">
                                    <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-white"
                                        href="' . $url . $siguiente . '">Siguiente</a>
                                </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->

<?php include_once 'Views/template/footer-principal.php'; ?>

</body>

</html>