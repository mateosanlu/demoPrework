<?php 

/**
 * 
 */
class menuWidget extends Widget
{
	private $_model;

	public function __construct(){
        //$this->_model = $this->loadModel('menu');
    }
    
	public function getMenu()
	{
		$data['menu'] = ['Documentación', 'Moléculas'];

		return $this->render('menu-top', $data);
	}

	public function getMenuTransfer()
	{
		return $this->render('menu-transfer');
	}
}

 ?>