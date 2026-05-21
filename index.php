<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
$APPLICATION->SetTitle('Главная — Nord Bean');
$APPLICATION->SetPageProperty('title', 'Nord Bean — Искусный кофе');
include $_SERVER['DOCUMENT_ROOT'] . '/local/templates/coffee/includes/home/content.php';
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
