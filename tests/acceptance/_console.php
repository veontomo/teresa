<?php

return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../config/console.php'),
    require(__DIR__ . '/../_config.php'),
    [
        'components' => [
            'db' => [
                'dsn' => 'mysql:host=localhost;dbname=teresadesign_test',
                'username' => 'daemon',
                'password' => 'HsqyJSAbZC3q3KJa',

            ],
        ],
    ]
);
