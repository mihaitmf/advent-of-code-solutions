#!/usr/bin/env bash

# set working directory after vagrant ssh
WORK_DIR=/var/advent-of-code-solutions
echo "cd $WORK_DIR" >> /home/vagrant/.bashrc

# build docker image
${WORK_DIR}/build.sh

# create symbolic link to use "/usr/bin/php" as interpreter path in IDE settings
ln --force --symbolic ${WORK_DIR}/run-php-container.sh /usr/bin/php
