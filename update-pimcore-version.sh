#!/usr/bin/env bash

if [ "$#" -ne 1 ]; then
    echo "Please add new version number as a command-line argument"
fi

cp composer.json .composer-base.json

line=$(grep \"pimcore/pimcore\":\ \" composer.json)
version=$(echo $line | cut -d '"' -f 4)
sed "s/$version/$1/g" .composer-base.json > composer.json

#Installing composer packages
docker-compose exec php bash -c "COMPOSER_MEMORY_LIMIT=-1 composer update --no-suggest --no-interaction --dev -vvv"

#Installing pimcore
docker-compose exec php bash -c "vendor/bin/pimcore-install --env=dev --ignore-existing-config --no-interaction -vvv"

#Installing assets
docker-compose exec php bash -c "bin/console assets:install --env=dev --symlink -vvv"

#clearing symfony cache
docker-compose exec php bash -c "bin/console cache:clear --env=dev --no-interaction --no-warmup -vvv"

#clearing pimcore cache
docker-compose exec php bash -c "bin/console pimcore:cache:clear --env=dev --no-interaction -vvv"
