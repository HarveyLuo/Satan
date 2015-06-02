<?php
namespace Boot;
defined('MEDZ') or exit('Forbidden');
class Define {

	// #定义系统目录分割符
	public static $_                 = DIRECTORY_SEPARATOR;

	// #定义核心目录位置
	public static $core;

	// #定义网站应用位置
	public static $app;

	// # 定义默认应用
	public static $defaultApp        = 'Home';

	// # 定义默认控制器
	public static $defaultController = 'Index';

	// # 定义控制器默认方法
	public static $defaultAction     = 'index';

	// # 定义控制器后缀
	public static $controllerSuffix  = 'Controller';

	// # 定义控制器中action的后缀
	public static $actionSuffix      = 'Action';

	// # 是否开启debug
	public static $debug             = false;

	// # 是否是多个项目
	public static $isApps            = true;

	// # 定义配置文件所在目录
	public static $configDir;

}