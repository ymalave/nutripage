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
    public function registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, 
                                    $nombre, $apellido, $direccion, $ciudad, $email_user)
    {
        $sql = "INSERT INTO pedidos (id_transaccion, monto, estado, fecha, email, nombre, 
                                    apellido, direccion, ciudad, email_user) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $datos = array($id_transaccion, $monto, $estado, $fecha, $email, 
                        $nombre, $apellido, $direccion, $ciudad, $email_user);
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
    public function registrarDetalle($producto, $precio, $cantidad, $id_pedido)
    {
        $sql = "INSERT INTO detalle_pedidos (producto, precio, cantidad, id_pedido) VALUES (?,?,?,?)";
        $datos = array($producto, $precio, $cantidad, $id_pedido);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    /*Metodo para obtener los pedidos que estan pendientes*/
    public function getPedidos($proceso)
    {
        $sql = "SELECT * FROM pedidos WHERE proceso = $proceso";
        return $this->selectAll($sql);
    }
    /*Metodo para obtener el detalle de los pedidos que estan pendientes*/
    public function verPedido($idPedido)
    {
        $sql = "SELECT d.* FROM pedidos p INNER JOIN detalle_pedidos d ON p.id = d.id_pedido WHERE p.id = $idPedido";
        return $this->selectAll($sql);
    }
}