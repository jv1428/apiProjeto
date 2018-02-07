<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    /********************************************/
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ZrehdmhPkmGhHXy2vaQCldhWfUphCoXI',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
     /*******************************************/
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
     /************************************************/
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'cliente'
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'artigos',
                    'extraPatterns' => [
                        'GET tipo/{tipo}' => 'filtro',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{tipo}' => '<tipo:\\w+>',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'extraPatterns' => [
                        'GET {username}/tipo' => 'user',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{username}' => '<username:\\w+>',
                    ],

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>['empregado']

                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>['equipa']

                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>['estado']

                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'fatura',
                    'extraPatterns' => [
                        'GET comnif' => 'comnif',
                        'GET semnif' => 'semnif',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{comnif}' => '<comnif:\\w+>',
                        '{semnif}' => '<semnif:\\w+>',
                    ],

                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>['meio-pagamento']

                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>['mesa'],
                    'extraPatterns' => [
                        'GET {id}/condicao' => 'mesa',
                        'GET condicao' => 'estado',
                    ],
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'pedidos',
                    'extraPatterns' => [
                        'GET acabado' => 'acabado',
                        'GET porfazer' => 'porfazer',
                        'GET afazer' => 'afazer',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{acabado}' => '<acabado:\\w+>',
                        '{porfazer}' => '<porfazer:\\w+>',
                        '{afazer}' => '<afazer:\\w+>',
                    ],
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>'pedidos-em-artigo',
                    'extraPatterns' => [
                        'GET pedido' => 'filtro',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{pedido}' => '<pedido:\\w+>',
                    ],
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>['tipo-artigo']

                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>['tipo-equipa']

                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>'reservas',
                    'extraPatterns' => [
                        'GET {hora}/mesa' => 'filtro',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{hora}' => '<hora:\\w+>',
                    ],

                ],


            ],
        ],
     /************************************************/
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
