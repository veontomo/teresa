<?php
$outputOfMerge = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../config/web.php'),
    require(__DIR__ . '/../_config.php'),
    [
        'components' => [
            'db' => [
                'dsn' => 'mysql:host=localhost;dbname=teresadesign_test',
                'username' => 'daemon',
                'password' => 'HsqyJSAbZC3q3KJa',
                 'tablePrefix' => ''
            ],

        ],
    ]
);
// echo __FILE__;
// print_r($outputOfMerge['components']['db']);
return $outputOfMerge;
