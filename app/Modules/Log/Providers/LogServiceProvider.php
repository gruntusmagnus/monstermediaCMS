<?php

namespace App\Modules\Log\Providers;

use MonsterMedia\Modules\ServiceProviders\ServiceProvider as ServiceProvider;

/**
 * Class LogServiceProvider
 * Service provider for module Log
 */
class LogServiceProvider extends ServiceProvider
{
    /**
     * Set module Alias
     */
    protected function setModuleAlias()
    {
        $this->alias = strtolower('log');
    }

    /**
     * Set path to module
     */
    protected function setModulePath()
    {
        $this->path = __DIR__;
    }

    protected function mapWebRoutes()
    {
        parent::mapWebRoutes();

        require $this->path . '/../Http/routes/channels.php';
    }

    public function boot()
    {
        parent::boot();

        $this->app->register(EventServiceProvider::class);
    }

    public function register()
    {
        parent::register();

        $this->publishes([$this->path . '/../Resources/assets/js' => resource_path('js/modules/Log')], 'vue-module-components');
    }
}