<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->name;
$this->breadcrumbs=array(
		'Index',
);
?>
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



<script type="text/javascript">
		$(document).ready(function () {							
			 var data = [];
		        var dataset = [{ label: "各时间段上架分布", data: data, color: "#5482FF" }];
		        var ticks = [];
		        for(var i=0; i<24; i++){
			        data.push([i, i*2]);
					ticks.push([i, i+"点"]);
			        }
		 
		        var options = {
		            series: {
		                bars: {
		                    show: true
		                }
		            },
		            bars: {
		                align: "center",
		                barWidth: 0.5
		            },
		            xaxis: {
		                axisLabel: "World Cities",
		                axisLabelUseCanvas: true,
		                axisLabelFontSizePixels: 12,
		                axisLabelFontFamily: 'Verdana, Arial',
		                axisLabelPadding: 10,
		                ticks: ticks
		            },
		            yaxis: {
		                axisLabel: "Average Temperature",
		                axisLabelUseCanvas: true,
		                axisLabelFontSizePixels: 12,
		                axisLabelFontFamily: 'Verdana, Arial',
		                axisLabelPadding: 3,
		                tickFormatter: function (v, axis) {
		                    return v + "%";
		                }
		            },
		            legend: {
		                noColumns: 0,
		                labelBoxBorderColor: "#000000",
		                position: "nw"
		            },
		            grid: {
		                hoverable: true,
		                borderWidth: 2,
		                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
		            }
		        };
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", dataset, options);	
				 $("#sales-charts").UseTooltip();	
			});	

		 function gd(year, month, day) {
	            return new Date(year, month, day).getTime();
	        }
	 
	        var previousPoint = null, previousLabel = null;
	 
	        $.fn.UseTooltip = function () {
	            $(this).bind("plothover", function (event, pos, item) {
	                if (item) {
	                    if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
	                        previousPoint = item.dataIndex;
	                        previousLabel = item.series.label;
	                        $("#tooltip").remove();
	 
	                        var x = item.datapoint[0];
	                        var y = item.datapoint[1];
	 
	                        var color = item.series.color;
	 
	                        //console.log(item.series.xaxis.ticks[x].label);               
	 
	                        showTooltip(item.pageX,
	                        item.pageY,
	                        color,
	                        "<strong>" + item.series.label + "</strong><br>" + item.series.xaxis.ticks[x].label + " : <strong>" + y + "</strong> %");
	                    }
	                } else {
	                    $("#tooltip").remove();
	                    previousPoint = null;
	                }
	            });
	        };
	 
	        function showTooltip(x, y, color, contents) {
	            $('<div id="tooltip">' + contents + '</div>').css({
	                position: 'absolute',
	                display: 'none',
	                top: y - 40,
	                left: x - 120,
	                border: '2px solid ' + color,
	                padding: '3px',
	                'font-size': '9px',
	                'border-radius': '5px',
	                'background-color': '#fff',
	                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
	                opacity: 0.9
	            }).appendTo("body").fadeIn(200);
	        }

</script>			
