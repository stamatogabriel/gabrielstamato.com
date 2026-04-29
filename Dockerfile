FROM wordpress:6.9.4-php8.5-apache

# Install useful extensions and tools
RUN apt-get update && apt-get install -y \
    less \
    vim \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install WP-CLI for management via terminal
RUN curl -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x /usr/local/bin/wp

# Enable Apache mod_rewrite (required for WordPress permalinks)
RUN a2enmod rewrite

# Custom php.ini settings — increase limits for uploads and execution
RUN { \
    echo 'upload_max_filesize = 64M'; \
    echo 'post_max_size = 64M'; \
    echo 'max_execution_time = 300'; \
    echo 'max_input_vars = 3000'; \
    echo 'memory_limit = 256M'; \
    echo 'allow_url_fopen = On'; \
} > /usr/local/etc/php/conf.d/wordpress-custom.ini

# Install sendmail and additional dependencies for SMTP
RUN apt-get update && apt-get install -y \
    sendmail \
    sendmail-bin \
    && rm -rf /var/lib/apt/lists/*

# Copy custom themes, plugins, or config files if present locally
# Uncomment and adjust paths as needed after uploading via FileZilla:
COPY ./themes/   /var/www/html/wp-content/themes/
COPY ./plugins/  /var/www/html/wp-content/plugins/
COPY ./uploads/  /var/www/html/wp-content/uploads/

# Expose wp-content as a volume so files transferred via FileZilla
# (or any FTP/SFTP client) persist and are accessible on the host
VOLUME ["/var/www/html/wp-content"]

# WordPress runs on port 80
EXPOSE 80

