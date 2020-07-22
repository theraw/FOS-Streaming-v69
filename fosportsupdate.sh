#!/bin/bash
killall -9 nginx_fos php-fpm
killall nginx nginx_fos
service php7.3-fpm stop

/bin/mkdir /home/fos-streaming/fos/www1/
/bin/mkdir /home/fos-streaming/fos/www1/log/
chown nginx:nginx /home/fos-streaming/fos/www1/log/
cp -R /home/fos-streaming/fos/www/* /home/fos-streaming/fos/www1/
rm /home/fos-streaming/fos/www1/*.*
rm -rf /home/fos-streaming/fos/www1/hl
ln -s /home/fos-streaming/fos/www/hl /home/fos-streaming/fos/www1/hl
ln -s /home/fos-streaming/fos/www/config.php /home/fos-streaming/fos/www1/config.php
ln -s /home/fos-streaming/fos/www/functions.php /home/fos-streaming/fos/www1/functions.php
ln -s /home/fos-streaming/fos/www/stream.php /home/fos-streaming/fos/www1/stream.php
ln -s /home/fos-streaming/fos/www/playlist.php /home/fos-streaming/fos/www1/playlist.php
curl -s https://raw.githubusercontent.com/theraw/FOS-Streaming-v69/master/improvement/nginx.conf /home/fos-streaming/fos/nginx/conf/nginx.conf
/home/fos-streaming/fos/nginx/sbin/nginx
service php7.3-fpm start
