<?php
namespace Home\Controller;
use \Base\Controller;
/**
 * 默认控制器
 *
 * @package Home.Controller.Index
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Index extends Controller
{

	/**
	 * 默认控制器
	 *
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 * @route /id/{id|1}/{page|5}
	 **/
	public function indexAction($id , $page)
	{
		echo '我是默认';
		var_dump($id, $page);
		var_dump(\Core::getInstance('\Http\Server')->get());
		return $this;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 * @route /demo/{a}/{d|a}/{c}
	 **/
	public function demoAction($a, $d, $c)
	{
		echo '我是demo';
		var_dump($a, $d, func_get_args());
		return $this;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function aaaAction()
	{
		echo '没有路由，无法定位';
		return $this;
	}

} // END class Index extends Controller