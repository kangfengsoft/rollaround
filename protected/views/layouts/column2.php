<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php include '/protected/views/layouts/sidebar.php'; ?>

<div id="main-content" class="clearfix">
	<div id="breadcrumbs">
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'htmlOptions'=>array ('class'=>'breadcrumb'),
			'homeLink' => '<i class="icon-home"></i> <a href="#">Home</a>',
			'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
		)); ?><!-- breadcrumbs -->
		

		<div id="nav-search">
			<form class="form-search">
				<span class="input-icon"> <input type="text"
					placeholder="Search ..." class="input-small search-query"
					id="nav-search-input" autocomplete="off" /> <i class="icon-search"
					id="nav-search-icon"></i>
				</span>
			</form>
		</div>
		<!--#nav-search-->
	</div>
	<div id="content">
		<?php echo $content; ?>
	</div>
	<!-- content -->
</div>


<?php $this->endContent(); ?>