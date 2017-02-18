#!/bin/bash
apt-get update
apt-get -y install git
apt-get -y install php5-cli curl
/bin/mkdir /home/fos-streaming/fos/www/
cd /home/fos-streaming/fos/www/
git clone https://github.com/zgelici/FOS-Streaming-v1.git .
php install_panel.php

read -p "Choose your MySQL database name: " sqldatabase
read -p "Enter your MySQL username(usual 'root'): " sqluname
read -rep $'Enter your MySQL password (ENTER for none):' sqlpasswd
echo "mysql-server mysql-server/root_password password $sqlpasswd" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $sqlpasswd" | debconf-set-selections
echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
echo "phpmyadmin phpmyadmin/app-password-confirm password $sqlpasswd" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/admin-pass password $sqlpasswd" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/app-pass password $sqlpasswd" | debconf-set-selections
echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections

apt-get install -y mysql-server > /dev/null 2>&1
apt-get install -y php5-mysql  > /dev/null 2>&1

mysql -uroot -p$sqlpasswd -e "CREATE DATABASE $sqldatabase"
mysql -uroot -p$sqlpasswd -e "grant all privileges on $sqldatabase.* to '$sqluname'@'localhost' identified by '$sqlpasswd'"

echo  "hostname: localhost, database_name: " $sqldatabase " , database_username: "  $sqluname  " , database_password " $sqlpasswd
echo "\n "

sed -i 's/xxx/'$sqldatabase'/g' /home/fos-streaming/fos/www/config.php
sed -i 's/zzz/'$sqlpasswd'/g' /home/fos-streaming/fos/www/config.php
sed -i 's/ttt/'$sqluname'/g' /home/fos-streaming/fos/www/config.php

curl "http://127.0.0.1:8000/install.php?install"
curl "http://127.0.0.1:8000/install.php?update"
rm -r /home/fos-streaming/fos/www/install.php

/bin/cp improvement/nginx.conf /home/fos-streaming/fos/nginx/conf/nginx.conf
/bin/cp improvement/php-fpm.conf /home/fos-streaming/fos/php/etc/php-fpm.conf
/bin/cp improvement/www.conf /home/fos-streaming/fos/php/etc/pool.d/www.conf
/bin/cp improvement/balance.conf /home/fos-streaming/fos/nginx/conf/balance.conf





