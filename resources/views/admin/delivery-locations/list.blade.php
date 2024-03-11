@extends('admin.layout.app')
@section('title', 'Delivery Location List')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Delivery Location List</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Delivery Location</a></div>
                <div class="breadcrumb-item">List </div>
            </div>
        </div>
        <div class="section-body">
            <div class="col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Locations ({{ count($locations) }})</h4>
                        <div class="card-header-action">
                            <a href="{{ route('delivery-location.addPage') }}" class="btn btn-primary"> + Add</a>
                        </div>
                    </div>
                    @if (count($locations) != 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                @if (session('createSuccessMessage'))
                                    <x-alert type="success" message="{{ session('createSuccessMessage') }} "></x-alert>
                                @endif
                                @if (session('updateSuccessMessage'))
                                    <x-alert type="primary" message=" {{ session('updateSuccessMessage') }}"></x-alert>
                                @endif
                                @if (session('deleteSuccessMessage'))
                                    <x-alert type="danger" message=" {{ session('deleteSuccessMessage') }}"></x-alert>
                                @endif

                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Gate Fee</th>
                                            <th>Gate Fee Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($locations as $location)
                                            <tr>
                                                <td>
                                                    {{ $location->name }}
                                                </td>
                                                <td>
                                                    {{ $location->price }} Kyats

                                                </td>
                                                @if ($location->status === 1)
                                                    <td><span class="badge badge-success">Available</span> </td>
                                                @else
                                                    <td><span class="badge badge-danger">Unavailable</span> </td>
                                                @endif

                                                <td>
                                                    {{ $location->gate_fee }}
                                                </td>

                                                @if ($location->gate_fee_status === 1)

                                                    <td><span class="badge badge-success">Yes</span> </td>
                                                @else
                                                    <td><span class="badge badge-danger">No</span> </td>
                                                @endif

                                                <td>
                                                    <a href="{{ route('delivery-location.edit',$location->id) }}"
                                                        class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                        title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <a class="btn btn-danger btn-action delete-category" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        data-category-id=""><i
                                                            class="fas fa-trash"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                                <a href="{{ route('category.addPage') }}" class="btn btn-primary mt-4">Create new One</a>
                                <a href="#" class="mt-4 bb">Need Help?</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirming deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete? The products related to this category is going to disappeared!</p>
                </div>
                <form action="{{ route('category.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('myScript')
    <script>
        $(document).ready(function() {
            $('.delete-category').on('click', function() {
                // Get the category_id from the data attribute
                var categoryId = $(this).data('category-id');
                // Set the category_id value in the modal input
                $('#category_id').val(categoryId);
            });
        });
    </script>
@endsection
