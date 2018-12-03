#!/usr/bin/env bash

IMAGE_NAME="advent-of-code/php:latest"

# needed to sync working directory
HOST_WORK_DIR=$(realpath $(dirname $(readlink -f "$0"))/../..)
CONTAINER_WORK_DIR=${HOST_WORK_DIR}

# needed to sync php config file
HOST_CONFIG_FILE_PATH=${HOST_WORK_DIR}/.dev/docker/config/custom-php.ini
CONTAINER_CONFIG_FILE_PATH=/usr/local/etc/php/conf.d/custom-php.ini

# needed for using Remote PHP Interpreter in IDE
PHPSTORM_HELPERS_DIR=/home/vagrant/.phpstorm_helpers

# needed for using XDebug from the IDE
SETTINGS_ENV_FILE_PATH=${HOST_WORK_DIR}/.dev/docker/config/settings.env

# enable XDebug by default
XDEBUG_STATUS=1
XDEBUG_HOST="192.168.30.1"

docker run --rm \
    --workdir ${CONTAINER_WORK_DIR} \
    --volume ${HOST_WORK_DIR}:${CONTAINER_WORK_DIR} \
    --volume ${HOST_CONFIG_FILE_PATH}:${CONTAINER_CONFIG_FILE_PATH} \
    --volume ${PHPSTORM_HELPERS_DIR}:${PHPSTORM_HELPERS_DIR} \
    --env "XDEBUG_STATUS=$XDEBUG_STATUS" \
    --env "XDEBUG_HOST=$XDEBUG_HOST" \
    --env-file ${SETTINGS_ENV_FILE_PATH} \
    ${IMAGE_NAME} "$@"

## Use this to debug inside the container
#docker run -it --entrypoint bash \
#    --workdir ${CONTAINER_WORK_DIR} \
#    --volume ${HOST_WORK_DIR}:${CONTAINER_WORK_DIR} \
#    --volume ${HOST_CONFIG_FILE_PATH}:${CONTAINER_CONFIG_FILE_PATH} \
#    --volume ${PHPSTORM_HELPERS_DIR}:${PHPSTORM_HELPERS_DIR} \
#    --env "XDEBUG_STATUS=$XDEBUG_STATUS" \
#    --env "XDEBUG_HOST=$XDEBUG_HOST" \
#    --env-file ${SETTINGS_ENV_FILE_PATH} \
#    ${IMAGE_NAME}
