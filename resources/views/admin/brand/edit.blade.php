@extends('admin.layout.app')
@section('title', 'Edit Brand')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('brand.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit New Brand</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Brands</a></div>
                <div class="breadcrumb-item">Edit New Brand</div>
            </div>
        </div>

        <div class="section-body">
            <form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Your Brand</h4>
                            </div>

                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text"  value="{{ $brand->name }}" class="form-control" name="brand">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                    <div class="col-sm-12 col-md-7">

                                        <div id="image-preview" class="image-preview" style="background-image: url({{ asset($brand->image) }})">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="brandId" value="{{ $brand->id }}">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" ></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" >Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('myScript')
<script src="{{ asset('admin/dist/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('admin/dist/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('admin/dist/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

<script src="{{ asset('admin/dist/assets/js/page/features-post-create.js') }}"></script>




@endsection
