<<<<<<< HEAD
<?php
/**
 * TOP API: taobao.promotion.activity.cancel request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class PromotionActivityCancelRequest
{
	/** 
	 * 活动id
	 **/
	private $activityId;
	
	private $apiParas = array();
	
=======
<?php
/**
 * TOP API: taobao.promotion.activity.cancel request
 * 
 * @author auto create
 * @since 1.0, 2013-08-16 12:49:12
 */
class PromotionActivityCancelRequest
{
	/** 
	 * 活动id
	 **/
	private $activityId;
	
	private $apiParas = array();
	
>>>>>>> #develop update w8
	public function setActivityId($activityId)
	{
		$this->activityId = $activityId;
		$this->apiParas["activity_id"] = $activityId;
	}

	public function getActivityId()
	{
		return $this->activityId;
	}

	public function getApiMethodName()
	{
		return "taobao.promotion.activity.cancel";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->activityId,"activityId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
