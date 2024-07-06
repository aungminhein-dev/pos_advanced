<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('user/assets/css/main.css') }}">

<div class="order_review">
    <div class="mb-20">
        <h4>Your Orders</h4>
    </div>
    <div class="table-responsive order_table text-center">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2">Product</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $item)
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
                            <span class="product-qty">{{ price_of($item->product) }} Ks x {{ $item->quantity }}</span>
                        </td>
                       <td>
                        {{ $item->subtotal }} Ks
                       </td>
                    </tr>
                @endforeach

                <tr>
                    <th>Total</th>
                    <td class="product-subtotal" colspan="2">{{ $order->total }} Kyats</td>
                </tr>
                <tr>
                    <th class="">Delivery + Gate Fee</th>
                    <td colspan="2"><em class="shipping">{{ $order->delivery_price }} Kyats</em></td>
                </tr>
                <tr>
                    <th>Grand Total</th>
                    <td colspan="2" class="" id="total"><span
                            class="font-xl text-brand fw-900">{{ $order->total_with_delivery_price }} Kyats</span></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
