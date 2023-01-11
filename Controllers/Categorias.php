<?php
class Categorias extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Categorias';
        $this->views->getView('admin/categorias', "index", $data);
    }
    //Permite obtener los datos de las categorias de los productos
    public function listar()
    {
        $data = $this->model->getCategorias(1);
        for ($i = 0; $i < count($data); $i++) {
            // Mostrar la imagen de la categoria de la fila
            $data[$i]['imagen'] = 
                '<img class="img-thumbnail" src="'. $data[$i]['imagen'] .'" alt="'. $data[$i]['categoria'] .'" width="80">';
            // Mostrar botones para editar o eliminar los datos de la categoria de la fila
            $data[$i]['accion'] =
                '<div class="d-flex">
                    <button class="btn btn-primary" type="button" onclick="editCat(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="eliminarCat(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
                </div>';
        }
        echo json_encode($data);
        die();
    }
    //Permite registrar o modificar los datos de las categorias
    public function registrar()
    {
        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/images/categorias/';
            $nombreImg = date('YmdHis');
            // Si el campo categoria esta vacio, mostrar alerta
            if (empty($_POST['categoria'])) {
                $respuesta = array('msg' => '¡Todos los campos son requeridos!', 'icono' => 'warning');
            } else {
                // Si existe el nombre de la imagen, crea el destino
                if (!empty($imagen['name'])) {
                    $destino = $ruta . $nombreImg . '.jpg';
                } else if (!empty($_POST['imagen_actual']) && empty($_POST['name'])) {
                    // Si existe la imagen y no existe el nombre, el destino es el de la imagen
                    $destino = $_POST['imagen_actual'];
                } else {
                    //Por defecto toma la imagen predefinida
                    $destino = $ruta . 'default.png';
                }
                // Si los campos fueron rellenados registrarlos
                if (empty($id)) {
                    $result = $this->model->verificarCategoria($categoria);
                    // Si la categoria no existe en la bd, registra la nueva categoria
                    if (empty($result)) {
                        $data = $this->model->registrar($categoria, $destino);
                        if ($data > 0) {
                            // Si existe el nombre de la imagen, moverlo al destino
                            if (!empty($imagen['name'])) {
                                move_uploaded_file($tmp_name, $destino);
                            }
                            // Si se completa el registro, mostrar alerta
                            $respuesta = array('msg' => '¡Registro exitoso!', 'icono' => 'success');
                        } else {
                            // Si no se ha podido registrar la categoria, mostrar alerta
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                        }
                    } else {
                        // Si la categoria existe en la bd, muestra alerta
                        $respuesta = array('msg' => '¡La categoría ya se encuentra registrada!', 'icono' => 'warning');
                    }
                } else {
                    // Permite modificar las categorias de la tabla
                    $data = $this->model->modificar($categoria, $destino, $id);
                    if ($data == 1) {
                        // Si existe el nombre de la imagen, moverlo al destino
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        // Si se completado la modificación, mostrar alerta
                        $respuesta = array('msg' => '¡Categoría modificada!', 'icono' => 'success');
                    } else {
                        // Si no se ha podido modificar la categoria, mostrar alerta
                        $respuesta = array('msg' => '¡Error al modificar!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    //Permite eliminar las categorias registradas desde la tabla
    public function delete($idCat)
    {
        // Permite borrar la categoria de la bd a traves del id
        if (is_numeric($idCat)) {
            $data = $this->model->eliminar($idCat);
            if ($data == 1) {
                // Si se ha eliminado el registro, mostrar alerta
                $respuesta = array('msg' => '¡Categoría eliminada!', 'icono' => 'success');
            } else {
                // Si no se ha podido eliminar la categoria, mostrar alerta
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Eliminar categoría no funciona', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    //Permite editar las categorias registradas desde la tabla
    public function edit($idCat)
    {
        // Permite editar la categoria de la bd a traves del id
        if (is_numeric($idCat)) {
            $data = $this->model->getCategoria($idCat);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}