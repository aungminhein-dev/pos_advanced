<div class="card">
    <div class="card-header">
        <h4>Orders</h4>
        <div class="card-header-form">
            <form>
                <div class="input-group">
                    <input type="text" wire:model.live.debounce.500="key" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        @if ($orders->count() != 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>

                        <th></th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>

                            <td><img width="20" alt="image" src="{{ asset('admin/dist/assets/img/avatar/avatar-1.png ') }}"
                                class="rounded-circle
                                mr-1">{{ $order->user->name }}</td>
                            <td>{{ $order->total }}</td>

                            <td>
                                <livewire:admin.order-badge status="{{ $order->status }}"/>
                            </td>
                            <td>
                                {{ $order->phone }}
                            </td>
                            @if ($order->status == 0)
                            <td>
                                <a href="#" class="btn btn-success"><i class="fa-solid fa-circle-check"></i></a>
                                <a href="#" class="btn btn-danger"><i class="fa-solid fa-circle-xmark"></i></a>
                                {{-- <a class="btn btn-danger btn-action delete-product" data-toggle="modal"
                                    data-target="#exampleModal" data-product-id="{{ $product->id }}"><i
                                        class="fas fa-trash"></i></a> --}}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </table>

            </div>
            <div class="text-end p-1">
                {{ $orders->links() }}
            </div>
        @else
            <div class="col-12  col-sm-12">
                <div class="empty-state" data-height="400">
                    <div class="empty-state-icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <h2>We couldn't find any data</h2>
                    <p class="lead">
                        Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                    </p>
                    <a href="{{ route('product.addPage') }}" class="btn btn-primary mt-4">Create new One</a>
                    <a href="#" class="mt-4 bb">Need Help?</a>
                </div>
            </div>
        @endif

    </div>
</div>
