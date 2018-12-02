#!/usr/bin/env bash

# set working directory after vagrant ssh
WORK_DIR=/var/advent-of-code-solutions
echo "cd $WORK_DIR" >> /home/vagrant/.bashrc

# this symbolic link makes possible to use "/usr/bin/php" as interpreter path in IDE settings
ln --force --symbolic ${WORK_DIR}/run-php-container.sh /usr/bin/php
