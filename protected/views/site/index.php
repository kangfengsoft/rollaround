<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->name;
$this->breadcrumbs=array(
		'上架总控制台',
);
?>

<!--kf scripts-->
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/kf/site.js"></script>
<h1><?php echo $shopScore?></h1>>
<div class="row-fluid">
	<div id="dashboard-left" class="">
		<h5 class="subtitle">当前店铺状态</h5>
		<ul class="shortcuts">
			
			<?php if($enableShelfService){?>
			<li class="system"><a href="<?php echo Yii::app()->baseUrl; ?>/index.php/shelf/enableShelfService?enable=false"> <span
					class="shortcuts-icon iconsi-on"></span> <span
					class="shortcuts-label">系统：已开启</span>
			</a></li>
			<?php }else{?>
			<li class="system"><a href="<?php echo Yii::app()->baseUrl; ?>/index.php/shelf/enableShelfService?enable=true"> <span
					class="shortcuts-icon iconsi-off"></span> <span
					class="shortcuts-label">系统：已关闭</span>
			</a></li>
			<?php }?>
			
			<li class="events"><a> <span
					class="shortcuts-icon iconsi-cart"></span> <span
					class="shortcuts-label">出售中的商品：</span>
					<span class="shortcuts-label right-block-num"><?php echo $onsaleGoodNum?></span>
			</a></li>
			<li class="products"><a> <span
					class="shortcuts-icon iconsi-cart"></span> <span
					class="shortcuts-label">仓库中的商品：</span>
					<span class="shortcuts-label right-block-num"><?php echo $inventoryGoodNum?></span>
			</a></li>
			<li class="archive"><a> <span
					class="shortcuts-icon iconsi-cart"></span> <span
					class="shortcuts-label">指定上架商品：</span>
					<span class="shortcuts-label right-block-num">16</span>
			</a></li>
			<li class="help"><a> <span class="shortcuts-icon iconsi-cart"></span>
					<span class="shortcuts-label">排除上架商品：</span>
					<span class="shortcuts-label right-block-num">4</span>
			</a></li>

		</ul>
		<br>

		<h5 class="subtitle">当天策略展示</h5>
		<br />
		<div id="sales-charts" style="height: 220px; font-size: 16px;"></div>

		<div class="divider30"></div>

		<table class="table table-bordered responsive" id="info-table">
			<thead>
				<tr>
					<th class="head1">Rendering engine</th>
					<th class="head0">重要提示</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Trident</td>
					<td><p class="text-warning"><i class="icon-star-empty"></i>&nbsp;上架优化需要显示“已开启”状态，才会执行上架计划.</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-info"><i class="icon-star-empty"></i>&nbsp;目前不支持虚拟类宝贝和酒店类宝贝.</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-error"><i class="icon-star-empty"></i>&nbsp;上架优化，调整周期为一周，这段时间内流量不会有明显变化或轻微下降，之后流量将会有所增长.</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-info"><i class="icon-star-empty"></i>&nbsp;添加新宝贝上架后，系统会自动检测到新宝贝，并安排上架计划，无需手动重新调整上架计划</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-info"><i class="icon-star-empty"></i>&nbsp;系统只对在售的宝贝进行上下架，不会调整在仓库中的宝贝</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-info"><i class="icon-star-empty"></i>&nbsp;系统根据选择的上架策略设置上架时间分布（均匀分布，自定义分布），让宝贝科学合理地分布在各时间段，由于最佳分布时间为7*14=98个小时，如果在售宝贝少于这个数字，某些时间段可能会出现无宝贝上架的情况</p></td>
				</tr>
				<tr>
					<td>Trident</td>
					<td><p class="text-info"><i class="icon-star-empty"></i>&nbsp;如果用户手动设置了指定宝贝在指定时间上架，系统会自动调整该时间段的宝贝上架，实现智能动态上架</p></td>
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

