<<<<<<< HEAD
<?php
/**
 * TOP API: taobao.ump.tool.delete request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class UmpToolDeleteRequest
{
	/** 
	 * 营销工具id
	 **/
	private $toolId;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: taobao.ump.tool.delete request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class UmpToolDeleteRequest
{
	/** 
	 * 营销工具id
	 **/
	private $toolId;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setToolId($toolId)
	{
		$this->toolId = $toolId;
		$this->apiParas["tool_id"] = $toolId;
	}

	public function getToolId()
	{
		return $this->toolId;
	}

	public function getApiMethodName()
	{
		return "taobao.ump.tool.delete";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->toolId,"toolId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
