<?php

namespace App\Modules\Catalog\Providers;

use MonsterMedia\Modules\ServiceProviders\ServiceProvider as ServiceProvider;

/**
 * Class CatalogServiceProvider
 * Service provider for module Catalog
 */
class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Set module Alias
     */
    protected function setModuleAlias()
    {
        $this->alias = strtolower('catalog');
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

        \Route::middleware(['web', 'api'])
            ->group($this->path . '/../Http/routes/api.php');
    }


    public function register()
    {
        parent::register();

        $this->publishes([$this->path . '/../Resources/assets/js' => resource_path('js/modules/Catalog')], 'vue-module-components');
    }
}
