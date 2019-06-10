<?php

return [
    'name'        => 'Chat',
    'alias'       => 'chat',
    'description' => '',
    'provider'    => \App\Modules\Chat\Providers\ChatServiceProvider::class,
    'installer'   => \App\Modules\Chat\Installer::class,
];