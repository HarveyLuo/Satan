<?php
namespace Boot;
/**
 * 驱动驱动器
 *
 * @package Boot.Drive
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Drive
{
	/**
	 * 当储存当前类的class
	 *
	 * @var object
	 **/
	protected static $class;

	/**
	 * 驱动命名空间
	 *
	 * @var string
	 **/
	protected $namespace = '\\{$driveName}\\{$entry}';

	/**
	 * 构造方法，用于单例获取驱动类
	 *
	 * @param string $driveName 驱动名称
	 * @param string $entry 驱动入口类
	 * @return void
	 * @author 
	 **/
	private function __construct($driveName, $entry) {
		$this->buildNamespace($driveName, $entry);
	}

	/**
	 * 组建命名空间
	 *
	 * @param string $driveName 驱动名称
	 * @param string $entry 驱动入口类
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	private function buildNamespace($driveName, $entry)
	{
		$this->namespace = str_replace('{$driveName}', $driveName, $this->namespace);
		$this->namespace = str_replace('{$entry}'    , $entry    , $this->namespace);
	}

	/**
	 * 获取驱动类
	 *
	 * @param [$var1, $var2 ...] 如果驱动有单例传参或者构造传出方法，可以在这里传参！
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getDrive($var = null)
	{
		// # 获取传入的参数
		$args = func_get_args();

		// # 将命名空间压入数组底部
		array_unshift($args, $this->namespace);

		return call_user_func_array('\Core::getInstance', $args);
	}

	/**
	 * 获取命名空间名称
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getNamespaceName()
	{
		return $this->namespace;
	}

	/**
	 * 单例获取驱动驱动器
	 *
	 * @param string $driveName 驱动名称
	 * @param string $entry 驱动入口类
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public static function getInstance($driveName, $entry)
	{
		isset(self::$class) or self::$class = new self($driveName, $entry);
		return self::$class;
	}

} // END class Drive