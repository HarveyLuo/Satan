<?php
namespace Boot;
/**
 * Http抽象类
 *
 * @package Boot.AbstractHttp
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
abstract class AbstractHttp
{
	// # 采用stripslashes反转义特殊字符
	protected function _stripSlashes($data) {
		if (is_array($data)) {
			return array_map(array($this, '_stripSlashes'), $data);
		}

		return stripslashes($data);
	}

	// # 构造方法
	public function __construct() {
		// # 判断是否存在get_magic_quotes_gpc 以及存在是否有传参
		if (function_exists('get_magic_quotes_gpc') and get_magic_quotes_gpc()) {
			// # 转义为安全的get方式数据
			isset($_GET)     and $_GET     = $this->_stripSlashes($_GET);

			// # 转义为安全的post方式数据
			isset($_POST)    and $_POST    = $this->_stripSlashes($_POST);

			// # 转义为安全的reuqest数据
			isset($_REQUEST) and $_REQUEST = $this->_stripSlashes($_REQUEST);

			// # 转义为安全的coookie数据
			isset($_COOKIE)  and $_COOKIE  = $this->_stripSlashes($_COOKIE);
		}

		\Boot\Define::$isParamLower and isset($_GET) and $_GET = $this->_strtolowr($_GET);
		\Boot\Define::$isParamLower and isset($_POST) and $_POST = $this->_strtolowr($_POST);
	}

	/**
	 * 将数据键值转换为小写，如果是数组，则转换键名
	 *
	 * @param array|string $data 需要转换的数据
	 * @param bool $arrayValueToLowe [=true]
	 * @return string | array
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	protected function _strtolowr($data, $arrayValueToLowe = false)
	{
		if (is_array($data)) {
			$data = array_change_key_case($data, CASE_LOWER);
			$arrayValueToLowe and $data = array_map(array($this, '_strtolowr'), $data, true);
		} else {
			$data = strtolower($data);
		}

		return $data;
	}

	/**
	 * 魔术方法，用于快捷调用获取数据
	 *
	 * @return string|object 
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function __invoke($key = null, $value = null)
	{
		if ($key and $value) {
			return $this->set($key, $value);
		}
		
		return $this->get($key);
	}

	/**
	 * 设置属性
	 *
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function __set($key, $value = null)
	{
		return $this->set($key, $value);
	}
} // END abstract class AbstractHttp