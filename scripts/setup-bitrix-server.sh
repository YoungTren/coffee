#!/bin/bash
set -euo pipefail

export DEBIAN_FRONTEND=noninteractive

apt update
apt upgrade -y

apt install -y \
  nginx \
  mysql-server \
  php8.3-fpm \
  php8.3-mysql \
  php8.3-xml \
  php8.3-mbstring \
  php8.3-curl \
  php8.3-zip \
  php8.3-gd \
  php8.3-intl \
  unzip \
  curl \
  git

systemctl enable nginx mysql
systemctl start nginx mysql

mkdir -p /var/www/coffee
chown -R www-data:www-data /var/www/coffee

curl -fsSL -o /var/www/coffee/bitrixsetup.php \
  'https://www.1c-bitrix.ru/download/scripts/bitrixsetup.php'

chown www-data:www-data /var/www/coffee/bitrixsetup.php

cat > /etc/nginx/sites-available/coffee <<'NGINX'
server {
    listen 80;
    server_name 72.56.14.11;

    root /var/www/coffee;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }
}
NGINX

ln -sf /etc/nginx/sites-available/coffee /etc/nginx/sites-enabled/coffee
rm -f /etc/nginx/sites-enabled/default

nginx -t
systemctl reload nginx

curl -fsSI "http://127.0.0.1/bitrixsetup.php" | head -1

echo "OK: http://72.56.14.11/bitrixsetup.php"
