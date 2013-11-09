<div class="leftpanel">
        
        <div class="leftmenu">
        <?php $this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activeCssClass'=>'active',
			'activateParents' => true,
			'htmlOptions' => array('class'=>'nav nav-tabs nav-stacked'),
			'items'=>array(
				array('itemOptions'=>array('class'=>'nav-header'),
					'label'=>'Navigation',
				),
				array('label'=>'<span class="iconfa-laptop"></span> 上架优化', 
					'url'=>array(''),
					'itemOptions'=>array('class'=>'dropdown'),
					//'submenuOptions'=>array('class'=>'submenu'),
						'items'=>array(
							array('label'=>'上架总控制台', 'url'=>array('site/index')),
							array('label'=>'自定义上架', 'url'=>array('site/custom')),
							array('label'=>'指定宝贝', 'url'=>array('site/assign')),
							array('label'=>'排除宝贝', 'url'=>array('site/exclude')),
							array('label'=>'上架日志记录', 'url'=>array('site/operation'))
			
					)), 
				array('label'=>'<span class="iconfa-picture"></span> 新功能研发中', 'url'=>array(''))
			),
		)); ?>
        
	</div><!--leftmenu-->
</div><!-- leftpanel -->
