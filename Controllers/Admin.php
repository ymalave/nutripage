<?php
class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Acceso al sistema';
        $this->views->getView('admin', "login", $data);
    }
    /* Función para validar el correo y clave al iniciar sesión */
    public function validar()
    {
        if (isset($_POST['email']) && isset($_POST['clave'])) {
            //Si los campos email y clave estan vacios, mostrar alerta
            if (empty($_POST['email']) || empty($_POST['clave'])) {
                $respuesta = array('msg' => '¡Todos los campos son requeridos!', 'icono' => 'warning');
            } else {
                // Si el correo ingresado no existe, mostrar alerta
                $data = $this->model->getUsuario($_POST['email']);
                if (empty($data)) {
                    $respuesta = array('msg' => '¡Correo no registrado!', 'icono' => 'warning');
                } else {
                    // Si el correo existe, verificar que la contraseña sea correcta
                    if (password_verify($_POST['clave'], $data['clave'])) {
                        // Si la contraseña es correcta, se muestra una alerta y se crea la sesión
                        $_SESSION['email'] = $data['correo'];
                        $_SESSION['nombre_usuario'] = $data['nombres'];
                        $respuesta = array('msg' => '¡Inicio de sesión exitoso!', 'icono' => 'success');
                    } else {
                        // Si la clave ingresada es incorrecta, mostrar alerta
                        $respuesta = array('msg' => '¡Contraseña incorrecta!', 'icono' => 'warning');
                    }
                }
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    /* Función para mostrar la vista de administracion al iniciar sesión */
    public function home()
    {
        $data['title'] = 'Panel administrativo';
        //Permiten obtener los totales para las estadisticas
        $data['pendientes'] = $this->model->getTotales(1);
        $data['proceso'] = $this->model->getTotales(2);
        $data['completados'] = $this->model->getTotales(3);
        $data['productos'] = $this->model->getProductos();
        $this->views->getView('admin/administracion', "index", $data);
    }
    /* Función para cerrar sesión */
    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
    /* Funcion para mostrar los productos minimos en stock */
    public function productosMinimos()
    {
        $data = $this->model->productosMinimos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    /* Funcion para mostrar los productos mas vendidos */
    public function topProductos()
    {
        $data = $this->model->topProductos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
