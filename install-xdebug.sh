#!/bin/sh

apk --update add gcc make g++ zlib-dev autoconf

pecl install xdebug-2.9.0

echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini
echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/xdebug.ini
echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/xdebug.ini
echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/xdebug.ini
echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini
echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/xdebug.ini
echo "xdebug.idekey=phpstorm-docker" >> /usr/local/etc/php/conf.d/xdebug.ini
