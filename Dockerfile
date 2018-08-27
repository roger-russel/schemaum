FROM php:7.2
MAINTAINER Roger Russel <roger@rrussel.org>

ENV TERM=xterm
ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN ln -s /opt/lib/vendor/bin/codecept /usr/bin/

WORKDIR /opt/lib/

RUN apt-get update && apt-get install -y \
 libpq-dev \
 git \
 zip \
 unzip \
 build-essential \
 && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN chmod +x /usr/local/bin/composer

RUN docker-php-ext-install \
   pdo_mysql

RUN pecl install xdebug \
   && docker-php-ext-enable xdebug

CMD ["sleep", "infinity"]
