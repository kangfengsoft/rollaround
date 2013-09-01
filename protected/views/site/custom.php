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
			<ul class="dropdown-menu">
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
			<h5><span class="text-success">将鼠标移动到蓝色柱形上，上下拖动可以调节该时间段上架货物百分比</span></h5> 
			<hr>
			<!-- 			<div id="drag"></div>
			<div id="drop"></div> 
			<hr> -->


			<div class="btn-group">
				<a class="btn btn-small dropdown-toggle" data-toggle="dropdown"
					href="#"> 平均策略 <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li class="active"><a href="#">星期一</a></li>
					<li><a href="#">星期二</a></li>
				</ul>
			</div>
			<hr>
			<ul class="unstyled spaced2">

				<li class="text-warning orange"><i class="icon-warning-sign"></i>
					平均抽取每个小时 0.01%进行再次分配</li>
			</ul>
			<button class="btn btn-primary" onclick=saveData()>
				<span class="hidden-phone">保存设置</span>
			</button>
	
	</div>
	<!--widgetcontent-->
</div>
<!--widgetbox-->

<span id="modifyStrategy" class="hide"><?php echo $distribution?></span>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kf/custom-chart.js"></script>

