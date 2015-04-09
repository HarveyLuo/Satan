<?php
namespace Http;
class Request {

	protected $type = array(
		'_GET',
		'_POST',
		'_REQUEST',
		'_EVN',
		'_PUT'
	);

	// # 获取GET请求
	public function get($key = null) {
		return $this->getRequestByType('_GET', $key);
	}

	// # 获取post请求
	public function post($key = null) {
		return $this->getRequestByType('_POST', $key);
	}

	// # 获取类型请求
	private function getRequestByType($type = '_GET', $key = null, $defaultValue = null) {
		if(!in_array($type, $this->type)) {
			throw new \Exception("获取参数的类型不合法", 403);
		}
		//$request = $$type;
		$_GET = 123;
		return $$type;
		// if(!isset($request) and $key) {
		// 	return $defaultValue;
		// } else if(!$key) {
		// 	return $request;
		// } else if(is_array($key)) {
		// 	foreach ($key as &$value) {
		// 		$value = $this->getRequestByType($type, $value);
		// 	}
		// 	unset($value);
		// 	unset($key);
		// 	return $key;
		// }
		// return isset($request[$key]) ? $request[$key] : $defaultValue;
	}
}