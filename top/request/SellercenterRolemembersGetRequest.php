<<<<<<< HEAD
<?php
/**
 * TOP API: taobao.sellercenter.rolemembers.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class SellercenterRolemembersGetRequest
{
	/** 
	 * 角色id
	 **/
	private $roleId;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: taobao.sellercenter.rolemembers.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class SellercenterRolemembersGetRequest
{
	/** 
	 * 角色id
	 **/
	private $roleId;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setRoleId($roleId)
	{
		$this->roleId = $roleId;
		$this->apiParas["role_id"] = $roleId;
	}

	public function getRoleId()
	{
		return $this->roleId;
	}

	public function getApiMethodName()
	{
		return "taobao.sellercenter.rolemembers.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->roleId,"roleId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
