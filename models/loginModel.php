<?php

class loginModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getUser($user, $password)
    {
        $data = $this->_db->query(
                "select cli.*, us.use_nstatus
                from users us 
                inner join clients cli on cli.id = us.id_clients 
                where " .
                "cli.cli_nidentification = '$user' " .
                "and us.use_cpassword = '" . Hash::getHash('sha1', $password, HASH_KEY) ."'"
                );
        
        return $data->fetch();
    }

    public function inhabilitarAccesoPorUsuario($usuario){
        $datos = $this->_db->query("UPDATE usuarios SET estado = '2' WHERE usuarios.usuario = '$usuario'");
    }

    public function habilitarAccesoPorId($idUsuario){
        $datos = $this->_db->query("UPDATE usuarios SET estado = '1' WHERE usuarios.id = '$idUsuario'");
    }
}

?>
