<section class="product-tabs section-padding position-relative wow fadeIn animated">
    <div class="bg-square"></div>
    <div class="container">
        <div class="tab-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $allProducts ? 'active' : '' }}" id="nav-tab-one" data-bs-toggle="tab"
                        data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                        aria-selected="true">Featured</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $popularItems ? 'active' : '' }}" id="nav-tab-two" data-bs-toggle="tab"
                        data-bs-target="#tab-two" wire:click="popularItem" type="button" role="tab"
                        aria-controls="tab-two" aria-selected="false">Popular</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $discountItems ? 'active' : '' }}" id="nav-tab-three"
                        data-bs-toggle="tab" data-bs-target="#tab-three" wire:click="discountItem" type="button"
                        role="tab" aria-controls="tab-three" aria-selected="false">
                        Discounted Items
                    </button>
                </li>
            </ul>
            <a href="{{ route('shop') }}" class="view-more d-none d-md-flex">View More<i
                    class="fi-rs-angle-double-small-right"></i></a>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content wow fadeIn animated" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('user.product.details', $product->slug) }}">
                                            @php
                                                $productImages = [];
                                                foreach ($product->images as $image) {
                                                    $productImages[] = $image->image_path;
                                                }
                                            @endphp

                                            @if (count($productImages) > 0)
                                                @if (count($productImages) != 1)
                                                    <img class="default-img" src="{{ asset($productImages[0]) }}"
                                                        alt="">
                                                    <img class="hover-img" src="{{ asset($productImages[1]) }}"
                                                        alt="">
                                                @else
                                                    <img class="default-img" src="{{ asset($productImages[0]) }}"
                                                        alt="">
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                            href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                class="fi-rs-shuffle"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->arrival_status == 'New')
                                            <span class="new">{{ $product->arrival_status }}</span>
                                        @else
                                            - {{ $product->discount->percentage }} %
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop.html">{{ $product->category->name }} /
                                            {{ $product->subCategory->name }}</a>
                                    </div>
                                    <h2><a
                                            href="{{ route('user.product.details', $product->slug) }}">{{ $product->name }}</a>
                                    </h2>
                                    @if ($product->rating)
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>{{ $product->rating }}%</span>
                                            </span>
                                        </div>
                                    @endif
                                    @if ($product->discount)
                                        <div class="product-price">
                                            <span>{{ discounted_price($product->price, $product->discount->percentage) }}
                                                Kyats</span>
                                            <span class="old-price">{{ $product->price }} Kyats</span>
                                        </div>
                                    @else
                                        <span class="old-price">{{ $product->price }} Kyats</span>
                                    @endif
                                    <div class="product-action-1 show">
                                        <a wire:click.prevent="addToCart({{ $product->id }})" aria-label="Add To Cart"
                                            class="action-btn hover-up"><i wire:target="addToCart({{ $product->id }})"
                                                wire:loading.remove class="fi-rs-shopping-bag-add"></i><img
                                                wire:target="addToCart({{ $product->id }})" wire:loading.block
                                                src="{{ asset('user/assets/imgs/spin.png') }}" class="spin"
                                                height="40px" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!--End product-grid-4-->
            </div>

            <!--En tab three (New added)-->
        </div>
        <!--End tab-content-->
    </div>
</section>
