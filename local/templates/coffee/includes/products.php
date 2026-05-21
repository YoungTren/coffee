<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$coffeeCatalog = json_decode(
    file_get_contents(__DIR__ . '/../data/catalog.json'),
    true,
    512,
    JSON_THROW_ON_ERROR
);

function coffee_product_mount(array $product): void
{
    $json = str_replace("'", '&#39;', json_encode($product, JSON_UNESCAPED_UNICODE));
    echo '<div data-vue-product=\'' . $json . '\'></div>';
}

function coffee_render_product_list(string $key): void
{
    global $coffeeCatalog;

    foreach ($coffeeCatalog['products'][$key] as $product) {
        coffee_product_mount($product);
    }
}

function coffee_render_team(): void
{
    global $coffeeCatalog;

    foreach ($coffeeCatalog['team'] as $member) {
        echo '<article class="coffee-team-card">';
        echo '<div class="coffee-team-card__avatar"></div>';
        echo '<h3 class="coffee-team-card__name">' . htmlspecialcharsbx($member['name']) . '</h3>';
        echo '<p class="coffee-team-card__role">' . htmlspecialcharsbx($member['role']) . '</p>';
        echo '</article>';
    }
}
