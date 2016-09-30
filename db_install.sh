#!/bin/bash
# This script made by sevano (fos-streaming.com)

echo  "Database Installation"

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

cd /usr/src/
wget https://getcomposer.org/installer 
php installer 
cd /home/fos-streaming/fos/www/  
php /usr/src/composer.phar install  

curl "http://127.0.0.1:8000/install.php?install" 
curl "http://127.0.0.1:8000/install.php?update"
rm -r /home/fos-streaming/fos/www/install.php