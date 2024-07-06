@extends('user.layout.app')
@section('content')

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Order</a>
                <span>Details</span>
            </div>
        </div>
    </div>

    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-12">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Order Code - <span class="text-danger">{{ $order->order_code }}</span></h4>
                                </div>

                                <div class="table-responsive order_table text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderDetails as $item)
                                                <tr>

                                                    <td colspan="2">
                                                        <h5><a href="product-details.html">{{ $item->product->name }}</a></h5>

                                                    </td>
                                                    <td>
                                                        {{ price_of($item->product) }} Ks
                                                    </td>
                                                    <td>
                                                        {{ $item->quantity }}
                                                    </td>
                                                    <td>
                                                        {{ $item->subtotal }} Ks
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th >Total</th>
                                                <td class="product-subtotal" colspan="4">{{ $order->total }} Kyats</td>
                                            </tr>
                                            <tr>
                                                <th class="">Delivery + Gate Fee</th>
                                                <td colspan="4"><em class="shipping">{{ $order->delivery_price }} Kyats</em></td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td colspan="4" class="" id="total"><span
                                                        class="font-xl text-brand fw-900">{{ $order->total_with_delivery_price }} Kyats</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('myScript')
<script>

</script>
@endsection
