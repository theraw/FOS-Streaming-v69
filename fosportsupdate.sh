#!/bin/bash
killall -9 nginx_fos php-fpm
killall -9 nginx_fos php-fpm
sleep 2
/bin/mkdir /home/fos-streaming/fos/www1/
/bin/mkdir /home/fos-streaming/fos/www1/log/
chown fosstreaming:fosstreaming /home/fos-streaming/fos/www1/log/
cp -R /home/fos-streaming/fos/www/* /home/fos-streaming/fos/www1/
rm /home/fos-streaming/fos/www1/*.*
rm -rf /home/fos-streaming/fos/www1/hl
ln -s /home/fos-streaming/fos/www/hl /home/fos-streaming/fos/www1/hl
ln -s /home/fos-streaming/fos/www/config.php /home/fos-streaming/fos/www1/config.php
ln -s /home/fos-streaming/fos/www/functions.php /home/fos-streaming/fos/www1/functions.php
ln -s /home/fos-streaming/fos/www/stream.php /home/fos-streaming/fos/www1/stream.php
ln -s /home/fos-streaming/fos/www/playlist.php /home/fos-streaming/fos/www1/playlist.php
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/improvement/nginx.conf -O nginx.conf
cp -R nginx.conf /home/fos-streaming/fos/nginx/conf/nginx.conf
sleep 2
/home/fos-streaming/fos/nginx/sbin/nginx_fos
/home/fos-streaming/fos/php/sbin/php-fpm
