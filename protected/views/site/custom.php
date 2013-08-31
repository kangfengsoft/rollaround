<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'自定义策略',
);
?>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>



	<div class="widget-box">
		<div class="widget-header widget-header-flat widget-header-small">
			<h5>
				<i class="icon-signal"></i>
				各时间段上架分布图
			</h5>

			<div class="widget-toolbar no-border">
				<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
					星期一
					<i class="icon-angle-down icon-on-right"></i>
				</button>

				<ul class="dropdown-menu dropdown-info pull-right dropdown-caret">
					<li class="active">
						<a href="#" class='1'>星期一</a>
					</li>

					<li>
						<a href="#" class='2'>星期二</a>
					</li>

					<li>
						<a href="#" class='3'>星期三</a>
					</li>

					<li>
						<a href="#" class='4'>星期四</a>
					</li>
					<li>
						<a href="#" class='5'>星期五</a>
					</li>
					<li>
						<a href="#" class='6'>星期六</a>
					</li>
					<li>
						<a href="#" class='0'>星期天</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main">
			
				
			<div id="container" style="height: 300px"></div>
			<i class="icon-circle green"></i>
					<span class="text-success">将鼠标移动到蓝色柱形上，上下拖动可以调节该时间段上架货物百分比</span>
 			<hr>
<!-- 			<div id="drag"></div>
			<div id="drop"></div> 
			<hr> -->
			
		
				<div class="btn-group">
  <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
 		平均策略
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    				<li class="active">
						<a href="#">星期一</a>
					</li>
					<li>
						<a href="#">星期二</a>
					</li>
  </ul>
</div>
				<hr>
			<ul class="unstyled spaced2">

				<li class="text-warning orange">
					<i class="icon-warning-sign"></i>
					平均抽取每个小时 0.01%进行再次分配
				</li>
			</ul>
			<button class="btn btn-small btn-info no-radius" onclick=saveData()>
				<i class="icon-share-alt"></i>
				<span class="hidden-phone">保存设置</span>
			</button>
			
			</div><!--/widget-main-->
		</div><!--/widget-body-->
	</div><!--/widget-box-->

<span id="modifyStrategy" class="hide"><?php echo $distribution?></span>


<script>



/**
 * Experimental Draggable points plugin
 * Revised 2013-06-13 (get latest version from http://jsfiddle.net/highcharts/AyUbx/)
 * Author: Torstein Hønsi
 * License: MIT License
 *
 */
(function (Highcharts) {
    var addEvent = Highcharts.addEvent,
        each = Highcharts.each;

    /**
     * Filter by dragMin and dragMax
     */
    function filterRange(newY, series, XOrY) {
        var options = series.options,
            dragMin = options['dragMin' + XOrY],
            dragMax = options['dragMax' + XOrY];

        if (newY < dragMin) {
            newY = dragMin;
        } else if (newY > dragMax) {
            newY = dragMax;
        }
        return newY;
    }

    Highcharts.Chart.prototype.callbacks.push(function (chart) {

        var container = chart.container,
            dragPoint,
            dragX,
            dragY,
            dragPlotX,
            dragPlotY;

        chart.redraw(); // kill animation (why was this again?)

        addEvent(container, 'mousedown', function (e) {
            var hoverPoint = chart.hoverPoint,
                options;

            if (hoverPoint) {
                options = hoverPoint.series.options;
                if (options.draggableX) {
                    dragPoint = hoverPoint;

                    dragX = e.pageX;
                    dragPlotX = dragPoint.plotX;
                }

                if (options.draggableY) {
                    dragPoint = hoverPoint;

                    dragY = e.pageY;
                    dragPlotY = dragPoint.plotY + (chart.plotHeight - (dragPoint.yBottom || chart.plotHeight));
                }

                // Disable zooming when dragging
                if (dragPoint) {
                    chart.mouseIsDown = false;
                }
            }
        });

        addEvent(container, 'mousemove', function (e) {
            if (dragPoint) {
                var deltaY = dragY - e.pageY,
                    deltaX = dragX - e.pageX,
                    newPlotX = dragPlotX - deltaX - dragPoint.series.xAxis.minPixelPadding,
                    newPlotY = chart.plotHeight - dragPlotY + deltaY,
                    newX = dragX === undefined ? dragPoint.x : dragPoint.series.xAxis.translate(newPlotX, true),
                    newY = dragY === undefined ? dragPoint.y : dragPoint.series.yAxis.translate(newPlotY, true),
                    series = dragPoint.series,
                    proceed;

                newX = filterRange(newX, series, 'X');
                newY = filterRange(newY, series, 'Y');

                // Fire the 'drag' event with a default action to move the point.
                dragPoint.firePointEvent(
                    'drag', {
                    newX: newX,
                    newY: newY
                },

                function () {
                    proceed = true;
                    dragPoint.update([newX, newY], false);
                    chart.tooltip.refresh(chart.tooltip.shared ? [dragPoint] : dragPoint);
                    if (series.stackKey) {
                        chart.redraw();
                    } else {
                        series.redraw();
                    }
                });
                
                // The default handler has not run because of prevented default
                if (!proceed) {
                    drop();
                }
            }
        });

        function drop(e) {
            if (dragPoint) {
                if (e) {
                    var deltaX = dragX - e.pageX,
                        deltaY = dragY - e.pageY,
                        newPlotX = dragPlotX - deltaX - dragPoint.series.xAxis.minPixelPadding,
                        newPlotY = chart.plotHeight - dragPlotY + deltaY,
                        series = dragPoint.series,
                        newX = dragX === undefined ? dragPoint.x : dragPoint.series.xAxis.translate(newPlotX, true),
                        newY = dragY === undefined ? dragPoint.y : dragPoint.series.yAxis.translate(newPlotY, true);
    
                    newX = filterRange(newX, series, 'X');
                    newY = filterRange(newY, series, 'Y');
                    dragPoint.update([newX, newY]);
                }                
                dragPoint.firePointEvent('drop');
            }
            dragPoint = dragX = dragY = undefined;
        }
        addEvent(document, 'mouseup', drop);
        addEvent(container, 'mouseleave', drop);
    });

    /**
     * Extend the column chart tracker by visualizing the tracker object for small points
     */
    var colProto = Highcharts.seriesTypes.column.prototype,
        baseDrawTracker = colProto.drawTracker;

    colProto.drawTracker = function () {
        var series = this;
        baseDrawTracker.apply(series);
        each(series.points, function (point) {
            point.graphic.attr(point.shapeArgs.height < 3 ? {
                'stroke': 'black',
                'stroke-width': 2,
                'dashstyle': 'shortdot'
            } : {
                'stroke-width': series.options.borderWidth,
                'dashstyle': series.options.dashStyle || 'solid'
            });
        });
    };
 
})(Highcharts);
// End plugin


var xLayer = [];
for(var i=0;i<24; i++){
	xLayer.push( i + '点');
}

var yValue = [];

var weekShelfStrategy = JSON.parse($("#modifyStrategy").text());
//show which day of week
var index = weekShelfStrategy.currentDay;
for(var i=0; i<24; i++){
	yValue.push([weekShelfStrategy.dayShelfStrategyList[weekShelfStrategy.currentDay].distribution[i]*100]);
}

var left_percent = 0.0;


var chart = new Highcharts.Chart({

    chart: {
        renderTo: 'container',
        animation: false
    },

    title: {
        text: '可调节的商品余量（' + left_percent + '%）'
    },
    
    xAxis: {
        categories: xLayer,
        labels: {
            rotation: 30
        }
    },

    yAxis: {
        title: {
            text: '占所有商品的比例(%)'
        }
    },

    credits : {
        enabled : false//去掉右下角的标志
    },
        
    plotOptions: {
        series: {
            cursor: 'ns-resize',
            point: {
                events: {
                    
                    drag: function(e) {
                        // Returning false stops the drag and drops. Example:
                        var remain = left_percent;
                        if(remain < '0.00'){
                            return false;
                            }
                        e.newY = Highcharts.numberFormat(e.newY, 2);
                        var diff = Highcharts.numberFormat(e.newY - this.y, 2);
                        
	                        if (remain < diff) {
	                            this.y += parseFloat(remain);
	                            left_percent = '0.00';
		                       	chart.setTitle({text: '可调节的商品余量（' + left_percent + '%）'});
	                            return false;
	                        }
	                        remain = Highcharts.numberFormat(remain - diff, 2);
	                        left_percent = remain;
	                       	chart.setTitle({text: '可调节的商品余量（' + left_percent + '%）'});

	            			weekShelfStrategy.dayShelfStrategyList[index].distribution[this.x] = e.newY/100;
	            			
                        
                        $('#drag').html(
                            'Dragging <b>' + this.series.name + '</b>, <b>' +
                            this.category + '</b> to <b>' + 
                            Highcharts.numberFormat(e.newY, 2) + '</b>'
                        );

                    },
                    drop: function() {
                    	//chart.redraw();
                    }
                }
            },
            stickyTracking: false
        },
        column: {
            stacking: 'normal'
        }
    },
    
    tooltip: {
        valueDecimals: 2,
        valueSuffix: '%'
    },

    legend: {
    	enabled: false
    },

    series: [{
        data: yValue,
        //draggableX: true,
        draggableY: true,
        dragMinY: 0,
        minPointLength: 2,
        name:'比例'
    }]

});


$(document).ready(function () {	
	var chart = $('#container').highcharts();
	$("ul.dropdown-menu a").click(function(){
			$("button.dropdown-toggle").html($(this).text()+'<i class="icon-angle-down icon-on-right"></i>');
			index = $(this).attr('class');
			var value = [];
			for(var i=0; i<24; i++){
				value.push([weekShelfStrategy.dayShelfStrategyList[index].distribution[i]*100]);
			}
			
			chart.series[0].setData(value);
		})
	
});

function formatData(weekShelfStrategy){
	var list = weekShelfStrategy.dayShelfStrategyList;
	var result = [];
	for(var item in list){
		var value = "";
		for(var v in list[item].distribution){
			value += list[item].distribution[v] + ",";
		}
		value = value.substr(0,value.length-1);
		result[item] = value;
	}
	return result;
}

function saveData(){
	
	$.ajax({
		type: "post",
		url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/site/save",
		dataType: "json",
		data: {'strategys' : formatData(weekShelfStrategy)},
		success: function(data, textStatus){

		},
		complete: function(XMLHttpRequest, textStatus){
			//HideLoading();
		},
		error: function(){
			//请求出错处理
		}
	});
}
</script>