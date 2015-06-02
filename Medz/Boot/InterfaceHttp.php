<?php
namespace Boot;
/**
 * Http服务接口类
 *
 * @package Boot.InterfaceHttp
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
interface InterfaceHttp
{
	/**
	 * 获取数据接口方法
	 *
	 * @param string $key 获取的键名 <null>
	 * @param string $defaultValue 不存在数据返回的默认数据 <null>
	 * @return string|object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function get($key = null, $defaultValue = null);

	/**
	 * 设置数据接口方法
	 *
	 * @param string $key 设置的键名
	 * @param        $value 设置的键值 <null>
	 * @return object Post
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function set($key, $value = null);

} // END interface Http