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
            <h1>Events</h1>
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
            @if ($events->count() != 0)
                <div class="row">
                    @foreach ($events as $event)
                        <div class=" col-12 col-lg-6">
                            <div class="card  position-relative"
                                style="background: url({{ asset($event->image->image_path) }}) no-repeat; background-position:center; background-size:cover; height:200px;">
                                <div class="banner_info w-100 h-100 rounded" style="backdrop-filter: blur(5px)">
                                    <div class="over-lay ">
                                        @if ($event->discounts->isNotEmpty())
                                            <h6>Save up to {{ $event->discounts->first()->percentage }} %</h6>
                                        @endif
                                        <h4 class="text-white">{{ $event->name }}</h4>
                                        <a href="#">Shop over ({{ $event->products->count() }} Items) </a>
                                        @php
                                            $start = date_create($event->start_date);
                                            $end = date_create($event->end_date);
                                            $now = now();
                                            $differenceInDays = date_diff($end, $now);
                                        @endphp

                                        {{-- @if ($differenceInDays > 0)
                                            <p class="text-white mt-2">
                                                from {{ $event->start_date }} to {{ $event->end_date }}
                                                ({{ $differenceInDays }} days left)
                                            </p>
                                        @else
                                            <p class="text-white mt-2">
                                                from {{ $event->start_date }} to {{ $event->end_date }}
                                                <span class="text-danger">Ended</span>
                                            </p>
                                        @endif --}}
                                        <div class="action">
                                            <a href="" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('event.add-items', $event->slug) }}"
                                                class="btn btn-primary">Add Discount Items</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

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
        </div>
    </section>
@endsection
