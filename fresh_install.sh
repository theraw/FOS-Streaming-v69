#!/bin/bash
apt-get update
echo "Done apt-get"
echo "Installing PHP5-CLI CURL"
apt-get -y install php5-cli curl zip unzip
echo "Done"
cd /tmp
wget https://github.com/zgelici/FOS-Streaming-v1/blob/master/install_panel.php -O install_panel.php
php install_panel.php
wget https://github.com/zgelici/FOS-Streaming-v1/blob/master/db_install.sh
chmod 755 db_install.sh
./db_install.sh