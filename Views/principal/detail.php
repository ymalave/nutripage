<?php include_once 'Views/template/header-principal.php'; ?>

<!-- Inicio del diseño del detalle de los productos -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <!-- Imagen del producto -->
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="<?php echo BASE_URL . $data['producto']['imagen']; ?>" alt="Card image cap" id="product-detail">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <!-- Muestra el nombre y el precio del producto -->
                        <h1 class="h2"><?php echo $data['producto']['nombre']; ?></h1>
                        <!-- Muestra la categoria del producto -->
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Categoria</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?php echo $data['producto']['categoria']; ?></strong></p>
                            </li>
                        </ul>
                        <!-- Muestra la descripción del producto -->
                        <?php 
                            $recipe = file_get_contents($data['producto']['receta']);
                            echo $recipe;
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fin del diseño del detalle de los productos -->

<!-- Inicio del diseño de los productos relacionados -->
<section class="py-5">
    <div class="container">
        <div class="row text-left p-2 pb-3">
            <h4>Productos relacionados</h4>
        </div>

        <!-- Carrusel de productos relacionados -->
        <div id="carousel-related-product">
            <?php foreach ($data['relacionados'] as $producto) { ?>
                <div class="p-2 pb-3">
                    <div class="product-wap card rounded-0">
                        <div class="card rounded-0">
                            <!-- Muestra las imagenes de los productos relacionados-->
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
                            <!-- Muestra el nombre de los productos relacionados -->
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
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Fin del diseño de los productos relacionados -->

<?php include_once 'Views/template/footer-principal.php'; ?>

<script src="<?php echo BASE_URL; ?>assets/js/modulos/detail.js"></script>
<!-- Start Slider Script -->
<script src="<?php echo BASE_URL; ?>assets/css/slick/slick.min.js"></script>
<script>
    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            }
        ]
    });
</script>
<!-- End Slider Script -->

</body>

</html>