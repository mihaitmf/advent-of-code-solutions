#!/usr/bin/env bash

SCRIPT_DIR=$(realpath $(dirname "$0"))

docker build \
    --tag advent-of-code/composer:latest \
    ${SCRIPT_DIR}
