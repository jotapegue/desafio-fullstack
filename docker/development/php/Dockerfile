from php:8.2-fpm

ARG uid
ARG user

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    zlib1g-dev \
    libmcrypt-dev \
    libpng-dev \
    libzip-dev \
    libsodium-dev

# Limpando cache do APT
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalando extensões PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring xml exif pcntl bcmath gd zip sodium intl \
    && docker-php-ext-enable pdo_mysql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

ENV PATH "$PATH:~/.composer/vendor/bin"
USER $user

