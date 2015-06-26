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
			Error::thrown('Error:自动加载的类文件(' . $classPath . ')不存在', 500);
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
	public function getPath($path) {
		$suffix = \Boot\Define::$PHPFileSuffix;

		// # 判断框架下文件是否存在
		if(file_exists(\Boot\Define::$core . $path . $suffix)) {
			$path = \Boot\Define::$core . $path . $suffix;

		// # 判断在项目中是否存在
		} elseif (file_exists(\Boot\Define::$app . $path . $suffix)) {
			$path = \Boot\Define::$app . $path . $suffix;

		// # 对控制器文件处理，判断是否是控制器文件，文件是否存在;
		} elseif (file_exists(\Boot\Define::$app . $path . \Boot\Define::$controllerSuffix . $suffix)) {
			$path = \Boot\Define::$app . $path . \Boot\Define::$controllerSuffix . $suffix;

		// # 对驱动进行文件判断
		} elseif (file_exists(\Boot\Define::$driveDir . $path . $suffix)) {
			$path = \Boot\Define::$driveDir . $path . $suffix;
		}

		// # 返回文件路径
		return $path;
	}
}