<?php
/* @var $this SiteController */
?>
<h1>enable/disable timed task</h1>
<br/>
<?php
if($enable){
?>
<a href="?r=admin/enableShelfPlanRecount&enable=false" class="btn btn-large btn-primary">disable</a>
<?php }else{ ?>
<a href="?r=admin/enableShelfPlanRecount&enable=true" class="btn btn-large btn-primary">enable</a>
<?php } ?>