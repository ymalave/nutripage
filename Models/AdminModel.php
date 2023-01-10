<?php
class AdminModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /* Método para obtener el correo de los usuarios */
    public function getUsuario($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        return $this->select($sql);
    }
}
?>