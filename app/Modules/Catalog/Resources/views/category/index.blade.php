@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @if (!$parentCategories->isEmpty() && !$categories->isEmpty())

                    @foreach($parentCategories as $parentCategory)
                        <div class="category-block category-block--{{ strtolower($parentCategory->{'slug:en'}) }}">
                            <h2 class="category-block__name">{{$parentCategory->name }}</h2>
                            <div class="category-block__content">
                                @foreach($categories as $category)
                                    @if($parentCategory->id === $category->parent_id)
                                        <div class="category-block__item category-block__item--{{ strtolower($category->{'slug:en'}) }}" style="background-image: url('/img/category.jpg')">
                                            <h3>
                                                <a href="{{ url('/kategorie/'.$category->id) }}">
                                                    <span>{{$category->name}}</span>
                                                </a>
                                            </h3>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="alert alert-info">
                        <em>@lang('catalog::catalog.noItems')</em>
                    </div>
                @endif

            </div>
        </div>
    </div>

    @if(isset($jwtToken))
        <script>localStorage.setItem ('customerAuthorizationToken', "{{$jwtToken}}")</script>
    @endif
@endsection
