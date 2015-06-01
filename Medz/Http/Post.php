<?php
namespace Http;
use \Http\Request as Request;
/**
 * $_POST操作类
 *
 * @package Http.Post
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Post extends Requset
{
	/**
	 * 获取POST数据
	 *
	 * @param string $key 获取的键名
	 * @param mixed  $defaultValue 获取的键名书客居不存在返回的默认值 <null>
	 * @return $_POST[$KEY]
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function get($key = null, $defaultValue = null)
	{
		if (!$key) {
			return $_POST;
		} elseif (isset($_POST[$key])) {
			return $_POST[$key];
		}
		return $defaultValue;
	}

	/**
	 * 设置POST数据数组
	 *
	 * @param string $key 设置的键名
	 * @param        $value 设置的键值 <null>
	 * @return object Post
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function set(string $key, $value = null)
	{
		$_POST[$key] = $this->_stripSlashes($value);
		return $this;
	}
} // END class Post extends Requset