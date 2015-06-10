<?php
use \Boot\Error;
use \Boot\Route;
use \Boot\Drive;
/**
 * 核心类
 *
 * @package Core
 * @author  Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Core {

	// # 文件加载列表
	private static $_loadlist  = array();

	// # 实例化类列表
	private static $_classList = array();

	// # 是否已经初始化
	private static $_isInit    = false;

	/**
	 * 初始化
	 *
	 * @param string $configFileName 需要导入的配置文件名，不包含后缀
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	final public static function init($configFileName = null) {
		// # 设置网页编码
		header('charset=UTF-8');

		// #判断是否初始化过了
		if(!self::$_isInit) {
			// #设置安全校验
			self::setDefine('MEDZ', true);

			// #加载配置文件
			self::import(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Boot' . DIRECTORY_SEPARATOR . 'Define.php');

			// #加载自动加载类文件
			self::import(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Boot' . DIRECTORY_SEPARATOR . 'AutoLoad.php');

			// #加载自动加载类文件
			self::import(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Boot' . DIRECTORY_SEPARATOR . 'Error.php');

			// # 设置致命错误处理方法
			function_exists('register_shutdown_function') and register_shutdown_function('\Boot\Error::fatalError');

			// #设置异常处理类
			function_exists('set_exception_handler')      and set_exception_handler('\Boot\Error::exception');

			// # 自定义错误处理类
			function_exists('set_error_handler')          and set_error_handler('\Boot\Error::errorHandler');

			// #禁用字符串自动转义
			if(function_exists('set_magic_quotes_runtime')and PHP_VERSION < '5.3.0') {
				set_magic_quotes_runtime(false);
			}

			// #禁用初始化
			self::$_isInit = true;
		}

		$configFileName and \Boot\Define::import($configFileName);
	}

	// #运行
	final public static function run() {
		// # 初始化配置
		self::getInstance('\Core')->defaultInit();

		// #设置运行模式
		self::getInstance('\Core')->runMode();
			
		// #注册自动加载方法
		spl_autoload_register('\Boot\AutoLoad::import');

		// # 运行
		self::getInstance('\Boot\Application');
	}

	// #设置常用值
	public static function setDefine($name, $value = '') {
		define($name, $value);
	}

	// #单例加载文件
	final public static function import($path) {
		if(file_exists($path) and !in_array($path, self::$_loadlist)) {
			array_push(self::$_loadlist, $path);
			return include $path;
		}
	}

	// #单例获取实例类
	final public static function getInstance($name) {
		// #检查是否已经存在单例
		if(isset(self::$_classList[$name])) {
			return self::$_classList[$name];

		// # 检查是否有构造方法 如果没有直接实例化
		} else if(method_exists($name, '__construct') == false) {
			$class         = new $name;

		// # 反射实例化
		} else {
			// # 获取需要传入的参数
			isset($args) or $args = func_get_args();
						    array_shift($args);

			// # 检查类是否自封装有单例类
			if (method_exists($name, 'getInstance')) {
				$class = call_user_func_array($name . '::getInstance', $args);

			// # 使用PHP反射类，对类构造方法进行动态传参，并实例化
			} else {
				$class = call_user_func_array(array(Route::addClass($name), 'newInstance'), $args);
			}

			unset($args);
		}

		// # 加入单例列表
		self::$_classList[$name] = $class;

		// # 注销实例化的类
		unset($class);

		// # 返回单例
		return self::getInstance($name);
	}

	// # 调配框架运行模式
	private function runMode() {
		if(\Boot\Define::$debug) {
			error_reporting(E_ALL);

			// #运行前的检查
			self::getInstance('\Core')->check();
		} else {
			error_reporting(E_ERROR | E_PARSE);
		}
	}

	// #程序必要函数检查
	private function check() {
		// #检查PHP版本
		if(PHP_VERSION < '5.3.0') {
			Error::thrown('PHP版本小于程序运行最低版本（PHP Version 5.3.0）', 403);

		// # 检查环境是否有set_exception_handler函数
		} else if(function_exists('set_exception_handler') === false) {
			Error::thrown('程序需要的set_exception_handler函数不存在！', 403);

		// # 检查单例重载的反射类是否存在
		} else if(class_exists('ReflectionClass') === false) {
			Error::thrown('程序必须的反射类“ReflectionClass”不存在！', 403);

		// # 检查func_get_args函数是否存在
		} else if(function_exists('func_get_args') === false) {
			Error::thrown('程序所需的func_get_args函数不存在', 403);
		
		// # 检查call_user_func_array函数是否存在
		} else if(function_exists('call_user_func_array') === false) {
			Error::thrown('程序所需的call_user_func_array函数不存在', 403);
			
		// # 检查应用目录是否存在
		} else if(is_dir(\Boot\Define::$app) === false) {
			Error::thrown('应用目录“' . \Boot\Define::$app . '”不存在', 403);
		}
	}

	// # 初始化配置
	private function defaultInit() {
		// # 设置核心类所在目录
		\Boot\Define::$core or \Boot\Define::$core = dirname(__FILE__) . \Boot\Define::$_;

		// #设置应用所在目录
		\Boot\Define::$app  or \Boot\Define::$app  = \Boot\Define::$core . 'Application' . \Boot\Define::$_;

		// # 设置驱动所在目录
		\Boot\Define::$DriveDir or \Boot\Define::$DriveDir = \Boot\Define::$core . 'Drives' . \Boot\Define::$_;
	}

} // END class Core