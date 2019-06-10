<?php

namespace App\Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use App\Modules\Catalog\Http\Resources\ProductResource;
use App\Modules\Catalog\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $upload;


    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		  $items = collect();

        return view('catalog::product.index', compact('items'));
    }


}
