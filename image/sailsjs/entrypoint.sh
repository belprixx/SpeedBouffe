#!/bin/sh

if [ ! -d ".temp" ]; then
    mkdir .temp
    chown -R sailsjs:sailsjs /home/sailsjs
fi

npm install --silent -g sails grunt bower

yarn install
yarn add sails-disk --save

sails lift --dev --silly
