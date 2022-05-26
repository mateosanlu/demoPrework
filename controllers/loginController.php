<?php

class loginController extends Controller
{
    private $_login;
    
    public function __construct(){
        parent::__construct();
        $this->_login = $this->loadModel('login');
        $this->_view->setJs(array('login'));
    }
    
    public function index()
    {
        if(Session::get('autenticado')){
            $this->redirect();
        }
        
        $this->_view->titulo = 'Iniciar Sesion';
        $this->_view->setCss(array('login'));
        
        if($this->getInt('enviar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('login-username')){
                $this->_view->_error = 'Debe introducir su nombre de usuario';
                $this->_view->renderizar('index', null);
                exit;
            }
            
            if(!$this->getPostParam('login-password')){
                $this->_view->_error = 'Debe introducir su contraseña';
                $this->_view->renderizar('index', null);
                exit;
            }
            
            $row = $this->_login->getUser(
                    $this->getPostParam('login-username'),
                    $this->getPostParam('login-password')
                    );
            
            $user_cookie = $this->getPostParam('login-username');
            
            if(!$row){
                if (!isset($_COOKIE[$user_cookie])){ 
                    setcookie($user_cookie,2,time() + (365 * 24 * 60 * 60));
                }
                elseif (isset($_COOKIE[$user_cookie]) && $_COOKIE[$user_cookie] < 10){
                    setcookie($user_cookie, $_COOKIE[$user_cookie]+1 ,time() + (365 * 24 * 60 * 60));
                }else{
                    $this->_login->inhabilitarAccesoPorUsuario($user_cookie);
                    $this->_view->_error = 'Ha superado el número de intentos, la cuenta ha sido bloqueada. Póngase en contacto con el administrador del sistema ';
                    $this->_view->renderizar('index', null);
                    exit;
                }
                
                $this->_view->_error = 'Usuario y/o contraseña incorrectos ';
                $this->_view->renderizar('index', null);
                exit;
            }
            
            if($row['use_nstatus'] != 1){
                $this->_view->_error = 'Este usuario no está habilitado, póngase en contacto con el administrador del sistema';
                $this->_view->renderizar('index', null);
                exit;
            }
                        
            Session::set('autenticado', true);
            //Session::set('level', $row['rol']);
            //Session::set('nombre_usuario', $row['cli_cfirstname']);
            Session::set('id_usuario', $row['ID']);
            Session::set('tiempo', time());

            unset($_COOKIE[$user_cookie]);
            setcookie($user_cookie, null, -1); 
            
            $this->redirect('home/');
        }
        
        $this->_view->renderizar('index', null);
        
    }
    
    public function cerrar()
    {
        Session::destroy();
        $this->redirect();
    }    

}

?>
