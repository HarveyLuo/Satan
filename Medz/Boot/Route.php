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
	 * 获取路由
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public static function get($namespace, $action)
	{
		self::addClass($namespace);
		
		$str = self::$classList[$namespace]->getMethod($action)->getDocComment();
		return $str;
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