@extends('admin.layout.app')
@section('title', 'Category List')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Category List</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Category</a></div>
                <div class="breadcrumb-item">List </div>
            </div>
        </div>
        <div class="section-body">
            <div class="col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Activities ({{ count($activityLogs) }})</h4>
                        <div class="card-header-action">
                            <a href="{{ route('category.addPage') }}" class="btn btn-primary"> + Add</a>
                        </div>
                    </div>
                    @if (count($activityLogs) != 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activityLogs as $log)
                                            <tr>
                                                <td>{{ $log->id }}</td>
                                                <td>
                                                    <span class=" text-muted">{{ $log->title }}</span>
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
@endsection
