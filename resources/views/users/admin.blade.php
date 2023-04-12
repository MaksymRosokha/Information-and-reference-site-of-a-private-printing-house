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
                    <td class="table-of-opportunities__column table-of-opportunities__column--create">Створити</td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--create">Створити</td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--create">Створити</td>
                </tr>
                <tr class="table-of-opportunities__row">
                    <td class="table-of-opportunities__column table-of-opportunities__column--update">Редагувати</td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--update">Редагувати</td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--update">Редагувати</td>
                </tr>
                <tr class="table-of-opportunities__row">
                    <td class="table-of-opportunities__column table-of-opportunities__column--delete">Видалити</td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--delete">Видалити</td>
                    <td class="table-of-opportunities__column table-of-opportunities__column--delete">Видалити</td>
                </tr>
            </table>
        </section>
        <a class="admin__logout" href="{{ route('logout') }}">Вихід</a>
    </section>
@endsection