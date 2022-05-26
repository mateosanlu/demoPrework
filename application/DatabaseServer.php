<?php
class DatabaseServer
{
	private $_dbServerConexion;
	private $datosDatabase = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR,
			PDO::ATTR_TIMEOUT => 3); 
	public function __construct() {
	}
	public function conectarDB(){
		try {
			$this->_dbServerConexion = new PDO('mysql:host=' . DBS_HOST .';dbname=' . DBS_NAME,DBS_USER, DBS_PASS, $this->datosDatabase);
		} catch (Exception $e) {
			
		}
			return $this->_dbServerConexion;
	}
	public function getDatadosDatabase()
	{
		return $this->datosDatabase;
	}
}

?>