@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">
                    <a href="/" class="page-title__categories">{{ trans('navbar.ourMenu') }}</a> <span
                        class="page-title__chevron"></span> <span
                        class="page-title__categories">{{$category->name}}</span>
                </h1>

                <div class="product-list" id="category-product-list">
                    <div class="product-list__in">
                        @if (!$products->isEmpty())
                            @foreach($products as $product)

                                <div data-id="{{$product->id}}" @click="()=>{productid = '{{$product->id}}',activemodal = !activemodal}"
                                     class="js_product-popup product-list__item {{ strtolower($product->{'slug:en'}) }}">
                                    <div class="product-list__image">
                                        <img src="/img/product.jpg" alt="{{$product->name}}">
                                    </div>
                                    <h2 class="product-list__name"><span>{{$product->name}}</span></h2>
                                    <div class="product-list__info">
                                        <div class="product-list__price">{{$product->price}} Kč</div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <em>@lang('catalog::catalog.noItems')</em>
                            </div>
                        @endif
                    </div>
                    <product-popup :productid="productid" :activemodal="activemodal">

                    </product-popup>

                </div>
            </div>
        </div>
    </div>

    {{--@include('catalog::product.modal')--}}
@endsection
<script src="{{asset('js/orderModal.js')}}" defer></script>
