@extends('user.layout.app')
@section('content')
    <style>
        .gold {
            background-color: gold;
            color: gold;
        }
    </style>
    <!-- Quick view -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/animations.min.css"
        integrity="sha512-GKHaATMc7acW6/GDGVyBhKV3rST+5rMjokVip0uTikmZHhdqFWC7fGBaq6+lf+DOS5BIO8eK6NcyBYUBCHUBXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @foreach ($product->images as $image)
                                            <figure class="border-radius-10" style="height: 300px;">
                                                <img src="{{ asset($image->image_path) }}" style="height: 100%; width:100%"
                                                    alt="product image" class="img-fluid">
                                            </figure>
                                        @endforeach

                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @foreach ($product->images as $image)
                                            <div><img src="{{ asset($image->image_path) }}" alt="product image"></div>
                                        @endforeach

                                    </div>
                                </div>
                                <!-- End Gallery -->
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">Share this:</strong></li>
                                        <li class="social-facebook"><a href="#"><img
                                                    src="{{ asset('user/assets/imgs/theme/icons/icon-facebook.svg') }}"
                                                    alt=""></a></li>
                                        <li class="social-twitter"> <a href="#"><img
                                                    src="{{ asset('user/assets/imgs/theme/icons/icon-twitter.svg') }}"
                                                    alt=""></a></li>
                                        <li class="social-instagram"><a href="#"><img
                                                    src="{{ asset('user/assets/imgs/theme/icons/icon-instagram.svg') }}"
                                                    alt=""></a></li>
                                        <li class="social-linkedin"><a href="#"><img
                                                    src="{{ asset('user/assets/imgs/theme/icons/icon-pinterest.svg') }}"
                                                    alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{ $product->name }} </h2>
                                    <span>( {{ $product->view_count }}
                                        views)</span>
                                    <div class="product-detail-rating">
                                        <h4 class="pro-details-brand">
                                            <span> Brands: <a href="shop.html">{{ $product->brand->name }}</a></span>
                                        </h4>
                                        <div class="product-rate-cover text-end">
                                            <div class="">
                                                @for ($i = 0; $i < star_rating_of($product); $i++)
                                                    <box-icon size='xs' name='star' color='gold'></box-icon>
                                                @endfor
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ number_rating_of($product) }} /
                                                10)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand">{{ number_format(price_of($product)) }}
                                                    Kyats</span></ins>
                                            @if ($product->discount)
                                                <ins><span class="old-price font-md ml-15">
                                                        {{ number_format($product->price) }} Kyats</span></ins>
                                                <span
                                                    class="save-price  font-md color3 ml-15">{{ $product->discount->percentage }}
                                                    % Off</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>

                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera Brand
                                                Warranty</li>
                                            <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                                            <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                        </ul>
                                    </div>
                                    @if ($product->colours)
                                        <div class="attr-detail attr-color mb-15">
                                            <strong class="mr-10">Color</strong>
                                            <ul class="list-filter color-filter">
                                                @foreach ($product->colours as $colour)
                                                    <li><a href="#" data-color="{{ $colour->colour }}"><span
                                                                style="background: {{ $colour->colour }}"></span></a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    @endif
                                    @if ($product->sizes)
                                        <div class="attr-detail attr-size">
                                            <strong class="mr-10">Size</strong>
                                            <ul class="list-filter size-filter font-small">
                                                @foreach ($product->sizes as $size)
                                                    <li><a href="#">{{ $size->size }}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    @endif
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button type="button " class="button button-add-to-cart ">Add to cart</button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                        <li class="mb-5">Tags: @foreach ($product->tags as $tag)
                                                <span class="badge badge-pill badge-success"
                                                    rel="tag">{{ $tag->tag }}</span>
                                            @endforeach
                                        </li>
                                        <li>Availability:<span class="in-stock text-success ml-5">{{ $product->quantity }}
                                            </span> Items In Stock
                                        </li>
                                    </ul>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                        href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                        href="#Additional-info">Additional info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews
                                        ({{ $comments->count() }})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        {!! $product->description !!}
                                        <ul class="product-more-infor mt-30">
                                            <li><span>Type Of Packing</span> Bottle</li>
                                            <li><span>Color</span> Green, Pink, Powder Blue, Purple</li>
                                            <li><span>Quantity Per Case</span> 100ml</li>
                                            <li><span>Ethyl Alcohol</span> 70%</li>
                                            <li><span>Piece In One</span> Carton</li>
                                        </ul>
                                        <hr class="wp-block-separator is-style-dots">
                                        <p>Laconic overheard dear woodchuck wow this outrageously taut beaver hey hello far
                                            meadowlark imitatively egregiously hugged that yikes minimally unanimous pouted
                                            flirtatiously as beaver beheld above forward
                                            energetic across this jeepers beneficently cockily less a the raucously that
                                            magic upheld far so the this where crud then below after jeez enchanting
                                            drunkenly more much wow callously irrespective limpet.</p>
                                        <h4 class="mt-30">Packaging & Delivery</h4>
                                        <hr class="wp-block-separator is-style-wide">
                                        <p>Less lion goodness that euphemistically robin expeditiously bluebird smugly
                                            scratched far while thus cackled sheepishly rigid after due one assenting
                                            regarding censorious while occasional or this more crane
                                            went more as this less much amid overhung anathematic because much held one
                                            exuberantly sheep goodness so where rat wry well concomitantly.
                                        </p>
                                        <p>Scallop or far crud plain remarkably far by thus far iguana lewd precociously and
                                            and less rattlesnake contrary caustic wow this near alas and next and pled the
                                            yikes articulate about as less cackled dalmatian
                                            in much less well jeering for the thanks blindly sentimental whimpered less
                                            across objectively fanciful grimaced wildly some wow and rose jeepers outgrew
                                            lugubrious luridly irrationally attractively
                                            dachshund.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Stand Up</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Folded (w/o wheels)</th>
                                                <td>
                                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Folded (w/ wheels)</th>
                                                <td>
                                                    <p>32.5″L x 24″W x 18.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Door Pass Through</th>
                                                <td>
                                                    <p>24</p>
                                                </td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Weight (w/o wheels)</th>
                                                <td>
                                                    <p>20 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Weight Capacity</th>
                                                <td>
                                                    <p>60 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="width">
                                                <th>Width</th>
                                                <td>
                                                    <p>24″</p>
                                                </td>
                                            </tr>
                                            <tr class="handle-height-ground-to-handle">
                                                <th>Handle height (ground to handle)</th>
                                                <td>
                                                    <p>37-45″</p>
                                                </td>
                                            </tr>
                                            <tr class="wheels">
                                                <th>Wheels</th>
                                                <td>
                                                    <p>12″ air / wide track slick tread</p>
                                                </td>
                                            </tr>
                                            <tr class="seat-back-height">
                                                <th>Seat back height</th>
                                                <td>
                                                    <p>21.5″</p>
                                                </td>
                                            </tr>
                                            <tr class="head-room-inside-canopy">
                                                <th>Head room (inside canopy)</th>
                                                <td>
                                                    <p>25″</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_color">
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Red, White</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_size">
                                                <th>Size</th>
                                                <td>
                                                    <p>M, S</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    @if ($comments->count() > 0)
                                                        @foreach ($comments as $comment)
                                                            <div class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="{{ asset('user/assets/imgs/page/avatar-6.jpg') }}"
                                                                            alt="">
                                                                        <h6><a
                                                                                href="#">{{ $comment->user->name }}</a>
                                                                        </h6>
                                                                        <p class="font-xxs">Since
                                                                            {{ $comment->user->created_at->format('Y') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div class="d-inline-block">
                                                                            @for ($i = 0; $i < $comment->user->userRatingToAProduct($comment->user->id, $product->id); $i++)
                                                                                <box-icon size='xs' name='star'
                                                                                    color='gold '></box-icon>
                                                                            @endfor
                                                                        </div>
                                                                        <p>{{ $comment->description }}</p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="font-xs mr-30">
                                                                                    {{ $comment->created_at->diffForHumans() }}
                                                                                    at
                                                                                    {{ $comment->created_at->format('h:i A') }}
                                                                                </p>
                                                                                <a href="#"
                                                                                    class="text-brand btn-reply">Reply <i
                                                                                        class="fi-rs-arrow-right"></i> </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <p>No reviews yet!</p>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>

                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%;"
                                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%;"
                                                        aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%;"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%
                                                    </div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%;"
                                                        aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%
                                                    </div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings
                                                    calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="stars">
                                            <box-icon size='xs' class="star" name='star'></box-icon>
                                            <box-icon size='xs' class="star" name='star'></box-icon>
                                            <box-icon size='xs' class="star" name='star'></box-icon>
                                            <box-icon size='xs' class="star" name='star'></box-icon>
                                            <box-icon size='xs' class="star" name='star'></box-icon>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="{{ route('comment') }}"
                                                    id="commentForm" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="starCount" id="star-count">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="description" id="comment" cols="30" rows="9"
                                                                    placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="productId"
                                                            value="{{ $product->id }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Related products</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @forelse ($relatedProducts as $product)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-details.html" tabindex="0">
                                                            @php
                                                                $productImages = [];
                                                                foreach ($product->images as $image) {
                                                                    $productImages[] = $image->image_path;
                                                                }

                                                            @endphp

                                                            @if (count($productImages) != 1)
                                                                <img class="default-img"
                                                                    src="{{ asset($productImages[0]) }}" alt="">
                                                                <img class="hover-img"
                                                                    src="{{ asset($productImages[1]) }}" alt="">
                                                            @else
                                                                <img class="default-img"
                                                                    src="{{ asset($productImages[0]) }}" alt="">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up"
                                                            data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                                class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                            href="wishlist.php" tabindex="0"><i
                                                                class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up"
                                                            href="compare.php" tabindex="0"><i
                                                                class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        @if ($product->quantity === 0)
                                                            <span class="hot">Out of stock</span>
                                                        @endif
                                                        @if ($product->arrival_status == 'New')
                                                            <span class="new">{{ $product->arrival_status }}</span>
                                                        @else
                                                            - {{ $product->discount->percentage }} %
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a
                                                            href="{{ route('user.product.details', $product->slug) }}">{{ $product->name }}</a>
                                                    </h2>
                                                   <div>
                                                    @for ($i = 0; $i < star_rating_of($product); $i++)
                                                            <i class="fi-rs-star text-warning fs-xs"></i>
                                                        @endfor
                                                        <span>{{ number_rating_of($product) ? number_rating_of($product) . '/ 10' : '(Not Rated)' }}
                                                        </span>
                                                   </div>
                                                    @if ($product->discount)
                                                        <div class="product-price">
                                                            <span>{{ number_format(price_of($product)) }}
                                                                Ks</span>
                                                            <span
                                                                class="old-price">{{ number_format(price_of($product)) }}
                                                                Ks</span>
                                                        </div>
                                                    @else
                                                        <div class="product-price">
                                                            <span>{{ number_format(price_of($product)) }} Ks</span>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                        <ul class="categories">
                            @foreach ($categories as $category)
                                <li><a href="shop.html">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('myScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.min.js"
        integrity="sha512-y8/3lysXD6CUJkBj4RZM7o9U0t35voPBOSRHLvlUZ2zmU+NLQhezEpe/pMeFxfpRJY7RmlTv67DYhphyiyxBRA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.button-add-to-cart').click(function() {
            @auth
            let userId = "{{ Auth::user()->id }}";
        @else
            let userId = null;
        @endauth
        if (!userId) {
            toastr.warning("Please log in first", "Error")
            return;
        }
        let quantity = $('.qty-val').text();
        let productId = "{{ $product->id }}"
        $.ajax({
            url: '/add-to-cart',
            method: 'get',
            data: {
                'quantity': quantity,
                'productId': productId
            },
            success: function(response) {
                Livewire.dispatch('addedToCart')
                $('.in-stock').text(parseFloat($('.in-stock').text()) - parseFloat(quantity))
            },
            error: function(error) {
                toastr.error("Something Went Wrong", "Failed")
            }
        })
        })

        const allStars = $('.stars .star');

        allStars.each(function(index, item) {
            $(item).click(function() {
                allStars.removeAttr('color');
                let starCount = index + 1
                // Set 'color' attribute to 'gold' for stars up to the clicked one
                allStars.slice(0, starCount).attr('color', 'gold');
                $('#star-count').val(starCount)
            });
        });
    </script>
@endsection
