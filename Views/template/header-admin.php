<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/favicon/favicon-32x32.png" type="image/png" />
    <link href="<?php echo BASE_URL; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?php echo BASE_URL; ?>assets/css/pace.min.css" rel="stylesheet" />
    <script src="<?php echo BASE_URL; ?>assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/app.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/dark-theme.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/semi-dark.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header-colors.css" />
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/DataTables/datatables.min.css'; ?>">
    <!-- Muestra el titulo de la pagina -->
    <title><?php echo TITLE . ' - ' . $data['title']; ?></title>
</head>

<body>
    <!-- Diseño de la barra de menu lateral -->
    <div class="wrapper">
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="<?php echo BASE_URL; ?>assets/images/logo2.png" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h5 class="logo-text">Administración</h5>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
            </div>
            <!-- Navegación de la barra de menu lateral -->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="<?php echo BASE_URL . 'admin/home'; ?>">
                        <div class="menu-title"><i class="fas fa-home"></i> Resumen</div>
                    </a>
                </li>
                <!-- Opción para manejar a los usuarios -->
                <li>
                    <a href="<?php echo BASE_URL . 'usuarios'; ?>">
                        <div class="menu-title"><i class="fas fa-users"></i> Usuarios</div>
                    </a>
                </li>
                <!-- Opción para manejar las categorias -->
                <li>
                    <a href="<?php echo BASE_URL . 'categorias'; ?>">
                        <div class="menu-title"><i class="fas fa-tags"></i> Categorías</div>
                    </a>
                </li>
                <!-- Opción para manejar los productos -->
                <li>
                    <a href="<?php echo BASE_URL . 'productos'; ?>">
                        <div class="menu-title"><i class="fas fa-list"></i> Productos</div>
                    </a>
                </li>
                <!-- Opción para manejar los pedidos -->
                <li>
                    <a href="<?php echo BASE_URL . 'pedidos'; ?>">
                        <div class="menu-title"><i class="fas fa-bell"></i> Pedidos</div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Fin del diseño de la barra de menu lateral -->
        <!-- Diseño de la barra de menu superior -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">

                    </div>
                    <div class="user-box dropdown">
                        <!-- Muestra los datos de la sesión -->
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo BASE_URL; ?>assets/images/logo.png" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0"><?php echo $_SESSION['nombre_usuario']; ?></p>
                                <p class="designattion mb-0"><?php echo $_SESSION['email']; ?></p>
                            </div>
                        </a>
                        <!-- lista desplegable con opciones sobre la sesion -->
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <!-- Para cerrar sesion -->
                            <li>
                                <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/salir'; ?>"><i class='bx bx-log-out-circle'></i><span>Cerrar sesión</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">