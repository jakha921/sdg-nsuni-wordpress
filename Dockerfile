FROM wordpress:6-php8.2-apache

# Минимальные настройки
RUN a2enmod expires headers rewrite && \
    echo "upload_max_filesize = 64M\n" \
         "post_max_size = 64M\n" \
         "memory_limit = 256M\n" \
         "max_execution_time = 300\n" > /usr/local/etc/php/conf.d/wordpress.ini
