<?php

namespace App\Config;

use CodeIgniter\Config\BaseConfig;

class Hooks extends BaseConfig
{
    public $enable_hooks = true;

    public $hooks = [
        'post_controller' => [
            [
                'class'    => 'App\Hooks\LogUserActivity',
                'function' => 'log',
                'filename' => 'LogUserActivity.php',
                'filepath' => 'Hooks'
            ]
        ]
    ];
}
