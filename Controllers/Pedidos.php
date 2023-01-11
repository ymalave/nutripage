<?php
class Pedidos extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Pedidos';
        $this->views->getView('admin/pedidos', "index", $data);
    }
    // Permite obtener los datos de los pedidos pendientes
    public function listarPendientes()
    {
        $data = $this->model->getPedidos(1);
        for ($i = 0; $i < count($data); $i++) {
            // Mostrar botones para eliminar los datos de los productos de la fila
            $data[$i]['accion'] =
                '<div class="d-flex">
                    <button class="btn btn-info" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ')"><i class="fas fa-check-circle"></i></button>
                </div>';
        }
        echo json_encode($data);
        die();
    }
    // Permite obtener los datos de los pedidos completados
    public function listarCompletados()
    {
        $data = $this->model->getPedidos(3);
        for ($i = 0; $i < count($data); $i++) {
            // Mostrar botones para eliminar los datos de los productos de la fila
            $data[$i]['accion'] =
                '<div class="d-flex">
                    <button class="btn btn-danger" type="button" onclick="eliminarPro(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
                </div>';
        }
        echo json_encode($data);
        die();
    }
    // Permite cambiar el estado de los pedidos
    public function update($idPedido)
    {
        // Permite cambiar el estado de un pedido especifico a traves de su id
        if (is_numeric($idPedido)) {
            $data = $this->model->actualizarEstado(2, $idPedido);
            if ($data == 1) {
                // Si se ha cambiado el estado, mostrar alerta
                $respuesta = array('msg' => '¡Pedido marcado como procesado!', 'icono' => 'success');
            } else {
                // Si no se ha podido cambiar el estado, mostrar alerta
                $respuesta = array('msg' => '¡Error al marcar pedido como procesado!', 'icono' => 'error');
            }
            echo json_encode($respuesta);
        }
        die();
    }
}