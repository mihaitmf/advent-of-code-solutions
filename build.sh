#!/usr/bin/env bash

SCRIPT_DIR=$(realpath $(dirname "$0"))

docker build \
    --tag advent-of-code/php:latest \
    ${SCRIPT_DIR}
