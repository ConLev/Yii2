# Базовый образ с nginx и php
FROM richarvey/nginx-php-fpm:1.8.2

# Добавляем наше веб приложение
ADD advanced /var/www/advanced

# Удаляем конфиги сайтов которые там есть
RUN rm -Rf /etc/nginx/sites-enabled/*

# Добавляем наш конфиг
ADD docker/conf/nginx/site.conf /etc/nginx/sites-available/site.conf
# Включаем его
RUN ln -s /etc/nginx/sites-available/site.conf /etc/nginx/sites-enabled/site.conf