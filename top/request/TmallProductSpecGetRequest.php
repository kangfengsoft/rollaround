<<<<<<< HEAD
<?php
/**
 * TOP API: tmall.product.spec.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class TmallProductSpecGetRequest
{
	/** 
	 * 要获取信息的产品规格信息。
	 **/
	private $specId;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: tmall.product.spec.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class TmallProductSpecGetRequest
{
	/** 
	 * 要获取信息的产品规格信息。
	 **/
	private $specId;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setSpecId($specId)
	{
		$this->specId = $specId;
		$this->apiParas["spec_id"] = $specId;
	}

	public function getSpecId()
	{
		return $this->specId;
	}

	public function getApiMethodName()
	{
		return "tmall.product.spec.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->specId,"specId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
