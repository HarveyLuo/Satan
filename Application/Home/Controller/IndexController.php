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
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 * @route /{首页处理|123,"\d+"}-demo
	 **/
	public function aaaAction()
	{
		echo '默认测试';
		return $this;
	}

	/**
	 * 默认控制器
	 *
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 * @route /index/id-{?我是描述|我是默认值,"\d+"}-p-{?page|1,"\d+"}
	 **/
	public function indexAction($id , $page)
	{
		// var_dump($this->url('index/%d/%s', 123, 45));
		// var_dump(\Core::getInstance('\Http\Server')->get());
		var_dump(func_get_args());
		return $this;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 * @route /456/{a,"\d+"}/{d|haha,"\w+"}/{?c|3}
	 **/
	public function demoAction($a, $d, $c)
	{
		echo '我是demo';
		var_dump($a, $d, func_get_args());
		return $this;
	}

} // END class Index extends Controller