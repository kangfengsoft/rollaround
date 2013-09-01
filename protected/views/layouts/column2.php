<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php include '/protected/views/layouts/sidebar.php'; ?>


<div class="rightpanel">
        
        	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
        	'tagName'=>'ul',
			'homeLink' => '<i class="icon-home"></i> <a href="#">主页</a>',
			'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="separator"></span></li>',
			)); ?><!-- breadcrumbs -->
        
        <div class="pageheader">

            <div class="pageicon"><span class="iconfa-bullhorn"></span></div>
            <div class="pagetitle">
                <h5>All Features Summary</h5>
                <h1>小贴士：只要998，终身会员带回家</h1>
            </div>

        </div><!--pageheader-->

	<div class="maincontent">
		<div class="maincontentinner">
			<?php echo $content; ?>
				<?php include '/protected/views/layouts/footer.php'; ?>	
		</div>
	</div>
	<!-- content -->
</div>


<?php $this->endContent(); ?>