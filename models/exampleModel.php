<?php

class exampleModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getExample(){
        $datos = $this->_db->query("SELECT * FROM example ");
        return $datos->fetchall();
    }
}

?>
