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
                <div class="breadcrumb-item"><a href="#">product</a></div>
                <div class="breadcrumb-item">Detail </div>
            </div>
        </div>
        <div class="section-body">
            <div class="container">
                <div class="card px-2">
                    <div class="container-fliud">
                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <div class="preview-pic tab-content">
                                    @php
                                        $firstImage = $product->images->first()->image_path;
                                    @endphp
                                    <div class="tab-pane active" style="max-width: 400px" id="pic-1"><img
                                            style="transition:0.5s" class="d-block mx-auto"
                                            src="{{ asset($firstImage) }}" /></div>
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
                                <h2 class="section-title">{{ $product->name }}</h2>
                                <div class="">
                                    {!! $product->description !!}
                                </div>
                                <h2 class="text-black mt-2">{{ $product->price }} Kyats</h2>
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
                                                    <input type="checkbox" checked  disabled value="s"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let mainImage = document.querySelector('#pic-1 img');
        imagesContainer = document.querySelectorAll('.preview-li');
        const previewImages = document.querySelectorAll('.preview-li a img')

        const changeImage = () => {
            imagesContainer.forEach(imageLi => {
                imageLi.addEventListener('click', (e) => {
                    let image = imageLi.querySelector('a img').src;
                    mainImage.src = image;
                    activeImage();
                })
            });
        }

        const activeImage = () => {
            previewImages.forEach(image => {
                image.src == mainImage.src ? image.classList.add('border', 'border-dark') : image.classList
                    .remove('border', 'border-dark')
            });
        }
        changeImage();
        activeImage();
    </script>
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
