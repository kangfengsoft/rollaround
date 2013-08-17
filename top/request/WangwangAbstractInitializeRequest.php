<<<<<<< HEAD
<?php
/**
 * TOP API: taobao.wangwang.abstract.initialize request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class WangwangAbstractInitializeRequest
{
	/** 
	 * 传入参数的字符集
	 **/
	private $charset;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: taobao.wangwang.abstract.initialize request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class WangwangAbstractInitializeRequest
{
	/** 
	 * 传入参数的字符集
	 **/
	private $charset;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setCharset($charset)
	{
		$this->charset = $charset;
		$this->apiParas["charset"] = $charset;
	}

	public function getCharset()
	{
		return $this->charset;
	}

	public function getApiMethodName()
	{
		return "taobao.wangwang.abstract.initialize";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
