<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'自定义策略',
);
?>


<script src="http://code.highcharts.com/highcharts.js"></script>

<div id="container" style="height: 300px"></div>
<div id="drag"></div>
<div id="drop"></div>

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
	j = i+1;
	xLayer.push( i+'-'+j+'点');
}

var yValue = [];
for(var i=0;i<24; i++){
	yValue.push( Math.random());
}

var chart = new Highcharts.Chart({

    chart: {
        renderTo: 'container',
        animation: false,
        borderWidth : 2
    },

    title: {
        text: '各时间段上架分布'
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
                        
                        if (e.newY > 3) {
                            this.y = 3;
                            return false;
                        }
                        
                        $('#drag').html(
                            'Dragging <b>' + this.series.name + '</b>, <b>' +
                            this.category + '</b> to <b>' + 
                            Highcharts.numberFormat(e.newY, 2) + '</b>'
                        );
                    },
                    drop: function() {
                        $('#drop').html(
                            'In <b>' + this.series.name + '</b>, <b>' +
                            this.category + '</b> was set to <b>' + 
                            Highcharts.numberFormat(this.y, 2) + '</b>'
                        );
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
        type: 'column',
        minPointLength: 2,
        name:'比例'
    }]

});
</script>