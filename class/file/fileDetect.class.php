<?php
class fileDetact {
	//检测目录是否存在
	public static function folder($name) { 
		if(!is_dir($name)){
			return true;
		} else {
			return false;
		}
	}
	//创建目录
	public static function cjml($name) {
		mkdir($name);
	}
	//判断文件是否存在
	public static function pdwj($name) {
		if(file_exists($name)) {
			return true;
		} else {
			return false;
		}
	}
	//创建文件和写入文件
	public static function cjwj($name, $data) {
		file_put_contents($name,$data);
	}
	//读取文件
	public static function dqwj($url, $hz='php'){
		return file_get_contents($url . '.' .$hz);
	}
	
	//xml读取
	public static function xml($name){
		return simplexml_load_string(self::dqwj($name, 'xml'));
	}
}
