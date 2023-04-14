@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endsection

@section('scripts')

@endsection

@section('content')
    <section id="admin" class="admin">
        <h2 class="admin__title">Адміністративна панель</h2>
        <section class="admin__opportunities opportunities">
            <ul class="opportunities__list-of-opportunities list-of-opportunities">
                <li class="list-of-opportunities__block">
                    <strong class="list-of-opportunities__title">Послуги</strong>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Створити послугу">
                        <service-creator link="{{ route('create_service') }}"></service-creator>
                    </button-with-modal-window>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Редагувати послугу">

                    </button-with-modal-window>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Видалити послугу">

                    </button-with-modal-window>
                </li>
                <li class="list-of-opportunities__block">
                    <strong class="list-of-opportunities__title">Продукти</strong>

                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Створити продукт">
                        <product-creator link="{{ route('create_product') }}"
                                         :services="{{ json_encode($services) }}">
                        </product-creator>
                    </button-with-modal-window>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Редагувати продукт">

                    </button-with-modal-window>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Видалити продукт">

                    </button-with-modal-window>
                </li>
                <li class="list-of-opportunities__block">
                    <strong class="list-of-opportunities__title">Новини</strong>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Створити пост">
                        <post-creator link="{{ route('create_post') }}"></post-creator>
                    </button-with-modal-window>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Редагувати пост">

                    </button-with-modal-window>
                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Видалити пост">

                    </button-with-modal-window>
                </li>
            </ul>
        </section>
        <a class="admin__logout" href="{{ route('logout') }}">Вихід</a>
    </section>
@endsection