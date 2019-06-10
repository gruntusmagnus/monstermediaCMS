<?php

namespace App\Modules\Order\Providers;

use \MonsterMedia\Modules\ServiceProviders\ServiceProvider as ServiceProvider;

/**
 * Class OrderServiceProvider
 *
 * Service provider for module Order
 */
class OrderServiceProvider extends ServiceProvider
{
    /**
     * Set module Alias
     */
    protected function setModuleAlias()
    {
        $this->alias = strtolower('order');
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

	    $this->publishes([$this->path . '/../Resources/assets/js' =>  resource_path('js/modules/Order')], 'vue-module-components');
	 }
}