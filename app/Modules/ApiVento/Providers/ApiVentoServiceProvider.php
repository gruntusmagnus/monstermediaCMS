<?php

namespace App\Modules\ApiVento\Providers;

use \MonsterMedia\Modules\ServiceProviders\ServiceProvider as ServiceProvider;

/**
 * Class ApiVentoServiceProvider
 *
 * Service provider for module ApiVento
 */
class ApiVentoServiceProvider extends ServiceProvider
{
    /**
     * Set module Alias
     */
    protected function setModuleAlias()
    {
        $this->alias = strtolower('apivento');
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

	    $this->publishes([$this->path . '/../Resources/assets/js' =>  resource_path('js/modules/ApiVento')], 'vue-module-components');
	 }
}
