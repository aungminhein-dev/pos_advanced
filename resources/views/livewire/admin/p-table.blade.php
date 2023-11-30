<div class="card">
    <div class="card-header">
        <h4>Products</h4>
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
        @if ($products->count() != 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>

                        <th>Product Name</th>
                        <th>Images</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>

                            <td>{{ $product->name }}</td>
                            <td>
                                @foreach ($product->images as $image)
                                    <img alt="image" src="{{ asset($image->image_path) }}" class="rounded-circle"
                                        width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                @endforeach
                            </td>
                            <td>
                                <span class="badge badge-warning">{{ $product->quantity }}</span>
                            </td>
                            <td>
                                @if ($product->discount)
                                <del class="text-danger">{{ $product->price }}</del>
                                <span class="text-success">{{ $product->price - $product->price * ($product->discount->percentage / 100) }}
                                    Kyats</span>
                            @else
                                {{ $product->price }} Kyats
                            @endif
                            </td>
                            <td><a href="{{ route('product.detail', $product->slug) }}"
                                    class="btn btn-primary">Detail</a>
                                <a href="{{ route('product.edit', $product->slug) }}" class="btn btn-warning">Edit</a>
                                <a class="btn btn-danger btn-action delete-product" data-toggle="modal"
                                    data-target="#exampleModal" data-product-id="{{ $product->id }}"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
            <div class="text-end p-1">
                {{ $products->links() }}
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
