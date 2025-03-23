FROM wordpress:php7.4-apache

RUN chown -R www-data:www-data /var/www/html

# Добавляем настройку max_input_vars
RUN echo "max_input_vars = 20000" > /usr/local/etc/php/conf.d/custom.ini

CMD ["apache2-foreground"]
