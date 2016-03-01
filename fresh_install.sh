#!/bin/bash
apt-get update
echo "Done apt-get"
echo "Installing PHP5-CLI CURL"
echo "Upgrading existing packages and removing the obsolete ones!"
apt-get upgrade -y && apt-get install -f && apt-get autoremove && apt-get autoclean -y > /dev/null
echo "Installing FOS Prerequisites..."
apt-get install php5-cli curl zip unzip sudo nano dialog apt-utils python-software-properties apt nscd lsb-release -y > /dev/null
echo "Done"


chmod 777 /tmp
cd /tmp > /dev/null
rm -rf /tmp/* > /dev/null
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/install_panel.php -O install_panel.php > /dev/null
php install_panel.php > /dev/null
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/my.cnf -O /etc/mysql/my.cnf.replace > /dev/null
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/db_install.sh -O db_install.sh > /dev/null 
chmod 755 db_install.sh > /dev/null
./db_install.sh > /dev/null
