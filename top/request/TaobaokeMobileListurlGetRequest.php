<<<<<<< HEAD
<?php
/**
 * TOP API: taobao.taobaoke.mobile.listurl.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class TaobaokeMobileListurlGetRequest
{
	/** 
	 * 关键词
	 **/
	private $q;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: taobao.taobaoke.mobile.listurl.get request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class TaobaokeMobileListurlGetRequest
{
	/** 
	 * 关键词
	 **/
	private $q;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setQ($q)
	{
		$this->q = $q;
		$this->apiParas["q"] = $q;
	}

	public function getQ()
	{
		return $this->q;
	}

	public function getApiMethodName()
	{
		return "taobao.taobaoke.mobile.listurl.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->q,"q");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
