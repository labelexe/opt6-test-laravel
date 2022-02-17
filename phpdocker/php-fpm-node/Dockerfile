FROM itdevgroup/php-fpm8.0
# FROM devilbox/php-fpm-8.2:latest-work
# FROM node:16
WORKDIR "/application"
# WORKDIR ${APP_DIR}

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    # PHP 7.4
    # && apt-get -y --no-install-recommends install php7.4-memcached php7.4-mysql php7.4-redis php7.4-xdebug php7.4-bz2 php7.4-gd php7.4-imagick php7.4-dev \ 
    #Clear 
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install node-js & npm

RUN apt-get update \
    && apt-get -y install nodejs \
    && apt-get -y install npm \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

#check work -> node && npm package
RUN nodejs -v