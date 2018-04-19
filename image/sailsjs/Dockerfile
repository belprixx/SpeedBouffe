FROM node:latest

COPY entrypoint.sh /entrypoint.sh

RUN mkdir -p /home/sailsjs/src ;
#    adduser sailsjs --shell /sbin/nologin --home /home/sailsjs ; \
#    chown +x /entrypoint.sh

WORKDIR /home/sailsjs/src

VOLUME /home/sailsjs/src

EXPOSE 1337
ENTRYPOINT /entrypoint.sh
