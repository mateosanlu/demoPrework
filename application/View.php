<?php

class View
{
    private $_request;
    private $_js;
    private $_css;
    private $_acl;
    private $_rutas;
    private $_jsPlugin;
    private $_template;
    
    public function __construct(Request $peticion, ACL $_acl) {
        $this->_request = $peticion;
        $this->_js = array();
        $this->_css = array();
        $this->_acl = $_acl;
        $this->_rutas = array();
        $this->_jsPlugin = array();
        $this->_template = DEFAULT_LAYOUT;
        
        $modulo = $this->_request->getModulo();
        $controlador = $this->_request->getControlador();
        
        if($modulo){
            $this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/js/';
            $this->_rutas['css'] = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/css/';
        }
        else{
            $this->_rutas['view'] = ROOT . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'views/' . $controlador . '/js/';
            $this->_rutas['css'] = BASE_URL . 'views/' . $controlador . '/css/';
        }
    }
    
    public function renderizar($vista, $item = false, $noLayout = false)
    {
        $menu = array(
            array(
                'id' => 'perfil',
                'titulo' => Session::get('nombre_usuario'),
                'enlace' => '#'
                )
        );

        
        if(Session::get('autenticado')){
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Cerrar Sesion',
                'enlace' => BASE_URL . 'login/cerrar'
                );
        }else{
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Iniciar Sesion',
                'enlace' => BASE_URL . 'login'
                );
            
            $menu[] = array(
                'id' => 'registro',
                'titulo' => 'Registro',
                'enlace' => BASE_URL . 'registro'
                );
        }

        $navegacion = array(
            'controlador' => $this->_request->getControlador(),
            'metodo' => $this->_request->getMetodo(),
            'ruta' => BASE_URL . $this->_request->getControlador() .'/'
            );

        $badges = array();
        
        $js = array();
        
        if(count($this->_js)){
            $js = $this->_js;
        }
        
        $css = array();
        
        if(count($this->_css)){
            $css = $this->_css;
        }

        $_layoutParams = array(
            'path_css' => BASE_URL . 'views/layout/' . $this->_template . '/css/',
            'path_img' => BASE_URL . 'views/layout/' . $this->_template . '/img/',
            'path_media' => BASE_URL . 'views/layout/' . $this->_template . '/media/',
            'path_js' => BASE_URL . 'views/layout/' . $this->_template . '/js/',
            'menu' => $menu,
            'item' => $item,
            'js' => $js,
            'css' => $css,
            'js_plugin' => $this->_jsPlugin,
            'navegacion' => $navegacion,
            'badges' => $badges
        );
        
        $pathView = $this->_rutas['view'] . $vista . '.phtml';
        
        if(is_readable($pathView)){
            include_once ROOT . 'views'. DS . 'layout' . DS . $this->_template . DS . 'header.php';
            include_once $pathView;
            include_once ROOT . 'views'. DS . 'layout' . DS . $this->_template . DS . 'footer.php';
        } 
        else {
            throw new MolecularException('Error de vista '.$vista);
            //header('location:' . BASE_URL . 'error/bug/3/'.$vista);
        }
    }
    
    public function setJs(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_js[] = $this->_rutas['js'] . $js[$i] . '.js';
            }
        } else {
            throw new MolecularException('Error de js');
            //header('location:' . BASE_URL . 'error/bug/5');
        }
    }

    public function setCss(array $css)
    {
        if(is_array($css) && count($css)){
            for($i=0; $i < count($css); $i++){
                $this->_css[] = $this->_rutas['css'] . $css[$i] . '.css';
            }
        } else {
            throw new MolecularException('Error de css');
            //header('location:' . BASE_URL . 'error/bug/6');
        }
    }

    public function setJsPlugin(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_jsplugin[] = BASE_URL . 'public/js/' .  $js[$i] . '.js';
            }
        } 
        else {
            throw new MolecularException('Error de js plugin');
            //header('location:' . BASE_URL . 'error/bug/7/');
        }
    }

    public function setTemplate($template)
    {
        $this->_template = (string) $template;
    }

    public function widget($widget, $method, $options = array())
    {
        if (!is_array($options)) {
            $options = array($options);
        }

        $pathWidget = ROOT . 'widgets' . DS . $widget . '.php';

        if (is_readable($pathWidget)) {

            include_once $pathWidget;

            $widgetClass = $widget . 'Widget';

            if (!class_exists($widgetClass)) {

                throw new MolecularException("Error clase widget");
                
            }

            if (is_callable($widgetClass, $method)) {

                if (count($options)) {
                    return call_user_func_array(array(new $widgetClass, $method), $options);
                }else{
                    return call_user_func(array(new $widgetClass, $method));
                }
            }

            throw new MolecularException("Error metodo widget");
            
        }

        throw new MolecularException("Error de widget");
        
    }
}

?>
