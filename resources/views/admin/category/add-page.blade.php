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
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="">
                                    <div id="image-preview" class="image-preview" style="width: 400px;">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

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

                           <div class="form-group">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                           </div>
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
@section('myScript')
    <script src="{{ asset('admin/dist/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/js/page/features-post-create.js') }}"></script>
@endsection
