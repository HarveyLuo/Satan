<?php
define('COUNT', './conf/'); //���������ļ�
load::jz(COUNT . 'global');
$getBase = load::returnInclude(COUNT . 'mvca');
load::jz(COUNT . 'jc');
function __autoload($src) {
	$xml = simplexml_load_file(PATH . 'control/' . POR . '/install.xml');
	foreach($xml->Directory->list as $v) {
		if(fileDetact::pdwj(CCS . $v . '/' . $src . '.php')) {
			load::jz(CCS . $v . '/' . $src);
			$pd = false;
		} else {
			$pd = true;
		}
	}
	if(fileDetact::pdwj(CLA . $src . '.class.php')) {
		load::classJz($src);
		$pd = false;
	} else if(fileDetact::pdwj(CCS . $src . '.php')) {
		load::jz(CCS . $src);
		$pd = false;
	} else if($pd) {
		exit($src . '.php(' . $src . '.class.php)������ļ������ڣ�');
	}
}
class load {
	public static function export() {
		global $getBase;
		self::jz(CCC . $getBase['m'] . '/' . $getBase['c'] . '.class');
		$data = new $getBase['c'];
		$action = $getBase['a'] . 'Action';
		$data->$action();
	}
	
	public static function classJz($name) {
		include(CLA . $name . '.class.php');
	}
	public static function jz($name){
		include($name . '.php');
	}
	public static function returnInclude($name, $hz='php'){
		return include($name . '.' . $hz);
	}
}