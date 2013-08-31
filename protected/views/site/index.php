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
                                    <th class="head1">Platform(s)</th>
                                    <th class="head0">Engine version</th>
                                    <th class="head1">CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet  Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                                    <td class="center">A</td>
                                </tr>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td class="center">6</td>
                                    <td class="center">A</td>
                                </tr>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td class="center">7</td>
                                    <td class="center">A</td>
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
                                <li>
                                    <img src="images/photos/thumb1.png" alt="" class="pull-left" />
                                    <div class="comment-info">
                                        <h4><a href="">But I must explain to you how all this mistaken</a></h4>
                                        <h5>in <a href="">At vero eos et accusamus et iusto odio dignissimos</a></h5>
                                        <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>
                                        <p>
                                            <a href="" class="btn btn-success btn-small"><span class="icon-thumbs-up icon-white"></span> Approve</a>
                                            <a href="" class="btn btn-small"><span class="icon-thumbs-down"></span> Reject</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="images/photos/thumb10.png" alt="" class="pull-left" />
                                    <div class="comment-info">
                                        <h4><a href="">On the other hand, we denounce with righteous indignation</a></h4>
                                        <h5>in <a href="">These cases are perfectly simple and easy to distinguish</a></h5>
                                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</p>
                                        <p>
                                            <a href="" class="btn btn-success btn-small"><span class="icon-thumbs-up icon-white"></span> Approve</a>
                                            <a href="" class="btn btn-small"><span class="icon-thumbs-down"></span> Reject</a>
                                        </p>
                                    </div>
                                </li>
                                <li><a href="">View More Comments</a></li>
                            </ul>
                        </div>
                        
                        <br />
                        
                        
                    </div><!--span8-->
                    
                    
                </div><!--row-fluid-->
                

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/site.js"></script>


<span id="weekShelfStrategy" class="hide"><?php echo $distribution?></span>

