FROM webdevops/php-nginx-dev:7.3

ARG API_ROOT=/srv/app
ENV API_ROOT=${API_ROOT}

ENV WEB_DOCUMENT_ROOT=/app/public

RUN apt-get update && apt-get install -y nano htop procps gettext-base
WORKDIR ${API_ROOT}

COPY . ${API_ROOT}
RUN chmod -R 777 ${API_ROOT}/storage
RUN composer install

ADD ./docker/10-location-root.conf /opt/docker/etc/nginx/vhost.common.d/10-location-root.conf
ADD ./docker/10-php.conf /opt/docker/etc/nginx/vhost.common.d/10-php.conf

RUN /bin/sh -c "envsubst < ./docker/vhost.conf >  /opt/docker/etc/nginx/vhost.conf"
