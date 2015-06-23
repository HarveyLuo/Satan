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
	final public function getParam($name = null, $type = null, $defaultValue = null)
	{
		is_string($type)            and                      $type = strtolower($type);

		\Boot\Define::$isParamLower and is_string($name) and $name = strtolower($name);

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

	/**
	 * 构建URL <后续有缓存机制，可能判断方式修改为缓存读取当前项目根！>
	 *
	 * @param string 需要创建的路由
	 * @param string|int ($var...$var[n]) 多个，需要和第一个路由规则绑定的参数值
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function url($route)
	{

		// # 参数绑定
		if (func_num_args() >= 2) {
			$args  = func_get_args();
			$route = call_user_func_array('sprintf', $args);
		}

		// # 判断第一个字符是不是分隔符，如果不是则添加
		substr($route, 0, 1) == '/' or $route = '/' . $route;

		// # 判断是否是pathinfo
		if (\Core::getInstance('\Http\Server')->getPathInfo()) {
			$route = \Core::getInstance('\Http\Server')->get('SCRIPT_NAME') . $route;

		// # 判断是否是多级目录
		} elseif (
			($dir = \Core::getInstance('\Http\Server')->get('SCRIPT_NAME')) and
			($dir = dirname($dir))                                          and
			$dir != '\\'                                                    and
			$dir != '/'                                                     and
			$dir != \Boot\Define::$_
		) {
			$route = $dir . $route;
			unset($dir);
		}

		// # 判断第一个字符是不是分隔符，如果不是则添加
		substr($route, 0, 1) == '/' or $route = '/' . $route;

		// # 判断端口
		if (
			($prot = intval(\Core::getInstance('\Http\Server')->getServerPort())) and
			!in_array($prot, array(80, 443))) {
			$route = ':' . $prot . $route;
			unset($prot);
		}

		// # 添加域名
		$route = \Core::getInstance('\Http\Server')->getHost() . $route;

		// # 添加协议，缺省协议类型，由浏览器自动判断协议
		$route = '://' . $route;

		return $route;
	}

}