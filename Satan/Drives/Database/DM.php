<?php
namespace Database;

use Base\DM as BaseDM;

/**
 * 数据库连接数据模型
 *
 * @package Database.DM
 * @author Medz Seven <lovevipdsw@vip.qq.com> 
 **/
final class DM extends BaseDM
{

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	private $types = array('mysql');

	/**
	 * 设置数据库主机地址
	 *
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setHost($host)
	{
		$this->setField('host', $host);
		return $this;
	}

	/**
	 * 设置数据库连接端口
	 *
	 * @param int $prot 数据库连接端口
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setProt($prot = 3306)
	{
		$this->setField('prot', intval($prot));
		return $this;
	}

	/**
	 * 设置数据库名称
	 *
	 * @param string $DatabaseName 数据库名称
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setDatabaseName($databaseName)
	{
		$this->setField('databaseName', $databaseName);
		return $this;
	}

	/**
	 * 设置数据库连接用户名
	 *
	 * @param string $userName 数据库名称
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setUserName($userName)
	{
		$this->setField('userName', $userName);
		return $this;
	}

	/**
	 * 设置数据库用户密码
	 *
	 * @param string $password 用户密码
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setPassword($password)
	{
		$this->setField('password', $password);
		return $this;
	}

	/**
	 * 设置数据库连接类型
	 *
	 * @param string $type = 设置数据库连接类型
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setDataType($type = 'mysql')
	{
		$type = strtolower($type);
		if (!in_array($type, $this->types)) {
			$this->setMessage('设置的数据库类型不支持');
			return false;
		}

		return $this;
	}

} // END final class DM extends BaseDM