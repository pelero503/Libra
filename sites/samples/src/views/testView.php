<?php

include_once 'ViewBase.php';

class TestView extends ViewBase{
	
	var $data;
	
	public function __construct(){
		
	}
	
	public function __destruct(){
		
	}
	
	public function getBody(){
		//echo 'Libra Framework Test View!!!';

		return 
		'<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"</head>'
		.'<p>'.$this->getData().'</p>'
		.'</html>';	
	}

	public function setData($data){
		$this->data = $data;
	}
	
	public function getData(){
		return $this->data;
	}
	
}

?>