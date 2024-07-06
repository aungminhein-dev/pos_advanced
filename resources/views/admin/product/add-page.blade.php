@extends('admin.layout.app')
@section('title', 'Add Product')
@section('myCss')
    <link rel="stylesheet"
        href="{{ asset('admin/dist/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">

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
            <div class="section-header-back">
                <a href="#" onclick="history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Add New Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Product</a></div>
                <div class="breadcrumb-item">Add</div>
            </div>
        </div>

        <div class="section-body">
            <form action="{{ route('product.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="previews-container"></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter produt name"
                                class="form-control @error('name')  'is-invalid'  @enderror">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Brand <span class="text-danger">*</span></label>
                            <select class="form-control selectric" name="brand">
                                <option disabled selected>Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Available Quantity <span class="text-danger">*</span></label>
                            <input type="number" value="{{ old('quantity') }}" name="quantity" min="1"
                                placeholder="Enter quantity" id=""
                                class="form-control @error('quantity') 'is-invalid'  @enderror">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Price <span class="text-danger">*</span></label>
                            <input type="number" min="0" value="{{ old('price') }}" name="price"
                                placeholder="Enter price" class="form-control @error('price') 'is-invalid'  @enderror">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Purchasing Price <span class="text-danger">*</span></label>
                            <input type="number" min="0" value="{{ old('purchasingPrice') }}"
                                name="purchasingPrice" placeholder="Enter price"
                                class="form-control @error('purchasingPrice') 'is-invalid'  @enderror">
                            @error('purchasingPrice')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Selling Price <span class="text-danger">*</span></label>
                            <input type="number" min="0" value="{{ old('sellingPrice') }}" name="sellingPrice"
                                placeholder="Enter price"
                                class="form-control @error('sellingPrice') 'is-invalid'  @enderror">
                            @error('sellingPrice')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-lg-6">
                        <label for="">Category</label>
                        <select class="form-control selectric" onchange="addSubCategory(event)" name="subCategories">
                            <option disabled selected>Select sub-category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subCategories')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Sub-Category <span class="text-danger">*</span></label>
                            <select class="form-control selectric" id="subCategories" name="subCategories">
                                <option disabled selected>Select sub-category</option>
                            </select>
                            @error('subCategories')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Color Input <span class="text-muted">(optional)</span></label>
                            <div class="row gutters-xs" id="colorContainer">
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value=" #007bff"
                                            class="colorinput-input" />
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#6c757d"
                                            class="colorinput-input" />
                                        <span class="colorinput-color bg-secondary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#dc3545"
                                            class="colorinput-input" />
                                        <span class="colorinput-color bg-danger"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#ffc107"
                                            class="colorinput-input" />
                                        <span class="colorinput-color bg-warning"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#17a2b8"
                                            class="colorinput-input" />
                                        <span class="colorinput-color bg-info"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="colours[]" type="checkbox" value="#28a745"
                                            class="colorinput-input" />
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
                            <label class="form-label">Choose Sizes <span class="text-muted">(optional)</span></label>
                            <div class="selectgroup selectgroup-pills" id="selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="S"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">S</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="L"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">L</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="M"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">Medium</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="XL"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">XL</span>
                                </label>

                                <label class="selectgroup-item">
                                    <input type="checkbox" onchange="checkAllSelected()" name="sizes[]" value="XXL"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">XXL</span>
                                </label>

                                <label class="selectgroup-item" id="all-selected">
                                    <input type="checkbox" onchange="selectAll(event)"s class="selectgroup-input">
                                    <span class="selectgroup-button">All</span>
                                </label>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 img-input">
                        <input type="file" name="images[]" id="file-input" multiple
                            onchange="productImagePreview(event)" />
                        <label for="file-input">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            &nbsp; Choose Files To Upload
                        </label>
                        @error('images')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <div class="selectgroup selectgroup-pills tagsContainer" id="selectgroup-pills">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label>Add Tags <span class="text-muted">(optional)</span></label>
                        <div class="form-group d-flex">
                            <input id="tag-input" type="text" style="border-radius: 5px 0px 0px 5px"
                                class="form-control" />
                            <button class="btn btn-success btn-sm" style="border-radius: 0px 5px 5px 0px"
                                onclick="addTags()" type="button">Add
                                Tag</button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>Discount By %<span class="text-muted">(optional)</span></label>
                            <input type="number" value="{{ old('discount') }}" oninput="toggleCalendar()"
                                name="discount" placeholder="Enter percentage for discount" class="form-control">
                        </div>
                    </div>
                    <div id="calendar" class="d-none row">
                        <div class="col-12 col-lg-6 ">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="startDate">
                            </div>


                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="endDate">
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mt-2">
                        <div class="form-group">
                            <textarea name="description" class="summernote-simple" placeholder="Write something to describe about the prouct...">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        </div>
    </section>
    <script src="{{ asset('admin/dist/assets/js/form-assets.js') }}"></script>
@endsection
