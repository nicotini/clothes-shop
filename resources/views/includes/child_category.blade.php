<li class="widget__form--check__list child-cat">
    <label class="widget__form--check__label" for="{{ $child_category->id }}">{{ $child_category->name }}</label>
    <input class="widget__form--check__input" id="{{ $child_category->id }}" type="checkbox" name="filterCat[]"
        value="{{ $child_category->id }}">
    <span class="widget__form--checkmark"></span>
</li>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('includes.child_category', ['child_category' => $childCategory])
    @endforeach
@endif
