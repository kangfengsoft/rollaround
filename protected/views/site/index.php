<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->name;
?>

<div class="span7 infobox-container">
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

	<div class="infobox infobox-green infobox-small infobox-dark">
		<div class="infobox-progress">
			<div class="easy-pie-chart percentage" data-percent="61"
				data-size="39">
				<span class="percent">61</span>%
			</div>
		</div>

		<div class="infobox-data">
			<div class="infobox-content">Task</div>
			<div class="infobox-content">Completion</div>
		</div>
	</div>

	<div class="infobox infobox-blue infobox-small infobox-dark">
		<div class="infobox-chart">
			<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
		</div>

		<div class="infobox-data">
			<div class="infobox-content">Earnings</div>
			<div class="infobox-content">$32,000</div>
		</div>
	</div>

	<div class="infobox infobox-grey infobox-small infobox-dark">
		<div class="infobox-icon">
			<i class="icon-download-alt"></i>
		</div>

		<div class="infobox-data">
			<div class="infobox-content">Downloads</div>
			<div class="infobox-content">1,205</div>
		</div>
	</div>
</div>

<div class="widget-body">
	<div class="widget-main padding-4">
		<div id="sales-charts"></div>
	</div><!--/widget-main-->
</div><!--/widget-body-->


<script type="text/javascript">
		$(document).ready(function () {							
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});		
			});	
</script>			