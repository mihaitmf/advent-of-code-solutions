#!/usr/bin/env bash

WORK_DIR=/var/advent-of-code-solutions

# set working directory after vagrant ssh
echo "cd $WORK_DIR" >> /home/vagrant/.bashrc

# build docker image
${WORK_DIR}/.dev/docker/build/build-all.sh

# create symbolic link to use "/usr/bin/php" as interpreter path in IDE settings
ln --force --symbolic ${WORK_DIR}/.dev/docker/run/run-php-container.sh /usr/bin/php

# needed for using Remote PHP Interpreter in IDE
mkdir /home/vagrant/.phpstorm_helpers
chown vagrant:vagrant /home/vagrant/.phpstorm_helpers
