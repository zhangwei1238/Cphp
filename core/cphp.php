<?php 
namespace core;
class cphp{
	public $assign;

	public static function run(){
		\core\lib\log::init();
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		$ctrlFile = APP.'/ctrl/'.$ctrlClass.'Ctrl.php';
		$ctrlClassNew = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl';
		if(is_file($ctrlFile)){
			//include $ctrlFile;
			$ctrl = new $ctrlClassNew();
			$ctrl->$action();
			\core\lib\log::log('ctrl:'.$ctrlClass.'  action:'.$action);
		} else {
			throw new \Exception("找不到控制器".$ctrlClass);
			
		}
	}

	public static function load($class){
		//自动加载类库
		//new \core\lib\route();
		//$class = 'core\lib\route';
		//CPHP.'/core/lib/route.php'
		$class = str_replace('\\', '/', $class);
		if(is_file(CPHP.'/'.$class.'.php')){
			include CPHP.'/'.$class.'.php';
			//echo CPHP.'/'.$class.'.php'.'<br/>';
		} else {
			return false;
		}
		
	}

	public function assign($name,$data){
		$this->assign[$name] = $data;	
	}

	public function display($file){
		$filePath = APP.'/views/'.$file;
		if(is_file($filePath)){
			//1.可以extract($this->assign);include $filePath;	
			//2.使用twig模板引擎
			\Twig_Autoloader::register();
			$loader = new \Twig_Loader_Filesystem(APP.'/views');
			$twig = new \Twig_Environment($loader, array(
			    'cache' => CPHP.'/log/twig',
			    'debug' =>DEBUG
			));
			$template = $twig->load($file);
			echo $template->render($this->assign?$this->assign:array());
		}
	}
}