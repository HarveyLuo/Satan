<?php
namespace Drive\Route;
/**
 * pathinfo获取请求的地址数据
 *
 * @package Drive.Route
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class PathInfo
{
	/**
	 * 获取
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function get()
	{
		// $scriptName = \Core::getInstance('\Http\Server')->get('SCRIPT_NAME');
		$url = \Core::getInstance('\Http\Server')->getPathInfo();

		return $url;
	}
} // END class PathInfo