#!/usr/bin/env bash

WORK_DIR=/var/advent-of-code-solutions

# set working directory after vagrant ssh
echo "cd $WORK_DIR" >> /home/vagrant/.bashrc

# create symbolic link to use "/usr/bin/php" as interpreter path in IDE settings
ln --force --symbolic ${WORK_DIR}/.dev/docker/run/run-php-container.sh /usr/bin/php

# needed for using Remote PHP Interpreter in IDE
mkdir /home/vagrant/.phpstorm_helpers
chown vagrant:vagrant /home/vagrant/.phpstorm_helpers

# build docker images
${WORK_DIR}/.dev/docker/build/build-all.sh

# add composer command and run composer install
ln --force --symbolic ${WORK_DIR}/.dev/docker/run/run-composer-container.sh /usr/bin/composer
composer install
