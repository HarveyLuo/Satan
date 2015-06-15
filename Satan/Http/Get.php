<?php
namespace Http;
use \Http\Request as Request;
class Get extends Request {

	// # 获取get参数
	public function get($key = null, $defaultValue = null) {
		if(!$key) {
			return $_GET;
		} else if(isset($_GET[$key])) {
			return $_GET[$key];
		}
		return $defaultValue;
	}

	// # 设置get
	public function set($key, $value = null) {
		$_GET[$key] = $this->_stripSlashes($value);
		return $this;
	}
}