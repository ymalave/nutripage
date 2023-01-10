<?php
class HomeModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Funcion para utilizar los datos de la tabla 'categorias'*/
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias";
        return $this->selectAll($sql);
    }
    /*Funcion para utilizar los ultimos datos agregados a la tabla 'productos'*/
    public function getNuevosProductos()
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC LIMIT 6";
        return $this->selectAll($sql);
    }
}
?>