#!/usr/bin/env bash

PROJECT_DIR=$(realpath $(dirname $(readlink -f "$0"))/../../..)

docker run --rm \
    --workdir ${PROJECT_DIR} \
    --volume ${PROJECT_DIR}:${PROJECT_DIR} \
    --env "COMPOSER_CACHE_DIR=$PROJECT_DIR/.composer-cache" \
    --user $(id -u):$(id -g) \
    advent-of-code/composer "$@"
