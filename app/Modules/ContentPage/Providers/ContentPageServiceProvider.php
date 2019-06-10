<?php

namespace App\Modules\ContentPage\Providers;

use \MonsterMedia\Modules\ServiceProviders\ServiceProvider as ServiceProvider;

/**
 * Class ContentPageServiceProvider
 *
 * Service provider for module ContentPage
 */
class ContentPageServiceProvider extends ServiceProvider
{
    /**
     * Set module Alias
     */
    protected function setModuleAlias()
    {
        $this->alias = strtolower('contentpage');
    }

    /**
     * Set path to module
     */
    protected function setModulePath()
    {
        $this->path = __DIR__;
    }

    public function register()
    {
        parent::register();

        $this->publishes([$this->path . '/../Resources/assets/js/admin' =>  resource_path('js/admin/modules/ContentPage')], 'vue-admin-components');
    }
}