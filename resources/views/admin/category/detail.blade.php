@extends('admin.layout.app')
@section('title', 'Category Details')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Category Details</h1>
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
                        <img style="max-width:880px;" src="{{ asset($category->image) }}" alt=""
                            class="d-block mx-auto rounded">

                    </div>
                    <div class="col-12 col-lg-6 d-flex flex-column justify-content-between">

                        <div class=" p-3">
                            <h1 class="section-title">{{ $category->name }}</h1>
                            <h6 class="text-muted mt-3">
                                <div class="bullet"></div>
                                {{ $category->description }}
                            </h6>
                        </div>
                        <div class="">
                            @foreach ($category->subCategories as $subC)
                                @php
                                    $colorArray = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                                    $indexer = $loop->index % count($colorArray);
                                    $color = $colorArray[$indexer];
                                @endphp
                                <span class="mt-2 badge badge-{{ $color }}">{{ $subC->name }} ({{ $subC->products->count() }}) <a
                                        href="{{ route('sub-category.delete', $subC->id) }}"><i class="fa-solid fa-xmark"
                                            style="color: rgb(206, 183, 9)"></i></a></span>
                            @endforeach
                            <h3 class="section-title">Add Sub Category for this Category</h3>
                            <form action="{{ route('sub-category.add') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Sub Category Name</label>
                                    <input type="hidden" name="categoryId" value="{{ $category->id }}">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button class="btn btn-success" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="{{ route('category.edit',$category->slug) }}"><i class="fa-solid fa-pencil"></i>edit</a>
            </div>
        </div>
        </div>
    </section>
@endsection
