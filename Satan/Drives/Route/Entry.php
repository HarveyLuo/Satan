<?php
namespace Route;
use \Boot\Error;
/**
 * 路由驱动 - 入口文件
 *
 * @package Drive.Route
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Entry
{

	/**
	 * 路由器规则
	 *
	 * @var array
	 **/
	protected $routes = array();

	/**
	 * 命名空间和方法名分隔符
	 *
	 * @var string
	 **/
	protected $explode = '>';

	/**
	 * 构造方法	接收需要匹配的路由规则文档（未格式化）
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct(array $docs) {
		foreach ($docs as $namespace => $actionsDocs) {
			foreach ($actionsDocs as $action => $doc) {
				$doc  =  $this->getRoutePattern($doc);
				$doc and $this->routes[$namespace . $this->explode . $action] = $doc;
			}
		}
	}

	/**
	 * 获取
	 *
	 * @return array
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function get()
	{
		$url = $this->getBasePath();
		$_   = array();

		foreach ($this->routes as $namespace => $route) {
			$i  = strpos($route, '{');
			$s1 = substr($url, 0, $i);
			$s2 = substr($route, 0, $i);
			substr($s1, strlen($s1)-1) == '/' and $s1 = substr($s1, 0, strlen($s1)-1);
			substr($s2, strlen($s2)-1) == '/' and $s2 = substr($s2, 0, strlen($s2)-1);

			if ($s1 == $s2) {
				$s1 = substr($url, $i);
				$s2 = substr($route, $i);
				$s1 = explode('/', $s1);
				$s2 = explode('/', $s2);

				foreach ($s2 as $key => $value) {
					empty($s1[$key]) and strpos($value, '|') and $s1[$key] = substr($value, strpos($value, '|') + 1, strpos($value, '}') - strlen($value));
					empty($s1[$key]) or  array_push($_, $s1[$key]);
					empty($s1[$key]) and array_push($_, null);
				}

				$__ = explode($this->explode, $namespace);
				$___= $__['1'];
				$__ = $__['0'];
				break;
			}
		}

		if (empty($__) and empty($___)) {
			$__ = array('');

			\Boot\Define::$isApps and array_push($__, \Boot\Define::$defaultApp);

			array_push($__, 'Controller');
			array_push($__, \Boot\Define::$defaultController);

			$__  = implode('\\', $__);
			$___ = \Boot\Define::$defaultAction . \Boot\Define::$actionSuffix;

			$_   = $__ . $this->explode . $___;
			$_   = $this->routes[$_];
			$_   = explode('/', $_);

			$_temp = array();
			foreach ($_ as $value) {
				$value = '.' . $value; // # 防止第一个参数索引为0

				if (strpos($value, '{') and strpos($value, '}')) {
					array_push($_temp, substr($value, strpos($value, '|') + 1, strlen($value) - strpos($value, '}')));
				}
			}
			$_ = $_temp;
		}

		return array(
			'action'    => $___,
			'namespace' => $__,
			'param'     => $_,
			'url'       => $url
		);
	}

	/**
	 * 根据doc说明获取路由
	 *
	 * @param string @doc 需要检索出路由规则的字符串
	 * @return string
	 * @author Medz Seven <lovevipdsw@ip.qq.com>
	 **/
	protected function getRoutePattern($doc)
	{
		preg_match('/@route\\s*(.*)\\s*\\n/si', $doc, $route, 0, 0);
		isset($route['1']) and $route = preg_replace('/\\s*/', '', $route['1']);
		is_array($route)   and $route = false;
		return $route;
	}

	/**
	 * 获取伪静态根为起始地伪静态真实字段，排除多级目录
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getBasePath()
	{
		$url =  \Core::getInstance('\Http\Server')->getPathInfo();
		$url or $url = $this->getRewritePath();
		return $url;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getRewritePath()
	{
		$url = \Core::getInstance('\Http\Server')->getRequestURL();

		strpos($url, '?') and $url = explode('?', $url);
		is_array($url)    and $url = $url['0'];

		$path = \Core::getInstance('\Http\Server')->get('PHP_SELF', \Core::getInstance('\Http\Server')->get('SCRIPT_NAME'));
		$path = dirname($path);

		$url  = str_replace($path, '', $url);
		$url  = explode('/', $url);
		$url  = array_filter($url, function($v) {
			if ($v) {
				return true;
			}
			return false;
		});

		$url  = implode('/', $url);
		substr($url, 0, 1) == '/' or $url = '/' . $url;

		return $url;
	}

} // END class PathInfo