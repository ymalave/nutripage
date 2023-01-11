<?php
class ProductosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Funcion para recuperar los datos de la tabla 'productos'*/
    public function getProductos($estado)
    {
        $sql = "SELECT * FROM productos WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    /*Funcion para recuperar los datos de la tabla 'categorias'*/
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }
    /*Funcion para registrar los datos de los productos*/
    public function registrar($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria)
    {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen, id_categoria) VALUES (?,?,?,?,?,?)";
        $array = array($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria);
        return $this->insertar($sql, $array);
    }
    /*Funcion para eliminar productos*/
    public function eliminar($idPro)
    {
        $sql = "UPDATE productos SET estado = ? WHERE id = ?";
        $array = array(0, $idPro);
        return $this->save($sql, $array);
    }
    /*Funcion para obtener los datos de un producto en especifico*/
    public function getProducto($idPro)
    {
        $sql = "SELECT * FROM productos WHERE id = $idPro";
        return $this->select($sql);
    }
    /*Funcion para modificar los datos de los productos*/
    public function modificar($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria, $id)
    {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, cantidad=?, imagen=?, id_categoria=? WHERE id = ?";
        $array = array($nombre, $descripcion, $precio, $cantidad, $imagen, $categoria, $id);
        return $this->save($sql, $array);
    }
}