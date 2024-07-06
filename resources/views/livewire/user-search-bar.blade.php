<div class="search-style-1">
    <form class="search-bar d-flex position-relative" role="search" method="get">
        <input class="form-control me-2 my-input" wire:model.live.debounce.300ms="searchKey" name="searchKey"
            type="search" placeholder="Search" aria-label="Search">
       <div class="col-md-12 position-absolute mt-4">
            <div class="list-group mt-3 me-4">
                @if (strlen($searchKey) > 1)
                    @if ($products->count() != 0)
                        @foreach ($products as $product)
                            <a href="{{ route('user.product.details', $product->slug) }}" style="z-index:9999"
                                class="list-item list-group-item-action border-1 p-2 shadow bg-white text-muted d-inline-flex">
                                <img class="me-2 rounded d-inline " width="30" src="{{ asset($product->anImage($product->id)) }}" alt="product">
                                <span class="">{{$product->name}}</span></a>
                        @endforeach
                    @else
                    <span href="" class="list-item list-group-item-action border-1 p-2 rounded bg-white text-muted">No Results</span>
                    @endif
                @endif
            </div>
        </div>
    </form>
</div>
