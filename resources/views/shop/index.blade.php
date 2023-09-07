 @extends('layouts.main')
 @section('content')
     <!-- Start breadcrumb section -->
     <div class="breadcrumb__section breadcrumb__bg">
         <div class="container">
             <div class="row row-cols-1">
                 <div class="col">
                     <div class="breadcrumb__content text-center">
                         <h1 class="breadcrumb__content--title">Product</h1>
                         <ul class="breadcrumb__content--menu d-flex justify-content-center">
                             <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                             <li class="breadcrumb__content--menu__items"><span>Product</span></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- End breadcrumb section -->

     <!-- Start collection section -->
     @include('includes.category')
     <!-- End collection section -->

     <!-- Start shop section -->
     <div class="shop__section section--padding pt-0">
         <div class="container">
             <div class="row">
                 @include('includes.sidebar', ['categories' => $categories, 'attributes' => $attributes])
                 <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                     <div class="shop__product--wrapper position__sticky">
                         <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                             <div class="product__view--mode d-flex align-items-center">
                                 <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
                                     <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512">
                                         <path fill="none" stroke="currentColor" stroke-linecap="round"
                                             stroke-linejoin="round" stroke-width="28"
                                             d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                                         <circle cx="336" cy="128" r="28" fill="none"
                                             stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="28" />
                                         <circle cx="176" cy="256" r="28" fill="none"
                                             stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="28" />
                                         <circle cx="336" cy="384" r="28" fill="none"
                                             stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="28" />
                                     </svg>
                                     <span class="widget__filter--btn__text">Filter</span>
                                 </button>
                                 <div class="product__view--mode__list product__short--by align-items-center d-flex ">
                                     <label class="product__view--label">Prev Page :</label>
                                     <div class="select shop__header--select">
                                         <select class="product__view--select">
                                             <option selected value="1">65</option>
                                             <option value="2">40</option>
                                             <option value="3">42</option>
                                             <option value="4">57 </option>
                                             <option value="5">60 </option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                     <label class="product__view--label">Sort By :</label>
                                     <div class="select shop__header--select">
                                         <select class="product__view--select">
                                             <option selected value="1">Sort by latest</option>
                                             <option value="2">Sort by popularity</option>
                                             <option value="3">Sort by newness</option>
                                             <option value="4">Sort by rating </option>
                                         </select>
                                     </div>

                                 </div>
                                 <div class="product__view--mode__list">
                                     <div
                                         class="product__tab--one product__grid--column__buttons d-flex justify-content-center">
                                         <button class="product__grid--column__buttons--icons active" aria-label="grid btn"
                                             data-toggle="tab" data-target="#product_grid">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                 viewBox="0 0 9 9">
                                                 <g transform="translate(-1360 -479)">
                                                     <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4"
                                                         height="4" transform="translate(1360 479)"
                                                         fill="currentColor" />
                                                     <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4"
                                                         height="4" transform="translate(1360 484)"
                                                         fill="currentColor" />
                                                     <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4"
                                                         height="4" transform="translate(1365 479)"
                                                         fill="currentColor" />
                                                     <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4"
                                                         height="4" transform="translate(1365 484)"
                                                         fill="currentColor" />
                                                 </g>
                                             </svg>
                                         </button>
                                         <button class="product__grid--column__buttons--icons" aria-label="list btn"
                                             data-toggle="tab" data-target="#product_list">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                 viewBox="0 0 13 8">
                                                 <g id="Group_14700" data-name="Group 14700"
                                                     transform="translate(-1376 -478)">
                                                     <g transform="translate(12 -2)">
                                                         <g id="Group_1326" data-name="Group 1326">
                                                             <rect id="Rectangle_5729" data-name="Rectangle 5729"
                                                                 width="3" height="2"
                                                                 transform="translate(1364 483)" fill="currentColor" />
                                                             <rect id="Rectangle_5730" data-name="Rectangle 5730"
                                                                 width="9" height="2"
                                                                 transform="translate(1368 483)" fill="currentColor" />
                                                         </g>
                                                         <g id="Group_1328" data-name="Group 1328"
                                                             transform="translate(0 -3)">
                                                             <rect id="Rectangle_5729-2" data-name="Rectangle 5729"
                                                                 width="3" height="2"
                                                                 transform="translate(1364 483)" fill="currentColor" />
                                                             <rect id="Rectangle_5730-2" data-name="Rectangle 5730"
                                                                 width="9" height="2"
                                                                 transform="translate(1368 483)" fill="currentColor" />
                                                         </g>
                                                         <g id="Group_1327" data-name="Group 1327"
                                                             transform="translate(0 -1)">
                                                             <rect id="Rectangle_5731" data-name="Rectangle 5731"
                                                                 width="3" height="2"
                                                                 transform="translate(1364 487)" fill="currentColor" />
                                                             <rect id="Rectangle_5732" data-name="Rectangle 5732"
                                                                 width="9" height="2"
                                                                 transform="translate(1368 487)" fill="currentColor" />
                                                         </g>
                                                     </g>
                                                 </g>
                                             </svg>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                             <p class="product__showing--count">Showing 1–9 of 21 results</p>
                         </div>
                         <div class="tab_content">
                             <div id="product_grid" class="tab_pane active show">
                                 <div class="product__section--inner">
                                     <div class="row mb--n30">
                                         @foreach ($products as $product)
                                             <div class="col-lg-4 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                                 <article class="product__card">
                                                     <div class="product__card--thumbnail">
                                                         <a class="product__card--thumbnail__link display-block"
                                                             href="product-details.html">
                                                             <img class="product__card--thumbnail__img product__primary--img"
                                                                 src="assets/img/product/main-product/product1.webp"
                                                                 alt="product-img">
                                                             <img class="product__card--thumbnail__img product__secondary--img"
                                                                 src="assets/img/product/main-product/product2.webp"
                                                                 alt="product-img">
                                                         </a>
                                                         
                                                        
                                                         <div class="product__add--to__card">
                                                             <a class="product__card--btn" title="Add To Card"
                                                                 href="cart.html"> Add to Cart
                                                                 <svg width="17" height="15" viewBox="0 0 14 11"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                     <path
                                                                         d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                                                                         fill="currentColor" />
                                                                 </svg>
                                                             </a>
                                                         </div>
                                                     </div>
                                                     <div class="product__card--content text-center">
                                                         <ul>
                                                            <li> 
                                                            ( {{$product->category->name}}  )
                                                            </li>
                                                            <li>
                                                            @foreach ($product->attributes as $attribute)
                                                                {{$attribute->name }},
                                                                
                                                                @foreach ($attribute->attributeValues as $value)
                                                                @if ($value->id === $attribute->pivot->attribute_value_id)
                                                                    <p>Value: {{ $value->name }}</p>
                                                                @endif
                                                                    
                                                                @endforeach
                                                            @endforeach
                                                            </li>
                                                         </ul>
                                                         <h3 class="product__card--title">
                                                             <a href="{{$product->slug}}">
                                                             {{ $product->name}}
                                                             </a>
                                                         </h3>
                                                         <div class="product__card--price">
                                                             <span class="current__price">${{ $product->price}}</span>
                                                             
                                                         </div>
                                                     </div>
                                                 </article>
                                             </div>
                                         @endforeach

                                     </div>
                                 </div>
                             </div>
                            
                         <!--pagination --->
                          {{ $products->links('vendor.pagination.custom-pagination')}}
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- End shop section -->

     <!-- Start feature section -->
     @include('includes.feature')
     <!-- End feature section -->
 @endsection
