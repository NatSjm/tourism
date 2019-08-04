@extends('layout')

@section('content')

    <div class="cart-page_container cont">

        <div class="cart-page_breadcrumbs">
            @include('components.breadcrumbs.breadcrumbs')
        </div>

        <h2 class="cart-page_title headline-2">Корзина</h2>

        <section class="cart-page_main">
            @if (session()->has('cart'))
                <div class="full-cart">

                    <div class="full-cart_main">
                        <table class="cart-products table mod_border-grey">
                            <thead>
                            <tr class="cart-products_head mod_color-light-milk">
                                <td class="cart-products_name">Название</td>
                                <td class="cart-products_price">Цена</td>
                                <td class="cart-products_delete">Удаление</td>
                            </tr>
                            </thead>
                            <tbody class="cart-products_body">
                            @foreach($products as $cartProduct)
                                <tr class="cart-product">
                                    <td class="cart-product_name">
                                        <div class="cart-product_details">
                                            <img class="cart-product_img"
                                                 src="/storage/images/{{$cartProduct['item']->mainImg->path}}">
                                            <div class="cart-product_info">
                                                <a href="{{ route('tour', $cartProduct['item']) }}"
                                                   class="cart-product_link">{{$cartProduct['item']->country->name}}
                                                    {{$cartProduct['item']->hotel->hotel_class}}<sup> &#42;</sup>
                                                    {{$cartProduct['item']->tourType->name}}
                                                    <span>{{$cartProduct['qty'] > 1 ? "(".$cartProduct['qty'].")" :
                                                    ''}}</span></a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="cart-product_price">{{number_format($cartProduct['price'], 0, ".", " ")}} ₿</td>
                                    <td class="cart-product_delete">
                                        <div class="cart-product_delete-container">
                                            <a href="{{ route('deleteFromCart', $cartProduct['item']['id']) }}">
                                            <svg class="cart-product_delete-icon">
                                                <use xlink:href="#rubbish-bin-grey"></use>
                                            </svg>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                    <div class="full-cart_total mod_border-grey">
                        <div class="sum">
                            <span>Итого:</span><span class="sum_value"> {{number_format($totalPrice, 0, ".", " ")}}  ₿</span>
                        </div>
                        <button class="full-cart_order-button button mod_color-med-blue">Заказать</button>


                    </div>
                </div>
            @else
                <div>Корзина пуста</div>
            @endif
        </section>
    </div>
@endsection
