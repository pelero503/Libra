<?php


/**
 * URIPath
 * URI 분석 결과를 가지는 클래스.
 */
class URIPath {
	var $control;
	var $method;
	var $params;
}

/**
*	URI Parser
*	sample 
*		$path=URIParser::parse("/con/me/?a=1&b=1");
*		$path[control];
*		$path[method];
*		$path[params];
*		$path->control;
*		$path->method;
*		$path->params;
*/
class URIParser{

	var $path;
	
	public function __construct($uri){
		$this->path = new URIPath;
		
		if($this->init($uri)==false)
			throw new ExceptionBadRequest();
	}
	
	public function __destruct(){ 
	}
	
	private function isValidSyntax($path, &$params){
	
		$count = count($path);

		// 1. Controller Name check
		if(preg_match("/^[a-zA-Z][a-zA-Z0-9]*$/", $path[0])  != 1){
			error_log('Controller name check failed.');
			return false;
		}
		// 2. Method Name check
		if(preg_match("/^[a-zA-Z][a-zA-Z0-9]*$/", $path[1])  != 1){
			error_log('Method name check failed.');
			return false;
		}
					
		if($count == 2)
			return true;
			
		// 3. param check
		if(substr($path[2],0,1) != '?')	// 첫 문자가 "?"인지 확인한다.
			return false;	

		$paramParts = explode('&', substr($path[2], 1)); 
		$items = array();
		$index =0;
		foreach ($paramParts as $items) {
			if (preg_match("/^[0-9A-Za-z]+=[^&=]+$/", $items, $match) == 0)
				return false;
				
			$params[$index++] = $match[0];
    	}
    	    	
		return true;
	}
	
	private function isValidURI($path) {
		$cnt=count($path);
		
		if($cnt==2)
			return true;
			
		if($cnt==3)
			return true;
			
		return false;
	}
	
	private function init($uri){
	
		if($uri[0] != '/')
			return false;
			
		$uri = substr($uri,1);
		
		$temp = preg_split("[[/]+]", $uri);
		
		// URI 체크
		if($this->isValidURI($temp)==false)
			return false;
			
		// 문법 체크
		if($this->isValidSyntax($temp, $params) == false)
			return false;

		$this->path->control=$temp[0];
		$this->path->method=$temp[1];
		$this->path->params=$params;
			
		return true;
	}


	public function getControllerName(){
		return $this->path->control;
	}
	
	public function getMethodName(){
		return $this->path->method;
	}
	
	public function getParams(){
		return $this->path->params;
	}
	
	public function getPath(){
		return $this->path;
	}
	
	static public function parse($uri){
		$parse=new URIParser($uri);
		
		return $parse->getPath();
	}
}

?>