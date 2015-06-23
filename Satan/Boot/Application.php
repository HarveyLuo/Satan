<?php
namespace Boot;
/**
 * 项目运行类
 *
 * @package Boot.Application
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
final class Application
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
	 * 用于储存伪静态下当前路由信息
	 *
	 * @var array
	 **/
	public $route;

	/**
	 * 路由参数
	 *
	 * @var string
	 **/
	public $param;

	/**
	 * 储存应用
	 *
	 * @var object
	 **/
	protected $application;

	final public function __construct() {
		$this->route     = Route::get();
		$this->namespace = $this->route['namespace'];
		$this->action    = $this->route['action'];
		$this->param     = $this->route['param'];
		$this->route     = $this->route['url']; 

		$this->application = \Core::getInstance($this->namespace, $this->route);

		$this->application = call_user_func_array(array(
			$this->application,
			$this->action
		), $this->param);

		$this->run();
	}

	/**
	 * 运行
	 *
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	protected function run()
	{
		list($this->app, $this->controller) = explode('Controller', $this->namespace);

		$this->app        = str_replace('\\', '', $this->app);
		$this->controller = str_replace('\\', '', $this->controller); 
		var_dump($this);
	}

} // END class Application