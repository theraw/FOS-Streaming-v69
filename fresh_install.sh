#!/bin/bash
apt-get update
echo "Done apt-get"
echo "Installing PHP5-CLI CURL"
apt-get -y install php5-cli curl
echo "Done"
cd /tmp
wget http://fos-streaming.com/install.php.1
mv install.php.1 install.php
php install.php
wget http://fos-streaming.com/db_install.sh
chmod 755 db_install.sh
./db_install.sh