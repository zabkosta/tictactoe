FROM webdevops/php-nginx:7.3

ARG API_ROOT=/srv/app
ENV API_ROOT=${API_ROOT}

ENV WEB_DOCUMENT_ROOT=/app/public

RUN apt-get update && apt-get install -y nano htop procps
WORKDIR ${API_ROOT}

COPY composer.json ${API_ROOT}/composer.json
RUN composer install

COPY . ${API_ROOT}
RUN chmod -R 777 ${API_ROOT}/storage

ADD ./docker/10-location-root.conf /opt/docker/etc/nginx/vhost.common.d/10-location-root.conf
ADD ./docker/10-php.conf /opt/docker/etc/nginx/vhost.common.d/10-php.conf

