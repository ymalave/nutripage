<?php
class Productos extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Productos';
        // Permite obtener las categorias de los productos
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView('admin/productos', "index", $data);
    }
    //Permite obtener los datos de los productos
    public function listar()
    {
        $data = $this->model->getProductos(1);
        for ($i = 0; $i < count($data); $i++) {
            // Mostrar la imagen del producto de la fila
            $data[$i]['imagen'] =
                '<img class="img-thumbnail" src="' . $data[$i]['imagen'] . '" alt="' . $data[$i]['nombre'] . '" width="80">';
            // Mostrar botones para editar o eliminar los datos de los productos de la fila
            $data[$i]['accion'] =
                '<div class="d-flex">
                    <button class="btn btn-primary" type="button" onclick="editPro(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="eliminarPro(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
                </div>';
        }
        echo json_encode($data);
        die();
    }
    //Permite registrar o modificar los datos de los productos
    public function registrar()
    {
        if (isset($_POST['nombre']) && isset($_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/images/productos/';
            $nombreImg = date('YmdHis');
            // Si el campo nombre, precio, cantidad esta vacio, mostrar alerta
            if (empty($nombre) || empty($precio) || empty($cantidad)) {
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
                    $data = $this->model->registrar($nombre, $descripcion, $precio, $cantidad, $destino, $categoria);
                    if ($data > 0) {
                        // Si existe el nombre de la imagen, moverlo al destino
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        // Si se completa el registro, mostrar alerta
                        $respuesta = array('msg' => '¡Registro exitoso!', 'icono' => 'success');
                    } else {
                        // Si no se ha podido registrar el producto, mostrar alerta
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
                } else {
                    // Permite modificar los productos de la tabla
                    $data = $this->model->modificar($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $id);
                    if ($data == 1) {
                        // Si existe el nombre de la imagen, moverlo al destino
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        // Si se completado la modificación, mostrar alerta
                        $respuesta = array('msg' => '¡Producto modificado!', 'icono' => 'success');
                    } else {
                        // Si no se ha podido modificar el producto, mostrar alerta
                        $respuesta = array('msg' => '¡Error al modificar!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    //Permite eliminar los productos registrados desde la tabla
    public function delete($idPro)
    {
        // Permite borrar el producto de la bd a traves del id
        if (is_numeric($idPro)) {
            $data = $this->model->eliminar($idPro);
            if ($data == 1) {
                // Si se ha eliminado el registro, mostrar alerta
                $respuesta = array('msg' => '¡Producto eliminado!', 'icono' => 'success');
            } else {
                // Si no se ha podido eliminar el producto, mostrar alerta
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Eliminar producto no funciona', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    //Permite editar los productos registrados desde la tabla
    public function edit($idPro)
    {
        // Permite editar el producto de la bd a traves del id
        if (is_numeric($idPro)) {
            $data = $this->model->getProducto($idPro);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
