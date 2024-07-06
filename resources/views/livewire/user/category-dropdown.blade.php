<li class="position-static"><a href="#">Our Categories <i class="fi-rs-angle-down"></i></a>
    <ul class="mega-menu overflow-scroll" style="max-height : 500px">
        @foreach ($categories as $category)
            <li class="sub-mega-menu sub-mega-menu-width-22 mb-4">
                <a class="menu-title" href="#">{{ $category->name }}</a>
                <ul>
                    @foreach ($category->subCategories as $subCategory)
                        <li><a href="product-details.html">{{ $subCategory->name }}</a></li>
                    @endforeach
                </ul>
            </li>
        @endforeach

        <li class="sub-mega-menu sub-mega-menu-width-34">
            <div class="menu-banner-wrap">
                <a href="product-details.html"><img src="{{ asset('user/assets/imgs/banner/menu-banner.jpg') }}"
                        alt="Surfside Media"></a>
                <div class="menu-banner-content">
                    <h4>Hot deals</h4>
                    <h3>Don't miss<br> Trending</h3>
                    <div class="menu-banner-price">
                        <span class="new-price text-success">Save to 50%</span>
                    </div>
                    <div class="menu-banner-btn">
                        <a href="product-details.html">Shop now</a>
                    </div>
                </div>
                <div class="menu-banner-discount">
                    <h3>
                        <span>35%</span>
                        off
                    </h3>
                </div>
            </div>
        </li>
    </ul>
</li>
