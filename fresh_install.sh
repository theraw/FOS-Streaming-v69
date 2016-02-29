#!/bin/bash
apt-get update
echo "Done apt-get"
echo "Installing PHP5-CLI CURL"
apt-get -y install php5-cli curl zip unzip
echo "Done"
echo "Upgrading existing packages and removing the obsolete ones!"
apt-get upgrade -y && apt-get autoremove -y

cd /tmp
wget -q https://github.com/zgelici/FOS-Streaming-v1/blob/master/install_panel.php -O install_panel.php && php install_panel.php
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/my.cnf -O my.cnf
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/install_panel.php -O db_install.sh && chmod 755 db_install.sh && ./db_install.sh