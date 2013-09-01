<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->name;
$this->breadcrumbs=array(
		'上架总控制台',
);
?>

<!--kf scripts-->

                <div class="row-fluid">
                    <div id="dashboard-left" class="">
                        
                        <h5 class="subtitle">Daily Statistics</h5><br />
                        <div id="sales-charts" style="height:300px;"></div>
                        
                        <div class="divider30"></div>
                        
                        <table class="table table-bordered responsive">
                            <thead>
                                <tr>
                                    <th class="head1">Rendering engine</th>
                                    <th class="head0">Browser</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td><p class="text-warning">上架优化需要显示“已启动”状态，才会执行上架计划.</p></td>
                                </tr>
                                <tr>
                                    <td>Trident</td>
                                    <td><p class="text-info">目前不支持虚拟类宝贝和酒店类宝贝.</p></td>
                                </tr>
                                <tr>
                                    <td>Trident</td>
                                    <td><p class="text-error">上架优化，调整周期为一周，这段时间内流量不会有明显变化或轻微下降，之后流量将会有所增长 .</p></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <br />
                        
                        <h4 class="widgettitle"><span class="icon-comment icon-white"></span> Recent Comments</h4>
                        <div class="widgetcontent nopadding">
                            <ul class="commentlist">
                                <li>
                                    <img src="images/photos/thumb2.png" alt="" class="pull-left" />
                                    <div class="comment-info">
                                        <h4><a href="">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</a></h4>
                                        <h5>in <a href="">Sit Voluptatem</a></h5>
                                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
                                        <p>
                                            <a href="" class="btn btn-success btn-small"><span class="icon-thumbs-up icon-white"></span> Approve</a>
                                            <a href="" class="btn btn-small"><span class="icon-thumbs-down"></span> Reject</a>
                                        </p>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                        
                        <br />
                        
                        
                    </div><!--span8-->
                    

                    
                    
                </div><!--row-fluid-->
                
                <div class='row-fluid'>
                                    
                    <div class="span6 profile-left">
                            
                        <div class="widgetbox tags">
                                <h4 class="widgettitle">成功案例</h4>
                                <div class="widgetcontent">
                                    <ul class="taglist">
                                        <li><a href="">HTML5 <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                        <li><a href="">CSS <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                        <li><a href="">PHP <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                        <li><a href="">jQuery <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                        <li><a href="">Java <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                        <li><a href="">GWT <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                        <li><a href="">CodeNgniter <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                        <li><a href="">Bootstrap <span class="close"><i class="icon-chevron-right"></i></span></a></li>
                                    </ul>
                                </div>
                        </div>
                            
                        </div>
                    
                 	<div class="span6">
                            
                        <div class="widgetbox tags">
                                <h4 class="widgettitle">Tags</h4>
                                <div class="widgetcontent">
                                    <ul class="taglist">
                                        <li><a href="">HTML5 <span class="close">×</span></a></li>
                                        <li><a href="">CSS <span class="close">×</span></a></li>
                                        <li><a href="">PHP <span class="close">×</span></a></li>
                                        <li><a href="">jQuery <span class="close">×</span></a></li>
                                        <li><a href="">Java <span class="close">×</span></a></li>
                                        <li><a href="">GWT <span class="close">×</span></a></li>
                                        <li><a href="">CodeNgniter <span class="close">×</span></a></li>
                                        <li><a href="">Bootstrap <span class="close">×</span></a></li>
                                    </ul>
                                    <a style="display:block;margin-top:10px" href="">+ Add Tag</a>
                                </div>
                        </div>
                            
                        </div> 
                </div>
                

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/site.js"></script>


<span id="weekShelfStrategy" class="hide"><?php echo $distribution?></span>

