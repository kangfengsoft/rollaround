<!DOCTYPE html>
<html>
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive-tables.css">

<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-1.9.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.9.2.min.js');
?>

</head>

<body>

<div class="mainwrapper">

<?php include 'header.php'; ?>

	<?php echo $content; ?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/responsive-tables.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kf/base.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/excanvas.min.js"></script><![endif]-->
	
</body>
</html>
