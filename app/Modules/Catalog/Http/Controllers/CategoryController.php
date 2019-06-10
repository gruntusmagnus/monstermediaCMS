<?php

namespace App\Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Catalog\Category;
use App\Modules\Catalog\Http\Resources\CategoryResource;
use App\Modules\Catalog\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $parentCategories = CategoryResource::collection(Category::where('parent_id',0)->orderBy('id')->get());
        $categories = CategoryResource::collection(Category::where('parent_id','<>',0)->orderBy('parent_id')->get());

        $jwtToken = session('jwtToken');

        if ($jwtToken) {
            Session::forget('jwtToken');
        }

        return view('catalog::category.index', compact('parentCategories','categories', 'jwtToken'));
    }

    public function show($id){
        $category = CategoryResource::make(Category::findOrFail($id));
        $products = ProductResource::collection($category->products()->get());
        return view('catalog::category.detail',compact('category','products'));
    }

}
