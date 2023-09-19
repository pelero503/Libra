<?php
include_once 'controllerBase.php';
include_once 'exception.php';
include_once 'models/testModel.php';
include_once 'views/testView.php';

class Test extends ControllerBase{
	
	var $result;
	
	public function __construct(){
		
	}
	
	public function __destruct(){
		
	}
	
	public function run(){
		// 모델을 불러온다.
		$testModel = new TestModel();
		// 모델에게 데이터를 달라고 한다.
		$modelData = $testModel->getData();
		// 뷰를 생성한다.
		$testView = new TestView();
		// 모델에서 받은 데이터를 뷰에게 넘겨준다.
		$testView->setData($modelData);
		// 뷰에게서 최종 결과물을 받아온다 .
		$this->result = $testView->getBody();
	}
	
	public function getResult(){
		return $this->result; 
	}
	
}

?>