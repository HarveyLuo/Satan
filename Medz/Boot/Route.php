<?php
namespace Boot;
/**
 * 路由器
 *
 * @package Boot.Route
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Route
{

	/**
	 * 已经反射的类列表
	 *
	 * @var array
	 **/
	private static $classList = array();

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public static $docs = array();

	/**
	 * 获取路由
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public static function get()
	{
		if (!self::$docs) {
			foreach (self::getControllerNamespaceAll() as $namespace) {
				self::addClass($namespace);

				foreach (self::$classList[$namespace]->getMethods() as $doc) {
					self::$docs[$namespace][$doc->name] = $doc->getDocComment();
				}
			}
		}
		return Drive::getInstance('Route', 'Entry')->getDrive(self::$docs)->get();
	}

	/**
	 * 获取所以Controller的命名空间
	 *
	 * @return array
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public static function getControllerNamespaceAll()
	{
		$namespaces = array();
		foreach (self::getControllers() as $path) {
			$namespace = explode(\Boot\Define::$app, $path);
			$namespace = $namespace['1'];
			$namespace = explode(\Boot\Define::$controllerSuffix . \Boot\Define::$PHPFileSuffix, $namespace);
			$namespace = $namespace['0'];
			$namespace = str_replace(\Boot\Define::$_, '\\', $namespace);
			$namespace = '\\' . $namespace;
			array_push($namespaces, $namespace);
		}
		return $namespaces;
	}

	/**
	 * 获取所有的控制器文件路径
	 *
	 * @return void
	 * @author 
	 **/
	private static function getControllers()
	{
		$list = array();
		if (\Boot\Define::$isApps) {
			$d = opendir(\Boot\Define::$app);
			while (($dir = readdir($d)) !== false) {
				if (!in_array($dir, array('.', '..')) and is_dir(($dir = \Boot\Define::$app . $dir))) {
					$list = self::getControllerFiles($dir . \Boot\Define::$_, $list);
				}
			}
			closedir($d);
			return $list;
		}
		return self::getControllerFiles(\Boot\Define::$app, $list);
	}

	/**
	 * 获取目录下的控制器
	 *
	 * @return void
	 * @author 
	 **/
	private static function getControllerFiles($path, array $list = array())
	{
		$path .= 'Controller' . \Boot\Define::$_;
		$d     = opendir($path);
		while (($file = readdir($d)) !== false) {
			if (!in_array($file, array('.', '..')) and is_file(($file = $path . $file))) {
				array_push($list, $file);
			}
		}
		closedir($d);
		return $list;
	}

	/**
	 * 添加一个反射类
	 *
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public static function addClass($namespace)
	{
		if (!isset(self::$classList[$namespace])) {
			self::$classList[$namespace] = new \ReflectionClass($namespace);
		}

		return self::$classList[$namespace];
	}

} // END class Route