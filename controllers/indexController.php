<?php

class indexController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->_view->setCss(array('cover'));
    }
    
    public function index()
    {
        
        $this->_view->titulo = 'Bienvenido';

        $this->_view->widget_menu_top = $this->_view->widget('menu','getMenu');

        $this->_view->renderizar('index');
    }
}

?>