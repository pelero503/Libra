<?php
include_once 'dispatcherbase.php';
include_once 'Config.php';
class Dispatcher extends DispatcherBase {

	var $exceptionPagePath;
	
	public function __construct(){
		parent::__construct();
		
		
	}
	
	public function __destruct(){
		parent::__destruct();
	}

	protected function exception(Exception $e) {
		// response exception pages
		//
		switch($e->getCode()){
			case 404:
			case 400:
				echo 'error'.$e->getCode().$e->getMessage().'<br/>';
				//header('location : /exception/uriexception.php');
				break;
			case 500:
				break;
			default:
				break;
		}
	}
	
	public function controllerFinder(){
		return ;
	}
	
	protected function onStaticPageProcess($URI) {
		return;
	}


}


$Config['defaultPage'] = 'inddex.php';

Dispatcher::invoke(new Dispatcher());

?>
