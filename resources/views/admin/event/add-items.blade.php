@extends('admin.layout.app')
@section('title', 'Events')
@section('content')
    <style>
        .banner_info {
            position: absolute;
            right: 0;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            padding: 15px;
        }
    </style>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="#" onclick="history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{ $event->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Events</a></div>
                <div class="breadcrumb-item">List</div>
            </div>
        </div>
        <div class="section-body">
            @if (session('createSuccessMessage'))
                <x-alert type="success" message="{{ session('createSuccessMessage') }} "></x-alert>
            @endif
            @if (session('updateSuccessMessage'))
                <x-alert type="primary" message=" {{ session('updateSuccessMessage') }}"></x-alert>
            @endif
            @if (session('deleteSuccessMessage'))
                <x-alert type="primary" message=" {{ session('deleteSuccessMessage') }}"></x-alert>
            @endif
            @if ($event_products->count() != 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header col-12">
                                <h4 class="col-4">Items in {{ $event->name }} Event</h4>

                                <div class=" col-3">
                                    <select class=" selectric" onchange="addSubCategory(event)">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-3">
                                    <select class=" selectric" id="subCategories">
                                        <option selected disabled>Select Sub Category</option>

                                    </select>
                                </div>

                                <div class="card-header-form col">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Product</th>
                                            <th></th>
                                            <th>Current Price</th>
                                            <th>Discount Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($event_products as $product)
                                            <tr>
                                                <td class="ps-2 text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" value="{{ $product->id }}"
                                                            data-checkboxes="mygroup" class="custom-control-input"
                                                            id="checkbox-{{ $product->id }}">
                                                        <label for="checkbox-{{ $product->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td><a
                                                        href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                                </td>
                                                <td>
                                                    @foreach ($product->images as $image)
                                                        <img alt="image" src="{{ asset($image->image_path) }}"
                                                            class="rounded-circle" width="35" data-toggle="tooltip"
                                                            title="Wildan Ahdian">
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($product->discount)
                                                        <del class="text-danger">{{ $product->price }}</del>
                                                        <span
                                                            class="text-success">{{ $product->price - $product->price * ($product->discount->percentage / 100) }}
                                                            Kyats</span>
                                                    @else
                                                        {{ $product->price }} Kyats
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->discount)
                                                        <div class="badge badge-success">Discounted</div>
                                                    @else
                                                        <div class="badge badge-warning">Not Discounted</div>
                                                    @endif
                                                </td>
                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-toggle="modal" data-target="#exampleModal" id="add-btn"
                            class="btn btn-primary ">Add To {{ $event->name }}
                            Event</button>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 col-sm-12 not-found">
                        <div class="empty-state" data-height="400">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>We couldn't find any data</h2>
                            <p class="lead">
                                Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                            </p>
                            <a href="{{ route('event.addPage') }}" class="btn btn-primary mt-4">Create new One</a>
                            <a href="#" class="mt-4 bb">Need Help?</a>
                        </div>
                    </div>
                </div>
            @endif

            @if ($filteredProducts->count() != 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header col-12">
                                <h4 class="col-4">Add Items To {{ $event->name }} Event</h4>

                                <div class=" col-3">
                                    <select class=" selectric" onchange="addSubCategory(event)">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-3">
                                    <select class=" selectric" id="subCategories">
                                        <option selected disabled>Select Sub Category</option>

                                    </select>
                                </div>

                                <div class="card-header-form col">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Product</th>
                                            <th></th>
                                            <th>Current Price</th>
                                            <th>Discount Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($filteredProducts as $product)
                                            <tr>
                                                <td class="ps-2 text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" value="{{ $product->id }}"
                                                            data-checkboxes="mygroup" class="custom-control-input"
                                                            id="checkbox-{{ $product->id }}">
                                                        <label for="checkbox-{{ $product->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td><a
                                                        href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                                </td>
                                                <td>
                                                    @foreach ($product->images as $image)
                                                        <img alt="image" src="{{ asset($image->image_path) }}"
                                                            class="rounded-circle" width="35" data-toggle="tooltip"
                                                            title="Wildan Ahdian">
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($product->discount)
                                                        <del class="text-danger">{{ $product->price }}</del>
                                                        <span
                                                            class="text-success">{{ $product->price - $product->price * ($product->discount->percentage / 100) }}
                                                            Kyats</span>
                                                    @else
                                                        {{ $product->price }} Kyats
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->discount)
                                                        <div class="badge badge-success">Discounted</div>
                                                    @else
                                                        <div class="badge badge-warning">Not Discounted</div>
                                                    @endif
                                                </td>
                                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-toggle="modal" data-target="#exampleModal" id="add-btn"
                            class="btn btn-primary ">Add To {{ $event->name }}
                            Event</button>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 col-sm-12 not-found">
                        <div class="empty-state" data-height="400">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>No Products Left to make discount</h2>
                            <p class="lead">
                                Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                            </p>
                            <a href="{{ route('event.addPage') }}" class="btn btn-primary mt-4">Create new One</a>
                            <a href="#" class="mt-4 bb">Need Help?</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to add this items to {{ $event->name }} Event Promotions ?</p>
                </div>
                <form action="{{ route('disount.bulkAdd') }}" method="post" id="discountForm">
                    @csrf
                    <input type="hidden" name="start_date" value="{{ $event->start_date }}">
                    <input type="hidden" name="end_date" value="{{ $event->end_date }}">
                    <input type="hidden" name="event" value="{{ $event->id }}">
                    <input type="number" class="form-control" name="percentage"
                        placeholder="Enter a percentage to discount.">
                    <input type="hidden" name="checkboxIds" id="checkboxIds">
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const addSubCategory = (event) => {
            const subCategories = document.getElementById('subCategories');

            // Clear existing options before making the AJAX request
            subCategories.innerHTML = '<option disabled selected>Select sub-category</option>';

            $.ajax({
                url: '/admin/sub-categories/list',
                method: 'get',
                data: {
                    categoryId: event.target.value
                },
                success: function(responses) {
                    // Check if responses is empty
                    if (responses.length === 0) {
                        // Clear the select box if there is no data
                        subCategories.innerHTML = '<option disabled selected>Select sub-category</option>';
                    } else {
                        // Populate the select box if there is data
                        responses.forEach(subCategory => {
                            subCategories.insertAdjacentHTML('beforeend', `
                        <option value="${subCategory.id}">${subCategory.name}</option>
                    `);
                        });
                    }
                }
            });
        };
        const submitForm = () => {
            $("#checkboxIds").val(Id);

            // Submit the form
            $("#discountForm").submit();
        }
    </script>
@endsection
@section('myScript')
    <script>
        const addButton = $('#add-btn');
        addButton.hide();
        let Id = [];

        $("[data-checkboxes]").each(function() {
            var me = $(this),
                group = me.data('checkboxes'),
                role = me.data('checkbox-role');

            me.change(function() {
                var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
                    checked = $('[data-checkboxes="' + group +
                        '"]:not([data-checkbox-role="dad"]):checked'),
                    dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                    total = all.length,
                    checked_length = checked.length;

                if (role == 'dad' && me.is(':checked')) {
                    // If "dad" checkbox is checked, get all checkbox IDs
                    Id = all.map(function() {
                        return $(this).val();
                    }).get();
                } else {
                    if (me.is(':checked')) {
                        Id.push(me.val());
                    } else {
                        // Remove the unchecked checkbox value from the array
                        Id = Id.filter(item => item !== me.val());
                    }
                }

                if (Id.length > 0 || dad.prop('checked')) {
                    addButton.show();
                } else {
                    addButton.hide();
                }

                if (role == 'dad') {
                    all.prop('checked', me.is(':checked'));
                } else {
                    dad.prop('checked', checked_length >= total);
                }
            });
        });
    </script>
@endsection
