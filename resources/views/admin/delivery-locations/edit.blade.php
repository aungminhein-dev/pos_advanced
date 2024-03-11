@extends('admin.layout.app')
@section('title', 'Edit Delivery Location')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('delivery-location.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Delivery Location</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Delivery Location</a></div>
                <div class="breadcrumb-item">Edit </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="card shadow p-3 col-lg-8  d-flex justify-center">
                        <form action="{{ route('delivery-location.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $location->id }}">
                            <div class="form-group mt-2">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $location->name }}" name="name" class="form-control" id="">
                            </div>
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select name="status" id="" class="form-control">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="0" {{ $location->status === 1 ? '' : 'selected'}}>Unavailable</option>
                                            <option value="1"  {{ $location->status === 1 ? 'selected' : ''}}>Available</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select name="gateFeeStatus" id="" class="form-control">
                                            <option value="" selected disabled>Select Gate Fee Status</option>
                                            <option value="1"  {{ $location->gate_fee_status === 1 ? 'selected' : ''}}>Have to pay</option>
                                            <option value="0"  {{ $location->gate_fee_status === 1 ? '' : 'selected'}}>Don't have to pay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Price <span class="text-danger">*</span></label>
                                <input type="number" value="{{ $location->price }}" name="price" class="form-control" id="">
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Gate Fee</label>
                                <input type="number" {{ $location->gate_fee }} name="gateFee" class="form-control" id="">
                            </div>

                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>

                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
        </div>
    </section>

@endsection
