@extends('admin.layout.app')
@section('title', 'Category Details')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('category.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Category Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Category</a></div>
                <div class="breadcrumb-item">Details</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card  rounded p-3">
                @if (session('addMessage'))
                    <x-alert type="success" message="{{ session('addMessage') }}"></x-alert>
                @endif
                @if (session('deleteMessage'))
                    <x-alert type="danger" message="{{ session('deleteMessage') }}"></x-alert>
                @endif
                <div class="row ">

                    <div class="col-12 col-lg-6 ">
                        <img style="max-width:500px;" src="{{ asset($category->image->image_path) }}" alt=""
                            class="d-block mx-auto rounded">

                    </div>
                    <div class="col-12 col-lg-6 d-flex flex-column justify-content-between">

                        <div class=" p-3">
                            <h1 class="section-title">{{ $category->name }}</h1>
                            <h6 class=" mt-3">
                                {!! $category->description !!}
                            </h6>
                        </div>

                       <livewire:admin.sub-category-form :category="$category" :id="$category->id"/>
                        <div class="">
                            <h3 class="section-title">Tags</h3>
                            <span class="badge badge-light">{{ $category->tag->tag }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('category.edit',$category->slug) }}"><i class="fa-solid fa-pencil"></i>edit</a>
            </div>
        </div>
        </div>
    </section>

@endsection
