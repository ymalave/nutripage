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
    /*Funcion para registrar los datos de las categorias*/
    public function registrar($categoria, $imagen)
    {
        $sql = "INSERT INTO categorias (categoria, imagen) VALUES (?,?)";
        $array = array($categoria, $imagen);
        return $this->insertar($sql, $array);
    }
    /*Funcion para verificar que la categoria a registrar o modificar no exista*/
    public function verificarCategoria($categoria)
    {
        $sql = "SELECT categoria FROM categorias WHERE categoria = '$categoria' AND estado = 1";
        return $this->select($sql);
    }
    /*Funcion para eliminar categorias*/
    public function eliminar($idCat)
    {
        $sql = "UPDATE categorias SET estado = ? WHERE id = ?";
        $array = array(0, $idCat);
        return $this->save($sql, $array);
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