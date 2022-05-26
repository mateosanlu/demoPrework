<?php


class Model
{
	private $_registry;
    protected $_db;
    
    public function __construct() {
    	$this->_registry = Registry::getInstance();
        $this->_db = $this->_registry->_db;
    }
}

?>
