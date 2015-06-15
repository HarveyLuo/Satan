<?php
namespace Http;
use \Http\Request;
/**
 * 服务器信息Http类
 *
 * @package Http.Server
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Server extends Request
{
	/**
	 * 根据键名获取信息
	 *
	 * @return string|array|object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function get($key = null, $defaultValue = null)
	{
		if (!$key) {
			return $_SERVER;
		} elseif (isset($_SERVER[$key])) {
			return $_SERVER[$key];
		}
		return $defaultValue;
	}

	/**
	 * 设置值
	 *
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function set($key, $value = null)
	{
		$_SERVER[$key] = $this->_stripSlashes($value);
		return $this;
	}

	/**
	 * 获取 HTTP_HOST
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getHost()
	{
		return $this->get('HTTP_HOST');
	}

	/**
	 * 获取 HTTP_CONNECTION
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getConnection()
	{
		return $this->get('HTTP_CONNECTION');
	}

	/**
	 * 获取 HTTP_ACCEPT
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getAccept()
	{
		return $this->get('HTTP_ACCEPT');
	}

	/**
	 * 获取 HTTP_USER_AGENT
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getUserAgent()
	{
		return $this->get('HTTP_USER_AGENT');
	}

	/**
	 * 获取 HTTP_ACCEPT_LANGUAGE
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getLanguage()
	{
		return $this->get('HTTP_ACCEPT_LANGUAGE');
	}

	/**
	 * 获取 SERVER_NAME
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getName()
	{
		return $this->get('SERVER_NAME');
	}

	/**
	 * 获取 SERVER_ADDR 服务器IP地址
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getServerIP()
	{
		return $this->get('SERVER_ADDR');
	}

	/**
	 * 获取 SERVER_PORT 服务器端口
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getServerPort()
	{
		return $this->get('SERVER_PORT');
	}

	/**
	 * 获取 REMOTE_ADDR 客户端IP
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getClientIP()
	{
		return $this->get('REMOTE_ADDR');
	}

	/**
	 * 获取 REMOTE_PORT 客户访问端口
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getClientPort()
	{
		return $this->get('REMOTE_PORT');
	}

	/**
	 * 获取 PATH_INFO 
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getPathInfo()
	{
		return $this->get('PATH_INFO');
	}

	/**
	 * 获取 REQUEST_TIME|REQUEST_TIME_FLOAT 客户端请求时间戳
	 *
	 * @return int|float
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getRequestTime($getMS = null)
	{
		if ($getMS) {
			return $this->get('REQUEST_TIME_FLOAT');
		}
		return $this->get('REQUEST_TIME');
	}

	/**
	 * 获取 REQUEST_URI 请求的地址
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getRequestURL()
	{
		return $this->get('REQUEST_URI');
	}

} // END class Server extends Request