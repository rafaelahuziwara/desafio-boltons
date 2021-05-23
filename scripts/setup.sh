#!/bin/sh

export LD_LIBRARY_PATH="/opt/openssl/lib"
export CLOUDSDK_PYTHON="/usr/bin/python3"

APP_IDENTIFIER=$(grep APP_IDENTIFIER= .env | cut -d '=' -f 2-)
echo "APP_IDENTIFIER=$APP_IDENTIFIER"

if [ ! -f .env ]; then
    cp .env.dist .env
fi

