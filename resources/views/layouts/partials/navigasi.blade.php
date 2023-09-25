<!-- menu start -->
<nav class="main-menu">
    <ul>        
        {{-- <li><a href="shop.html">Menu</a>
            <ul class="sub-menu">
                <li><a href="shop.html">Shop</a></li>
                <li><a href="checkout.html">Check Out</a></li>
                <li><a href="single-product.html">Single Product</a></li>
                <li><a href="cart.html">Cart</a></li>
            </ul>
        </li> --}}
        <li>
            <div class="header-icons">
                @if(Str::length(Auth::guard('webmeja')->user()) > 0)
                    <a href="{{ route('home') }}">{{ Auth::guard('webmeja')->user()->name }}</a>
                    <a class="shopping-cart" href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i> <span>{{ $cartNum }}</span></a>
                @else
                    <a class="shopping-cart" href="#"><i class="fas fa-shopping-cart"></i> <span>{{ $cartNum }}</span></a>
                @endif
                <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
            </div>
        </li>
    </ul>
</nav>
<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
<div class="mobile-menu"></div>
<!-- menu end -->