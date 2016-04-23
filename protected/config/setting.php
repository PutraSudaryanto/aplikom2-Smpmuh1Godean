<?php
return array(
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'primaryLang' => 'id',
		'translateLangs' => array(
			'en' => 'en',
			'id' => 'id',
			'fr' => 'fr',
		),
		
		// timthumb replace url
		'timthumb_url_replace' => 0,		
		'timthumb_url_replace_website' => 'http://nirwasita.com',	//default http
		// access system *from product
		'product_access_system' => 'sso.bpadjogja.info',
		'oauth_server_options' => array(
			//'http://ommu.co',
			'http://localhost/_product_ommu.co',
		),
	),
);
?>