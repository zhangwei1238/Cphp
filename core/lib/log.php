<?php
namespace core\lib;
use core\lib\conf;
class log{
	/**
	 * 1.确定日志的存储方式
	 *
	 * 2.写日志
	 */
	public static $class;
	public static function init(){
		//确定存储方式
		$drive = conf::get('DRIVE','log');
		$class = '\core\lib\drive\log\\'.$drive;  //\core\lib\drive\log\file
		self::$class = new $class();
	}

	public static function log($message,$file='log'){
		self::$class->log($message,$file);
	}
}