<?php
class PedidosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Funcion para recuperar los datos de la tabla 'pedidos'*/
    public function getPedidos($proceso)
    {
        $sql = "SELECT * FROM pedidos WHERE proceso = $proceso";
        return $this->selectAll($sql);
    }
    /*Funcion para actualizar el estado de los pedidos*/
    public function actualizarEstado($proceso, $idPedido)
    {
        $sql = "UPDATE pedidos SET proceso=? WHERE id = ?";
        $array = array($proceso, $idPedido);
        return $this->save($sql, $array);
    }
}