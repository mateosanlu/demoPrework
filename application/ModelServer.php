<?php
set_time_limit('3000000');
class ModelServer
{
    private $_registry;
    protected $_db;
    protected $_dbserver;
    protected $_dbserverObj;
    protected $datosModelServer;
    public function __construct() {
        $this->_registry = Registry::getInstance();
        try {
        	$this->_dbserverObj = $this->_registry->_dbServer;
            $this->_dbserver = $this->_dbserverObj->conectarDB();
            $this->_db = $this->_registry->_db;
        } catch (PDOException $e) {
        }
    }
    public function setDatosModelServer()
    {
           $this->_dbserver = $this->_dbserverObj->conectarDB();
    }
    public function getDatosModelServer()
 	{
        return $this->_dbserverObj->getDatadosDatabase();
    }
}

?>