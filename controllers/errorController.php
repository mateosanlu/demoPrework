<?php

class errorController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index($error = false)
    {       
        $this->_view->titulo = 'Error';
        if ($error == '404') {
        	$this->_view->renderizar('404', 'login');
        }else{
        	$this->_view->_errorMensaje = 'Error desconocido';
        	$this->_view->renderizar('bug', 'login');
        }
        
    }

    public function bug($error = false, $msj = false)
    {   
    	if (DEBUG == 'false') {
    	    $this->redireccionar('error/notice/');
	    }

        $this->_view->titulo = 'Error';
        if ($error == '1') {
        	$this->_view->_errorMensaje = 'Controlador no encontrado';
        	$this->_view->renderizar('bug', 'login');
        }if ($error == '2') {
        	$this->_view->_errorMensaje = 'Modelo no encontrado';
        	$this->_view->renderizar('bug', 'login');
        }if ($error == '3') {
        	$this->_view->_errorMensaje = 'Vista no encontrada '.$msj;
        	$this->_view->renderizar('bug', 'login');
        }if ($error == '4') {
        	$this->_view->_errorMensaje = 'Error de librería '.$msj;
        	$this->_view->renderizar('bug', 'login');
        }if ($error == '5') {
        	$this->_view->_errorMensaje = 'Error de js';
        	$this->_view->renderizar('bug', 'login');
        }if ($error == '6') {
        	$this->_view->_errorMensaje = 'Error de css';
        	$this->_view->renderizar('bug', 'login');
        }if ($error == '7') {
        	$this->_view->_errorMensaje = 'Error de plugin js';
        	$this->_view->renderizar('bug', 'login');
        }else{
        	$this->_view->_errorMensaje = 'Error desconocido';
        	$this->_view->renderizar('bug', 'login');
        }
        
    }

    public function notice($error = false)
    {       
        $this->_view->titulo = 'Error';

        if ($error == '400') {
        	$this->_view->_errorCodigo = '400';
        	$this->_view->_errorMensaje = 'Error desconocido';
        	$this->_view->_errorIcon = 'fa fa-exclamation-triangle text-info';
        }elseif ($error == '401') {
        	$this->_view->_errorCodigo = '401';
        	$this->_view->_errorMensaje = 'Ups, lo sentimos pero no está autorizado para acceder a esta página';
        	$this->_view->_errorIcon = 'fa fa-times-circle-o text-muted';
        }elseif ($error == '403') {
        	$this->_view->_errorCodigo = '403';
        	$this->_view->_errorMensaje = 'Ups, lo sentimos pero no tiene los permisos para acceder a esta página';
        	$this->_view->_errorIcon = 'fa fa-times text-danger';
        }elseif ($error == '404') {
        	$this->_view->_errorCodigo = '404';
        	$this->_view->_errorMensaje = 'Ups, lo sentimos pero la página que está buscando no se encuentra';
        	$this->_view->_errorIcon = 'fa fa-exclamation-circle text-warning';
        }elseif ($error == '500') {
        	$this->_view->_errorCodigo = '500';
        	$this->_view->_errorMensaje = 'Ups, lo sentimos pero nuestro servidor encontró un error interno';
        	$this->_view->_errorIcon = 'fa fa-cog fa-spin text-danger';
        }elseif ($error == '503') {
        	$this->_view->_errorCodigo = '503';
        	$this->_view->_errorMensaje = 'Ups, lo sentimos actualmente el servicio no está disponible';
        	$this->_view->_errorIcon = 'fa fa-bullhorn text-success';
        }else{
        	$this->_view->_errorCodigo = '400';
        	$this->_view->_errorMensaje = 'Error desconocido';
        	$this->_view->_errorIcon = 'fa fa-exclamation-triangle';
        }
        
        $this->_view->renderizar('notice', 'login');
    }
}

?>