@extends('admin.layout.app')
@section('title', 'Product Details')
@section('content')
    <style>
        img {
            max-width: 100%;
        }

        .circle {
            width: 25px;
            height: 25px;
            display: inline-block;
            border-radius: 100%;
        }

        a img {
            cursor: pointer;
        }

        .comment-reply li {
            margin-bottom: 15px
        }

        .comment-reply li:last-child {
            margin-bottom: none
        }

        .comment-reply li h5 {
            font-size: 18px
        }

        .comment-reply li p {
            margin-bottom: 0px;
            font-size: 15px;
            color: #777
        }

        .comment-reply .list-inline li {
            display: inline-block;
            margin: 0;
            padding-right: 20px
        }

        .comment-reply .list-inline li a {
            font-size: 13px
        }

        @media (max-width: 640px) {
            .blog-page .left-box .single-comment-box>ul>li {
                padding: 25px 0
            }

            .blog-page .left-box .single-comment-box ul li .icon-box {
                display: inline-block
            }

            .blog-page .left-box .single-comment-box ul li .text-box {
                display: block;
                padding-left: 0;
                margin-top: 10px
            }
        }
    </style>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="#" onclick="history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>More About {{ $product->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Product</a></div>
                <div class="breadcrumb-item">Details </div>
            </div>
        </div>
        <div class="section-body">

            <div class="container-fliud">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                        role="tab" aria-controls="home" aria-selected="true">About Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                        aria-controls="profile" aria-selected="false">Discount Status</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                        aria-controls="contact" aria-selected="false">Reviews</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                    aria-labelledby="home-tab3">
                                    <div class="wrapper row">
                                        <div class="preview col-md-6">
                                            <div class="preview-pic tab-content">
                                                @php
                                                    $firstImage = $product->images->first()->image_path;
                                                @endphp
                                                <div class="tab-pane active" style="max-width: 400px;" id="pic-1"><img
                                                        style="transition:0.5s" class="d-block mx-auto"
                                                        src="{{ asset($firstImage) }}" />
                                                </div>
                                                <ul
                                                    class="preview-thumbnail nav nav-tabs owl-carousel owl-theme d-block mt-10">
                                                    @foreach ($product->images as $image)
                                                        <div class="preview-li item" style="display: block; !important">
                                                            <a data-toggle="tab">
                                                                <img src="{{ asset($image->image_path) }}" class="rounded"
                                                                    style="transition:0.5s;" />
                                                            </a>
                                                        </div>
                                                    @endforeach

                                                </ul>
                                            </div>

                                        </div>
                                        <div class="details col-md-6">
                                            <h2 class="section-title text-muted">{{ $product->name }}
                                                ({{ $product->brand->name }})</h2>
                                            <div class="">
                                                {!! $product->description !!}
                                                <a href="{{ route('product.edit', $product->slug) }}"><i
                                                        class="fas fa-pencil-alt"></i>edit</a>

                                            </div>
                                            @if ($product->discount)
                                                <div class="mt-2">
                                                    The original price : <span
                                                        class="originalPriceBox"><del>{{ $product->price }}</del>
                                                        Kyats</span>
                                                </div>
                                                <div class="mt-2">
                                                    Current price : <span
                                                        class="text-success current-price">{{ price_of($product) }}
                                                        Kyats</span> <span
                                                        class="percentageSpan text-danger">(-{{ $product->discount->percentage }}%)</span>
                                                </div>
                                            @else
                                                <h2 class="mt-2">
                                                    {{ $product->price }} Kyats
                                                </h2>
                                            @endif

                                            <p class="mt-2">
                                                <span class="text-success">{{ $product->quantity }}</span> in stocks.
                                            </p>

                                            <div class="row mt-2">
                                                <div class="col-3">
                                                    @for ($i = 0; $i < star_rating_of($product); $i++)
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                    @endfor

                                                </div>
                                                <div class="col-auto">{{ $product->comments->count() }} reviews | <span
                                                        class=" text-muted"> ({{ number_rating_of($product) }} / 10)
                                                    </span></div>
                                            </div>
                                            <div class="mt-2">
                                                @foreach ($product->colours as $colour)
                                                    <span class="circle" style="background : {{ $colour->colour }}"></span>
                                                @endforeach
                                            </div>
                                            <div class="mt-2">
                                                <form action="">
                                                    <div class="selectgroup selectgroup-pills" id="selectgroup-pills">
                                                        @foreach ($product->sizes as $size)
                                                            <label class="selectgroup-item">
                                                                <input type="checkbox" checked disabled value="s"
                                                                    class="selectgroup-input">
                                                                <span class="selectgroup-button">{{ $size->size }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="mt-2">
                                                <span class="badge badge-warning">#{{ $product->category->name }}</span>
                                                <span class="badge badge-success">#{{ $product->subCategory->name }}</span>

                                            </div>
                                            <div class="mt-2">
                                                @foreach ($product->tags as $tag)
                                                    <span class="mt-2 badge badge-light">{{ $tag->tag }}
                                                        <a href="{{ route('tag.delete', $tag->id) }}"><i
                                                                class="fa-solid fa-xmark"
                                                                style="color: rgb(206, 183, 9)"></i></a>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile3" role="tabpanel"
                                    aria-labelledby="profile-tab3">
                                    @if ($product->discount)
                                        <h2 class="badge badge-success" id="current-discount">
                                            Discounted for {{ $product->discount->percentage }}%
                                        </h2>
                                        <div class="mt-2">
                                            The original price : <span class="originalBoxes"><del>{{ $product->price }}
                                                    Kyats</del></span>
                                        </div>
                                        <div class="mt-2">
                                            Current price :
                                            <span
                                                class="text-success current-price">{{ $product->price - $product->price * ($product->discount->percentage / 100) }}
                                            </span> Kyats <span
                                                class="percentageSpan text-danger">(-{{ $product->discount->percentage }}%)</span>
                                            <i style="cursor: pointer" onclick="showForm()"
                                                class="fa-solid fa-pencil"></i>
                                        </div>
                                        <div class="col-6 col-sm-12 d-none" id="edit">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="percentage"
                                                    placeholder="Fill a percentage">
                                            </div>
                                            <button type="button" class="btn btn-success"
                                                onclick="save('update')">Save</button>
                                            <input type="hidden" value="{{ $product->id }}" id="product-id">
                                            <input type="hidden" value="{{ $product->discount->id }}" id="discount-id">
                                            <button type="reset" class="btn btn-danger"
                                                onclick="formClear()">Cancel</button>

                                        </div>
                                    @else
                                        <input type="hidden" value="{{ $product->id }}" id="product-id">
                                        <input type="hidden" value="{{ $product->price }}" id="product-price">
                                        <div class="mt-2">
                                            The original price : <span
                                                class="originalPriceBox"><del>{{ $product->price }}</del>
                                                Kyats</span>
                                        </div>
                                        <div class="mt-2 current-price">
                                        </div>
                                        <h2 class="badge badge-warning" id="current-discount">Not discounted.</h2>
                                        <div class="col-6 col-sm-12" id="edit">
                                            <input type="number" class="form-control" id="percentage"
                                                placeholder="Fill a percentage">
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-success"
                                                    onclick="save('create')">Save</button>
                                                <button type="reset" class="btn btn-danger"
                                                    onclick="formClear()">Cancel</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="contact3" role="tabpanel"
                                    aria-labelledby="contact-tab3">
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($product->comments->count() != 0)
                                                <div class="card">
                                                    <div class="header">
                                                        <h2 class="text-muted">What are people saying about this course
                                                            ({{ $product->comments->count() }})
                                                        </h2>
                                                    </div>
                                                    <div class="body">
                                                        <ul class="comment-reply list-unstyled">
                                                            @foreach ($product->comments as $comment)
                                                                <li class="row clearfix">
                                                                    @if (Auth::user()->image)
                                                                        <div class="icon-box col-md-2 col-4"><img
                                                                                class="img-fluid img-thumbnail"
                                                                                src="{{ asset('storage/' . Auth::user()->image) }}"
                                                                                alt="image" /></div>
                                                                    @elseif (Auth::user()->profile_photo_path)
                                                                        <div class="icon-box col-md-2 col-4"> <img
                                                                                class="img-fluid img-thumbnail"
                                                                                src="{{ Auth::user()->profile_photo_path }}"
                                                                                alt="Google Avatar" />
                                                                        </div>
                                                                    @else
                                                                        <div class="icon-box col-md-2 col-4"><img
                                                                                class="img-fluid img-thumbnail"
                                                                                src="{{ asset('user/assets/images/faces/face1.jpg') }}"
                                                                                alt="image" /></div>
                                                                    @endif

                                                                    <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                                                        <h5 class="m-b-0">{{ $comment->user->name }}</h5>
                                                                        <p>{{ $comment->description }}</p>
                                                                        <ul class="list-inline">
                                                                            <li><a
                                                                                    href="javascript:void(0);">{{ $comment->created_at->format('j-F-Y') }}</a>
                                                                            </li>
                                                                            <li><a href="javascript:void(0);">Reply</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <hr>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('admin/dist/assets/js/product-detail.js') }}"></script>
@endsection
@section('myScript')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            items: 5,
            autoplay: true
        })
    </script>

@endsection
