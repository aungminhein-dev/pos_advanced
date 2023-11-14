<div class="search-element" wire:click="key">
    {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
        class="fas fa-search"></i></a></li> --}}
    <input wire:model.live.debounce.300="key" class="form-control" id="search-input" type="search" placeholder="Search"
        aria-label="Search" data-width="250">
    <button class="btn" style="height:45px; background:rgb(12, 9, 182);" type="submit"><i
            class="fas fa-search"></i></button>
    <div class="search-backdrop"></div>
    <div class="search-result p-2">
        @if (strlen($key) == 0)
            Enter you keywords
        @endif
        @if (strlen($key) > 2)
            @if (count($categories) !== 0 || count($users) !== 0)
                <div class="search-header">
                    Results :
                </div>
            @else
                <div class="search-header">Oops! No results found!</div>
            @endif
        @endif
        @if (count($categories) != 0)
            <div class="search-header">
                #Categories
            </div>
            @foreach ($categories as $category)
                <div class="search-item">
                    <a href="{{ route('category.detail', $category->slug) }}">
                        <img class="mr-3 rounded" width="30" src="{{ asset($category->image) }}" alt="product">
                        {{ $category->name }} (<span class="text-success">{{ $category->sub_categories_count }}</span>)
                    </a>
                </div>
            @endforeach
        @endif
        @if (count($users) != 0)
            <div class="search-header">
                #Users
            </div>
            @foreach ($users as $user)
                <div class="search-item">
                    <a href="#">
                        @if ($user->image)
                            <img class="mr-3 rounded" width="30" src="{{ asset($user->image) }}" alt="product">
                        @else
                            <img class="mr-3 rounded" width="30"
                                src="{{ asset('admin/dist/assets/img/avatar/avatar-1.png') }}" alt="">
                        @endif
                        {{ $user->name }}
                    </a>
                </div>
            @endforeach
        @endif
        @if (count($products) != 0)
            <div class="search-header">
                Products
            </div>
            @foreach ($products as $product)
                <div class="search-item">
                    @php
                        $firstImage = $product->images->first()->image_path;
                    @endphp
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <img class="mr-3 rounded" width="30" src="{{ asset($firstImage) }}" alt="product">
                        {{ $product->name }}
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>
