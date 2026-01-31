@extends('layouts.master')

@section('title', 'Store - Electro Master')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Store</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Categories</h3>
                        <div class="checkbox-filter">
                            @if(isset($categories) && count($categories) > 0)
                                @foreach($categories as $category)
                                <div class="input-checkbox">
                                    <a href="{{ route('store', ['category' => $category->slug]) }}">
                                        <span></span>
                                        {{ $category->name }}
                                    </a>
                                </div>
                                @endforeach
                            @else
                                <div class="input-checkbox">
                                    <label for="category-1">
                                        <span></span>
                                        Laptops
                                    </label>
                                </div>
                                <div class="input-checkbox">
                                    <label for="category-2">
                                        <span></span>
                                        Smartphones
                                    </label>
                                </div>
                                <div class="input-checkbox">
                                    <label for="category-3">
                                        <span></span>
                                        Cameras
                                    </label>
                                </div>
                                <div class="input-checkbox">
                                    <label for="category-4">
                                        <span></span>
                                        Accessories
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Price</h3>
                        <form action="{{ route('store') }}" method="GET">
                            @if(request()->has('category'))
                                <input type="hidden" name="category" value="{{ request()->get('category') }}">
                            @endif
                            <div class="price-filter">
                                <div id="price-slider"></div>
                                <div class="input-number price-min">
                                    <input id="price-min" type="number" name="min_price" placeholder="Min" value="{{ request()->get('min_price', 0) }}">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                                <span>-</span>
                                <div class="input-number price-max">
                                    <input id="price-max" type="number" name="max_price" placeholder="Max" value="{{ request()->get('max_price', 1000) }}">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 10px;">Filter</button>
                        </form>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Top selling</h3>
                        <div class="product-widget">
                            <div class="product-img">
                                <img src="{{ asset('img/product01.png') }}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>

                        <div class="product-widget">
                            <div class="product-img">
                                <img src="{{ asset('img/product02.png') }}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>

                        <div class="product-widget">
                            <div class="product-img">
                                <img src="{{ asset('img/product03.png') }}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By:
                                <select class="input-select" onchange="window.location.href='{{ route('store') }}?sort='+this.value+'{{ request()->has('category') ? '&category='.request()->get('category') : '' }}'">
                                    <option value="newest" {{ request()->get('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="price_asc" {{ request()->get('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ request()->get('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="name_asc" {{ request()->get('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                    <option value="name_desc" {{ request()->get('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        @if(isset($products) && count($products) > 0)
                            @foreach($products as $product)
                            <div class="col-md-4 col-xs-6">
                                <x-product-card
                                    :image="$product->image ?? 'product01.png'"
                                    :name="$product->name"
                                    :category="$product->category->name ?? 'General'"
                                    :price="number_format($product->price, 2)"
                                    :old-price="$product->compare_price ? number_format($product->compare_price, 2) : null"
                                    :sale="!is_null($product->compare_price)"
                                    :new="false"
                                    :rating="$product->rating ?? 5"
                                    :slug="$product->slug"
                                />
                            </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <p class="text-center">No products found.</p>
                            </div>
                        @endif
                    </div>
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        @if(isset($products) && count($products) > 0)
                        <span class="store-qty">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products</span>
                        {{ $products->appends(request()->query())->links() }}
                        @else
                        <span class="store-qty">No products to display</span>
                        @endif
                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
