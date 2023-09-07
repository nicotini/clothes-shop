<div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
    <div class="shop__sidebar--widget widget__area d-none d-lg-block">
        <form action="{{ route('shop.filter')}}" method="post" id="filter_form" enctype="multipart/form-data">
        @csrf
            <div class="single__widget widget__bg">
                <h2 class="widget__title h3">Choose Category</h2>
                <ul class="widget__form--check">
                    @foreach ($categories as $category)
                        <li class="widget__form--check__list">
                            <label class="widget__form--check__label" for="{{ $category->id }}">{{ $category->name }}</label>
                            <input class="widget__form--check__input" id="{{ $category->id }}" type="checkbox" name="filterCat[]" value="{{ $category->id }}">
                            <span class="widget__form--checkmark"></span>
                        </li>
                        <ul>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('includes.child_category', ['child_category' => $childCategory])
                            @endforeach
                        </ul>
                    @endforeach
                </ul>
            </div>
            <div class="single__widget price__filter widget__bg">
                <h2 class="widget__title h3">Filter By Price</h2>
                <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-GTE2">From</label>
                        <div class="price__filter--input border-radius-5 d-flex align-items-center">
                            <span class="price__filter--currency">$</span>
                            <input class="price__filter--input__field border-0" name="filterPriceMin"
                                id="Filter-Price-GTE2" type="number" value="{{ $min }}"
                                min="0" max="{{ $max }}">
                        </div>
                    </div>
                    <div class="price__divider">
                        <span>-</span>
                    </div>
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-LTE2">To</label>
                        <div class="price__filter--input border-radius-5 d-flex align-items-center">
                            <span class="price__filter--currency">$</span>
                            <input class="price__filter--input__field border-0" name="filterPriceMax"
                                id="Filter-Price-LTE2" type="number" min="0"
                                value="{{ $max }}" max="{{ $max }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="single__widget widget__bg">
                @foreach ($attributes as $attribute)
                    <h2 class="widget__title h3">{{ $attribute->name }}</h2>
                    <ul class="widget__form--check">
                        @foreach ($attribute->attributeValues as $value)
                            <li class="widget__form--check__list">
                                <label class="widget__form--check__label" for="{{ $value->id }}">{{ $value->name }}</label>
                                <input class="widget__form--check__input" id="{{ $value->id }}" name="filterAttr[{{ $attribute->id }}][]" value="{{ $value->id }}" type="checkbox">
                                <span class="widget__form--checkmark"></span>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
            <button class="primary__btn price__filter--btn" form="filter_form" type="submit">Filter</button>
        </form>
    </div>
</div>
