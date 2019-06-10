<?php

namespace App\Modules\Catalog\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Modules\Catalog\Http\Resources\ProductResource;
use App\Modules\Catalog\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $paginate
     * @return ProductResource
     */
    public function index($paginate = 50)
    {
        //v objemu CyberDog můžeme posílat všechna data a řešit filtraci až ve Vue
        //return CategoryResource::collection(Category::paginate($paginate));
        return ProductResource::collection(Product::with('vat')->get());
    }

    public function show($id)
    {
        return Product::with('categories')->with('imageCover')->findOrFail($id);
        //potřebujeme veškerá data pro editaci, včetně všech překladů
    }

    public function modal($id){
        return ProductResource::make(Product::where('id',$id)->first());
    }

}
