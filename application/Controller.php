<?php

abstract class Controller
{
    private $_registry;
    protected $_view;
    protected $_acl;
    protected $_request;
    
    public function __construct() 
    {
        $this->_registry = Registry::getInstance();
        $this->_acl = $this->_registry->_acl;
        $this->_request = $this->_registry->_request;
        $this->_view = new View($this->_request, $this->_acl);
    }

    abstract public function index();
    
    protected function loadModel($model, $module = false)
    {
        $model = $model . 'Model';
        $pathModel = ROOT . 'models' . DS . $model . '.php';
        
        if(!$module){
            $module = $this->_request->getModulo();
        }
        
        if($module){
           if($module != 'default'){
               $pathModel = ROOT . 'modules' . DS . $module . DS . 'models' . DS . $model . '.php';
           } 
        }

        if(is_readable($pathModel)){
            require_once $pathModel;
            $model = new $model;
            return $model;
        }
        else {
            throw new MolecularException('Error de modelo '.$model);
        }
    }
    
    protected function getLibrary($library)
    {
        $pathLibrary = ROOT . 'libs' . DS . $library . '.php';
        
        if(is_readable($pathLibrary)){
            require_once $pathLibrary;
        }
        else{
            throw new MolecularException('Error de libreria '.$library);
        }
    }
    
    protected function getText($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
            return $_POST[$clave];
        }
        
        return '';
    }
    
    protected function getInt($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }
        
        return 0;
    }
    
    protected function redirect($path = false)
    {
        if($path){
            header('location:' . BASE_URL . $path);
            exit;
        }
        else{
            header('location:' . BASE_URL);
            exit;
        }
    }

    protected function filterInt($int)
    {
        $int = (int) $int;
        
        if(is_int($int)){
            return $int;
        }
        else{
            return 0;
        }
    }
    
    protected function getPostParam($clave)
    {
        if(isset($_POST[$clave])){
            return $_POST[$clave];
        }
    }
    
    protected function getSql($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = strip_tags($_POST[$clave]);
            
            if(!get_magic_quotes_gpc()){
                //$_POST[$clave] = mysql_escape_string($_POST[$clave]);
            }
            
            return trim($_POST[$clave]);
        }
    }
    
    protected function getAlphaNum($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
        
    }
    
    public function validateEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        
        return true;
    }

    protected function formatPermiso($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
    }
}

?>
