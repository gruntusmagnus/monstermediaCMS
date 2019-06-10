<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstallMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Menu::query()->delete();

        $menu = \App\Menu::create(['name' => 'Sidebar', 'slug' => 'admin-sidebar']);

        
        $items = [
            '/chat' => 'Komunikace',
            '/order' =>'Kuchyně',
            '/archive'=> 'Archiv',
            '/customer' => 'Zákazníci',
            '/category' => 'Kategorie',
            '/product' => 'Produkty',
            '/log' => 'Log',
        ];

        foreach ($items as $url => $link) {
            \App\MenuItem::create(['menu_id' => $menu->id, 'href' => $url, 'label' => $link]);
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
