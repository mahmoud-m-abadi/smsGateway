#!/bin/bash

rm -Rf dockerfiles/config/mysql/data
rm -Rf dockerfiles/config/redis/data
rm -Rf node_modules/
rm -Rf vendor/
rm public/mix-manifest.json
rm composer.lock
rm .env
