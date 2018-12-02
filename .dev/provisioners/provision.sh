#!/usr/bin/env bash

# set working directory after vagrant ssh
WORK_DIR=/var/advent-of-code-solutions
echo "cd $WORK_DIR" >> /home/vagrant/.bashrc
