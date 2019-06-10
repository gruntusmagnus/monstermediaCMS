<?php

namespace App\Modules\Chat\Providers;

use Illuminate\Support\Facades\Route;
use MonsterMedia\Modules\ServiceProviders\ServiceProvider as ServiceProvider;

/**
 * Class ChatServiceProvider
 * Service provider for module Chat
 */
class ChatServiceProvider extends ServiceProvider
{
    /**
     * Set module Alias
     */
    protected function setModuleAlias()
    {
        $this->alias = strtolower('chat');
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
        Route::middleware(['web', 'api'])
             ->group($this->path . '/../Http/routes/api.php');

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

        $this->publishes([
                             $this->path . '/../Resources/assets/js' => resource_path('js/modules/Chat')
                         ], 'vue-module-components');
    }
}