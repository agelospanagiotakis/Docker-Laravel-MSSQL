FROM php:8.2-fpm

RUN apt-get update && apt-get install -y  \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libssl-dev \
    npm \
    --no-install-recommends 

RUN docker-php-ext-configure gd --with-freetype --with-jpeg 
RUN docker-php-ext-install pdo_mysql -j$(nproc) gd

# RUN curl -o libssl1.deb https://security.debian.org/debian-security/pool/updates/main/o/openssl/libssl1.1-udeb_1.1.1n-0+deb11u5_amd64.udeb
# RUN dpkg -i libssl1.deb
# RUN curl -o openssl_1.1.1.deb https://security.debian.org/debian-security/pool/updates/main/o/openssl/openssl_1.1.1n-0+deb11u5_amd64.deb
# RUN dpkg -i openssl_1.1.1.deb


###############
# MSSQL support
###############
RUN apt-get update \
    && apt-get install -y gpg unixodbc unixodbc-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install sqlsrv pdo_sqlsrv wget

# ------------ Install MS SQL client deps ------------ #
# adding custom MS repository
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list

# install SQL Server drivers and tools
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17
RUN echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
RUN /bin/bash -c "source ~/.bashrc"

# Debian 9 msodbcsql : https://packages.microsoft.com/debian/9/prod/pool/main/m/msodbcsql17/
# RUN curl -o msodbcsql17_17.4.2.1-1_amd64.deb https://packages.microsoft.com/debian/9/prod/pool/main/m/msodbcsql17/msodbcsql17_17.4.2.1-1_amd64.deb
# RUN ACCEPT_EULA=Y dpkg -i msodbcsql17_17.4.2.1-1_amd64.deb
RUN curl -o msodbcsql17_amd64.deb https://packages.microsoft.com/debian/9/prod/pool/main/m/msodbcsql17/msodbcsql17_17.10.6.1-1_amd64.deb
RUN ACCEPT_EULA=Y dpkg -i msodbcsql17_amd64.deb



RUN apt-get -y install locales
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen
RUN locale-gen

RUN echo "extension=sqlsrv.so" >> /usr/local/etc/php/conf.d/docker-php-ext-sqlsrv.ini
RUN echo "extension=pdo_sqlsrv.so" >> /usr/local/etc/php/conf.d/docker-php-ext-pdo-sqlsrv.ini
# -------------- END MSSQL -------------------------------- #
    