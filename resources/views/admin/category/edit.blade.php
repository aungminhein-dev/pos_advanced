@extends('admin.layout.app')
@section('title', 'Edit Category')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('category.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Category</a></div>
                <div class="breadcrumb-item">Edit </div>
            </div>
        </div>
        <a href="{{ route('category.detail',$category->slug) }}"><i class="fa-solid fa-arrow-left text-black"></i></a>

        <div class="section-body">
            <form action="{{ route('category.update', $category->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 ">
                        <div class="card p-3">
                            <input type="hidden" value="{{ $category->id }}" name="categoryId">
                            <img id="image" src="{{ asset('$category->image') }}" alt="" class="d-block mx-auto rounded"
                                style="max-width :800px">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="custom-file ">
                                    <input type="file" onchange="showImage()"
                                        class="custom-file-input @error('image') is-invalid @enderror" name="image"
                                        id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="name"  value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror"
                                    id="inputEmail4" name="name" placeholder="Enter Category Name...">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Content</label>
                                <textarea name="description" class="form-control summernote-simple @error('description') is-invalid @enderror" rows="9"
                                    cols="">{!! $category->description !!}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="">
                <h1 class="section-title">Sub-Categories for {{ $category->name }}</h1>
                @foreach ($subCategories as $subC)
                @php
                    $colorArray = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                    $indexer = $loop->index % count($colorArray);
                    $color = $colorArray[$indexer];
                @endphp
                <span class="mt-2 badge badge-{{ $color }}">{{ $subC->name }} <a
                        href="{{ route('sub-category.delete', $subC->id) }}"><i class="fa-solid fa-xmark"
                            style="color: rgb(206, 183, 9)"></i></a></span>
            @endforeach
            </div>
        </div>
        </div>
    </section>
    <script src="{{ asset('admin/dist/assets/js/form-assets.js') }}"></script>
@endsection
