<?php
error_reporting(E_ALL);
require_once "Model/Core/Session.php";
$s=new Model_Core_Session();
$s->start();
define('DS', DIRECTORY_SEPARATOR);	


spl_autoload_register(function($className){
	$classPath= str_replace("_","/",$className);
	require_once "{$classPath}.php";
});



require_once "Controller/Core/Front.php";
require_once "Controller/Core/Action.php";


class Ccc extends Controller_Core_Action
{

	public static function init()
	{
		$front = new Controller_Core_Front();
		$front->init();
	}



	public static function getModel($className){
		$className='Model_'.$className;
		return new $className();
	}


	public static function getBlock($className){
		$className='Block_'.$className;
		return new $className();
	}
	

	public static function getSingleton($className){
		$className = 'Model_'.$className;

		if (array_key_exists($className,$GLOBALS)) {
			return $GLOBALS[$className];
		}

		$GLOBALS[$className]=new $className();
		return $GLOBALS[$className];
	}



	public static function register($key,$value)
	{
		$GLOBALS[$key]=$value;
	}

	public static function getRegistry($key)
	{
		if (array_key_exists($key,$GLOBALS)) {
			return $GLOBALS[$key];
		}
		return null;
	}

	public static function log($data,$fileName='system.log',$newFile=false)		
	{
		self::getSingleton('Core_Log')->log($data,$fileName,$newFile);	
	}

	public static  function getBaseDir($subDir=null)
	{
		$dir=getcwd();
		if ($subDir) {
			return $dir.$subDir;
		}
		return $dir;
	}


	

}

Ccc::init();

?>