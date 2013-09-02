<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->name;
$this->breadcrumbs=array(
		'上架总控制台',
);
?>

<!-- for test -->
<a href="?r=shelf/getGoodNum" class="btn btn-large btn-primary">get good
	number demo</a>
<a href="?r=shelf/getOnsaleGoods" class="btn btn-large btn-primary">get
	onsale goods</a>
<!-- for test end -->

<!--kf scripts-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kf/site.js"></script>

<div class="row-fluid">
	<div id="dashboard-left" class="">
		<h5 class="subtitle">当前店铺状态</h5>
		<ul class="shortcuts">
			
			
			<?php if($enableShelfService){?>
			<li class="system"><a href="?r=shelf/enableShelfService&enable=false"> <span
					class="shortcuts-icon iconsi-images"></span> <span
					class="shortcuts-label">系统：已开启</span>
			</a></li>
			<?php }else{?>
			<li class="system"><a href="?r=shelf/enableShelfService&enable=true"> <span
					class="shortcuts-icon iconsi-images"></span> <span
					class="shortcuts-label">系统：已关闭</span>
			</a></li>
			<?php }?>
			
			<li class="events"><a href=""> <span
					class="shortcuts-icon iconsi-cart"></span> <span
					class="shortcuts-label">在售商品：95</span>
			</a></li>
			<li class="products"><a href=""> <span
					class="shortcuts-icon iconsi-cart"></span> <span
					class="shortcuts-label">仓库中商品：6</span>
			</a></li>
			<li class="archive"><a href=""> <span
					class="shortcuts-icon iconsi-cart"></span> <span
					class="shortcuts-label">指定商品：16</span>
			</a></li>
			<li class="help"><a href=""> <span class="shortcuts-icon iconsi-cart"></span>
					<span class="shortcuts-label">排除商品：3</span>
			</a></li>

		</ul>
		<br>

		<h5 class="subtitle">当天策略展示</h5>
		<br />
		<div id="sales-charts" style="height: 220px; font-size: 16px;"></div>

		<div class="divider30"></div>

		<table class="table table-bordered responsive">
			<thead>
				<tr>
					<th class="head1">Rendering engine</th>
					<th class="head0">重要提示</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Trident</td>
					<td><p class="text-warning">上架优化需要显示“已开启”状态，才会执行上架计划.</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-info">目前不支持虚拟类宝贝和酒店类宝贝.</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-error">上架优化，调整周期为一周，这段时间内流量不会有明显变化或轻微下降，之后流量将会有所增长
							.</p></td>
				</tr>
			</tbody>
		</table>

		<br />

	</div>
	<!--span8-->




</div>
<!--row-fluid-->

<div class='row-fluid'>

	<div class="span6 profile-left">

		<div class="widgetbox tags">
			<h4 class="widgettitle">成功案例</h4>
			<div class="widgetcontent">
				<ul class="taglist">
					<li><a href="">HTML5 <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">CSS <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">PHP <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">jQuery <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">Java <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">GWT <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">CodeNgniter <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">Bootstrap <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
				</ul>
			</div>
		</div>

	</div>

	<div class="span6 profile-right">

		<div class="widgetbox tags">
			<h4 class="widgettitle">常见问题</h4>
			<div class="widgetcontent">
				<ul class="taglist">
					<li><a href="">HTML5 <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">CSS <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">PHP <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">jQuery <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">Java <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">GWT <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">CodeNgniter <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
					<li><a href="">Bootstrap <span class="close"><i
								class="icon-chevron-right"></i></span></a></li>
				</ul>
				<a style="display: block; margin-top: 10px" href="">更多问题</a>
			</div>
		</div>

	</div>
</div>

<span id="weekShelfStrategy" class="hide"><?php echo $weekShelfStrategy?></span>

