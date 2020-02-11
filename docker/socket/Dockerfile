FROM node:latest

#The host is set to 0.0.0.0 to give full external access to the app container.
ENV HOST 0.0.0.0

ENV APP_ROOT /var/www

# always run apt update when start and after add new source list, then clean up at end.
RUN set -xe; \
    apt-get update -yqq

RUN apt-get install -y nano

WORKDIR ${APP_ROOT}

ADD ./docker-entrypoint.sh /docker-entrypoint.sh

CMD ["/docker-entrypoint.sh"]

EXPOSE 3000