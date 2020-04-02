FROM node:12.16.1-alpine


ARG APP_ROOT=/srv/app
ENV APP_ROOT=${APP_ROOT}
ENV NODE_ENV production

RUN mkdir /run/nginx
RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}

RUN apk update && \ 
    apk add --no-cache bash \
    supervisor \
    nginx \
    gettext
  

COPY . ${APP_ROOT}

RUN yarn install
RUN yarn build

ADD docker/supervisord.conf /etc/supervisord.conf
ADD docker/nginx.conf /etc/nginx/nginx.conf
ADD docker/client.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

ENTRYPOINT ["/usr/bin/supervisord"]

              



