<?php
namespace Boot;
use \Base\Controller;
/**
 * 项目运行类
 *
 * @package Boot.Application
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class Application
{

	/**
	 * 当前运行的项目名称
	 *
	 * @var string
	 **/
	public $app;

	/**
	 * 当前运行的控制器名称
	 *
	 * @var string
	 **/
	public $controller;

	/**
	 * 当前控制器名称
	 *
	 * @var string
	 **/
	public $action;

	/**
	 * 命名空间
	 *
	 * @var string
	 **/
	public $namespace;

	/**
	 * 运行
	 *
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function run()
	{
		var_dump(Route::get('Http\Post', 'get'));
	}

	function __construct() {
		// $this->app = $this->getAppName
	}

} // END class Application