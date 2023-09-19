<?php

/**
 * controller abstract Class
 */
abstract class controllerBase{
	
	public function __construct(){
	}
	
	public function __destruct(){
	}
	
	abstract public function getResult();
}

?>