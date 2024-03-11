@extends('user.layout.app')
@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Your Cart
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ($cartItems->count() != 0)
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        @php
                                            $productImages = [];
                                            foreach ($item->product->images as $image) {
                                                $productImages[] = $image->image_path;
                                            }

                                        @endphp
                                        <tr data-cart-id="{{ $item->id }}">
                                            <td class="image"><img src="{{ asset($productImages[0]) }}" alt="#">
                                            </td>
                                            <td class="product-des">
                                                <h5 class="product-name"><a
                                                        href="product-details.html">{{ $item->product->brand->name }} -
                                                        {{ $item->product->name }}</a></h5>

                                            </td>
                                            @if ($item->product->discount)
                                                <td class="price" data-title="Price">
                                                    <span>{{ discounted_price($item->product->price, $item->product->discount->percentage) }}
                                                    </span> Kyats
                                                </td>
                                            @else
                                                <td class="price" data-title="Price">
                                                    <span>{{ $item->prouct->price }}
                                                    </span>Kyats
                                                </td>
                                            @endif

                                            <td class="text-center" data-title="Stock">
                                                <div class="detail-qty border radius m-auto">
                                                    <a href="#" class="qty-down"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                    <span class="qty-val">{{ $item->quantity }}</span>
                                                    <a href="#" class="qty-up"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span
                                                    class="subtotal">{{ calculated_subtotal($item->product->price, $item->quantity, $item->product->discount) }}

                                                </span> Kyats
                                            </td>

                                            <td class="action" data-title="Remove"><a href="#" class="text-muted"><i
                                                        class="fi-rs-trash"></i></a></td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="#" class="text-muted clear-cart"> <i
                                                    class="fi-rs-cross-small"></i> Clear
                                                Cart</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            <a class="btn update-cart-btn  mr-10 mb-sm-15"><i class="fi-rs-shuffle mr-10"></i>Update
                                Cart</a>
                            <a class="btn "><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                            <a class="btn" href="{{ route('cart.checkout') }}"><i
                                    class="fi-rs-shopping-bag mr-10"></i>Proceed to Checkout</a>

                        </div>
                    @else
                        <div class ="col-12 text-center d-block">
                            <img src="{{ asset('user/assets/imgs/empty-cart.png') }}" class="img-fluid  " />
                        </div>
                    @endif
                    <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                </div>
            </div>
        </div>
    </section>
@endsection
