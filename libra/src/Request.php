<?php
include_once 'uriparser.php';
include_once 'UserAgent.php';

/**
 * Request
 * 1. URI 파싱 : URIParser::parse()
 * 2. 쿠키 분석 : $_COOKIE['cookieName']
 * 3. 에이전트 분석 : $_SERVER["HTTP_USER_AGENT"];
 * 4. 메소드 분석 : $_SERVER["REQUEST_METHOD"];
 */
class Request{

	public $method=NULL;
	public $path=NULL;
	public $agent=NULL;
	public $cookies=NULL;
	
	public function __construct($URI){
		$this->method=$_SERVER['REQUEST_METHOD'];
		$this->path=URIParser::parse($URI);
		$this->agent=UserAgent::detect($_SERVER['HTTP_USER_AGENT']);
		//$this->cookies=$_COOKIE['cookieName'];
	}
	
	public function __destruct(){
	}	
	
	public function getMethod(){ return $this->method; }
	public function getPath(){ return $this->path; }
	public function getAgent(){ return $this->agent; }
	public function getCookie($name){	return $this->cookies; }

}

?>
