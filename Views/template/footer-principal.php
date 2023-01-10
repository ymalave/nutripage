<!-- Inicio del diseño de ventana del carrito de compras-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="fas fa-cart-arrow-down"></i> Carrito de compras</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middle" id="tableListaCarrito">
            <thead>
              <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Boton para comprar los productos del carrito-->
      <div class="d-flex justify-content-around mb-3">
        <h3 id="totalGeneral"></h3>
        <!-- Si se ha iniciado sesión muestra el boton de procesar pedido-->
        <!-- Caso contrario muestra un boton de iniciar sesión -->
        <?php if (!empty($_SESSION['correoCliente'])) { ?>
          <a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'clientes'; ?>">Procesar pedido</a>
        <?php } else{ ?>
          <a class="btn btn-outline-primary" href="#" onclick="abrirModalLogin();">Iniciar sesión</a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- Fin del diseño de ventana del carrito de compras -->

<!-- Inicio del diseño del login para clientes -->
<div id="modalLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="titleLogin">Bienvenido</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body m-3">
        <form method="get" action="">
          <!-- Icono del formulario de inicio de sesión y registro -->
          <div class="text-center">
            <img class="img-thumbnail rounded-circle" src="<?php echo BASE_URL . 'assets/images/logo.png'; ?>" alt="" width="150">
          </div>
          <div class="row">
            <!-- Formulario de inicio de sesión -->
            <div class="col-md-12" id="frmLogin">
              <div class="form-group mb-3">
                <label for="correoLogin"><i class="fas fa-envelope"></i> Correo electrónico</label>
                <input id="correoLogin" class="form-control" type="email" name="correoLogin" placeholder="Correo electrónico">
              </div>
              <div class="form-group mb-3">
                <label for="claveLogin"><i class="fas fa-key"></i> Contraseña</label>
                <input id="claveLogin" class="form-control" type="password" name="claveLogin" placeholder="Contraseña">
              </div>
              <a href="#" id="btnRegister">¿Aún no te has registrado?</a>
              <!-- Boton del formulario para iniciar sesión-->
              <div class="float-end">
                <button class="btn btn-primary btn-lg" type="button" id="login">Iniciar sesión</button>
              </div>
            </div>
            <!-- Formulario de registro -->
            <div class="col-md-12 d-none" id="frmRegister">
              <div class="form-group mb-3">
                <label for="nombreRegistro"><i class="fas fa-list"></i> Nombre</label>
                <input id="nombreRegistro" class="form-control" type="text" name="nombreRegistro" placeholder="Nombre completo">
              </div>
              <div class="form-group mb-3">
                <label for="correoRegistro"><i class="fas fa-envelope"></i> Correo electrónico</label>
                <input id="correoRegistro" class="form-control" type="email" name="correoRegistro" placeholder="Correo electrónico">
              </div>
              <div class="form-group mb-3">
                <label for="claveRegistro"><i class="fas fa-key"></i> Contraseña</label>
                <input id="claveRegistro" class="form-control" type="password" name="claveRegistro" placeholder="Contraseña">
              </div>
              <a href="#" id="btnLogin">¿Ya tienes una cuenta?</a>
              <!-- Boton del formulario para registrarse-->
              <div class="float-end">
                <button class="btn btn-primary btn-lg" type="button" id="registrarse">Registrarse</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Fin del diseño del login para clientes -->

<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
  <div class="container">
    <div class="row">

      <div class="col-md-4 pt-5">
        <h2 class="h2 text-util border-bottom pb-3 border-light logo">Ubícanos</h2>
        <ul class="list-unstyled text-light footer-link-list">
          <li>
            <i class="fas fa-map-marker-alt fa-fw"></i>
            123 Consectetur at ligula 10660
          </li>
          <li>
            <i class="fa fa-phone fa-fw"></i>
            <a class="text-decoration-none" href="tel:010-020-0340">0426 3941802</a>
          </li>
          <li>
            <i class="fa fa-envelope fa-fw"></i>
            <a class="text-decoration-none" href="mailto:info@company.com">ad.atencionalcliente@gmail.com</a>
          </li>
        </ul>
      </div>

      <div class="col-md-4 pt-5">
        <h2 class="h2 text-light border-bottom pb-3 border-light">Nuestros productos</h2>
        <ul class="list-unstyled text-light footer-link-list">
          <li><a class="text-decoration-none" href="#">Agua</a></li>
          <li><a class="text-decoration-none" href="#">Detergentes</a></li>
          <li><a class="text-decoration-none" href="#">Envases</a></li>
        </ul>
      </div>

      <div class="col-md-4 pt-5">
        <h2 class="h2 text-light border-bottom pb-3 border-light"> Para más información</h2>
        <ul class="list-unstyled text-light footer-link-list">
          <li><a class="text-decoration-none" href="#">Sobre nosotros</a></li>
          <li><a class="text-decoration-none" href="#">Contactos</a></li>
        </ul>
      </div>
    </div>

    <div class="row text-light mb-4">
      <div class="col-12 mb-3">
        <div class="w-100 my-3 border-top border-light"></div>
      </div>
      <div class="col-auto me-auto">
        <ul class="list-inline text-left footer-icons">
          <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
          </li>
          <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
          </li>
          <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
          </li>
          <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-auto">
        <label class="sr-only" for="subscribeEmail">Correo electrónico</label>
        <div class="input-group mb-2">
          <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Correo electrónico">
          <div class="input-group-text btn-util text-light">Subscribirse</div>
        </div>
      </div>
    </div>
  </div>

  <div class="w-100 bg-black py-3">
    <div class="container">
      <div class="row pt-2">
        <div class="col-12">
          <p class="text-left text-light">
            Copyright &copy; 2022 A&D
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer -->

<!-- Start Script -->
<script src="<?php echo BASE_URL; ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/templatemo.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/all.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>
<script>
  const base_url = '<?php echo BASE_URL; ?>';
</script>
<script src="<?php echo BASE_URL; ?>assets/js/carrito.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/login.js"></script>
<!-- End Script -->