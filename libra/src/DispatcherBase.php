<?php
include_once 'request.php';
include_once 'exception.php';
include_once 'util/ClassLoader.php';
include_once 'Config.php';

/**
 * DispatcherBase
 * 중앙 관리 클래스로서 사용자의 dispatcher는 이 크랠스를 상속받아 사용해야한다.
 * 웹서버로부터 받아온 정보들을 개발자에게 보여줄 수 있으며 컨트롤러를 보여주기위한 루틴을 포함하고 있다.
 */
abstract class DispatcherBase {
	
	const staticPageRule = '/pages/';
	const framedir = '../../../libra/src';
	
	public function __construct() {
	}

	public function __destruct() {
	}

	static public function invoke($disp) {
		if($disp==null)
			return;
			
		try{
			
			$disp->dispatch();
		}catch(Exception $e){
			$disp->exception($e);
		}
		return;
	}

	abstract protected function exception(Exception $e);
	abstract protected function onStaticPageProcess($URI);
		
	protected function isStaticPage($uri, $rule){
		if(strtolower(substr($uri,0, strlen($rule)))== strtolower($rule)){
			return true;
		}
		return false;
		
	}
	
	private function staticPageProcess($URI){
		// 예외 페이지 처리(컨트롤러를 거치지 않는 정적인 페이지)
		// 1. URI를 불러온다.
		// 2. URI가 설정된 예외페이지 규칙에 맞는지 본다.
		// 3. 맞으면 실제로 그페이지가 존재 하는지 물어보고 있으면 가져와서 보내준다. 리턴한다. 끝
		// 4. 없으면 Exception페이지를 보여준다. 리턴한다. 끝.
		
		switch($URI){
			case '/':											// index page
				if($GLOBALS['Config']['defaultPage'] == '')		// 설정이 되있지 않을 경우.
					return false;
				break;
			default:
				if($this->isStaticPage($URI, self::staticPageRule)===false)
					return false;
		}
			
		if(file_exists(self::framedir.$URI)===false)
			throw new ExceptionNotFound();
			
		include_once self::framedir.$URI;
		
		return true;		
	}
	
	private function isController($name){
		
		if(file_exists(self::framedir.$name)===false)
			throw new ExceptionNotFound();
	}
	
	protected function defaultURI(&$URI){
		// '/' 이 들어온걸 비교하고, '/'이 아니라면 인덱스 페이지 스트링과 같은지 비교 한다.
		if( $URI != '/' && $URI != '/'.$GLOBALS['Config']['defaultPage'])
			return false;
		
		// defaultURI 처리
		if( $GLOBALS['Config']['defaultURI'] != ''){
			$URI .= $GLOBALS['Config']['defaultURI'];
			return false;
		}
		
		return true;
	}
	
	private function response(){
		
	}

	private function dispatch() {
		
		$URI = $_SERVER['REQUEST_URI'];
				
		// defaultPage 처리
		if( $this->defaultURI($URI) === true ){
			return;
		}
				echo 'an';
		// 사용자 예외 페이지 처리.
		if($this->onStaticPageProcess($URI) === true){
			return;
		}
		
		if($this->staticPageProcess($URI) === true ){
			return;
		}
					
		// 1. request analysis
		$request = new Request($URI);
		
		// 2. request to controller mapping
		// 컨트롤러들을 포함시켜준다.
		ClassLoader::loader('controllers');

		// 클래스가 있는지 확인한다.
		if( class_exists($request->path->control) === false )
			throw new ExceptionBadRequest();
		
		$controller = new $request->path->control();	
		
		// 메소드가 있는지 확인한다.
		if( method_exists($controller, $request->path->method) === false )
			throw new ExceptionBadRequest();	

		// 컨트롤러를 실행시킨다.
		$method = $request->path->method;
		$controller->$method($request->path->params);
		
		
		// response를 custom 할 수 있다.
		
		header('a : a');
		setcookie('asdfd');
		print $controller->getResult();
		
		return;
	}
	
	
	
}

?>
