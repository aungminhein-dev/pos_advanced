@extends('admin.layout.app')
@section('title', 'Product List')
@section('myCss')
    <style>
        .square {
            display: inline-block;
            width: 25px;
            height: 25px;
            border-radius: 3px;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Product List</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Product</a></div>
                <div class="breadcrumb-item">List </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if (session('created'))
                        <x-alert type="success" message="{{ session('created') }} "></x-alert>
                    @endif
                    @if (session('updated'))
                        <x-alert type="primary" message=" {{ session('updated') }}"></x-alert>
                    @endif
                    @if (session('deleted'))
                        <x-alert type="danger" message=" {{ session('deleted') }}"></x-alert>
                    @endif
                    @livewire('admin.p-table')
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
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <form action="{{ route('product.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id"  id="product_id">
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const deleteButtons = document.querySelectorAll('.delete-product');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click',function(e) {
                document.getElementById('product_id').value = btn.getAttribute('data-product-id');
            })
        });
    </script>
@endsection
{{-- @section('myScript')
    <script>
        $(document).ready(function() {
            $('.delete-product').on('click', function() {
                // Get the product_id from the data attribute
                var productId = $(this).data('product-id');
                // Set the product_id value in the modal input
                $('#product_id').val(productId);
                console.log(productId);
            });
        });
    </script>
@endsection --}}
