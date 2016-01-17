<?php
include ("config.php");
$username = $_GET['username'];
$password = $_GET['password'];
$setting = Setting::first();

echo 'USERNAME="' .$username  . '";';
echo 'PASSWORD="' .$password  . '";';
echo 'bouquet="' . ($setting->user_agent ? $setting->user_agent : 'FOS-Streaming') . '";';
echo 'directory="/etc/enigma2/iptv.sh";';
echo 'url="http://' . $setting->webip . ':' . $setting->webport  . '/playlist.php?username=' .$username  . '&password=' .$password  . '&e2";';
echo 'rm /etc/enigma2/userbouquet."$bouquet"__tv_.tv;';
echo 'wget -O /etc/enigma2/userbouquet."$bouquet"__tv_.tv '. 'http://' . $setting->webip . ':' . $setting->webport  . ';';
echo 'if !cat /etc/enigma2/bouquets.tv | grep -v grep | grep -c $bouquet > /dev/null;then echo "[+]Creating Folder for iptv and rehashing...";';
echo 'cat /etc/enigma2/bouquets.tv | sed -n 1p > /etc/enigma2/new_bouquets.tv;';
echo 'echo \'#SERVICE 1:7:1:0:0:0:0:0:0:0:FROM BOUQUET "userbouquet.\'$bouquet\'__tv_.tv" ORDER BY bouquet\' >> /etc/enigma2/new_bouquets.tv;';
echo 'cat /etc/enigma2/bouquets.tv | sed -n \'2,$p\' >> /etc/enigma2/new_bouquets.tv;';
echo 'rm /etc/enigma2/bouquets.tv;mv /etc/enigma2/new_bouquets.tv /etc/enigma2/bouquets.tv;fi;rm /usr/bin/enigma2_pre_start.sh;echo "writing to the file.. NO NEED FOR REBOOT";echo "/bin/sh "$directory" > /dev/null 2>&1 &" > /usr/bin/enigma2_pre_start.sh;chmod 777 /usr/bin/enigma2_pre_start.sh;wget -qO - "http://127.0.0.1/web/servicelistreload?mode=2";';
echo 'wget -qO - "http://127.0.0.1/web/servicelistreload?mode=2";';

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="fos.sh"');