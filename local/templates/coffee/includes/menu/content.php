<?php
require __DIR__ . '/../products.php';
?>
<section class="coffee-page-header">
    <div class="coffee-container">
        <h1 class="coffee-page-header__title">Наше меню</h1>
        <p class="coffee-page-header__text">Откройте для себя широкий выбор кофейных напитков и десертов, приготовленных с любовью и мастерством</p>
    </div>
</section>

<section class="coffee-section">
    <div class="coffee-container">
        <div class="coffee-section__header-row">
            <div class="coffee-section__header-icon"><svg width="28" height="28"><use href="#icon-coffee"/></svg></div>
            <h2 class="coffee-section__title" style="text-align:left;margin:0">Горячие напитки</h2>
        </div>
        <div class="coffee-grid coffee-grid--products-menu">
            <?php coffee_render_product_list('hot'); ?>
        </div>
    </div>
</section>

<section class="coffee-section coffee-section--gradient-reverse">
    <div class="coffee-container">
        <div class="coffee-section__header-row">
            <div class="coffee-section__header-icon"><svg width="28" height="28"><use href="#icon-ice-cream"/></svg></div>
            <h2 class="coffee-section__title" style="text-align:left;margin:0">Холодные напитки</h2>
        </div>
        <div class="coffee-grid coffee-grid--4">
            <?php coffee_render_product_list('cold'); ?>
        </div>
    </div>
</section>

<section class="coffee-section">
    <div class="coffee-container">
        <div class="coffee-section__header-row">
            <div class="coffee-section__header-icon"><svg width="28" height="28"><use href="#icon-cookie"/></svg></div>
            <h2 class="coffee-section__title" style="text-align:left;margin:0">Десерты</h2>
        </div>
        <div class="coffee-grid coffee-grid--4">
            <?php coffee_render_product_list('desserts'); ?>
        </div>
    </div>
</section>
