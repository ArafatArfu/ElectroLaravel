    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                    @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-user-o"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="main-nav nav navbar-nav">
                                <li><a href="{{ route('profile') }}">My Profile</a></li>
                                <li><a href="{{ route('profile.orders') }}">My Orders</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link" style="padding: 5px 15px; color: #333;">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ route('home') }}" class="logo">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form action="{{ route('store.search') }}" method="GET">
                                <select class="input-select" name="category">
                                    <option value="">All Categories</option>
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input class="input" placeholder="Search here" name="q" value="{{ isset($search) ? $search : '' }}">
                                <button type="submit" class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            @php
                                $cart = session()->get('cart', []);
                                $cartCount = count($cart);
                                $cartTotal = 0;
                                foreach($cart as $item) {
                                    $cartTotal += $item['price'] * $item['quantity'];
                                }
                            @endphp
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="{{ route('cart.index') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">{{ $cartCount }}</div>
                                </a>
                                <div class="cart-dropdown">
                                    @if($cartCount > 0)
                                    <div class="cart-list">
                                        @foreach($cart as $item)
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="{{ route('product.show', $item['slug']) }}">{{ $item['name'] }}</a></h3>
                                                <h4 class="product-price"><span class="qty">{{ $item['quantity'] }}x</span>${{ number_format($item['price'], 2) }}</h4>
                                            </div>
                                            <button class="delete" onclick="removeFromCart('{{ $item['id'] }}')"><i class="fa fa-close"></i></button>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="cart-summary">
                                        <small>{{ $cartCount }} Item(s) selected</small>
                                        <h5>SUBTOTAL: ${{ number_format($cartTotal, 2) }}</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{ route('cart.index') }}">View Cart</a>
                                        <a href="{{ route('checkout') }}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    @else
                                    <div class="cart-list">
                                        <p class="text-center">Your cart is empty</p>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{ route('store') }}">Continue Shopping</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->
