#!/bin/bash
echo "Updating sources"
apt-get update > /dev/null
echo "Done"
echo "Installing FOS Prerequisites..."
apt-get install php5-cli php5-curl curl zip unzip sudo nano dialog apt-utils python-software-properties apt lsb-release -y > /dev/null
echo "Done"


chmod 777 /tmp > /dev/null
rm -rf ~/bin  > /dev/null
rm -rf ~/ffmpeg*  > /dev/null
cd /tmp > /dev/null
rm -rf /tmp/* > /dev/null
echo "FOS-Streaming -> Web Platform"
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/install_panel.php -O install_panel.php > /dev/null
php install_panel.php
echo "FOS-Streaming -> Database Deployment"
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/db_install.sh -O db_install.sh > /dev/null 
chmod 755 db_install.sh > /dev/null
./db_install.sh
if [ ! -f /usr/bin/ffmpeg ]; then
echo "FOS-Streaming -> FFmpeg and FFprobe installation"
wget -q https://raw.githubusercontent.com/zgelici/FOS-Streaming-v1/master/ffmpeg_install.sh -O ffmpeg_install.sh > /dev/null
chmod 755 ffmpeg_install.sh > /dev/null
./ffmpeg_install.sh
fi
chown fosstreaming:fosstreaming /usr/bin/ff*
chown -R fosstreaming:fosstreaming /home/fos-streaming
