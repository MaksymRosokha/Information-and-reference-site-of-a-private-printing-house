@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endsection

@section('scripts')

@endsection

@section('content')
    <section class="admin">
        <h2 class="admin__title">Адміністративна панель</h2>
        <section class="admin__opportunities opportunities">
            <table class="opportunities__table-of-opportunities table-of-opportunities">
                <tr class="table-of-opportunities__row">
                    <th class="table-of-opportunities__column table-of-opportunities__column--title">Послуги</th>
                    <th class="table-of-opportunities__column table-of-opportunities__column--title">Продукти</th>
                    <th class="table-of-opportunities__column table-of-opportunities__column--title">Новини</th>
                </tr>
                <tr class="table-of-opportunities__row">
                    <td class="table-of-opportunities__column table-of-opportunities__column--create">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Створити послугу">

                        </button-with-modal-window>
                    </td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--create">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Створити продукт">

                        </button-with-modal-window>
                    </td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--create">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Створити пост">

                        </button-with-modal-window>
                    </td>
                </tr>
                <tr class="table-of-opportunities__row">
                    <td class="table-of-opportunities__column table-of-opportunities__column--update">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Редагувати послугу">

                        </button-with-modal-window>
                    </td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--update">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Редагувати продукт">

                        </button-with-modal-window>
                    </td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--update">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Редагувати пост">

                        </button-with-modal-window>
                    </td>
                </tr>
                <tr class="table-of-opportunities__row">
                    <td class="table-of-opportunities__column table-of-opportunities__column--delete">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Видалити послугу">

                        </button-with-modal-window>
                    </td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--delete">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Видалити продукт">

                        </button-with-modal-window>
                    </td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--delete">
                        <button-with-modal-window class="opportunities__button"
                                                  button-text="Видалити пост">

                        </button-with-modal-window>
                    </td>
                </tr>
            </table>
        </section>
        <a class="admin__logout" href="{{ route('logout') }}">Вихід</a>
    </section>
@endsection