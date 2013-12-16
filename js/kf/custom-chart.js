

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

var shelfStrategyList = JSON.parse($("#shelfStrategyList").text());
var weekShelfStrategy = shelfStrategyList[0]; 
//show which day of week
var index = weekShelfStrategy.currentDay;
$("ul.dropdown-menu a").each(function(){
	if($(this).attr("class") == index){
		$("button.dropdown-toggle").html($(this).text()+'<span class="caret"></span>');
	}
})

for(var i=0; i<24; i++){
	yValue.push([weekShelfStrategy.dayShelfStrategyList[weekShelfStrategy.currentDay].hours[i].percent*100]);
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

	            			weekShelfStrategy.dayShelfStrategyList[index].hours[this.x].percent = e.newY/100;
	            			
                        
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
	window.$=jQuery
	var showDay = 0;
	var chart = $('#container').highcharts();
	$("#selectCurrentDay a").click(function(){
			$("button.dropdown-toggle").html($(this).text()+'<span class="caret"></span>');
			index = $(this).attr('class');
			$(this).parents("ul").children().removeClass("active");
			$(this).parent().addClass("active");
			var value = [];
			for(var i=0; i<24; i++){
				value.push([weekShelfStrategy.dayShelfStrategyList[index].hours[i].percent*100]);
				
			}
			showDay = index;
			chart.series[0].setData(value);
		})
	
	$("#selectCurrentStrategy a").click(function(){
			$("a.dropdown-toggle").html($(this).text()+'<span class="caret"></span>');
			index = $(this).attr('class');
			$(this).parents("ul").children().removeClass("active");
			$(this).parent().addClass("active");
			weekShelfStrategy = shelfStrategyList[index];
			
			var value = [];
			for(var i=0; i<24; i++){
				value.push([weekShelfStrategy.dayShelfStrategyList[showDay].hours[i].percent*100]);
			}
			chart.series[0].setData(value);
		})
});

function formatData(weekShelfStrategy){
	var list = weekShelfStrategy.dayShelfStrategyList;
	var result = [];
	for(var item in list){
		var value = "";
		for(var v in list[item].hours){
			value += list[item].hours[v].percent + ",";
		}
		value = value.substr(0,value.length-1);
		result[item] = value;
	}
	return result;
}

function saveData(){
	$.ajax({
		type: "post",
		url: BASE_PATH + "/index.php/site/save",
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

function extract(){
	var list = weekShelfStrategy.dayShelfStrategyList;
	var temp_add = 0;
	for(var item in list){
		for(var v in list[item].hours){
			if(list[item].hours[v].percent > 0.0001){
				list[item].hours[v].percent -= 0.0001;
				temp_add += 0.0001;
			}
		}
	}
	left_percent = parseFloat(left_percent);
	left_percent += temp_add;
	left_percent = Math.round(left_percent * 10000) / 10000
	chart.setTitle({
		text : "可调节的商品余量（"+ left_percent * 100 +"%）"
	})
}
