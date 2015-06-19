<?php
namespace Database;

use \PDO;

use \Database\DM;

/**
 * 数据库操作 - MySQL 驱动
 *
 * @package Database.MySQL
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
class MySQL extends PDO
{

	private function __construct($host, $prot = 3306, $userName, $password, $DatabaseName) {
		$this->foo = $foo;
	}

	/**
	 * 获取数据库连接操作类
	 *
	 * @param object $object 数据库信息封装类
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public static function getHandler(DM $object)
	{
		return new self(
			$object->host,
			$object->prot,
			$object->userName,
			$object->password,
			$object->databaseName
		);
	}

} // END class MySQL extends PDO