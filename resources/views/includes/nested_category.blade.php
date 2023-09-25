<div class="swiper-slide">
    <div class="shop__collection--card text-center">
        <a class="shop__collection--link" href="shop.html">
            <img class="shop__collection--img" src="assets/img/collection/collection7.webp" alt="icon-img">
            <h3 class="shop__collection--title mb-0">{{ $childCategory->name }}</h3>
        </a>
    </div>
</div>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('includes.nested_category', ['child_category' => $childCategory])
    @endforeach
@endif
