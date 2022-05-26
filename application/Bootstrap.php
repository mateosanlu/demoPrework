<?php

class Bootstrap
{
    public static function run(Request $peticion)
    {
        $modulo = $peticion->getModulo();
        $controller = $peticion->getControlador() . 'Controller';
        $metodo = $peticion->getMetodo();
        $args = $peticion->getArgs();
        

        if($modulo){

            $rutaControlador = ROOT . 'modules'. DS . $modulo . DS . 'controllers' . DS . $controller . '.php';

        }
        else{
            $rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';
        }
        
        if(is_readable($rutaControlador)){
            require_once $rutaControlador;
            $controller = new $controller;
            
            if(is_callable(array($controller, $metodo))){
                $metodo = $peticion->getMetodo();
            }
            else{
                $metodo = 'index';
            }
            
            if(isset($args)){
                call_user_func_array(array($controller, $metodo), $args);
            }
            else{
                call_user_func(array($controller, $metodo));
            }
            
        } else {
            throw new MolecularException('Controlador "'.$peticion->getControlador().'" no encontrado');

        }
    }
}

?>