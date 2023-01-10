<?php
class UsuariosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    /*Funcion para utilizar los datos de la tabla 'usuarios'*/
    public function getUsuarios($estado)
    {
        $sql = "SELECT id, nombres, apellidos, correo, perfil FROM usuarios WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    /*Funcion para registrar los datos de los nuevos usuarios*/
    public function registrar($nombre, $apellido, $correo, $clave)
    {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo, clave) VALUES (?,?,?,?)";
        $array = array($nombre, $apellido, $correo, $clave);
        return $this->insertar($sql, $array);
    }
    /*Funcion para verificar que el correo a registrar del nuevo usuario no exista*/
    public function verificarCorreo($correo)
    {
        $sql = "SELECT correo FROM usuarios WHERE correo = '$correo' AND estado = 1";
        return $this->select($sql);
    }
    /*Funcion para eliminar usuarios*/
    public function eliminar($idUser)
    {
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $array = array(0, $idUser);
        return $this->save($sql, $array);
    }
    /*Funcion para editar los datos de la tabla 'usuarios'*/
    public function getUsuario($idUser)
    {
        $sql = "SELECT id, nombres, apellidos, correo FROM usuarios WHERE id = $idUser";
        return $this->select($sql);
    }
    /*Funcion para modificar los datos de los usuarios*/
    public function modificar($nombre, $apellido, $correo, $id)
    {
        $sql = "UPDATE usuarios SET nombres=?, apellidos=?, correo=? WHERE id = ?";
        $array = array($nombre, $apellido, $correo, $id);
        return $this->save($sql, $array);
    }
}
?>