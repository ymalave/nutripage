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
        $sql = "SELECT P.*, C.categoria FROM productos P INNER JOIN categorias C  ON P.id_categoria = C.id WHERE P.estado = $estado";
        return $this->selectAll($sql);
    }
    /*Funcion para recuperar los datos de la tabla 'categorias'*/
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }
    
    /*Funcion para obtener los datos de un producto en especifico*/
    public function getProducto($idPro)
    {
        $sql = "SELECT * FROM productos WHERE id = $idPro";
        return $this->select($sql);
    }
}