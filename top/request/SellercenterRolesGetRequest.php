<<<<<<< HEAD
<?php
/**
 * TOP API: taobao.sellercenter.roles.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class SellercenterRolesGetRequest
{
	/** 
	 * 卖家昵称(只允许查询自己的信息：当前登陆者)
	 **/
	private $nick;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: taobao.sellercenter.roles.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class SellercenterRolesGetRequest
{
	/** 
	 * 卖家昵称(只允许查询自己的信息：当前登陆者)
	 **/
	private $nick;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setNick($nick)
	{
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick()
	{
		return $this->nick;
	}

	public function getApiMethodName()
	{
		return "taobao.sellercenter.roles.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->nick,"nick");
		RequestCheckUtil::checkMaxLength($this->nick,500,"nick");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
