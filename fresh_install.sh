#!/bin/bash
echo "Updating sources"
apt-get update > /dev/null
echo "Done"
echo "Installing FOS Prerequisites..."
apt-get install php5-cli php5-curl curl zip unzip sudo nano dialog apt-utils python-software-properties apt lsb-release -y > /dev/null
echo "Done"


chmod 777 /tmp > /dev/null
cd /tmp > /dev/null
rm -rf /tmp/* > /dev/null
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/install_panel.php -O install_panel.php > /dev/null
php install_panel.php
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/db_install.sh -O db_install.sh > /dev/null 
chmod 755 db_install.sh > /dev/null
./db_install.sh
