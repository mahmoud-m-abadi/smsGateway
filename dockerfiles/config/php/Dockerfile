FROM php:8.0.6-fpm-alpine

MAINTAINER Mahmoud <mahmood.nh2008@gmail.com>

ENV GOSU_VERSION=1.11 \
    USER=app \
    HOME=/home/app

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl-dev \
        libtool \
        libxml2-dev \
        sqlite-dev \
        curl \
        imagemagick \
        mysql \
        mysql-client \
        libintl \
        icu \
        icu-dev \
        libzip \
        libzip-dev \
        jpeg-dev \
        libpng-dev \
        oniguruma-dev \
        freetype-dev \
        libjpeg-turbo \
        libjpeg-turbo-dev \
    && docker-php-ext-install \
        bcmath \
        gd \
        curl \
        dom \
        iconv \
        bcmath \
        mbstring \
        pdo \
        pdo_mysql \
        pdo_sqlite \
        pcntl \
        tokenizer \
        xml \
        zip \
        intl \
    && apk add --no-cache \
       nano \
       zsh \
       wget \
       shadow \
       git \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN set -x \
    && apk add --no-cache --virtual .gosu-deps \
        dpkg \
        gnupg \
        openssl \
    && dpkgArch="$(dpkg --print-architecture | awk -F- '{ print $NF }')" \
    && wget -O /usr/local/bin/gosu "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch" \
    && wget -O /usr/local/bin/gosu.asc "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch.asc" \
    && export GNUPGHOME="$(mktemp -d)" \
#    && gpg --keyserver ha.pool.sks-keyservers.net --keyserver-options  --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4 \
#    && gpg --batch --verify /usr/local/bin/gosu.asc /usr/local/bin/gosu \
    && rm -r "$GNUPGHOME" /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && gosu nobody true \
    && apk del .gosu-deps
RUN apk add --no-cache shadow \
    && addgroup -S app \
    && adduser -S -G app -s /bin/zsh -h $HOME $USER \
    && usermod -aG $USER www-data \
    && chown app:app -R $HOME/.composer \
#    && touch $HOME/.zshrc \
    && gosu $USER sh -c "SHELL=/bin/zsh && $(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)" \
    && gosu $USER sed -i 's/ZSH_THEME=".*"/ZSH_THEME="candy"/g' $HOME/.zshrc
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apk add --no-cache zlib fontconfig libx11 libxext libxrender sqlite
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev 
RUN pear config-set php_bin /usr/local/bin/php
RUN pear install php_codesniffer
WORKDIR $HOME/sms
RUN apk add --no-cache supervisor

# Implementations for crontab
RUN apk add --update --no-cache libcap && \
    setcap cap_setgid=ep /bin/busybox
USER app
RUN mkdir /home/app/crontabs \
        && echo 'SHELL=/bin/sh' > /home/app/crontabs/app \
    && echo "* * * * * /usr/local/bin/php /home/app/sms/artisan schedule:run >> /dev/null 2>&1" >> /home/app/crontabs/app
RUN crond service as foreground mode
USER root
RUN /usr/bin/crontab /home/app/crontabs/app
