<?php

class transfersController extends Controller
{
	private $_transfers;

    public function __construct() {
        parent::__construct();

        if(!Session::get('autenticado')){
            $this->redirect('login');
        }
        $this->_transfers = $this->loadModel("transfers");
        $this->_view->setJs(array("validations"));
        //$this->_view->setCss(array(""));
    }
    
    public function index()
    {
    	//$result = $this->_transfers->getExample();		        
        $this->_view->title = "transfers";
        //$this->_view->setJs(array("datatable"));
        $this->_view->clientTransactions = $this->_transfers->getClientTransactions(Session::get('id_usuario'));

        $this->_view->renderizar("index");
    }

    public function own_accounts()
    {
    	//$result = $this->_transfers->getExample();		        
        $this->_view->title = "transfers";
        $this->_view->transferResult = 0;
        //$this->_view->widget_menu_user_dropdown = $this->_view->widget('menu','getMenuTransfer');

        $this->_view->clientAccounts = $this->_transfers->getClientAccounts(Session::get('id_usuario'));

        if($this->getInt('enviar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('origin')){
                $this->_view->_error = 'Debe seleccionar una cuenta de origen';
                $this->_view->renderizar('own_accounts', null);
                exit;
            }
            
            if(!$this->getPostParam('destiny')){
                $this->_view->_error = 'Debe seleccionar una cuenta destino';
                $this->_view->renderizar('own_accounts', null);
                exit;
            }

            if($this->getPostParam('origin') == $this->getPostParam('destiny')){
                $this->_view->_error = 'La cuenta de destino debe ser diferente a la cuenta de origen';
                $this->_view->renderizar('own_accounts', null);
                exit;
            }

            if(!$this->getPostParam('amount')){
                $this->_view->_error = 'Digite el monto a transferir';
                $this->_view->renderizar('own_accounts', null);
                exit;
            }

            if($this->getPostParam('amount') <= 0 ){
                $this->_view->_error = 'El monto a transferir debe ser mayor a 0';
                $this->_view->renderizar('own_accounts', null);
                exit;
            }

            $originBalance = $this->_transfers->getBalance($this->getPostParam('origin'), Session::get('id_usuario'));

            if($this->getPostParam('amount') > $originBalance){
                $this->_view->_error = 'Fondos insuficientes en la cuenta de origen';
                $this->_view->renderizar('own_accounts', null);
                exit;
            }

            $result = $this->_transfers->setTransfer(
                $this->getPostParam('origin'), 
                $this->getPostParam('destiny'), 
                $this->getPostParam('amount')
            );    
            
                      
            if ($result != null) {
                $this->_view->_mensaje = 'La transferencia #'.$result.' se realizó exitosamente.';
                $this->_view->transferResult = $result;
                $this->_view->renderizar('own_accounts', null);
                exit;
            }
                    
        }

        $this->_view->renderizar("own_accounts");
    }

    public function third_parties()
    {
        $this->_view->title = "transfers";
        $this->_view->transferResult = 0;

        $this->_view->clientAccounts = $this->_transfers->getClientAccounts(Session::get('id_usuario'));
        $this->_view->registeredRegAccounts = $this->_transfers->getClientRegisteredAccounts(Session::get('id_usuario'));

        if($this->getInt('enviar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('origin')){
                $this->_view->_error = 'Debe seleccionar una cuenta de origen';
                $this->_view->renderizar('third_parties', null);
                exit;
            }
            
            if(!$this->getPostParam('destiny')){
                $this->_view->_error = 'Debe seleccionar una cuenta destino';
                $this->_view->renderizar('third_parties', null);
                exit;
            }

            if($this->getPostParam('origin') == $this->getPostParam('destiny')){
                $this->_view->_error = 'La cuenta de destino debe ser diferente a la cuenta de origen';
                $this->_view->renderizar('third_parties', null);
                exit;
            }

            if(!$this->getPostParam('amount')){
                $this->_view->_error = 'Digite el monto a transferir';
                $this->_view->renderizar('third_parties', null);
                exit;
            }

            if($this->getPostParam('amount') <= 0 ){
                $this->_view->_error = 'El monto a transferir debe ser mayor a 0';
                $this->_view->renderizar('third_parties', null);
                exit;
            }

            $originBalance = $this->_transfers->getBalance($this->getPostParam('origin'), Session::get('id_usuario'));

            if($this->getPostParam('amount') > $originBalance){
                $this->_view->_error = 'Fondos insuficientes en la cuenta de origen';
                $this->_view->renderizar('third_parties', null);
                exit;
            }

            $result = $this->_transfers->setTransfer(
                $this->getPostParam('origin'), 
                $this->getPostParam('destiny'), 
                $this->getPostParam('amount')
            );    
            
                      
            if ($result != null) {
                $this->_view->transferResult = $result;
                $this->_view->_mensaje = 'La transferencia #'.$result.' se realizó exitosamente.';
                $this->_view->renderizar('third_parties', null);
                exit;
            }
                    
        }

        $this->_view->renderizar("third_parties");
    }
}

?>
