<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$coffeeMedia = json_decode(
    file_get_contents(__DIR__ . '/../data/catalog.json'),
    true,
    512,
    JSON_THROW_ON_ERROR
)['media'];

function coffee_img(string $url, string $alt, string $class = ''): void
{
    $classAttr = $class !== '' ? ' class="' . htmlspecialcharsbx($class) . '"' : '';
    $src = htmlspecialcharsbx($url);
    $altText = htmlspecialcharsbx($alt);
    $fallback = htmlspecialcharsbx($GLOBALS['coffeeMedia']['hero']);

    echo '<img src="' . $src . '" alt="' . $altText . '"' . $classAttr
        . ' loading="lazy" onerror="this.onerror=null;this.src=\'' . $fallback . '\'">';
}
