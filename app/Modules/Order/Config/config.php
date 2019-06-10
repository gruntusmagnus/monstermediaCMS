<?php

return [
    'name'        => 'Order',
    'alias'       => 'order',
    'description' => '',
    'provider'    => \App\Modules\Order\Providers\OrderServiceProvider::class,
    'installer'   => \App\Modules\Order\Installer::class,
];