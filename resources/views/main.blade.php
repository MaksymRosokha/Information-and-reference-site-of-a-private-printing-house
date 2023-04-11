@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/css/main.css">
@endsection

@section('scripts')

@endsection

@section('content')
    <section class="main">
        <h1 class="main__title title visibility-hidden">Скарбничка нотаріуса. Видавництво ІВА</h1>
        <article id="about-company" class="main__about-company about-company main__section">
            <h2 class="about-company__title title">Про компанію</h2>

            <p class="about-company__paragraph paragraph">
                <strong class="paragraph__strong">Приватна друкарня</strong> - це компанія, яка надає послуги з
                друкування різноманітної
                продукції на замовлення. Це може бути все від візитних карток та листівок до брошур, книг, плакатів та
                інших матеріалів рекламного характеру.
            </p>
            <p class="about-company__paragraph paragraph">
                Одна з головних переваг приватної друкарні полягає у тому, що вона може працювати
                із специфічними запитами клієнтів та виконувати замовлення на індивідуальні проекти. Це означає, що
                клієнти можуть отримати продукцію, яка повністю відповідає їхнім потребам та вимогам.
            </p>
            <p class="about-company__paragraph paragraph">
                Приватна друкарня також має більш гнучкий підхід до замовлень та
                може працювати з клієнтами в більш індивідуальному порядку. Це може включати пропозиції щодо дизайну,
                розміру та матеріалу продукції, а також консультації щодо технічних особливостей друкування.
            </p>
            <p class="about-company__paragraph paragraph">
                Звичайно, у друкарні можуть проводитись додаткові послуги, такі як ламінування, фальцювання, перфорація,
                проклейка та інші операції з обробки та обробки продукції. Крім того, друкарня може працювати з різними
                видами матеріалів, таких як папір, картон, пластик, тканини та інші.
            </p>
            <p class="about-company__paragraph paragraph">
                Завдяки приватній друкарні клієнти можуть отримати якісну продукцію від
                професіоналів зі значним досвідом у галузі друкарства. Компанія використовує сучасні
                технології та обладнання для виробництва продукції, що забезпечує високу якість та точність
                друкування.
            </p>
            <p class="about-company__paragraph paragraph">
                Друкарня може також забезпечувати швидкість та ефективність виконання замовлень, що робить її корисною
                для компаній, які потребують швидкого друкування більшого обсягу продукції. В друкарні працюють
                кваліфіковані фахівці, які дбайливо виконують кожне замовлення з урахуванням всіх вимог клієнта та
                стандартів якості.
            </p>
        </article>
        <section id="printing-services" class="main__printing-services printing-services main__section">
            <h2 class="printing-services__title title">Поліграфічні послуги</h2>
            <ol class="printing-services__list-of-services list-of-services">
                @foreach($printing_services as $service)
                    <li class="printing-services__service service">
                        <a href="{{ route('service', ['id' => $service->id]) }}" class="service__link">
                            <img src="/storage/images/services/{{$service->image}}"
                                 alt="Зображення послуги {{ $service->name }}"
                                 class="service__image">
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>
        <section id="everything_for_notary" class="main__everything_for_notary everything_for_notary main__section">
            <h2 class="everything_for_notary__title title">Все для нотаріата</h2>
            <ol class="everything_for_notary__list-of-services list-of-services">
                @foreach($notaries as $notary)
                    <li class="everything-for-notary__service service">
                        <a href="{{ route('service', ['id' => $service->id]) }}" class="service__link">
                            <img src="/storage/images/services/{{ $service->image }}"
                                 alt="Зображення послуги {{ $service->name }}"
                                 class="service__image">
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>
        <section id="news" class="main__news news main__section">
            <h2 class="news__title title">Новини</h2>
            <ul class="news__list-of-posts list-of-posts">
                @foreach($posts as $post)
                    <li class="list-of-posts__post post">
                        <img src="/storage/images/posts/{{ $post->image }}"
                             alt="Зображення поста {{ $post->title }}"
                             class="post__image">
                        <h4 class="post__title">{{ $post->title }}</h4>
                        <p class="post__text">{{ $post->content }}</p>
                    </li>
                @endforeach
            </ul>
        </section>
        <section id="contacts" class="main__contacts contacts main__section">
            <h2 class="contacts__title title">Контакти</h2>
            <div class="contacts__info">
                <iframe class="contacts__map"
                        src="https://maps.google.com/maps?q=48.61569837155951,22.27877601782837&hl=uk&z=14&output=embed"></iframe>
                <dl class="contacts__texts">
                    <dt class="contacts__definition">Адрес:</dt>
                    <dd class="contacts__content-of-definition">
                        <address class="contacts__address">м. Ужгород, вул. Капушанська, 82 А</address>
                    </dd>
                    <dt class="contacts__definition">Номери телефону:</dt>
                    <dd class="contacts__content-of-definition">
                        <a class="contacts__link" href="tel:380508696851">+380508696851</a>
                        <a class="contacts__link" href="tel:380673001999">+380673001999</a>
                    </dd>
                    <dt class="contacts__definition">Електронна пошта:</dt>
                    <dd class="contacts__content-of-definition">
                        <a class="contacts__link" href="mailto: print.pruvat@gmail.com">print.pruvat@gmail.com</a>
                    </dd>
                </dl>
            </div>
        </section>
    </section>
@endsection