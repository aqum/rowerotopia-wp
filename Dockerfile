FROM wordpress:5.4.1-php7.4-apache

COPY ./php-config/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY ./rowerotopia-theme/* /usr/src/wordpress/wp-content/themes/rowerotopia-theme/
