FROM node:10.15.3-alpine


ARG APP_ROOT=/opt/app
ENV APP_ROOT=${APP_ROOT}

RUN mkdir /run/nginx
RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}

RUN apk update && \ 
    apk add --no-cache bash \
    supervisor \
    nginx \
    gettext
  

COPY . ${APP_ROOT}


RUN mkdir /etc/nginx/ssl
ADD docker/supervisord.conf /etc/supervisord.conf
ADD docker/nginx.conf /etc/nginx/nginx.conf
# need rewrite default.conf
ADD docker/bfclient.conf /etc/nginx/conf.d/default.conf
COPY docker/ssl /etc/nginx/ssl

RUN yarn install

# Set environment variables
ENV NODE_ENV production
ENV NUXT_HOST 127.0.0.1
ENV NUXT_PORT 3399

RUN yarn build


EXPOSE 443 80

#ENTRYPOINT ["/opt/app/docker/entrypoint.sh"]
ENTRYPOINT ["/usr/bin/supervisord"]

              



