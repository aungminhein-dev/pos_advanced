<div class="container">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="invoice-container">
                        <div class="invoice-header">

                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="custom-actions-btns mb-5">
                                        <a href="#" class="btn btn-primary">
                                            <i class="icon-download"></i> Download
                                        </a>
                                        <a href="#" class="btn btn-secondary">
                                            <i class="icon-printer"></i> Print
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->

                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <a href="index.html" class="invoice-logo">
                                        Bootdey.com
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <address class="text-right">
                                        Maxwell admin Inc, 45 NorthWest Street.<br>
                                        Sunrise Blvd, San Francisco.<br>
                                        00000 00000
                                    </address>
                                </div>
                            </div>
                            <!-- Row end -->

                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                    <div class="invoice-details">
                                        <address>
                                            Alex Maxwell<br>
                                            150-600 Church Street, Florida, USA
                                        </address>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                    <div class="invoice-details">
                                        <div class="invoice-num">
                                            <div>Invoice - #009</div>
                                            <div>January 10th 2020</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->

                        </div>

                        <div class="invoice-body">

                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table custom-table m-0">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderDetails as $item)
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="{{ route('user-profile-information.update', $item->product->slug) }}">{{ $item->product->name }}</a>

                                                        </td>
                                                        <td>{{ $item->product->price }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->subtotal }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td colspan="2">
                                                        <p>
                                                            Total<br>
                                                            Delivery &amp; Gate Fee<br>
                                                        </p>
                                                        <h5 class="text-success"><strong>Grand Total</strong></h5>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ $order->total }} Kyats<br>
                                                            {{ $order->delivery_price }} Kyats<br>
                                                            <br>
                                                        </p>
                                                        <h5 class="text-success">
                                                            <strong>{{ $order->total_with_delivery_price }}
                                                                Kyats</strong></h5>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->

                        </div>

                        <div class="invoice-footer">
                            Thank you for your Business.
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
