#!/bin/bash
# This script made by sevano (fos-streaming.com)

echo  "Database Installation"

read -p "Choose your MySQL database name: " sqldatabase
read -p "Enter your MySQL username(usual 'root'): " sqluname 
read -rep $'Enter your MySQL password (ENTER for none):' sqlpasswd

echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
echo "phpmyadmin phpmyadmin/app-password-confirm password $sqlpasswd" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/admin-pass password $sqlpasswd" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/app-pass password $sqlpasswd" | debconf-set-selections
echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections

UP=$(pgrep mysql | wc -l);
if [ "$UP" -ne 1 ];
then
if [ -f /etc/init.d/mysql* ]; then
    service mysql start
else 
echo "$VAR"
VAR=$(expect -c '
spawn apt-get -y install mysql-server
expect "New password for the MySQL \"root\" user:"
send "$sqlpasswd\r"
expect "Repeat password for the MySQL \"root\" user:"
send "$sqlpasswd\r"
expect eof
')
    
fi
    
fi
apt-get install -y mysql-client php5-mysql mysql-common > /dev/null 2>$1

mysql -uroot -p$sqlpasswd -e "CREATE DATABASE $sqldatabase"
mysql -uroot -p$sqlpasswd -e "grant all privileges on $sqldatabase.* to '$sqluname'@'localhost' identified by '$sqlpasswd'"

echo  "hostname: localhost, database_name: " $sqldatabase " , database_username: "  $sqluname  " , database_password " $sqlpasswd
echo "\n "

sed -i 's/xxx/'$sqldatabase'/g' /home/fos-streaming/fos/www/config.php  
sed -i 's/zzz/'$sqlpasswd'/g' /home/fos-streaming/fos/www/config.php 
sed -i 's/ttt/'$sqluname'/g' /home/fos-streaming/fos/www/config.php

cd /home/fos-streaming/fos/www/
/usr/bin/composer.phar install

curl "http://127.0.0.1:8000/install.php?install" 
curl "http://127.0.0.1:8000/install.php?update"

cp /etc/mysql/my.cnf /etc/mysql/my.cnf.original
cat my.cnf > /etc/mysql/my.cnf
cp fos-streaming.conf /etc/sysctl.d/

service mysql restart
sysctl -p

rm -rf fos-streaming.conf
rm -rf my.cnf
rm -rf *install*
rm -rf /tmp/*
rm -rf /usr/src/*