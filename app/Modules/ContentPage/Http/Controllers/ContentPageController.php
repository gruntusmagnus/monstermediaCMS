<?php

namespace App\Modules\ContentPage\Http\Controllers;

use App\Http\Controllers\Controller;

class ContentPageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		  $items = collect();

        return view('contentpage::contentpage.index', compact('items'));
    }
}