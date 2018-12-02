#!/usr/bin/env bash

COMMAND="$@"
IMAGE_NAME="advent-of-code/php:latest"

HOST_WORK_DIR=$(realpath $(dirname $(readlink -f "$0")))
CONTAINER_WORK_DIR=${HOST_WORK_DIR}
HOST_CONFIG_FILE_PATH=${HOST_WORK_DIR}/dev/config/custom-php.ini
CONTAINER_CONFIG_FILE_PATH=/usr/local/etc/php/conf.d/custom-php.ini

XDEBUG_STATUS=1 # enable XDebug by default
XDEBUG_HOST="192.168.30.11"

docker run --rm \
    --workdir ${CONTAINER_WORK_DIR} \
    --volume ${HOST_WORK_DIR}:${CONTAINER_WORK_DIR} \
    --volume ${HOST_CONFIG_FILE_PATH}:${CONTAINER_CONFIG_FILE_PATH} \
    --env "XDEBUG_STATUS=$XDEBUG_STATUS" \
    --env "XDEBUG_HOST=$XDEBUG_HOST" \
    ${IMAGE_NAME} "$COMMAND"

## Use this to debug inside the container
#docker run -it --entrypoint bash \
#    --workdir ${CONTAINER_WORK_DIR} \
#    --volume ${HOST_WORK_DIR}:${CONTAINER_WORK_DIR} \
#    --volume ${HOST_CONFIG_FILE_PATH}:${CONTAINER_CONFIG_FILE_PATH} \
#    --env "XDEBUG_STATUS=$XDEBUG_STATUS" \
#    --env "XDEBUG_HOST=$XDEBUG_HOST" \
#    ${IMAGE_NAME}
