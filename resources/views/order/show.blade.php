@extends('layouts.main')
@section('content')
    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Order </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- my account section start -->
        <section class="my__account--section section--padding">
            <div class="container">

                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title mb-20">My Profile</h2>
                        <ul class="account__menu">
                            <li class="account__menu--list active"><a href="my-account.html">Dashboard</a></li>
                            <li class="account__menu--list"><a href="my-account-2.html">Addresses</a></li>
                            <li class="account__menu--list"><a href="wishlist.html">Wishlist</a></li>
                            <li class="account__menu--list"><a href="login.html">Log Out</a></li>
                        </ul>
                    </div>
                    <div class="account__wrapper">
                        <div class="account__content">
                            <h2 class="account__content--title h3 mb-20">Orders History</h2>
                            <div class="account__table--area">
                                @if ($orderProducts)
                                    <table class="account__table">
                                        <thead class="account__table--header">
                                            <tr class="account__table--header__child">
                                                <th class="account__table--header__child--items">product Id</th>
                                                <th class="account__table--header__child--items">Name</th>
                                                <th class="account__table--header__child--items">Quantity</th>
                                                <th class="account__table--header__child--items">attributes</th>

                                            </tr>
                                        </thead>
                                        <tbody class="account__table--body mobile__none">
                                            @foreach ($orderProducts as $product)
                                                <tr class="account__table--body__child">
                                                    <td class="account__table--body__child--items">
                                                        {{ $product->product->id }}</td>
                                                    <td class="account__table--body__child--items">
                                                        {{ $product->product->name }}</td>
                                                    <td class="account__table--body__child--items">{{ $product->quantity }}
                                                    </td>
                                                    <td class="account__table--body__child--items">
                                                        @if ($product->attributes)
                                                            @php
                                                                $attributes = json_decode($product->attributes, true);
                                                            @endphp
                                                            @if ($attributes)
                                                                @foreach ($product->product->productAttributes->unique('attribute_id') as $attr)
                                                                    @foreach ($attributes as $attribute => $attributeValue)
                                                                        @if ($attr->attribute_id == $attribute)
                                                                            {{ $attr->attribute->name }}:
                                                                            @foreach ($attr->attribute->attributeValues as $value)
                                                                                @if ($value->id == $attributeValue)
                                                                                    {{ $value->name }}<br>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tbody class="account__table--body mobile__block">
                                            <tr class="account__table--body__child">
                                                <td class="account__table--body__child--items">
                                                    <strong>Order</strong>
                                                    <span>#2014</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Date</strong>
                                                    <span>November 24, 2022</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Payment Status</strong>
                                                    <span>Paid</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Fulfillment Status</strong>
                                                    <span>Unfulfilled</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Total</strong>
                                                    <span>$40.00 USD</span>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- my account section end -->
    </main>
@endsection
