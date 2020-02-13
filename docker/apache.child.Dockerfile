# Installs this theme as a child theme of Jentil,
# with Jentil in `wp-content/themes/` directory
# rather than inside this theme's `vendor/` directory

ARG JENTIL_VERSION=0.11.1
ARG PHP_VERSION=7.4
ARG WORDPRESS_VERSION=5.3

FROM prooph/composer:${PHP_VERSION} as vendor

WORKDIR /tmp

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer remove grottopress/jentil \
        --no-interaction \
        --no-scripts \
        --no-update

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

FROM grottopress/jentil:${JENTIL_VERSION}-wordpress${WORDPRESS_VERSION}-php${PHP_VERSION}-apache

ARG THEME_NAME=jentil-theme

ENV THEME_NAME=${THEME_NAME}
ENV WORDPRESS_DIR=/var/www/html
ENV THEME_DIR=${WORDPRESS_DIR}/wp-content/themes/${THEME_NAME}

COPY --chown=www-data . /usr/src/${THEME_NAME}/
COPY --chown=www-data --from=vendor /tmp/vendor/ /usr/src/${THEME_NAME}/vendor/
COPY docker/docker-entrypoint.sh /tmp/docker-entrypoint.sh

RUN sed '/Template: /d' /usr/src/${THEME_NAME}/style.css; \
    sed -i 's|^\s*\*/| * Template: jentil\n */|' \
        /usr/src/${THEME_NAME}/style.css

RUN cat /usr/local/bin/docker-jentil-entrypoint.sh | \
        sed '/^\s*exec "$@"/d' > \
        /usr/local/bin/docker-main-entrypoint.sh; \
    cat /tmp/docker-entrypoint.sh >> \
        /usr/local/bin/docker-main-entrypoint.sh; \
    chmod +x /usr/local/bin/docker-main-entrypoint.sh

ENTRYPOINT ["docker-main-entrypoint.sh"]

CMD ["apache2-foreground"]
