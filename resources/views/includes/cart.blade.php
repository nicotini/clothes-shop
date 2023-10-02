 @if ($cart)
     <div class="cart__table checkout__product--table">
         <table class="cart__table--inner">
             <tbody class="cart__table--body">
                 @foreach ($cartItems as $cartItem)
                     <tr class="cart__table--body__items">
                         <td class="cart__table--body__list">
                             <div class="product__image two  d-flex align-items-center">
                                 <div class="product__thumbnail border-radius-5">
                                     <a class="display-block" href=""><img class="display-block border-radius-5"
                                             src="assets/img/product/small-product/product1.webp"
                                             alt="cart-product"></a>
                                     <span class="product__thumbnail--quantity">{{ $cartItem->quantity }}</span>
                                 </div>
                                 <div class="product__description">
                                     <h4 class="product__description--name"><a
                                             href="product-details.html">{{ $cartItem->product->name }}</a></h4>
                                     @php
                                         $attributes = json_decode($cartItem->attributes, true);
                                     @endphp
                                     @if ($attributes)
                                         @foreach ($cartItem->product->productAttributes->unique('attribute_id') as $attr)
                                             @foreach ($attributes as $attribute => $attributeValue)
                                                 @if ($attr->attribute_id == $attribute)
                                                     <span
                                                         class="product__description--variant">{{ $attr->attribute->name }}:
                                                         @foreach ($attr->attribute->attributeValues as $value)
                                                             @if ($value->id == $attributeValue)
                                                                 {{ $value->name }}
                                                             @endif
                                                         @endforeach
                                                     </span>
                                                 @endif
                                             @endforeach 
                                         @endforeach
                                     @endif
                                 </div>
                             </div>
                         </td>
                         <td class="cart__table--body__list">
                             <span class="cart__price">{{ $cartItem->product->price }}</span>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 @endif
