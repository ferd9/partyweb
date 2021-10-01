<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Chimbote Juerga',
	'language'=>'es',
	'sourceLanguage'=>'en',
	//'charset'=>'utf-8',
	'theme'=>'classic',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',	
                'application.models.modelimg.*',
                'application.models.amistad.*',
                'application.models.comentario.*',
                'application.models.notas.*',
		'application.components.*',
                'ext.boarduser.*',
                'ext.useragent.*',
                'ext.uploaderfile.*',
                'ext.uploadfoto.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),*/
                'anonimos'
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
                        'class'=>'application.components.ASPCUrlManager',
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        //'urlSuffix'=>'.html',
			'rules'=>array(                                
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',                                
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>',                                 
                                //'<lang>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                /*'index'=>'site/index',
                                'registro'=>'site/registro',
                                'ingresar'=>'site/login',
                                'salir'=>'site/logout',
                                'perfil'=>'perfil/index',
                                'publicaciones'=>'anonimos/default/allpost',
                                'publicacion'=>'anonimos/default/comentspost',
                                'comentar'=>'anonimos/media/comentar',
                                'imagenes'=>'anonimos/media/index',
                                'imagen'=>'site/aimage',*/
                               
                                
                                
			),
		),
               
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cfdata',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'schemaCachingDuration'=>180,
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'webRoot' => dirname(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'),
		'postsPerPage'=>10,
	),
);