<div id="sidebar">
	<div id="sidebar-shortcuts">
		<div id="sidebar-shortcuts-large">
			<button class="btn btn-small btn-success">
				<i class="icon-signal"></i>
			</button>

			<button class="btn btn-small btn-info">
				<i class="icon-pencil"></i>
			</button>

			<button class="btn btn-small btn-warning">
				<i class="icon-group"></i>
			</button>

			<button class="btn btn-small btn-danger">
				<i class="icon-cogs"></i>
			</button>
		</div>

		<div id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span> <span class="btn btn-info"></span>

			<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
		</div>
	</div>
	<!--#sidebar-shortcuts-->
	
		<?php $this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activeCssClass'=>'active',
				'activateParents' => true,
			'htmlOptions' => array('class'=>'nav nav-list'),
			'items'=>array(
				array('label'=>'<i class="icon-dashboard"></i><span>上架优化</span><b class="arrow icon-angle-down"></b>', 
					'url'=>array(''),
					'linkOptions'=>array('class'=>'dropdown-toggle'),
					'submenuOptions'=>array('class'=>'submenu'),
						'items'=>array(
							array('label'=>'<i class="icon-double-angle-right"></i>上架总控制台', 'url'=>array('site/index','id'=>'12')),
							array('label'=>'<i class="icon-double-angle-right"></i>自定义上架', 'url'=>array('site/login','id'=>'13')),
			
					)),
				array('label'=>'<i class="icon-edit"></i><span>权限设置</span>', 'url'=>array('site/contact')),

			),
		)); ?>
	


	<!--/.nav-list-->

	<div id="sidebar-collapse">
		<i class="icon-double-angle-left"></i>
	</div>
</div>