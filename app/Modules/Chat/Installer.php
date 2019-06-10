<?php

namespace App\Modules\Chat;

use MonsterMedia\Modules\ModuleManager\Contracts\IInstalable;
use MonsterMedia\Modules\ModuleManager\Module;

class Installer implements IInstalable
{
    public static function install(Module $module)
    {
        exec('composer require predis/predis');
        exec('npm install laravel-echo');
        exec('npm install laravel-echo-server');
    }
}