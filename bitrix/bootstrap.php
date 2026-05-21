<?php

if (!defined('B_PROLOG_INCLUDED')) {
    define('B_PROLOG_INCLUDED', true);
}

if (!defined('SITE_TEMPLATE_PATH')) {
    define('SITE_TEMPLATE_PATH', '/local/templates/coffee');
}

if (!defined('COFFEE_DEV')) {
    define('COFFEE_DEV', getenv('COFFEE_DEV') === '1');
}

if (!function_exists('htmlspecialcharsbx')) {
    function htmlspecialcharsbx($string)
    {
        return htmlspecialchars((string) $string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!isset($APPLICATION)) {
    class CoffeeApplication
    {
        private string $title = 'Nord Bean';

        public function SetTitle(string $title): void
        {
            $this->title = $title;
        }

        public function SetPageProperty(string $key, string $value): void
        {
        }

        public function GetCurPage(bool $absolute = false): string
        {
            $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

            return rtrim($uri, '/') ?: '/';
        }

        public function ShowHead(): void
        {
            echo '<title>' . htmlspecialcharsbx($this->title) . '</title>' . "\n";
        }

        public function ShowPanel(): void
        {
        }
    }

    $APPLICATION = new CoffeeApplication();
}
