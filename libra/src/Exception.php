<?php

/**
 * ExceptonBase
 * 예외처리에 관련된 메세지를 로깅한다.
 */
class ExceptionBase extends Exception{

	public function __construct($message, $code){
		parent::__construct($message, $code);
		$this->logging();
	}
	
	public function __destruct(){
	}
	
	public function logging(){
		error_log($this);
	}

}

class ExceptionNotFound extends ExceptionBase {
	public function __construct(){
		parent::__construct("Not Found", 404);
	}
}

class ExceptionBadRequest extends ExceptionBase {
	public function __construct() {
		parent::__construct("Bad Request", 400);
	}
}

class ExceptionInternalServerError extends ExceptionBase {
	public function __construct() {
		parent::__construct("InternalServerError", 500);
	}
}


?>
