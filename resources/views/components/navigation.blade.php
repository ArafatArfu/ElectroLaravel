    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">Hot Deals</a></li>
                    <li class="{{ request()->routeIs('store') && !request()->has('category') ? 'active' : '' }}"><a href="{{ route('store') }}">All Products</a></li>
                    
                    @if(isset($categories) && count($categories) > 0)
                        @foreach($categories as $category)
                        <li class="{{ request()->get('category') == $category->slug ? 'active' : '' }}">
                            <a href="{{ route('store', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    @else
                        <li><a href="#">Laptops</a></li>
                        <li><a href="#">Smartphones</a></li>
                        <li><a href="#">Cameras</a></li>
                        <li><a href="#">Accessories</a></li>
                    @endif
                    <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
