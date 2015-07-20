#
# PHP 5.6
# - also includes Apache, Composer, Drupal configuration
#

FROM debian:wheezy
MAINTAINER Lopez Shackleford <lopez.shackleford@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

# Keep upstart from complaining
RUN dpkg-divert --local --rename --add /sbin/initctl
RUN ln -sf /bin/true /sbin/initctl

# Packages.
RUN apt-get update && apt-get -y --force-yes install \
  apache2 \
  apt-utils \
  curl \
  git \
  libapache2-mod-php5 \
  mysql-client \
  openjdk-7-jre-headless \
  pv \
  pwgen \
  python-setuptools \
  sudo \
  supervisor \
  tidy \
  vim \
  wget

# ADD PHP 5.6 Repo
RUN echo "deb http://packages.dotdeb.org wheezy-php56 all" >> /etc/apt/sources.list.d/dotdeb.list
RUN echo "deb-src http://packages.dotdeb.org wheezy-php56 all" >> /etc/apt/sources.list.d/dotdeb.list
RUN sudo wget http://www.dotdeb.org/dotdeb.gpg -O- | sudo apt-key add -

# Install PHP
RUN apt-get update && apt-get install -y \
  php5-curl \
  php5-dbg \
  php5-gd \
  php5-mysql \
  php5-sqlite \
  php5-pgsql \
  php-pear \
  php5-xdebug

# Install Mailcatcher
RUN apt-get install -y \
  binutils \
  build-essential \
  bzip2 \
  cpp \
  dpkg-dev \
  fakeroot \
  g++ \
  libsqlite3-dev \
  make \
  ruby \
  ruby-dev \
  sqlite3

RUN gem install mailcatcher

RUN apt-get remove -y build-essential libsqlite3-dev ruby-dev && \
    apt-get autoclean && \
    rm -rf /var/lib/apt/lists

# whitelist = phar
RUN \
  mkdir -p /etc/php5/conf.d/ && \
  echo "suhosin.executor.include.whitelist = phar" >> /etc/php5/conf.d/suhosin.ini

# Composer.
RUN \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin -d detect_unicode=0 && \
  ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Enable a2enmod rewrite
RUN a2enmod rewrite php5

# Sudo.
RUN echo %sudo	ALL=NOPASSWD: ALL >> /etc/sudoers

# Scripts.
COPY ./conf/scripts/start.sh /start.sh

# Apache.
RUN rm -rf /var/www/*

# Apache / PHP.
COPY ./conf/apache2/vhost.conf /etc/apache2/sites-available/default
COPY ./conf/php5/apache2.ini /etc/php5/apache2/php.ini
COPY ./conf/php5/cli.ini /etc/php5/cli/php.ini

# Supervisor
COPY ./conf/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Drupal.
COPY ./conf/drupal/settings.docker.php /etc/settings.docker.php

# Xdebug settings.
RUN \
  echo xdebug.remote_enable=1 >> /etc/php5/mods-available/xdebug.ini && \
  echo xdebug.remote_connect_back=1 >> /etc/php5/mods-available/xdebug.ini && \
  echo xdebug.remote_autostart=0 >> /etc/php5/mods-available/xdebug.ini && \
  echo xdebug.max_nesting_level=256 >> /etc/php5/mods-available/xdebug.ini && \
  echo xdebug.remote_log=/var/www/logs/xdebug.log >> /etc/php5/mods-available/xdebug.ini

EXPOSE 80 1080 1025

# Start  file
RUN chmod 755 /start.sh