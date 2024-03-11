<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{route('cart.list',Auth::user()->id)}}">
        <img alt="Surfside Media" src="{{ asset('user/assets/imgs/theme/icons/icon-cart.svg') }}">
        <span class="pro-count blue">{{ $cartItemCount }}</span>
    </a>
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
                            @if ($item->product->discount)
                                <div class="product-price">
                                    <span>{{ discounted_price($item->product->price,$item->product->discount->percentage) }}
                                        Ks</span>
                                </div>
                            @else
                                <span class="old-price">{{ $item->product->price }} Ks</span>
                            @endif
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
                <a href="{{ route('cart.list',Auth::user()->id) }}" class="outline">View cart</a>
                <a href="{{ route('cart.checkout') }}">Checkout</a>
            </div>
        </div>
    </div>
</div>
