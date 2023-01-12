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
            // Mostrar botones para ver el detalle y cambiar el estado a 'por procesar' del pedido de la fila
            $data[$i]['accion'] =
                '<div class="d-flex">
                <button class="btn btn-success" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-info" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 2)"><i class="fas fa-check-circle"></i></button>
                </div>';
        }
        echo json_encode($data);
        die();
    }
    // Permite obtener los datos de los pedidos por procesar
    public function listarProceso()
    {
        $data = $this->model->getPedidos(2);
        for ($i = 0; $i < count($data); $i++) {
            // Mostrar botones para ver detalle y cambiar el estado a 'completado' del pedido de la fila
            $data[$i]['accion'] =
                '<div class="d-flex">
                <button class="btn btn-success" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-info" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 3)"><i class="fas fa-check-circle"></i></button>
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
            // Mostrar boton para ver el detalle del pedido de la fila
            $data[$i]['accion'] =
                '<div class="d-flex">
                    <button class="btn btn-success" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
                </div>';
        }
        echo json_encode($data);
        die();
    }
    // Permite cambiar el estado de los pedidos
    public function update($datos)
    {
        $array = explode(',', $datos);
        $idPedido = $array[0];
        $proceso = $array[1];
        // Permite cambiar el estado de un pedido especifico a traves de su id
        if (is_numeric($idPedido)) {
            $data = $this->model->actualizarEstado($proceso, $idPedido);
            if ($data == 1) {
                // Si se ha cambiado el estado, mostrar alerta
                $respuesta = array('msg' => '¡Estado del pedido actualizado!', 'icono' => 'success');
            } else {
                // Si no se ha podido cambiar el estado, mostrar alerta
                $respuesta = array('msg' => '¡Error al cambiar el estado del pedido!', 'icono' => 'error');
            }
            echo json_encode($respuesta);
        }
        die();
    }
}