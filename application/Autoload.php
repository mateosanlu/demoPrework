<?php 

function autoloadCore($class)
{
	if (file_exists(APP_PATH . ucfirst(strtolower($class) . '.php'))) {
		include_once APP_PATH . ucfirst(strtolower($class)) . '.php';
	}
    
}

function autoloadLibs($class)
{
	/* - La clase de la libreria debe llamarse igual que el archivo 
		- No puede ser el mismo nombre de los archivos en Application
	*/

	if (file_exists(ROOT . 'li bs'. DS. 'class.'.strtolower($class) . '.php')) {
		include_once ROOT . 'libs'. DS. 'class.'.strtolower($class) . '.php';
	}
    
}

spl_autoload_register('autoloadCore');
spl_autoload_register('autoloadLibs');

 ?>