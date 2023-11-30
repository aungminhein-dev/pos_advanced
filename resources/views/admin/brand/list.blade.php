@extends('admin.layout.app')
@section('title', 'Brands')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Brands</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Brands</a></div>
                <div class="breadcrumb-item">List</div>
            </div>
        </div>

        <div class="section-body">
            @if ($brands->count() != 0)
                @if (session('addMessage'))
                    <x-alert type="success" message="{{ session('addMessage') }} "></x-alert>
                @endif
                @if (session('updateMessage'))
                    <x-alert type="primary" message=" {{ session('updateMessage') }}"></x-alert>
                @endif
                @if (session('deleteMessage'))
                    <x-alert type="primary" message=" {{ session('deleteMessage') }}"></x-alert>
                @endif
                <a href="{{ route('brand.addPage') }}" class="btn btn-primary my-2">+ Add New Brand</a>
                <div class="row">
                    @foreach ($brands as $brand)
                        <div class="col-12 col-lg-3">
                            <div class="card rounded shadow">
                                <img src="{{ asset($brand->image) }}" alt="">
                                <div class="action">
                                    <a href="{{ route('brand.delete', $brand->id) }}"><i
                                            class="fas fa-trash text-danger"></i></a>
                                    <a href="{{ route('brand.edit', $brand->id) }}"><i
                                            class="fas fa-pencil-alt text-primary"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="col-12 col-sm-12 not-found">
                    <div class="empty-state" data-height="400">
                        <div class="empty-state-icon">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2>We couldn't find any data</h2>
                        <p class="lead">
                            Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                        </p>
                        <a href="{{ route('product.addPage') }}" class="btn btn-primary mt-4">Create new One</a>
                        <a href="#" class="mt-4 bb">Need Help?</a>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection
{{-- @section('myScript')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            items: 5,
            autoplay: true
        })
    </script>
@endsection --}}
