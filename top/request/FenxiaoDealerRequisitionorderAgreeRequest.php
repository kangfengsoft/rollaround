<<<<<<< HEAD
<?php
/**
 * TOP API: taobao.fenxiao.dealer.requisitionorder.agree request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class FenxiaoDealerRequisitionorderAgreeRequest
{
	/** 
	 * 采购申请单编号
	 **/
	private $dealerOrderId;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: taobao.fenxiao.dealer.requisitionorder.agree request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class FenxiaoDealerRequisitionorderAgreeRequest
{
	/** 
	 * 采购申请单编号
	 **/
	private $dealerOrderId;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setDealerOrderId($dealerOrderId)
	{
		$this->dealerOrderId = $dealerOrderId;
		$this->apiParas["dealer_order_id"] = $dealerOrderId;
	}

	public function getDealerOrderId()
	{
		return $this->dealerOrderId;
	}

	public function getApiMethodName()
	{
		return "taobao.fenxiao.dealer.requisitionorder.agree";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->dealerOrderId,"dealerOrderId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
