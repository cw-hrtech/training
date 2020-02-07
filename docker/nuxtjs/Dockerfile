FROM node:latest

#The host is set to 0.0.0.0 to give full external access to the app container.
ENV HOST 0.0.0.0

ENV APP_ROOT /var/www

# always run apt update when start and after add new source list, then clean up at end.
RUN set -xe; \
    apt-get update -yqq

RUN apt-get install -y nano

WORKDIR ${APP_ROOT}

#ADD conf/.bashrc /root/.bashrc
ADD ./docker-entrypoint.sh /docker-entrypoint.sh

RUN npm i -g create-nuxt-app

#################################
#####   install pm2         #####
#################################
RUN npm install pm2 -g

CMD ["/docker-entrypoint.sh"]

EXPOSE 3000
