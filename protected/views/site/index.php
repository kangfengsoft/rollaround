<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->name;
$this->breadcrumbs=array(
		'Index',
);
?>
<!--kf scripts-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/site.js"></script>
<div class="row-fluid">
	<div class="span10 infobox-container">
		<a href="?r=shelf/getGoodNum" class="btn btn-large btn-primary">get good number demo</a>
		<a href="?r=shelf/getOnsaleGoods" class="btn btn-large btn-primary">get onsale goods</a>
		<div class="infobox infobox-green  ">
			<div class="infobox-icon">
				<i class="icon-comments"></i>
			</div>
	
			<div class="infobox-data">
				<span class="infobox-data-number">32</span>
				<div class="infobox-content">comments + 2 reviews</div>
			</div>
			<div class="stat stat-success">8%</div>
		</div>
	
		<div class="infobox infobox-blue  ">
			<div class="infobox-icon">
				<i class="icon-twitter"></i>
			</div>
	
			<div class="infobox-data">
				<span class="infobox-data-number">11</span>
				<div class="infobox-content">new followers</div>
			</div>
	
			<div class="badge badge-success">
				+32% <i class="icon-arrow-up"></i>
			</div>
		</div>
	
		<div class="infobox infobox-pink  ">
			<div class="infobox-icon">
				<i class="icon-shopping-cart"></i>
			</div>
	
			<div class="infobox-data">
				<span class="infobox-data-number">8</span>
				<div class="infobox-content">new orders</div>
			</div>
			<div class="stat stat-important">+4%</div>
		</div>
	
		<div class="infobox infobox-red  ">
			<div class="infobox-icon">
				<i class="icon-beaker"></i>
			</div>
	
			<div class="infobox-data">
				<span class="infobox-data-number">7</span>
				<div class="infobox-content">experiments</div>
			</div>
		</div>
	
		<div class="infobox infobox-orange2  ">
			<div class="infobox-chart">
				<span class="sparkline"
					data-values="196,128,202,177,154,94,100,170,224"></span>
			</div>
	
			<div class="infobox-data">
				<span class="infobox-data-number">6,251</span>
				<div class="infobox-content">pageviews</div>
			</div>
	
			<div class="badge badge-success">
				7.2% <i class="icon-arrow-up"></i>
			</div>
		</div>
	
		<div class="infobox infobox-blue2  ">
			<div class="infobox-progress">
				<div class="easy-pie-chart percentage" data-percent="42"
					data-size="46">
					<span class="percent">42</span>%
				</div>
			</div>
	
			<div class="infobox-data">
				<span class="infobox-text">traffic used</span>
	
				<div class="infobox-content">
					<span class="bigger-110">~</span> 58GB remaining
				</div>
			</div>
		</div>
	
		<div class="spw8-6"></div>
	
		
	</div>
</div>

<div class="hr hr32 hr-dotted"></div>

<div class="row-fluid">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-flat">
			<h4>上架策略</h4>

			<div class="widget-toolbar">
				
			</div>
		</div>
	<div class="widget-body">
		<div class="widget-main padding-4">
			<div id="sales-charts"></div>
		</div><!--/widget-main-->
	</div><!--/widget-body-->
</div>

<hr>

<div class="row-fluid">
	<div class="widget-box">
		<div class="widget-header widget-header-flat">
			<h4>上架设置</h4>

			<div class="widget-toolbar">
				
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				<label>
					<small class="green">
						<b>未启动</b>
					</small>

					<input id="id-check-horizontal" type="checkbox" class="ace-switch ace-switch-6" />
					<span class="lbl" for="id-check-horizontal"></span>
				</label>
				
				<hr>
				
					<ul id="tasks" class="item-list">
						<li class="item-grey">
							<label class="inline">
								<input type="checkbox" />
								<span class="lbl"> Adding new skins</span>
							</label>
						</li>

						<li class="item-green">
							<label class="inline">
								<input type="checkbox" />
								<span class="lbl"> Updating server software up</span>
							</label>
						</li>
					</ul>
			</div>
		</div>
	</div>
</div>
<span id="dayShelfStrategy" class="hide"><?php echo $distribution?></span>

