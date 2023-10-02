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
    <!-- End breadcrumb section -->
    <!-- Start checkout page area -->
    <div class="checkout__page--area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="main checkout__mian">

                        <div class="checkout__content--step section__contact--information">
                            <div class="checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                <h2 class="checkout__header--title h3">Contact information</h2>
                                <p class="layout__flex--item">
                                    Already have an account?
                                    <a class="layout__flex--item__link" href="login.html">Log in</a>
                                </p>
                            </div>
                            <form action="{{route('checkout.store')}}" method="post" id="checkout_form">
                                @csrf
                                <div class="customer__information">
                                @if (isset($user))
                                <input  type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="checkout__email--phone mb-12">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Name"
                                                type="text" name="name" value="{{ $user->name }}">
                                        </label>
                                    </div>
                                    <div class="checkout__email--phone mb-12">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Email"
                                                type="text" name="email" value="{{ $user->email }}">
                                        </label>
                                    </div>
                                @else
                                 <div class="checkout__email--phone mb-12">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Name"
                                                type="text" name="name" value="">
                                        </label>
                                    </div>
                                 <div class="checkout__email--phone mb-12">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Email"
                                                type="text" name="email" value="">
                                        </label>
                                    </div>
                                @endif
                                    <div class="checkout__email--phone mb-12">
                                        <label>
                                            <input class="checkout__input--field border-radius-5"
                                                placeholder="Mobile phone mumber" type="text" name="phone"
                                                value="">
                                        </label>
                                        
                                    </div>
                                
                                </div>
                                <input type="hidden" name="card_id" value={{$cart->id }}>
                                <input type="hidden" name="total_sum" value="{{ $totalSum }}">
                        </div>
                        <div class="checkout__content--step__footer d-flex align-items-center">

                            <a class="previous__link--content" href="{{ route('cart.index') }}">Return to cart</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <aside class="checkout__sidebar sidebar border-radius-10">
                        <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                        @include('includes.cart', [
                            'cart' => $cart,
                            'cartItems' => $cartItems,
                        ])
                        
                        <div class="checkout__total">
                            <table class="checkout__total--table">
                                <tbody class="checkout__total--body">
                                    <tr class="checkout__total--items">
                                        <td class="checkout__total--title text-left">Subtotal </td>
                                        <td class="checkout__total--amount text-right">{{ $totalSum }}</td>
                                    </tr>
                                    <tr class="checkout__total--items">
                                    </tr>
                                </tbody>
                                <tfoot class="checkout__total--footer">
                                    <tr class="checkout__total--footer__items">
                                        <td class="checkout__total--footer__title checkout__total--footer__list text-left">
                                            Total </td>
                                        <td
                                            class="checkout__total--footer__amount checkout__total--footer__list text-right">
                                            {{ $totalSum }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <button class="checkout__now--btn primary__btn" form="checkout_form" type="submit">Checkout Now</button>
                    </aside>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End checkout page area -->
@endsection
