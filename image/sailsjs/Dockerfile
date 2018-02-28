FROM node:latest

RUN npm i -g sails grunt bower && \
	mkdir -p /home/sailsjs/src

# COPY src /home/sailsjs/src
WORKDIR /home/sailsjs/src

RUN yarn install ; \
	yarn add sails-disk --save

VOLUME /home/sailsjs/src

EXPOSE 1337

ENTRYPOINT sails lift --dev --silly
