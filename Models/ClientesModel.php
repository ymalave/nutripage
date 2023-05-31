<?php
class ClientesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Funcion para insertar los datos del registro en la tabla 'clientes'*/
    public function registroDirecto($nombre, $correo, $clave, $token)
    {
        $sql = "INSERT INTO clientes (nombre, correo, clave, token) VALUES (?,?,?,?)";
        $datos = array($nombre, $correo, $clave, $token);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    /*Obtiene el token de la tabla 'clientes'*/
    public function getToken($token)
    {
        $sql = "SELECT * FROM clientes WHERE token = '$token'";
        return $this->select($sql);
    }
    /*Actualiza en la tabla clientes si el correo fue verificado*/
    public function actualizarVerify($id)
    {
        $sql = "UPDATE clientes SET token=?, verify=? WHERE id=?";
        $datos = array(null, 1, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    /*Permite verificar que no se registren correos duplicados*/
    public function getVerificar($correo)
    {
        $sql = "SELECT * FROM clientes WHERE correo = '$correo'";
        return $this->select($sql);
    }
    /*Funcion para insertar los datos del pago de la compra en la tabla 'pedidos'*/
    public function registrarPedido($id_transaccion, $monto, $fecha, $email_user)
    {
        $sql = "INSERT INTO pedidos (id_transaccion, monto, fecha, email_user) VALUES (?,?,?,?)";
        $datos = array($id_transaccion, $monto, $fecha, $email_user);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    /*Funcion para insertar los datos del pago de la compra en la tabla 'pedidos'*/
    public function registroPago($payDetails)
    {
        $sql = "INSERT INTO pedidos (tipo_pago, id_transaccion, monto, fecha, email_user) VALUES (?,?,?,?,?)";
        $datos = array( $payDetails['tipo'], $payDetails['referencia'],$payDetails['monto'], $payDetails['fecha'], $payDetails['email']);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    /*Metodo para utilizar los datos del producto*/
    public function getProducto($id_producto)
    {
        $sql = "SELECT * FROM productos WHERE id = $id_producto";
        return $this->select($sql);
    }
    /*Metodo para insertar los datos de los productos comprados en la tabla 'detalle_pedidos'*/
    public function registrarDetalle($producto, $precio, $cantidad, $id_pedido, $id_producto)
    {
        $sql = "INSERT INTO detalle_pedidos (producto, precio, cantidad, id_pedido, id_producto) VALUES (?,?,?,?,?)";
        $datos = array($producto, $precio, $cantidad, $id_pedido, $id_producto);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    /*Metodo para obtener los pedidos*/
    public function getPedidos()
    {
        $sql = "SELECT * FROM pedidos";
        return $this->selectAll($sql);
    }
    /*Metodo para obtener los pedidos*/
    public function getPedido($idPedido)
    {
        $sql = "SELECT * FROM pedidos WHERE id = $idPedido";
        return $this->select($sql);
    }
    /*Metodo para obtener el detalle de los pedidos que estan pendientes*/
    public function verPedidos($idPedido)
    {
        $sql = "SELECT d.* FROM pedidos p INNER JOIN detalle_pedidos d ON p.id = d.id_pedido WHERE p.id = $idPedido";
        return $this->selectAll($sql);
    }
}