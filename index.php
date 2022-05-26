<?php

ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);
define('M_VERSION', '1.0');


try{
    require_once APP_PATH . 'Autoload.php';
    require_once APP_PATH . 'Config.php';

    Session::init();

    $registry = Registry::getInstance();
    $registry->_request = new Request();
    $registry->_db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
    //$registry->_dbServer = new DatabaseServer();
    $registry->_acl = new ACL();

    Bootstrap::run($registry->_request);
}
catch(MolecularException $e) {
    $e->getException();
}



?>