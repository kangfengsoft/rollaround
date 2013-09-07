<?php
/* @var $this SiteController */
?>
<h1>enable/disable shelfPlanRecount</h1>
<br/>
<?php
if($enableShelfPlanRecount){
?>
<a href="<?php echo Yii::app()->baseUrl ;?>/admin.php/admin/enableShelfPlanRecount?enable=false" class="btn btn-large btn-primary">disable</a>
<?php }else{ ?>
<a href="<?php echo Yii::app()->baseUrl ;?>/admin.php/admin/enableShelfPlanRecount?enable=true" class="btn btn-large btn-primary">enable</a>
<?php } ?>
<h1>enable/disable listTask</h1>
<br/>
<?php
if($enableListTask){
?>
<a href="<?php echo Yii::app()->baseUrl ;?>/admin.php/admin/enableListTask?enable=false" class="btn btn-large btn-primary">disable</a>
<?php }else{ ?>
<a href="<?php echo Yii::app()->baseUrl ;?>/admin.php/admin/enableListTask?enable=true" class="btn btn-large btn-primary">enable</a>
<?php } ?>