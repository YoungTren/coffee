<?php
require __DIR__ . '/../products.php';
require __DIR__ . '/../media.php';
?>
<section class="coffee-hero">
    <div class="coffee-hero__bg">
        <?php coffee_img($coffeeMedia['hero'], 'Приготовление премиального кофе'); ?>
        <div class="coffee-hero__overlay"></div>
    </div>
    <div class="coffee-hero__orb coffee-hero__orb--1"></div>
    <div class="coffee-hero__orb coffee-hero__orb--2"></div>

    <div class="coffee-hero__content">
        <div class="coffee-hero__float-card coffee-hero__float-card--tl">
            <div class="coffee-hero__float-inner">
                <div class="coffee-hero__float-icon"><svg width="24" height="24"><use href="#icon-leaf"/></svg></div>
                <div>
                    <p class="coffee-hero__float-title">Свежая обжарка</p>
                    <p class="coffee-hero__float-sub">Каждый день</p>
                </div>
            </div>
        </div>
        <div class="coffee-hero__float-card coffee-hero__float-card--tr">
            <div class="coffee-hero__float-inner">
                <div class="coffee-hero__float-icon"><svg width="24" height="24"><use href="#icon-star"/></svg></div>
                <div>
                    <p class="coffee-hero__float-title">Рейтинг 4.9</p>
                    <p class="coffee-hero__float-sub">2,4 тыс. отзывов</p>
                </div>
            </div>
        </div>
        <div class="coffee-hero__float-card coffee-hero__float-card--bl">
            <div class="coffee-hero__float-inner">
                <div class="coffee-hero__float-icon"><svg width="24" height="24"><use href="#icon-award"/></svg></div>
                <div>
                    <p class="coffee-hero__float-title">Органические зерна</p>
                    <p class="coffee-hero__float-sub">сертифицировано</p>
                </div>
            </div>
        </div>

        <div class="coffee-hero__center">
            <h1 class="coffee-hero__title">
                Искусный кофе для<br>
                <span class="coffee-hero__title-accent">успешного утра</span>
            </h1>
            <p class="coffee-hero__text">
                Откройте для себя скандинавскую кофейную культуру. Каждая чашка готовится вручную
                из премиальных органических зёрен с идеальной обжаркой — для бодрого и продуктивного дня.
            </p>
            <div class="coffee-hero__actions">
                <button type="button" class="coffee-header__order" data-scroll-to="menu">
                    Заказать сейчас
                    <svg width="20" height="20"><use href="#icon-coffee"/></svg>
                </button>
                <a href="/menu/" class="coffee-btn-outline">Смотреть меню</a>
            </div>
        </div>

        <div class="coffee-hero__cards-mobile">
            <div class="coffee-hero__float-card">
                <div class="coffee-hero__float-inner">
                    <div class="coffee-hero__float-icon"><svg width="24" height="24"><use href="#icon-leaf"/></svg></div>
                    <div>
                        <p class="coffee-hero__float-title">Свежая обжарка</p>
                        <p class="coffee-hero__float-sub">Каждый день</p>
                    </div>
                </div>
            </div>
            <div class="coffee-hero__float-card">
                <div class="coffee-hero__float-inner">
                    <div class="coffee-hero__float-icon"><svg width="24" height="24"><use href="#icon-star"/></svg></div>
                    <div>
                        <p class="coffee-hero__float-title">Рейтинг 4.9</p>
                        <p class="coffee-hero__float-sub">2,4 тыс. отзывов</p>
                    </div>
                </div>
            </div>
            <div class="coffee-hero__float-card">
                <div class="coffee-hero__float-inner">
                    <div class="coffee-hero__float-icon"><svg width="24" height="24"><use href="#icon-award"/></svg></div>
                    <div>
                        <p class="coffee-hero__float-title">Органические зерна</p>
                        <p class="coffee-hero__float-sub">сертифицировано</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="coffee-section">
    <div class="coffee-container">
        <div class="coffee-grid coffee-grid--3">
            <article class="coffee-feature">
                <div class="coffee-feature__icon"><svg width="32" height="32"><use href="#icon-leaf"/></svg></div>
                <h3 class="coffee-feature__title">Свежие зерна</h3>
                <p class="coffee-feature__text">Закупаем зерно на устойчивых фермах и обжариваем его каждый день, чтобы сохранить насыщенный вкус и аромат.</p>
            </article>
            <article class="coffee-feature">
                <div class="coffee-feature__icon"><svg width="32" height="32"><use href="#icon-heart"/></svg></div>
                <h3 class="coffee-feature__title">Ручная работа</h3>
                <p class="coffee-feature__text">Каждый напиток готовят опытные бариста — с вниманием к деталям и вашим предпочтениям.</p>
            </article>
            <article class="coffee-feature">
                <div class="coffee-feature__icon"><svg width="32" height="32"><use href="#icon-coffee"/></svg></div>
                <h3 class="coffee-feature__title">Уютная атмосфера</h3>
                <p class="coffee-feature__text">Тёплое и уютное пространство для отдыха, встреч и вдохновения.</p>
            </article>
        </div>
    </div>
</section>

<section id="menu" class="coffee-section coffee-section--gradient-reverse">
    <div class="coffee-container">
        <div class="coffee-text-center" style="margin-bottom:4rem">
            <h2 class="coffee-section__title">Наше фирменное меню</h2>
            <p class="coffee-section__subtitle">Тщательно подобранные напитки ручной работы</p>
        </div>
        <div class="coffee-grid coffee-grid--4">
            <?php coffee_render_product_list('home'); ?>
        </div>
        <div class="coffee-text-center coffee-mt-12">
            <a href="/menu/" class="coffee-header__order">Полное меню</a>
        </div>
    </div>
</section>

<section class="coffee-section" style="overflow:hidden">
    <div class="coffee-decoration-orb coffee-decoration-orb--tr"></div>
    <div class="coffee-container">
        <div class="coffee-about-block">
            <div class="coffee-about-block__image-wrap">
                <div class="coffee-about-block__image">
                    <?php coffee_img($coffeeMedia['interior'], 'Уютный интерьер кофейни'); ?>
                </div>
            </div>
            <div>
                <span class="coffee-about-block__badge">О Nord Bean</span>
                <h2 class="coffee-about-block__title">Где скандинавская элегантность<br>встречает кофейное мастерство</h2>
                <p class="coffee-about-block__text">Основанная в центре города, Nord Bean привносит скандинавскую кофейную культуру в ваш ежедневный ритуал. Мы верим в простоту, качество и силу хорошего начала дня.</p>
                <p class="coffee-about-block__text">Зерно мы закупаем на небольших фермах, обжариваем на месте и подаём с заботой — чтобы каждая чашка заряжала энергией на весь день.</p>
                <p class="coffee-about-block__text">В нашей кофейне всё продумано до мелочей: здесь можно остановиться, отдохнуть и насладиться моментом.</p>
                <div class="coffee-about-block__stats">
                    <div><div class="coffee-about-block__stat-value">8+</div><div class="coffee-about-block__stat-label">Лет мастерства</div></div>
                    <div><div class="coffee-about-block__stat-value">12k+</div><div class="coffee-about-block__stat-label">Довольных клиентов</div></div>
                    <div><div class="coffee-about-block__stat-value">100%</div><div class="coffee-about-block__stat-label">Органика</div></div>
                </div>
                <a href="/about/" class="coffee-btn-outline">Узнать больше</a>
            </div>
        </div>
    </div>
</section>

<section class="coffee-section">
    <div class="coffee-container" style="max-width:56rem">
        <div id="coffee-subscription"></div>
    </div>
</section>
