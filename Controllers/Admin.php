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
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                // Si el correo ingresado no existe, mostrar alerta
                $data = $this->model->getUsuario($_POST['email']);
                if (empty($data)) {
                    $respuesta = array('msg' => 'Correo no registrado', 'icono' => 'warning');
                } else {
                    // Si el correo existe, verificar que la contraseña sea correcta
                    if (password_verify($_POST['clave'], $data['clave'])) {
                        // Si la contraseña es correcta, se muestra una alerta y se crea la sesión
                        $_SESSION['email'] = $data['correo'];
                        $respuesta = array('msg' => 'Inicio de sesión exitoso', 'icono' => 'success');
                    } else {
                        // Si la clave ingresada es incorrecta, mostrar alerta
                        $respuesta = array('msg' => 'Contraseña incorrecta', 'icono' => 'warning');
                    }
                }
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    /* Función para mostrar la la vista de administracion al iniciar sesión */
    public function home()
    {
        $data['title'] = 'Panel administrativo';
        $this->views->getView('admin/administracion', "index", $data);
    }
}
