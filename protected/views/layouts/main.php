<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />

<!-- W8 -->
<!--basic styles-->

<link
	href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" />
<link
	href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap-responsive.min.css"
	rel="stylesheet" />
<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/themes/font-awesome/css/font-awesome.min.css" />

<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/font-awesome/css/font-awesome-ie7.min.css" />
		<![endif]-->

<!--page specific plugin styles-->

<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/themes/css/prettify.css" />

<!--fonts-->

<link rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

<!--ace styles-->

<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/themes/css/w8.min.css" />
<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/themes/css/w8-responsive.min.css" />
<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/themes/css/w8-skins.min.css" />

<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/css/ace-ie.min.css" />
		<![endif]-->

<!--inline styles if any-->





<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php include '/protected/views/layouts/header.php'; ?>

	<div class="container" id="main-container">
		<a id="menu-toggler" href="#"> <span></span>
		</a>

	<?php echo $content; ?>

	<div class="clear"></div>

	</div>

			<!--basic scripts-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.ui.touch-punch.min.js"></script>
		
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.slimscroll.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.easy-pie-chart.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.sparkline.min.js"></script>
		
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.flot.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.flot.pie.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/jquery.flot.resize.min.js"></script>

		<!--w8 scripts-->

		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/w8-elements.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/js/w8.min.js"></script>
	
	
</body>
</html>
