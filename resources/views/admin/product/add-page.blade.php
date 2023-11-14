@extends('admin.layout.app')
@section('title', 'Add Product')
@section('myCss')

    <style>
        .img-input input[type="file"] {
            display: none;
        }

        .img-input label {
            display: block;
            position: relative;
            background-color: #025bee;
            color: #ffffff;
            font-size: 1em;
            font-weight: 500;
            text-align: center;
            width: 100%;
            padding: 0.8em 0;
            margin-top: 25px;
            border-radius: 0.31em;
            cursor: pointer;
        }

        .previews-container {
            position: relative;
        }

        .previews-container img {
            width: 100px;
            margin-right: 5px;
        }

        .previews-container i {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            cursor: pointer;
            /* Adding cursor style for visual feedback */
            color: red;
            /* Changing the 'x' color */
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Add product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">product</a></div>
                <div class="breadcrumb-item">Add </div>
            </div>
        </div>

        <div class="section-body">
            <form action="{{ route('product.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="previews-container"></div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name" placeholder="Enter produt name"
                                class="form-control @error('name')  'is-invalid'  @enderror">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Available Quantity</label>
                            <input type="number" name="quantity" placeholder="Enter quantity" id=""
                                class="form-control @error('quantity') 'is-invalid'  @enderror">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="Enter price"
                                class="form-control @error('price') 'is-invalid'  @enderror">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Sub-Category</label>
                            <select class="form-control selectric" onchange="addCategory1(event)" name="subCategories">
                                <option disabled selected>Select sub-category</option>
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}"
                                        data-category="{{ $sub_category->category->name }}">{{ $sub_category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subCategories')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="">Category</label>
                        <input type="text" id="categoryInput" value="Shirts" name="" class="form-control"
                            disabled>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Color Input</label>
                            <div class="row gutters-xs" id="colorContainer">
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value=" #007bff" class="colorinput-input" />
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#6c757d" class="colorinput-input" />
                                        <span class="colorinput-color bg-secondary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#dc3545" class="colorinput-input" />
                                        <span class="colorinput-color bg-danger"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#ffc107" class="colorinput-input" />
                                        <span class="colorinput-color bg-warning"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#17a2b8" class="colorinput-input" />
                                        <span class="colorinput-color bg-info"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#28a745" class="colorinput-input" />
                                        <span class="colorinput-color bg-success"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <span class="text-muted">Choose your product's custom colours here!</span>
                        <div class="form-group d-flex">
                            <input type="color" style="border-radius: 5px 0px 0px 5px" class="form-control"
                                onchange="changeColor(event)" value="#43da86" id="" />
                            <button class="btn btn-warning btn-sm" style="border-radius: 0px 5px 5px 0px"
                                onclick="addColor()" type="button">Add
                                Colour</button>
                        </div>
                    </div>


                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Choose Sizes</label>
                            <div class="selectgroup selectgroup-pills" id="selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="S" class="selectgroup-input">
                                    <span class="selectgroup-button">S</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="L" class="selectgroup-input">
                                    <span class="selectgroup-button">L</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="M" class="selectgroup-input">
                                    <span class="selectgroup-button">Medium</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="XL" class="selectgroup-input">
                                    <span class="selectgroup-button">XL</span>
                                </label>

                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="XXL" class="selectgroup-input">
                                    <span class="selectgroup-button">XXL</span>
                                </label>

                                <label class="selectgroup-item" id="all-selected">
                                    <input type="checkbox" onchange="selectAll(event)"s
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">All</span>
                                </label>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 img-input">
                        <input type="file" name="images[]" id="file-input" multiple onchange="productImagePreview(event)" />
                        <label for="file-input">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            &nbsp; Choose Files To Upload
                        </label>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-group">
                            <textarea name="description" class="summernote-simple" placeholder="Write something to describe about the prouct..."></textarea>
                            @error('description') <small class="text-danger">{{ $message }}</small>  @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block col-4 mx-auto">Save</button>
                </div>
            </form>
        </div>
        </div>
    </section>
    <script src="{{ asset('admin/dist/assets/js/form-assets.js') }}"></script>
@endsection
