# Nord Bean Coffee

Верстка сайта кофейни Nord Bean, подготовленная для дальнейшей интеграции в 1C-Bitrix. Проект включает главную страницу, меню, страницу о компании и контакты.

## Стек

- HTML внутри Bitrix/PHP-шаблонов
- SCSS с BEM-классами `coffee-*`
- Vue 3 для интерактива
- Vite для сборки CSS и JS
- Node.js preview-сервер для локального просмотра без установленного Bitrix
- PHP-заглушки для локальной эмуляции Bitrix-структуры

## Структура

```text
coffee/
├── local/templates/coffee/
│   ├── header.php
│   ├── footer.php
│   ├── includes/          # HTML/PHP-блоки страниц
│   ├── assets/scss/       # исходные SCSS-стили
│   ├── assets/js/src/     # Vue-компоненты и точка входа
│   ├── assets/dist/       # собранные CSS и JS
│   └── data/catalog.json  # данные товаров и изображений
├── dev/                   # локальный preview-сервер
├── index.php
├── menu/
├── about/
├── contact/
└── package.json
```

## Локальный запуск

Установите зависимости:

```bash
npm install
```

Запустите проект:

```bash
npm run dev
```

После запуска откройте в браузере:

```text
http://localhost:8080
```

Доступные страницы:

- `http://localhost:8080/`
- `http://localhost:8080/menu/`
- `http://localhost:8080/about/`
- `http://localhost:8080/contact/`

Важно: открывать нужно порт `8080`, а не `5173`. Порт `5173` используется только для Vite.

## Сборка

Для сборки CSS и JS:

```bash
npm run build
```

Собранные файлы появятся в:

```text
local/templates/coffee/assets/dist/
```

## Preview без watch-режима

```bash
npm run preview
```

Команда сначала выполнит сборку, затем запустит локальный preview-сервер на `http://localhost:8080`.

## Интеграция в Bitrix

Основной шаблон находится в:

```text
local/templates/coffee/
```

Для интеграции в Bitrix нужно перенести эту папку в `local/templates/` проекта Bitrix и выбрать шаблон `Coffee — Nord Bean` в настройках сайта.

Страницы и блоки:

- главная: `local/templates/coffee/includes/home/content.php`
- меню: `local/templates/coffee/includes/menu/content.php`
- о нас: `local/templates/coffee/includes/about/content.php`
- контакты: `local/templates/coffee/includes/contact/content.php`

## Примечания

- Изображения загружаются с Unsplash, поэтому для полного отображения нужен интернет.
- Предупреждения Sass про `@import` не мешают запуску и сборке проекта.
