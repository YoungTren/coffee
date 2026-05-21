<?php
require __DIR__ . '/../products.php';
require __DIR__ . '/../media.php';
?>
<section class="coffee-page-header">
    <div class="coffee-container">
        <h1 class="coffee-page-header__title">О нас</h1>
        <p class="coffee-page-header__text">История нашей страсти к кофе и скандинавской культуре</p>
    </div>
</section>

<section class="coffee-section">
    <div class="coffee-container">
        <div class="coffee-about-block">
            <div class="coffee-about-block__image-wrap">
                <div class="coffee-about-block__image">
                    <?php coffee_img($coffeeMedia['interior'], 'Уютный интерьер кофейни'); ?>
                </div>
            </div>
            <div>
                <h2 class="coffee-about-block__title">Наша история</h2>
                <p class="coffee-about-block__text">Nord Bean была основана в 2016 году с простой миссией: принести подлинную скандинавскую кофейную культуру в наш город. Вдохновленные минималистичной эстетикой и философией hygge, мы создали пространство, где каждая деталь имеет значение.</p>
                <p class="coffee-about-block__text">Наше путешествие началось с поездки в Копенгаген, где мы влюбились в то, как скандинавы относятся к кофе — не просто как к напитку, но как к ритуалу, моменту замедления в стремительном мире.</p>
                <p class="coffee-about-block__text">Мы тщательно отбираем каждую партию зерен, сотрудничая напрямую с фермерами, которые разделяют наши ценности устойчивости и качества. Наша обжарка происходит небольшими партиями, чтобы раскрыть уникальный характер каждого сорта.</p>
                <p class="coffee-about-block__text">Сегодня Nord Bean — это не просто кофейня. Это сообщество людей, ценящих качество, простоту и моменты настоящего присутствия.</p>
            </div>
        </div>
    </div>
</section>

<section class="coffee-section coffee-section--gradient-reverse">
    <div class="coffee-container">
        <div class="coffee-text-center" style="margin-bottom:4rem">
            <h2 class="coffee-section__title">Наши ценности</h2>
            <p class="coffee-section__subtitle">Принципы, которые направляют нас каждый день</p>
        </div>
        <div class="coffee-grid coffee-grid--4">
            <article class="coffee-value-card">
                <div class="coffee-value-card__icon"><svg width="28" height="28"><use href="#icon-award"/></svg></div>
                <h3 class="coffee-value-card__title">Качество</h3>
                <p class="coffee-value-card__text">Используем только отборные зерна премиум класса, обжаренные с точностью мастера</p>
            </article>
            <article class="coffee-value-card">
                <div class="coffee-value-card__icon"><svg width="28" height="28"><use href="#icon-leaf"/></svg></div>
                <h3 class="coffee-value-card__title">Устойчивость</h3>
                <p class="coffee-value-card__text">Поддерживаем экологичные фермы и используем биоразлагаемую упаковку</p>
            </article>
            <article class="coffee-value-card">
                <div class="coffee-value-card__icon"><svg width="28" height="28"><use href="#icon-heart"/></svg></div>
                <h3 class="coffee-value-card__title">Страсть</h3>
                <p class="coffee-value-card__text">Каждая чашка создается с любовью и вниманием к каждой детали</p>
            </article>
            <article class="coffee-value-card">
                <div class="coffee-value-card__icon"><svg width="28" height="28"><use href="#icon-users"/></svg></div>
                <h3 class="coffee-value-card__title">Сообщество</h3>
                <p class="coffee-value-card__text">Создаем пространство, где люди чувствуют себя как дома</p>
            </article>
        </div>
    </div>
</section>

<section class="coffee-section">
    <div class="coffee-container">
        <div class="coffee-text-center" style="margin-bottom:4rem">
            <h2 class="coffee-section__title">Наша команда</h2>
            <p class="coffee-section__subtitle">Люди, которые воплощают наше видение в жизнь</p>
        </div>
        <div class="coffee-grid coffee-grid--3">
            <?php coffee_render_team(); ?>
        </div>
    </div>
</section>

<section class="coffee-section coffee-section--gradient-reverse">
    <div class="coffee-container" style="max-width:56rem">
        <div class="coffee-visit-card">
            <div class="coffee-text-center" style="margin-bottom:3rem">
                <h2 class="coffee-section__title">Посетите нас</h2>
                <p class="coffee-section__subtitle">Мы всегда рады видеть вас в нашей уютной кофейне</p>
            </div>
            <div class="coffee-grid coffee-grid--2">
                <div class="coffee-contact-card">
                    <div class="coffee-contact-card__row">
                        <div class="coffee-contact-card__icon"><svg width="24" height="24"><use href="#icon-map-pin"/></svg></div>
                        <div>
                            <h4 class="coffee-contact-card__title">Адрес</h4>
                            <p class="coffee-contact-card__text">ул. Северная, 123<br>Москва, Россия</p>
                        </div>
                    </div>
                </div>
                <div class="coffee-contact-card">
                    <div class="coffee-contact-card__row">
                        <div class="coffee-contact-card__icon"><svg width="24" height="24"><use href="#icon-clock"/></svg></div>
                        <div>
                            <h4 class="coffee-contact-card__title">Часы работы</h4>
                            <p class="coffee-contact-card__text">Пн-Пт: 7:00 - 20:00<br>Сб: 8:00 - 21:00<br>Вс: 8:00 - 19:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
