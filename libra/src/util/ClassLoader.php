<?php

// Class Loader Util
// 
// History
// 2011.11.27 Cheol-Joo Lee (fogking@bncp.co.kr), make it
// 2011.11.28 Heo Yongseon (yong5eon@bncp.co.kr), move PhpFileLoader to ClassLoader
//

class ClassLoader{

	private $extensions=array('php', 'phtml', 'phps', 'inc');
	private $handle=NULL;
	private $path=NULL;
	
	public function __construct($path){
		$this->handle=opendir($path);

		if($this->handle===false)
			throw ExceptionInternalServerError();

		$this->path=$path;
	}
	
	public function __destruct(){
		closedir($this->handle);
	}

	public function load(){

		$file=readdir($this->handle);

		do{

			if($file===false)
				break;
			
			if($file=='.' || $file=='..')
				continue;

			$filepath=$this->path.'/'.$file;

			if(is_dir($filepath)===true){
				self::loader($filepath);
				continue;
			}

			$info=pathinfo($file);

			if(array_key_exists('extension', $info)==false)
				continue;

			foreach($this->extensions as $value)
				if($value==$info['extension']){
					require_once($filepath);
					continue;
				}

		}while($file=readdir($this->handle));

		return;
	}
	
	public static function loader($path){

		$loader=new self($path);

		$loader->load();

		return;		
	}
	
}

?>
