<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php include 'sidebar.php'; ?>

<div id="main-content" class="clearfix">
	<div id="breadcrumbs">
		<ul class="breadcrumb">
			<li><i class="icon-home"></i> <a href="#">Home</a> <span
				class="divider"> <i class="icon-angle-right"></i>
			</span></li>
			<li class="active">Dashboard</li>
		</ul>
		<!--.breadcrumb-->

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