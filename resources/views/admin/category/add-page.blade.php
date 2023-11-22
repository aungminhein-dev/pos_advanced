@extends('admin.layout.app')
@section('title', 'Add Category')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('category.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Add Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Category</a></div>
                <div class="breadcrumb-item">Add </div>
            </div>
        </div>

        <div class="section-body">
            <form action="{{ route('category.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 ">
                        <div class="card p-3">
                            <img id="image" src="" alt="" class="d-block mx-auto rounded"
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="inputEmail4" name="name" placeholder="Enter Category Name...">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Content</label>
                                <textarea name="description" class="form-control summernote-simple @error('description') is-invalid @enderror"
                                    rows="9" cols=""></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary col-3 ">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </section>
    <script>
        // image preview for category
        const showImage = () => {
            document.getElementById('image').src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
