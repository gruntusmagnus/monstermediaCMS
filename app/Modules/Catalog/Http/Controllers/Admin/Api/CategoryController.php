<?php

namespace App\Modules\Catalog\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Modules\Catalog\Http\Resources\CategoryResource;
use App\Modules\Catalog\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $paginate
     * @return CategoryResource
     */
    public function index()
    {
        //načítání stromové struktury všech kategorií
        return CategoryResource::collection(Category::where('parent_id', 0)->with('subcategories', 'subcategories.subcategories')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CategoryResource
     */
    public function show($id)
    {
        //načítání všech kategorií daného rodiče
        return CategoryResource::collection(Category::where('parent_id', $id)->get());
    }

}