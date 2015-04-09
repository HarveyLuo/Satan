<?php
namespace Boot;
defined('MEDZ') or exit('Forbidden');
class Error {
	
	// #发送错误消息
	public function exception($e) {
		var_dump($e);
	}

}