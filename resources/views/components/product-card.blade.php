@props([
    'image' => 'img/product01.png',
    'name' => 'product name goes here',
    'category' => 'Category',
    'price' => '980.00',
    'oldPrice' => null,
    'sale' => false,
    'new' => false,
    'rating' => 5,
    'slug' => '#'
])

<div class="product">
    <div class="product-img">
        <img src="{{ asset($image) }}" alt="{{ $name }}">
        @if($sale)
        <div class="product-label">
            <span class="sale">-30%</span>
            @if($new)
            <span class="new">NEW</span>
            @endif
        </div>
        @elseif($new)
        <div class="product-label">
            <span class="new">NEW</span>
        </div>
        @endif
    </div>
    <div class="product-body">
        <p class="product-category">{{ $category }}</p>
        <h3 class="product-name"><a href="{{ route('product.show', $slug) }}">{{ $name }}</a></h3>
        <h4 class="product-price">${{ $price }} @if($oldPrice)<del class="product-old-price">${{ $oldPrice }}</del>@endif</h4>
        <div class="product-rating">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $rating)
                    <i class="fa fa-star"></i>
                @else
                    <i class="fa fa-star-o"></i>
                @endif
            @endfor
        </div>
        <div class="product-btns">
            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
            <button class="quick-view" onclick="window.location.href='{{ route('product.show', $slug) }}'"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
        </div>
    </div>
    <div class="add-to-cart">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $slug }}">
            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
        </form>
    </div>
</div>
