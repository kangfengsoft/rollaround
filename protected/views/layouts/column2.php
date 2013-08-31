<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php include '/protected/views/layouts/sidebar.php'; ?>


<div class="rightpanel">
        
        <ul class="breadcrumbs">
        	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
        	'tagName'=>'ul',
			'homeLink' => '<i class="icon-home"></i> <a href="#">Home</a>',
			'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="separator"></span></li>',
			)); ?><!-- breadcrumbs -->
            <li><a href="dashboard.html"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>Dashboard</li>
            <li class="right">
                    <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-tint"></i> Color Skins</a>
                    <ul class="dropdown-menu pull-right skin-color">
                        <li><a href="default">Default</a></li>
                        <li><a href="navyblue">Navy Blue</a></li>
                        <li><a href="palegreen">Pale Green</a></li>
                        <li><a href="red">Red</a></li>
                        <li><a href="green">Green</a></li>
                        <li><a href="brown">Brown</a></li>
                    </ul>
            </li>
        </ul>
        
        <div class="pageheader">
            <form action="results.html" method="post" class="searchbar">
                <input type="text" name="keyword" placeholder="To search type and hit enter..." />
            </form>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>All Features Summary</h5>
                <h1>Dashboard</h1>
            </div>
            <div class="infobox-icon">
				<i class="icon-twitter"></i>
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