@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/public/css/admin.css?ver=5.4.12">
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
                        <service-updater link="{{ route('update_service') }}"
                                         :services="{{ json_encode($services) }}">
                        </service-updater>
                    </button-with-modal-window>

                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Видалити послугу">
                        <service-deleter link="{{ route('delete_service') }}"
                                         :services="{{ json_encode($services) }}">
                        </service-deleter>
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
                        <product-updater link="{{ route('update_product') }}"
                                         :services="{{ json_encode($services) }}"
                                         :products="{{ json_encode($products) }}">
                        </product-updater>
                    </button-with-modal-window>

                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Видалити продукт">
                        <product-deleter link="{{ route('delete_product') }}"
                                         :services="{{ json_encode($services) }}"
                                         :products="{{ json_encode($products) }}">
                        </product-deleter>
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
                        <post-updater link="{{ route('update_post') }}"
                                      :posts="{{ json_encode($posts) }}">
                        </post-updater>
                    </button-with-modal-window>

                    <button-with-modal-window class="list-of-opportunities__button"
                                              button-text="Видалити пост">
                        <post-deleter link="{{ route('delete_post') }}"
                                      :posts="{{ json_encode($posts) }}">

                        </post-deleter>
                    </button-with-modal-window>
                </li>
            </ul>
        </section>
        <a class="admin__logout" href="{{ route('logout') }}">Вихід</a>
    </section>
@endsection