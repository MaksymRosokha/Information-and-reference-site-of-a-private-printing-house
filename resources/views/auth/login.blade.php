@extends("layouts.app")

@section('title', 'Вхід')

@section('styles')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('scripts')

@endsection

@section('content')
    <section class="sign-in">
        <div class="sign-in__wrapper">
            <h2 class="sign-in__title">Вхід</h2>
            <form class="sign-in__form sign-in-form" action="{{ route('login') }}" method="POST">
                @csrf

                @error('login')
                <p class="sign-in-form__error">{{ $message }}</p>
                @enderror
                <label class="sign-in-form__label" for="login-field">Login:</label>
                <input id="login-field"
                       class="sign-in-form__input-field"
                       type="text"
                       name="login"
                       placeholder="Введіть login"
                       required>
                <label class="sign-in-form__label" for="password-field">Пароль:</label>
                <input id="password-field"
                       class="sign-in-form__input-field"
                       type="password"
                       name="password"
                       placeholder="Введіть пароль"
                       required>
                <button class="sign-in-form__do-sign-in" type="submit">Увійти</button>
            </form>
        </div>
    </section>
@endsection
