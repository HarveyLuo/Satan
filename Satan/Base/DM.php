<?php
namespace Base;

/**
 * 数据模型 标准
 *
 * @package Base.DM
 * @author Medz Seven <lovevipdsw@vip.qq.com>
 **/
abstract class DM
{

	/**
	 * 储存数据的属性
	 *
	 * @var array
	 **/
	protected $data = array();

	/**
	 * 信息
	 *
	 * @var string
	 **/
	protected $message;

	/**
	 * 获取属性值
	 *
	 * @param string $filedName 需要获取属性值名称
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getField($fieldName)
	{
		if (isset($this->data[$fieldName])) {
			return $this->data[$fieldName];
		}

		$this->setMessage('获取的属性不存在');
		return false;
	}

	/**
	 * 设置属性的值
	 *
	 * @param string $filedName 设置属性的名称
	 * @param $value 设置的值
	 * @return object
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setField($fieldName, $value)
	{
		if (!is_int($value) or !is_float($value) or is_string($value)) {
			$this->setMessage('设置的字段值必须是数字或者字符串不能是其他信息');
			return false;
		}

		$this->data[$fieldName] = $value;
		return $this;
	}

	/**
	 * 获取封装的数据
	 *
	 * @return array
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getData()
	{
		return $this->data;
	}

	/**
	 * 用对象方式获取数据
	 *
	 * @param string $fieldName 获取的字段名
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	final public function __get($fieldName)
	{
		return $this->getField($fieldName);
	}

	/**
	 * 清理封装的数据
	 *
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function clear()
	{
		$this->data = array();
	}

	/**
	 * 设置消息
	 *
	 * @param string $message 消息
	 * @return void
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function setMessage($message)
	{
		$this->message = $message;
	}

	/**
	 * 获取消息
	 *
	 * @return string
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * 插入数据前调用的方法
	 *
	 * @return bool
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	abstract public function _addBefore()
	{
		return true;
	}

	/**
	 * 更新数据前的检测
	 *
	 * @return bool
	 * @author Medz Seven <lovevipdsw@vip.qq.com>
	 **/
	abstract public function _updateBefore()
	{
		return true;
	}

} // END abstract class DM