FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
	vim \
		curl \
		wget \
		git

RUN curl  -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

CMD ["php-fpm"]