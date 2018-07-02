ad-ddd 
========================

ad-ddd is a sample application for learning DDD. It was made in a DevIN session at eMAG(thank you!). 
It follows best practices and SOLID principles.

## Mandatory requirements

* PHP 7.2
* npm

## Set up the project
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

## Create the database and schema
    php bin/console doctrine:database:create
    php bin/console doctrine:schema:create
## Run the queries
    php bin/console doctrine:schema:update --force
    
## Install assets and js stuff
    sudo npm install -g
    bower install