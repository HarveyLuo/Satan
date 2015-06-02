<?php
namespace Boot;
use \Exception;
defined('MEDZ') or exit('Forbidden');
class Error extends Exception {
	
	// #发送错误消息
	public static function exception($e) {
		var_dump($e);
	}

	// # 致命错误异常处理
	public static function fatalError() {
		if(($e = error_get_last())) {
			var_dump($e);
		}
	}

	// # 自定义错误
	public static function errorHandler() {
		var_dump(func_get_args());
	}

	// # 抛出异常
	public static function thrown($message, $code = 1) {
		throw new Error($message, $code);
	}

	// # 输出异常，并终止运行
	public static function halt(array $e) {
		// # code...
	}

}