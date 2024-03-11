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
            <form method="post" action="{{ route('checkout') }}">
                @csrf
                @foreach ($cartItems as $index => $item)
                    <input type="hidden" name="products[{{ $index }}][id]" value="{{ $item->product->id }}">
                    <input type="hidden" name="products[{{ $index }}][quantity]" value="{{ $item->quantity }}">
                    <input type="hidden" name="products[{{ $index }}][subtotal]" value="{{ calculated_subtotal($item->product->price,$item->quantity,$item->product->discount) }}">
                @endforeach
                <input type="hidden" name="total" value="{{ total($cartItems) }}">
                <input type="hidden" name="deliveryPrice" value="0" id="deliveryPrice" value="">
                <input type="hidden" name="totalWithDeliveryPrice" value="0" id="totalWithDeliveryPrice">
                {{-- <div class="row">
                    <div class="col-lg-6 mb-sm-15">
                        <div class="toggle_info">
                            <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Already have an account?</span>
                                <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click
                                    here to login</a></span>
                        </div>
                        <div class="panel-collapse collapse login_form" id="loginform">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have shopped with us before, please enter your details
                                    below. If
                                    you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Username Or Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="remember" value="">
                                                <label class="form-check-label" for="remember"><span>Remember
                                                        me</span></label>
                                            </div>
                                        </div>
                                        <a href="#">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-md" name="login">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a
                                    href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click
                                    here
                                    to enter your code</a></span>
                        </div>
                        <div class="panel-collapse collapse coupon_form " id="coupon">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Coupon Code...">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn  btn-md" name="login">Apply Coupon</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-25">
                        <h4>Billing Details</h4>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="phone" placeholder="Phone *">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" required="" placeholder="Address *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                    <label class="form-check-label label_info" data-bs-toggle="collapse"
                                        href="#collapsePassword" data-target="#collapsePassword"
                                        aria-controls="collapsePassword" for="createaccount"><span>Send me an invoice
                                            mail</span></label>
                                </div>
                            </div>
                        </div>
                        <div id="collapsePassword" class="form-group create-account collapse in">
                            <input required="" type="text" placeholder="Email Address" name="email">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <input type="text" name="locationLink" required="" placeholder="Google map link *">
                        </div>

                        <div class="form-group">
                            <input type="text" name="paymentAccountNumber" required="" placeholder="Paid account Name *">
                        </div>

                        <div class="form-group">
                            <input type="text" name="paymentProcessNumber" required=""
                                placeholder="Online banking process number *">
                        </div>

                        <div class="mb-20">
                            <h5>Additional information</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" placeholder="Other Notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Your Orders</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Total</th>
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
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{ asset($productImages[0]) }}"
                                                    alt="#">
                                            </td>
                                            <td>
                                                <h5><a href="product-details.html">{{ $item->product->name }}</a></h5>
                                                <span class="product-qty">x {{ $item->quantity }}</span>
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
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th>SubTotal</th>
                                        <td class="product-subtotal" colspan="2">{{ total($cartItems) }} Kyats</td>
                                    </tr>
                                    <tr>
                                        <th class="">Shipping + Gate Fee</th>
                                        <td colspan="2"><em class="shipping">Free Shipping</em></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2" class="" id="total"><span
                                                class="font-xl text-brand fw-900">{{ total($cartItems) }} Kyats</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="row">
                            <div class="col-lg-6 payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="cashOnDelivery"
                                            id="exampleRadios3">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                            data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On
                                            Delivery</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="cardPayment"
                                            id="exampleRadios4">
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                            data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="paypal"
                                            id="exampleRadios5">
                                        <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                            data-target="#paypal" aria-controls="paypal">Paypal</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class=" border p-md-4 p-30 border-radius cart-totals">
                                    <div class="d-flex justify-content-between">
                                        <h4>Calculate Shipping</h4>
                                        <div class="custom_select">
                                            <select class="form-control select-active">
                                                <option value="" disabled selected>Select Region</option>
                                                @foreach ($deliveryAreas as $area)
                                                    <option region="{{ $area->name }}" value="{{ $area->price }}"
                                                        gate-fee="{{ $area->gate_fee }}">
                                                        {{ $area->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Price</td>
                                                    <td class="deli-price"><span class="font-lg">0</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Gate Fee</td>
                                                    <td id="gate-fee">0.00 Kyats</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Price + Gate Fee</td>
                                                    <td class="shipping_total"><span class="font-xl"
                                                            style="">0</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection
