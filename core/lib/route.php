<?php 
namespace core\lib;
use core\lib\conf;
class route{
	public $ctrl;
	public $action;
	public function __construct(){
		//xxx.com/index/index
		/**
		 * 1.隐藏index.php
		 * 2.获取url 参数部分
		 * 3.返回对应控制器和方法
		 * [REQUEST_URI] => /   ||/index/index
		 * [PATH_INFO] => /   ||/index/index
		 */
		if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
			$path = $_SERVER['REQUEST_URI'];
			$pathArr = explode('/', trim($path,'/'));
			if(isset($pathArr[0])){
				$this->ctrl = $pathArr[0];
				unset($pathArr[0]);
			} 
			if(isset($pathArr[1])){
				$this->action = $pathArr[1];
				unset($pathArr[1]);
			} else {
				$this->action = conf::get('ACTION','route');
			}
			//url的多余部分转换成_GET
			//id/1/str/2/test/3
			$count = count($pathArr);
			for($i=2;$i<=$count;$i=$i+2){
				$_GET[$pathArr[$i]] = $pathArr[$i+1];	
			}
		} else {
			$this->ctrl = conf::get('CTRL','route');;
			$this->action = conf::get('ACTION','route');;
		}
	}

}