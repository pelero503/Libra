<?php

/**
 * view abstract class
 */
abstract class ViewBase{
	
	public function __construct(){
		
	}
	
	public function __destruct(){
		
	}
	
	abstract public function setData($data);
	abstract public function getBody();
	
}


?>