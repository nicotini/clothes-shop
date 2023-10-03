@extends('layouts.main')
@section('content')
    <!-- Start breadcrumb section -->
    <div class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout__page--area section--padding">
        <div class="container">
            <div class="row">
                <h2>Your order has been successfully placed!</h2>
                <p>Thank you for your purchase.</p>
            </div>
        </div>
    </div>
@endsection
