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
	 * 储存应用
	 *
	 * @var object
	 **/
	protected $application;

	final public function __construct() {
		$this->route       = Route::get();
		$this->application = \Core::getInstance($this->route['namespace'], $this->route['url']);

		$this->application = call_user_func_array(array(
			$this->application,
			$this->route['action']
		), $this->route['param']);
	}

} // END class Application