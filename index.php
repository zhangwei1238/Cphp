<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */
define('CPHP',realpath('./'));   //CPHP表示当前文件的根目录 
define('CORE',CPHP.'/core');     
define('APP', CPHP.'/app');
define('MODULE','app');
define('DEBUG',true);

include "vendor/autoload.php";   

if(DEBUG){
	//whoops 错误展现类
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
	ini_set('display_error', 'On');
}else{
	ini_set('display', 'Off');
}

include CORE.'/common/function.php';

include CORE.'/cphp.php';

spl_autoload_register('\core\cphp::load');    //自动装载load函数

\core\cphp::run();     //启动框架