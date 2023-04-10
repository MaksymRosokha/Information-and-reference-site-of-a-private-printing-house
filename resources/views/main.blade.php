@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/css/main.css">
@endsection

@section('scripts')

@endsection

@section('content')
    <section class="main">
        <h2 class="main__title title visibility-hidden">Скарбничка нотаріуса. Видавництво ІВА</h2>
        <article id="about-company" class="main__about-company about-company main__section">
            <h3 class="about-company__title title">Про компанію</h3>

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
            <h3 class="printing-services__title title">Поліграфічні послуги</h3>
            <ol class="printing-services__list-of-services list-of-services">
                @foreach($printing_services as $service)
                    <li class="printing-services__service service">
                        <a href="#" class="service__link">
                            <img src="/storage/images/services/{{$service->image}}"
                                 alt="Зображення послуги {{ $service->name }}"
                                 class="service__image">
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>
        <section id="everything_for_notary" class="main__everything_for_notary everything_for_notary main__section">
            <h3 class="everything_for_notary__title title">Все для нотаріата</h3>
            <ol class="everything_for_notary__list-of-services list-of-services">
                @foreach($notaries as $notary)
                    <li class="everything-for-notary__service service">
                        <a href="#" class="service__link">
                            <img src="/storage/images/services/{{ $service->image }}"
                                 alt="Зображення послуги {{ $service->name }}"
                                 class="service__image">
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>
    </section>
@endsection