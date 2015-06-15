<?php
namespace Base;
abstract class Controller {

	/**
	 * 请求的路由地址
	 *
	 * @var string
	 **/
	protected $routeURL;
	
	/**
	 * 构造方法
	 *
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	final public function __construct($url) {
		$this->routeURL = $url;
		method_exists($this, '_before') and $this->_before();
	}

	/**
	 * 析构方法，不允许被覆盖，使用 function _after
	 *
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	final public function __destruct() {
		method_exists($this, '_after') and $this->_after();
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	final public function showMessage($message, $type = 'success', $jumpUrl = null, $seconds = 3)
	{
		// $this->setMessage($message);

	}

	/**
	 * 获取请求的参数
	 *
	 * @param string|array 获取的参数名
	 * @param string 获取的类型
	 * @param string|array 返回的默认值
	 * @return string|array
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	final public function getParam($name, $type = null, $defaultValue = null)
	{
		is_string($type) and $type = strtolower($type);

		if (is_array($name)) {
			foreach ($name as $key => $value) {
				$value = $this->getParam($value, $type, $defaultValue);
				$name[$key] = $value;
			}
		}
		elseif ($type == 'get') {
			$name = \Core::getInstance('\Http\Get')->get($name, $defaultValue);
		}
		elseif ($type == 'post') {
			$name = \Core::getInstance('\Http\Post')->get($name, $defaultValue);
		}
		elseif ($type == 'server') {
			$name = \Core::getInstance('\Http\Server')->get($name, $defaultValue);
		}
		else {
			$name = \Core::getInstance('\Http\Request')->get($name, $defaultValue);
		}

		return $name;
	}
}