<?php

class menuModelWidget extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getEjemplo()
    {
        $datos = $this->_db->query(
                "SELECT * FROM ejemplo"
                );
        
        return $datos->fetchall();
    }

}

?>
