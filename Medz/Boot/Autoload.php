<?php
namespace Boot;
defined('MEDZ') or exit('Forbidden');
class AutoLoad {

	// #自动加载方法
	public static function import($className) {
		// #转义目录分割符号
		$classPath = \Core::getInstance('\Boot\AutoLoad')->replace($className);

		// # 获取文件真实路径
		$classPath = \Core::getInstance('\Boot\AutoLoad')->getPath($classPath);

		// # 如果文件不存在中断自动加载抛出异常
		if(!file_exists($classPath)) {
			throw new \Exception("Error:自动加载的类不存在", 503);
		}

		// #引入文件
		\Core::import($classPath);
	}

	// #命名空间目录分割符解析
	public function replace($name) {
		$name = str_replace('\\', \Boot\Define::$_, $name);
		$name = str_replace('/',  \Boot\Define::$_, $name);
		return $name;
	}

	// #获取文件路径
	public function getPath($path, $suffix = '.php') {
		if(file_exists(\Boot\Define::$core . $path . $suffix)) {
			$path = \Boot\Define::$core . $path . $suffix;
		}
		return $path;
	}
}