ad-ddd 
========================

ad-ddd is a sample application for learning DDD. It was made in a DevIN session at eMAG(thank you!). 
It follows best practices and SOLID principles.

## Mandatory requirements

* PHP 7.2

## Set up the project
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

## Create the database schema
    php bin/console doctrine orm:schema-tool:create
    php bin/console doctrine orm:schema-tool:update --force