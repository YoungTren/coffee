<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$templatePath = SITE_TEMPLATE_PATH;
$currentPage = $APPLICATION->GetCurPage(false);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $APPLICATION->ShowHead(); ?>
    <?php if (defined('COFFEE_DEV') && COFFEE_DEV): ?>
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <?php else: ?>
    <link rel="stylesheet" href="<?= $templatePath ?>/assets/dist/main.css">
    <?php endif; ?>
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>
<?php include __DIR__ . '/includes/icons.php'; ?>

<div class="coffee-page">
    <div id="coffee-navigation" data-current="<?= htmlspecialcharsbx($currentPage) ?>"></div>
