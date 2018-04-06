FROM node:8

COPY entrypoint.sh /entrypoint.sh

RUN npm install -g sails
RUN npm install -g grunt
RUN npm install -g bower
RUN npm install sails-mongo --save
RUN npm cache clear --force

RUN mkdir /root/speedbouffe ; \
    chmod +x /entrypoint.sh

VOLUME /root/speedbouffe

EXPOSE 1337
ENTRYPOINT /entrypoint.sh
