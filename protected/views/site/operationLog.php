<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 操作日志';
$this->breadcrumbs=array(
	'操作日志',
);
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kf/reloadAjax.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kf/exclude-table.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.tabbedwidget').tabs();
	refresh = false;
	jQuery("#exclude-good").click(function(){
		if(refresh){
			$('#dyntable').dataTable().fnReloadAjax();
			refresh = false;
		}
		
	})
})
</script>

<h4 class="widgettitle">上架操作日志</h4>
<div class="row-fluid">
	<div id="a-1"><table id="dyntable" class="table table-bordered responsive">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                          	<th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                            <th class="head0">图片</th>
                            <th class="head1">标题</th>
                            <th class="head0">价格</th>
                            <th class="head1">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
	</div>
</div>

