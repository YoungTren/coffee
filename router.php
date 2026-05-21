<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');
$root = __DIR__;
$file = $root . $uri;

if ($uri !== '/' && is_file($file)) {
    return false;
}

if (is_file($file . '/index.php')) {
    require $file . '/index.php';
    return true;
}

if ($uri === '/' || $uri === '') {
    require $root . '/index.php';
    return true;
}

http_response_code(404);
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html><html lang="ru"><body><h1>404</h1><p><a href="/">На главную</a></p></body></html>';

return true;
