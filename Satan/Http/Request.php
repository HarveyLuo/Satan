<?php
namespace Http;
use \Boot\InterfaceHttp;
use \Boot\AbstractHttp;
class Request extends AbstractHttp implements InterfaceHttp {

	// # 获取请求的参数
	public function get($key = null, $defaultValue = null) {
		if(!$key) {
			return array_merge($_REQUEST, $_GET, $_POST);
		} else if(isset($_GET[$key])) {
			return $_GET[$key];
		} else if(isset($_POST[$key])) {
			return $_POST[$key];
		} else if(isset($_REQUEST[$key])) {
			return $_REQUEST[$key];
		}
		return $defaultValue;
	}

	// # 设置request全局变量
	public function set($key, $value = null) {
		$_REQUEST[$key] = $this->_stripSlashes($value);
		return $this;
	}
}