<?php

return [
    'name'        => 'Log',
    'alias'       => 'log',
    'description' => '',
    'provider'    => \App\Modules\Log\Providers\LogServiceProvider::class,
    'installer'   => \App\Modules\Log\Installer::class,
];