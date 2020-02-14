ARG PHP_VERSION=7.4
ARG WORDPRESS_VERSION=5.3

FROM prooph/composer:${PHP_VERSION} AS vendor

WORKDIR /tmp

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer update \
        --no-autoloader \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --prefer-dist

RUN composer dump-autoload \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --optimize

FROM grottopress/wordpress:${WORDPRESS_VERSION}-php${PHP_VERSION}-fpm-alpine

ARG THEME_NAME=jentil-theme

ENV THEME_NAME=${THEME_NAME}
ENV WORDPRESS_DIR=/var/www/html
ENV THEME_DIR=${WORDPRESS_DIR}/wp-content/themes/${THEME_NAME}

COPY --chown=www-data . /usr/src/${THEME_NAME}/
COPY --chown=www-data --from=vendor /tmp/vendor/ /usr/src/${THEME_NAME}/vendor/
COPY docker/docker-entrypoint.sh /tmp/

RUN cat /usr/local/bin/docker-entrypoint.sh | \
        sed '/^\s*exec "$@"/d' > \
        /usr/local/bin/docker-main-entrypoint.sh; \
    cat /tmp/docker-entrypoint.sh >> \
        /usr/local/bin/docker-main-entrypoint.sh; \
    chmod +x /usr/local/bin/docker-main-entrypoint.sh

ENTRYPOINT ["docker-main-entrypoint.sh"]

CMD ["php-fpm"]
