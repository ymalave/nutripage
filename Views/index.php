<!-- Conecta con el header del diseño para los clientes -->
<?php include_once 'Views/template/header-principal.php'; ?>

<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
    <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="container">
        <div class="row p-5">
          <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
            <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/images/carrusel/1.png" alt="">
          </div>
          <div class="col-lg-6 mb-0 d-flex align-items-center">
            <div class="text-align-left">
              <h1 class="h1 text-util"><b>¡Tenemos los postres mas ricos y saludables!</b></h1>
              <h3 class="h2">Lorem ipsum dolor sit amet.</h3>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="container">
        <div class="row p-5">
          <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
            <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/images/carrusel/2.jpg" alt="">
          </div>
          <div class="col-lg-6 mb-0 d-flex align-items-center">
            <div class="text-align-left">
              <h1 class="h1 text-util"><b>¡Las mejoes recetas para su comida!</b></h1>
              <h3 class="h2">Aliquip ex ea commodo consequat</h3>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="container">
        <div class="row p-5">
          <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
            <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/images/carrusel/3.png" alt="">
          </div>
          <div class="col-lg-6 mb-0 d-flex align-items-center">
            <div class="text-align-left">
              <h1 class="h1 text-util"><b>¡Consejos sobre vida saludable!</b></h1>
              <h3 class="h2">Ullamco laboris nisi ut </h3>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
    <i class="fa fa-chevron-left"></i>
  </a>
  <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
    <i class="fa fa-chevron-right"></i>
  </a>
</div>
<!-- End Banner Hero -->

<!-- Inicio del diseño de las categorias de productos de la tienda -->
<section class="container py-5">
  <div class="row text-center pt-3">
    <div class="col-lg-6 m-auto">
      <h1 class="h1">Categorías</h1>
      <p>
        ¡Acá puedes encontrar todos nuestros productos separados por categorias!
      </p>
    </div>
  </div>
  <!-- Listar categorias en filas -->
  <div class="row justify-content-center">
    <?php foreach ($data['categorias'] as $categoria) { ?>
      <div class="col-12 col-md-3 p-5 mt-3">
        <!-- Toma las imagenes de las categorias de la bd -->
        <a href="<?php echo BASE_URL . 'principal/categorias/' . $categoria['id']; ?>"><img src="<?php echo $categoria['imagen']; ?>" class="rounded-circle img-fluid border"></a>
        <!-- Toma los tipos de categorias de la bd y las coloca debajo de la imagen-->
        <h5 class="text-center mt-3 mb-3"><?php echo $categoria['categoria']; ?></h5>
      </div>
    <?php } ?>
  </div>
</section>
<!-- Fin de diseño de las categorias -->

<!-- Inicio del diseño de los nuevos productos agregados a la tienda -->
<section class="bg-light">
  <div class="container py-5">
    <div class="row text-center py-3">
      <div class="col-lg-6 m-auto">
        <h1 class="h1">Productos</h1>
        <p>
          ¡Ven, mira lo último que hemos agregado!
        </p>
      </div>
    </div>
    <!-- Listar nuevos productos en filas -->
    <div class="row">
      <?php foreach ($data['nuevoProductos'] as $producto) { ?>
        <div class="col-12 col-md-4 mb-4">
          <div class="card h-100">
            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>">
              <!-- Muestra las imagenes de los nuevos productos y su nombre de la bd -->
              <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
            </a>
            <div class="card-body">
              <ul class="list-unstyled d-flex justify-content-between">
                <li>
                  <i class="text-warning fa fa-star"></i>
                  <i class="text-warning fa fa-star"></i>
                  <i class="text-warning fa fa-star"></i>
                  <i class="text-muted fa fa-star"></i>
                  <i class="text-muted fa fa-star"></i>
                </li>
                
              </ul>
              <!-- Al tocar un producto muestra sus detalles -->
              <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>" class="h2 text-decoration-none text-dark"><?php echo $producto['nombre']; ?></a>
             
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<!-- Fin del diseño de los nuevos productos -->

<!-- Conecta con el footer del diseño para los clientes -->
<?php include_once 'Views/template/footer-principal.php'; ?>

</body>

</html>