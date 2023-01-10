<?php
class PrincipalModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Metodo para utilizar los datos de la tabla 'producto' en el detalle de los productos*/
    public function getProducto($id_producto)
    {
        $sql = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.id = $id_producto";
        return $this->select($sql);
    }
    /*Metodo para crear la paginación del catalogo*/
    public function getProductos($desde, $porPagina)
    {
        $sql = "SELECT * FROM productos LIMIT $desde, $porPagina";
        return $this->selectAll($sql);
    }
    /*Metodo para obtener el total de los productos del catalogo*/
    public function getTotalProductos()
    {
        $sql = "SELECT COUNT(*) AS total FROM productos";
        return $this->select($sql);
    }
    /*Metodo para mostrar los productos por categoria*/
    public function getProductosCat($id_categoria, $desde, $porPagina)
    {
        $sql = "SELECT * FROM productos WHERE id_categoria = $id_categoria LIMIT $desde, $porPagina";
        return $this->selectAll($sql);
    }
    /*Metodo obtener el total de los productos por categoria*/
    public function getTotalProductosCat($id_categoria)
    {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE id_categoria = $id_categoria";
        return $this->select($sql);
    }
    /*Metodo para mostrar los productos relacionados aleatorios*/
    public function getAleatorios($id_categoria, $id_producto)
    {
        $sql = "SELECT * FROM productos WHERE id_categoria = $id_categoria AND id != $id_producto ORDER BY RAND() LIMIT 20";
        return $this->selectAll($sql);
    }
    /*Metodo para realizar busqueda de los productos*/
    public function getBusqueda($valor)
    {
        /*el % sirve para indicar que debe traer todos los valores cercanos al inicio o al final*/
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%". $valor ."%' OR descripcion LIKE '%". $valor ."%' LIMIT 6";
        return $this->selectAll($sql);
    }
}