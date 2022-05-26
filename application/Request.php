<?php

class Request
{
    private $_modulo;
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    private $_modulos;
    
    public function __construct() 
    {
        if(isset($_GET['url'])){
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);
            
            /* modulos de la app */
            //$this->_modulos = array('');
            $this->_modulos = scandir(ROOT.'modules');
            $this->_modulo = strtolower(array_shift($url));
            
            if(!$this->_modulo){
                $this->_modulo = false;
            }
            else{
                if(count($this->_modulos)){
                    if(!in_array($this->_modulo, $this->_modulos)){
                        $this->_controlador = $this->_modulo;
                        $this->_modulo = false;
                    }
                    else{
                        $this->_controlador = strtolower(array_shift($url));
                        
                        if(!$this->_controlador){
                            $this->_controlador = 'index';
                        }
                    }
                }
                else{
                     $this->_controlador = $this->_modulo;
                     $this->_modulo = false;
                }
            }
            
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;           
        }       
        
        if(!$this->_controlador){
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        
        if(!$this->_metodo){
            $this->_metodo = 'index';
        }
        
        if(!isset($this->_argumentos)){
            $this->_argumentos = array();
        }
    }
    
    public function getModulo()
    {
        return $this->_modulo;
    }
    
    public function getControlador()
    {
        return $this->_controlador;
    }
    
    public function getMetodo()
    {
        return $this->_metodo;
    }
    
    public function getArgs()
    {
        return $this->_argumentos;
    }
}

?>