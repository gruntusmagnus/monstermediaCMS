<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        return response()->json($menus);
    }

    public function show(Menu $menu)
    {


        $menu->load('items');

        // @todo nutno doresit hierarchii
        $items = [];
        foreach ($menu->items as $item) {

            $href = '#';

            if (!is_null($item->route_name)) {
                $href = route($item->route_name, $item->route_parameter);
            }

            if (!is_null($item->href)) {
                $href = $item->href;
            }

            $items[] = ['href' => $href, 'text' => $item->label, 'slug' => str_slug($item->label)];
        }

        return response()->json($items);
    }
}
