FROM ubuntu:xenial

RUN apt-get update -q && apt-get install -qqy \
	git-core \
	composer \ 
	libapache2-mod-php \
	php-mcrypt \
	php-intl \
	php-mbstring \
	php-zip \
	php-xml \
	php-codesniffer \
	php-pgsql && \
	# Delete all the apt list files since they're big and get stale quickly
	rm -rf /var/lib/apt/lists/*

# Add apache config to enable .htaccess and do some stuff you want
COPY apache_default /etc/apache2/sites-available/000-default.conf

# Enable mod rewrite and listen to localhost
RUN a2enmod rewrite && \
	echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN rm -rf /var/www/html
WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

# Set write permissions for webserver
RUN chgrp -R www-data logs tmp && \
	chmod -R g+rw logs tmp && \
	chmod +x bin/cake

# RUN bin/cake migrations migrate

EXPOSE 80
CMD ["/usr/sbin/apache2ctl", "-DFOREGROUND"]