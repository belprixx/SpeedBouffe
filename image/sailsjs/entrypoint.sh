#!/bin/sh

if [ ! -d "/root/speedbouffe/.temp" ]; then
    mkdir /root/speedbouffe/.temp
    chown -R root:root /root/speedbouffe/.tmp
fi

# npm install --silent -g sails grunt bower

cd /root/speedbouffe && \
yarn install && \
yarn add sails-disk --save

# npm install sails-mongo

sails generate api speedbouffe

sails lift --dev --silly
