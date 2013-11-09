<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'自定义策略',
);
?>


<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>

<div class="widgetbox box-info">
	<div class="headtitle">
		<div class="btn-group">
			<button data-toggle="dropdown" class="btn dropdown-toggle">
				星期一<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" id="selectCurrentDay">
				<li class="active"><a href="#" class='1'>星期一</a></li>
				<li><a href="#" class='2'>星期二</a></li>
				<li><a href="#" class='3'>星期三</a></li>
				<li><a href="#" class='4'>星期四</a></li>
				<li><a href="#" class='5'>星期五</a></li>
				<li><a href="#" class='6'>星期六</a></li>
				<li><a href="#" class='0'>星期天</a></li>
			</ul>
		</div>
		<h4 class="widgettitle">各时间段上架分布图</h4>
	</div>
	<div class="widgetcontent">
	
	<div id="container" style="height: 300px"></div>
			<h5><span class="text-success">使用说明：</span></h5>
			<h5><span class="text-success">① 一周黄金时段是7*16小时左右，如果平均分配宝贝，则每小时约上架宝贝占总数是100/7/16约为0.89%</span></h5> 
			<h5><span class="text-success">② 将鼠标移动到蓝色的圆点上，上下拖动该点位置即可以调节该时间段上架货物百分比</span></h5> 
			<h5><span class="text-success">③ 初始的“可调节的商品余量”是0%，需要拖动某个蓝色的点往下（降低某时段上架量），以此来获得可调节商品量，从而上调其他时段商品量</span></h5> 
			<h5><span class="text-success">④ 图右上角可以选择星期几，查看不同天的不同策略，全部调节完后点击下方的“保存设置”方可生效，可刷新页面进行查验</span></h5> 
			<hr>
			<!-- 			<div id="drag"></div>
			<div id="drop"></div> 
			<hr> -->
		
			<div class="btn-group ">
				<a class="btn btn-small dropdown-toggle" data-toggle="dropdown"
					href="#"> 平均策略 <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" id='selectCurrentStrategy'>
					<li class="active"><a href="#" class="0">策略一</a></li>
					<li><a href="#" class="1">策略二</a></li>
					<li><a href="#" class="2">策略三</a></li>
					<li><a href="#" class="3">策略四</a></li>
				</ul>
			</div>
			<hr>
			<ul class="unstyled spaced2">

				<li class="text-warning orange"><i class="icon-warning-sign"></i>
					平均抽取每个时间段的 0.01%进行再次分配(只抽取大于0.01%的时间段)</li>
			</ul>
			<button class="btn btn-primary" onclick=extract()>
				<span class="hidden-phone">抽取</span>
			</button>
			<button class="btn btn-primary" onclick=saveData()>
				<span class="hidden-phone">保存设置</span>
			</button>
	</div>
	<!--widgetcontent-->
</div>
<!--widgetbox-->

<span id="shelfStrategyList" class="hide"><?php echo $shelfStrategyList?></span>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kf/custom-chart.js"></script>

