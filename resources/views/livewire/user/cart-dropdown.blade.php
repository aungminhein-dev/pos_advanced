<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{ route('cart.list') }}">
        <img alt="Surfside Media" src="{{ asset('user/assets/imgs/theme/icons/icon-cart.svg') }}">
        <span class="pro-count blue">{{ $cartItemCount }}</span>
    </a>
    @if ($cartItems->count() != 0)
    <div class="cart-dropdown-wrap cart-dropdown-hm2 overflow-scroll" style="max-height: 450px">
        <ul>
            @foreach ($cartItems as $item)
                @php
                    $productImages = [];
                    foreach ($item->product->images as $image) {
                        $productImages[] = $image->image_path;
                    }

                @endphp
                <li>
                    <div class="shopping-cart-img">
                        <a href="product-details.html"><img alt="Surfside Media"
                                src="{{ asset($productImages[0]) }}"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="product-details.html">{{ $item->product->name }}</a></h4>
                        <h4><span>{{ $item->quantity }} ×</span>
                            <span class="old-price">{{ price_of($item->product) }} Ks</span>
                        </h4>
                    </div>
                    <div class="shopping-cart-delete">
                        <a href="#"><i class="fi-rs-cross-small"></i></a>
                    </div>
                </li>
                <hr>
            @endforeach
        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total <span>{{ total($cartItems) }} Ks</span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href="{{ route('cart.list', Auth::user()->id) }}" class="outline">View cart</a>
                <a href="{{ route('cart.checkout') }}">Checkout</a>
            </div>
        </div>
    </div>
    @else
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <img src="{{ asset('user/assets/imgs/empty-cart.png') }}" class="img-fluid  " />
    </div>
    @endif
</div>
