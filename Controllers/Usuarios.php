<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Usuarios';
        $this->views->getView('admin/usuarios', "index", $data);
    }
    //Permite obtener los datos de los usuarios activos
    public function listar()
    {
        $data = $this->model->getUsuarios(1);
        // Mostrar botones para editar o eliminar el usuario de la fila
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =
                '<div class="d-flex">
                    <button class="btn btn-primary" type="button" onclick="editUser(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="eliminarUser(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
                </div>';
        }
        echo json_encode($data);
        die();
    }
    //Permite registrar o modificar los datos de los usuarios
    public function registrar()
    {
        if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['clave'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $id = $_POST['id'];
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            // Si los campos estan vacios, mostrar alerta
            if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo'])) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                // Si los campos fueron rellenados registrarlos
                if (empty($id)) {
                    $result = $this->model->verificarCorreo($correo);
                    // Si el correo no existe en la bd, registra el nuevo usuario
                    if (empty($result)) {
                        $data = $this->model->registrar($nombre, $apellido, $correo, $hash);
                        if ($data > 0) {
                            // Si se completado el registro, mostrar alerta
                            $respuesta = array('msg' => 'Registro exitoso', 'icono' => 'success');
                        } else {
                            // Si no se ha podido registrar el usuario, mostrar alerta
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                        }
                    } else {
                        // Si el correo existe en la bd, muestra alerta
                        $respuesta = array('msg' => '¡El correo electrónico ya se encuentra registrado!', 'icono' => 'warning');
                    }
                } else {
                    //Permite modificar los usuarios registrados
                    $data = $this->model->modificar($nombre, $apellido, $correo, $id);
                    if ($data == 1) {
                        // Si se completado la modificación, mostrar alerta
                        $respuesta = array('msg' => '¡Usuario modificado!', 'icono' => 'success');
                    } else {
                        // Si no se ha podido modificar el usuario, mostrar alerta
                        $respuesta = array('msg' => '¡Error al modificar!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    //Permite eliminar usuarios registrados desde la tabla
    public function delete($idUser)
    {
        // Permite borrar el usuario de la bd a traves del id
        if (is_numeric($idUser)) {
            $data = $this->model->eliminar($idUser);
            if ($data == 1) {
                // Si se ha eliminado el registro, mostrar alerta
                $respuesta = array('msg' => '¡Usuario eliminado!', 'icono' => 'success');
            } else {
                // Si no se ha podido eliminar el usuario, mostrar alerta
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Eliminar usuario no funciona', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    //Permite editar usuarios registrados desde la tabla
    public function edit($idUser)
    {
        // Permite borrar el usuario de la bd a traves del id
        if (is_numeric($idUser)) {
            $data = $this->model->getUsuario($idUser);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}