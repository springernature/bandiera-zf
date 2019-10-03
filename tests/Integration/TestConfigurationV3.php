<?php

return [
    'modules' => [
        'Zend\Router',
        'SpringerNature\Zend\Bandiera',
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            __DIR__ . '/../../config/*.config.php',
        ],
        'module_paths' => [],
    ],
];
