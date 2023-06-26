<?php
class CategoriasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Funcion para recuperar los datos de la tabla 'categorias'*/
    public function getCategorias($estado)
    {
        $sql = "SELECT * FROM categorias WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    
    /*Funcion para verificar que la categoria a registrar o modificar no exista*/
    public function verificarCategoria($categoria)
    {
        $sql = "SELECT categoria FROM categorias WHERE categoria = '$categoria' AND estado = 1";
        return $this->select($sql);
    }

    /*Funcion para obtener los datos de una categoria en especifico*/
    public function getCategoria($idCat)
    {
        $sql = "SELECT * FROM categorias WHERE id = $idCat";
        return $this->select($sql);
    }
    /*Funcion para modificar los datos de las categorias*/
    public function modificar($categoria, $imagen, $id)
    {
        $sql = "UPDATE categorias SET categoria=?, imagen=? WHERE id = ?";
        $array = array($categoria, $imagen, $id);
        return $this->save($sql, $array);
    }
}
?>