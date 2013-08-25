<?php  
$backend = dirname(dirname(__FILE__));  
$frontend = dirname($backend);  
Yii::setPathOfAlias('backend',$backend);  
  
$frontendArray = require_once($frontend.'/config/main.php');  
  
$backendArray=array(  
    'name'=>'网站后台管理系统',  
    'basePath'=>$frontend,  
    'viewPath'=>$backend.'/views',  
    'controllerPath'=>$backend.'/controllers',  
    'runtimePath'=>$backend.'/runtime',  
    'import'=>array(   
        'application.models.*',  
        'application.components.*',  
    	'application.admin.config.*',
        'backend.models.*',
        'backend.components.*',  
    ),  
    //'params'=>CMap::mergeArray(require($frontend.'/config/params.php'),require($backend.'/config/params.php')),  
);  
if(isset($frontendArray['components']['user']))unset($frontendArray['components']['user']);
 
return CMap::mergeArray($frontendArray,$backendArray); 