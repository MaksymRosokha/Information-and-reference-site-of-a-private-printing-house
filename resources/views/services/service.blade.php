@extends("layouts.app")

@section('title', $service->name)

@section('styles')
    <link rel="stylesheet" href="/public/css/service.css?ver=5.4.12">
@endsection

@section('scripts')

@endsection

@section('content')
    <section class="service">
        <h2 class="service__title">{{ $service->name }}</h2>
        <service-search class="service__search" :service="{{ $service->id }}"></service-search>
        @if(empty($products[0]))
            <p class="service__empty-products">Не вдалося знайти продукти</p>
        @else
            <table class="service__table-of-products table-of-products">
                <tr class="table-of-products__row">
                    <th class="table-of-products__column table-of-products__column--title table-of-products__column--image">
                        Зображення
                    </th>
                    <th class="table-of-products__column table-of-products__column--title table-of-products__column--name">
                        Назва
                    </th>
                    <th class="table-of-products__column table-of-products__column--title table-of-products__column--price">
                        Ціна
                    </th>
                </tr>
                @foreach($products as $product)
                    <tr class="table-of-products__row table-of-products__product product">
                        <td class="table-of-products__column table-of-products__column--image   ">
                            <img class="product__image"
                                 src="/public/storage/images/products/{{$product->image}}"
                                 alt="Картинка продукту {{$product->name}}">
                        </td>
                        <td class="table-of-products__column table-of-products__column--name">
                            <h3 class="product__name">{{$product->name}}</h3>
                        </td>
                        <td class="table-of-products__column table-of-products__column--price">
                            <b class="product__prise">{{$product->price}} ₴</b>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </section>
@endsection