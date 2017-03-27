<?php



$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'FooderMe',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
		
	 'modules' => [
			'users' => [
				'class' => 'app\modules\users\Users',
			],	
		],	
	'layout' => '/fuber_me/formlayout',
	'timeZone' => 'US/Eastern',
    'components' => [

		
		'assetManager' => [
			'linkAssets' => false,
		    'bundles' => [
				'yii\bootstrap\BootstrapAsset' => [
					'css' => [],
					'js' => [],
				],
			 ],
		], 
	
		'mycomponent' => [ 
            'class' => 'app\components\Customuseridentity', 
        ],
		
		'mediacomponent' => [ 
            'class' => 'app\components\Mediaopration', 
        ],	
		
		'emailcomponent' => [ 
            'class' => 'app\components\Emailfunction', 
        ],

/* 		'paypal'=> [
			'class'        => 'app\components\Paypal',
			'clientId'     => 'you_client_id',
			'clientSecret' => 'you_client_secret',
			'isProduction' => false,
			 // This is config file for the PayPal system
			 'config'       => [
				 'http.ConnectionTimeOut' => 30,
				 'http.Retry'             => 1,
			//	 'mode'                   => \marciocamello\Paypal::MODE_SANDBOX, // development (sandbox) or production (live) mode
				 'log.LogEnabled'         => YII_DEBUG ? 1 : 0,
				 'log.FileName'           => '@runtime/logs/paypal.log',
			//	'log.LogLevel'           => \marciocamello\Paypal::LOG_LEVEL_FINE,
			]
		],		 */

        'view' => [
            'theme' => [
                'basePath' => '@app/views/layouts/',
                'baseUrl' => '@web/../views/layouts',
            ],
        ],
	
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'edqedvzPrpTrUH5VVi6GQZhibCFHkWVj',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
/*         'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ], */
        'errorHandler' => [
		//	'maxSourceLines' => 10,
            'errorAction' => 'site/error',
        ],
		
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
		//	'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
			//'useFileTransport' => false,
/* 			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'md-95.webhostbox.net',
				'username' => 'fuberme@rajwadiantiques.com',
				'password' => 'fuberme!@#45',
				'port' => '587',
				'encryption' => 'tls',
			], */	
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				// 'host' => 'email-smtp.us-west-2.amazonaws.com',
				'host' => 'email-smtp.us-east-1.amazonaws.com',
				'username' => 'AKIAIJFOM3KL7MJMEFQA',
				'password' => 'AuOM/qPeJH2tdQG3THGSRtR3w/OWhh24nmBoq/5uDYOL',
				'port' => '587',
				'encryption' => 'tls',
			],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
		
		'user' => [
            'identityClass' => 'app\modules\users\models\Userdetail',
			'loginUrl'=>array('users/login'),
            'enableAutoLogin' => true,
        ], 

		
    ],
	


    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
/*     $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ]; */

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
