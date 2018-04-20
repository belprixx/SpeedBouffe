#!/bin/bash

service php7.2-fpm start
composer update
bin/console doctrine:schema:update --force &
bin/console cache:clear --env=dev
tail -f /var/log/lastlog
