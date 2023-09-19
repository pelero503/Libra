<?php
include_once 'ModelBase.php';

class TestModel extends ModelBase{
	
	public function __construct(){
		
	}
	
	public function  __destruct(){
		
	}
	
	public function getData(){
		return '모델 데이터 입니다.';
	}
}


?>