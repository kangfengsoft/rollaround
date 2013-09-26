<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),
		
	// autoloading model and component classes
	'import' => array (
			'application.models.*',
			'application.models.modelsMemory.*',
			'application.components.*',
			'application.service.*',
			'application.apis.top.*',
			'application.apis.top.request.*',
			'application.apis.lotusphp_runtime.Logger.*',
			'application.admin.models.*',
			'application.admin.config.*',
			'application.admin.service.*'
	),

	// application components
	'components'=>array(
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=kfsoft',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
						'class'=>'KfEmailLogRoute',
						'levels'=>'error',
						'emails'=>'kangfeng_soft@163.com',
				),
			),
		),
		'mailer' => array(
				'class' => 'application.extensions.mailer.EMailer',
				'pathViews' => 'application.views.email',
				'pathLayouts' => 'application.views.email.layouts'
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => CMap::mergeArray(require('params.php'),array(
		'logBasePath' => dirname(__FILE__).'/../apis/lotusphp_runtime/Logger'
	)),
);