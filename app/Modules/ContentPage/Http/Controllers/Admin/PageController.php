<?php

namespace App\Modules\ContentPage\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;

class PageController extends AdminController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		  $items = collect();

        return view('contentpage::admin.content_page.index', compact('items'));
    }
}