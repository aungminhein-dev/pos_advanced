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
    </style>
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">More about {{ $product->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Product</a></div>
                <div class="breadcrumb-item">Detail </div>
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
                                                <div class="tab-pane active" style="max-width: 400px" id="pic-1"><img
                                                        style="transition:0.5s" class="d-block mx-auto"
                                                        src="{{ asset($firstImage) }}" />
                                                </div>
                                            </div>
                                            <ul class="preview-thumbnail nav nav-tabs owl-carousel owl-theme">
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
                                        <div class="details col-md-6">
                                            <h2 class="section-title text-muted">{{ $product->name }} (<a
                                                    href="{{ route('product.edit', $product->slug) }}"><i
                                                        class="fas fa-pencil-alt"></i>edit</a>)</h2>
                                            <div class="">
                                                {!! $product->description !!}
                                            </div>
                                            @if ($product->discount)
                                                <div class="mt-2">
                                                    The original price : <span
                                                        class="originalPriceBox"><del>{{ $product->price }}</del>
                                                        Kyats</span>
                                                </div>
                                                <div class="mt-2">
                                                    Current price : <span
                                                        class="text-success current-price">{{ $product->price - $product->price * ($product->discount->percentage / 100) }}
                                                        Kyats</span> <span
                                                        class="percentageSpan text-danger">(-{{ $product->discount->percentage }}%)</span>
                                                </div>
                                            @else
                                                <h2 class="mt-2">
                                                    {{ $product->price }} Kyats
                                                </h2>
                                            @endif
                                            <div class="row mt-2">
                                                <div class="col-3">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                </div>
                                                <div class="col-auto">20 reviews</div>
                                            </div>
                                            <div class="mt-5">
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
                                                <h4>Tags</h4>
                                                @foreach ($product->tags as $tag)
                                                    @php
                                                        $colorArray = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                                                        $indexer = $loop->index % count($colorArray);
                                                        $color = $colorArray[$indexer];
                                                    @endphp
                                                    <span class="mt-2 badge badge-{{ $color }}">{{ $tag->tag }}
                                                        <a
                                                            href="{{ route('sub-category.delete', $product->subCategory->id) }}"><i
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
                                        <h2 class="badge badge-warning">Not discounted.</h2>
                                        <div class="mt-2">Original Price :
                                            <span class="price">{{ $product->price }}</span> Kyats
                                        </div>
                                        <div class="col-6 col-sm-12">
                                            <input type="number" class="form-control" id="percentage"
                                                placeholder="Fill a percentage">
                                            <button type="button" class="btn btn-success"
                                                onclick="save('create')">Save</button>
                                            <button type="reset" class="btn btn-danger"
                                                onclick="formClear()">Cancel</button>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="contact3" role="tabpanel"
                                    aria-labelledby="contact-tab3">
                                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin
                                    ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque
                                    fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius
                                    lectus elit id dolor.
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
