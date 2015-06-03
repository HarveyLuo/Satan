<?php
namespace Boot;
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

	final public function __construct() {
		// // var_dump(basename(__FILE__));
		// // var_dump(\Core::getInstance('\Http\Server')->get());
		// var_dump(Route::get('Http\Post', 'get'));
		// $info = Route::get();
		// var_dump(scandir(\Boot\Define::$app));
		var_dump(Route::get());
	}

} // END class Application