<?php

class homeController extends Controller
{
	private $_home;

    public function __construct() {
        parent::__construct();
        
        if(!Session::get('autenticado')){
            $this->redirect('login');
        }
        //$this->_home = $this->loadModel("home");
        //$this->_view->setJs(array(""));
        $this->_view->setCss(array("home"));
    }
    
    public function index()
    {
    	//$result = $this->_home->getExample();		        
        $this->_view->title = "home";
        $this->_view->renderizar("index");
    }
}

?>
