#!/usr/bin/env bash

SCRIPT_DIR=$(realpath $(dirname "$0"))

${SCRIPT_DIR}/php/build.sh
${SCRIPT_DIR}/composer/build.sh
