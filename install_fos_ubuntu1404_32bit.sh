#!/bin/bash

# FUNCTION: Ubuntu 14.04 Check
distro(){
if [ -f /etc/lsb-release ]; then
    . /etc/lsb-release
        if [ $DISTRIB_ID == Ubuntu ]; then
            if [ $DISTRIB_RELEASE != "14.04" ]; then
                error
            fi
        else
            error
        fi
fi
}

# FUNCTION: ERROR
error(){
    sleep 2
    echo -ne '\n'"--PROBLEM!--"
    echo -ne '\n'"Support: https://github.com/zgelici/FOS-Streaming-v1" '\n'
exit
}


# FUNCTION: FOS-Streaming Exist
fosstreamingexist() {
    if [ -d "/home/fos-streaming" ]; then
      echo -ne '\n'"You have already installed fos streaming before?"
      echo "If you want remove fos-streaming"
      echo "killall -9 nginx php-fpm"
      echo  "userdel fosstreaming"
      echo "rm -r /home/fos-streaming"
      exit
    fi
}

# FUNCTION: Packages Install
packages_install(){
    apt-get update >/dev/null 2>&1
    apt-get install -y --force-yes git >/dev/null 2>&1
    apt-get install -y --force-yes install php5-cli curl >/dev/null 2>&1
    apt-get install -y --force-yes libxml2-dev  > /dev/null 2>&1
    apt-get install -y --force-yes libbz2-dev  > /dev/null 2>&1
    apt-get install -y --force-yes curl   > /dev/null 2>&1
    apt-get install -y --force-yes libcurl4-openssl-dev   > /dev/null 2>&1
    apt-get install -y --force-yes libmcrypt-dev  > /dev/null 2>&1
    apt-get install -y --force-yes libmhash2 > /dev/null 2>&1
    apt-get install -y --force-yes libmhash-dev  > /dev/null 2>&1
    apt-get install -y --force-yes libpcre3  > /dev/null 2>&1
    apt-get install -y --force-yes libpcre3-dev  > /dev/null 2>&1
    apt-get install -y --force-yes make  > /dev/null 2>&1
    apt-get install -y --force-yes build-essential  > /dev/null 2>&1
    apt-get install -y --force-yes libxslt1-dev git > /dev/null 2>&1
    apt-get install -y --force-yes libssl-dev > /dev/null 2>&1
    apt-get install -y --force-yes git > /dev/null 2>&1
    apt-get install -y --force-yes php5  > /dev/null 2>&1
    apt-get install -y --force-yes unzip > /dev/null 2>&1
    apt-get install -y --force-yes python-software-properties > /dev/null 2>&1
    apt-get install -y --force-yes libpopt0 > /dev/null 2>&1
    apt-get install -y --force-yes libpq-dev > /dev/null 2>&1
    apt-get install -y --force-yes libpq5 > /dev/null 2>&1
    apt-get install -y --force-yes libpspell-dev > /dev/null 2>&1
    apt-get install -y --force-yes libpthread-stubs0-dev > /dev/null 2>&1
    apt-get install -y --force-yes libpython-stdlib > /dev/null 2>&1
    apt-get install -y --force-yes libqdbm-dev > /dev/null 2>&1
    apt-get install -y --force-yes libqdbm14 > /dev/null 2>&1
    apt-get install -y --force-yes libquadmath0 > /dev/null 2>&1
    apt-get install -y --force-yes librecode-dev > /dev/null 2>&1
    apt-get install -y --force-yes librecode0 > /dev/null 2>&1
    apt-get install -y --force-yes librtmp-dev > /dev/null 2>&1
    apt-get install -y --force-yes librtmp0 > /dev/null 2>&1
    apt-get install -y --force-yes libsasl2-dev > /dev/null 2>&1
    apt-get install -y --force-yes libsasl2-modules > /dev/null 2>&1
    apt-get install -y --force-yes libsctp-dev > /dev/null 2>&1
    apt-get install -y --force-yes libsctp1 > /dev/null 2>&1
    apt-get install -y --force-yes libsensors4 > /dev/null 2>&1
    apt-get install -y --force-yes libsensors4-dev > /dev/null 2>&1
    apt-get install -y --force-yes libsm-dev > /dev/null 2>&1
    apt-get install -y --force-yes libsm6 > /dev/null 2>&1
    apt-get install -y --force-yes libsnmp-base > /dev/null 2>&1
    apt-get install -y --force-yes libsnmp-dev > /dev/null 2>&1
    apt-get install -y --force-yes libsnmp-perl > /dev/null 2>&1
    apt-get install -y --force-yes libsnmp30 > /dev/null 2>&1
    apt-get install -y --force-yes libsqlite3-dev > /dev/null 2>&1
    apt-get install -y --force-yes libssh2-1 > /dev/null 2>&1
    apt-get install -y --force-yes libssh2-1-dev > /dev/null 2>&1
    apt-get install -y --force-yes libssl-dev > /dev/null 2>&1
    apt-get install -y --force-yes libstdc++-4.8-dev > /dev/null 2>&1
    apt-get install -y --force-yes libstdc++6-4.7-dev > /dev/null 2>&1
    apt-get install -y --force-yes libsybdb5 > /dev/null 2>&1
    apt-get install -y --force-yes libtasn1-3-dev > /dev/null 2>&1
    apt-get install -y --force-yes libtasn1-6-dev > /dev/null 2>&1
    apt-get install -y --force-yes libterm-readkey-perl > /dev/null 2>&1
    apt-get install -y --force-yes libtidy-0.99-0 > /dev/null 2>&1
    apt-get install -y --force-yes libtidy-dev > /dev/null 2>&1
    apt-get install -y --force-yes libtiff5 > /dev/null 2>&1
    apt-get install -y --force-yes libtiff5-dev > /dev/null 2>&1
    apt-get install -y --force-yes libtiffxx5 > /dev/null 2>&1
    apt-get install -y --force-yes libtimedate-perl > /dev/null 2>&1
    apt-get install -y --force-yes libtinfo-dev > /dev/null 2>&1
    apt-get install -y --force-yes libtool > /dev/null 2>&1
    apt-get install -y --force-yes libtsan0 > /dev/null 2>&1
    apt-get install -y --force-yes libunistring0 > /dev/null 2>&1
    apt-get install -y --force-yes libvpx-dev > /dev/null 2>&1
    apt-get install -y --force-yes libvpx1 > /dev/null 2>&1
    apt-get install -y --force-yes libwrap0-dev > /dev/null 2>&1
    apt-get install -y --force-yes libx11-6 > /dev/null 2>&1
    apt-get install -y --force-yes libx11-data > /dev/null 2>&1
    apt-get install -y --force-yes libx11-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxau-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxau6 > /dev/null 2>&1
    apt-get install -y --force-yes libxcb1 > /dev/null 2>&1
    apt-get install -y --force-yes libxcb1-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxdmcp-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxdmcp6 > /dev/null 2>&1
    apt-get install -y --force-yes libxml2 > /dev/null 2>&1
    apt-get install -y --force-yes libxml2-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxmltok1 > /dev/null 2>&1
    apt-get install -y --force-yes libxmltok1-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxpm-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxpm4 > /dev/null 2>&1
    apt-get install -y --force-yes libxslt1-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxslt1.1 > /dev/null 2>&1
    apt-get install -y --force-yes libxt-dev > /dev/null 2>&1
    apt-get install -y --force-yes libxt6 > /dev/null 2>&1
    apt-get install -y --force-yes linux-libc-dev > /dev/null 2>&1
    apt-get install -y --force-yes m4 > /dev/null 2>&1
    apt-get install -y --force-yes make > /dev/null 2>&1
    apt-get install -y --force-yes man-db > /dev/null 2>&1
    apt-get install -y --force-yes netcat-openbsd > /dev/null 2>&1
    apt-get install -y --force-yes odbcinst1debian2 > /dev/null 2>&1
    apt-get install -y --force-yes openssl > /dev/null 2>&1
    apt-get install -y --force-yes patch > /dev/null 2>&1
    apt-get install -y --force-yes pkg-config > /dev/null 2>&1
    apt-get install -y --force-yes po-debconf > /dev/null 2>&1
    apt-get install -y --force-yes python > /dev/null 2>&1
    apt-get install -y --force-yes python-minimal > /dev/null 2>&1
    apt-get install -y --force-yes python2.7 > /dev/null 2>&1
    apt-get install -y --force-yes python2.7-minimal > /dev/null 2>&1
    apt-get install -y --force-yes re2c > /dev/null 2>&1
    apt-get install -y --force-yes unixodbc > /dev/null 2>&1
    apt-get install -y --force-yes unixodbc-dev > /dev/null 2>&1
    apt-get install -y --force-yes uuid-dev > /dev/null 2>&1
    apt-get install -y --force-yes x11-common > /dev/null 2>&1
    apt-get install -y --force-yes x11proto-core-dev > /dev/null 2>&1
    apt-get install -y --force-yes x11proto-input-dev > /dev/null 2>&1
    apt-get install -y --force-yes x11proto-kb-dev > /dev/null 2>&1
    apt-get install -y --force-yes xorg-sgml-doctools > /dev/null 2>&1
    apt-get install -y --force-yes libjpeg8 > /dev/null 2>&1
    apt-get install -y --force-yes xtrans-dev > /dev/null 2>&1
    apt-get install -y --force-yes zlib1g-dev > /dev/null 2>&1
    apt-get install -y --force-yes php5-fpm  > /dev/null 2>&1
}

fos_install(){
    /usr/sbin/useradd -s /sbin/nologin -U -d /home/fos-streaming -m fosstreaming > /dev/null
    cd /home/fos-streaming > /dev/null
    wget http://fos-streaming.com/fos-streaming_unpack_i686.tar.gz -O /home/fos-streaming/fos-streaming_unpack_i686.tar.gz  > /dev/null 2>&1
    tar -xzf /home/fos-streaming/fos-streaming_unpack_i686.tar.gz -C /home/fos-streaming/
    rm -rf /home/fos-streaming/fos/www/vendor /home/fos-streaming/fos/www/50x.html > /dev/null 2>&1
    cd /home/fos-streaming/fos/www  > /dev/null 2>&1
    git clone https://github.com/zgelici/FOS-Streaming-v1.git  > /dev/null 2>&1
    cp -R /home/fos-streaming/fos/www/FOS-Streaming-v1/* /home/fos-streaming/fos/www/  > /dev/null 2>&1

    echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffmpeg' >> /etc/sudoers  > /dev/null 2>&1
    echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffprobe' >> /etc/sudoers  > /dev/null 2>&1
    echo '*/2 * * * * www-data /home/fos-streaming/fos/php/bin/php /home/fos-streaming/fos/www/cron.php' >> /etc/crontab  > /dev/null 2>&1

    sed --in-place '/exit 0/d' /etc/rc.local > /dev/null 2>&1
    echo 'sleep 10' >> /etc/rc.local > /dev/null 2>&1
    echo '/home/fos-streaming/fos/nginx/sbin/nginx_fos' >> /etc/rc.local > /dev/null 2>&1
    echo '/home/fos-streaming/fos/php/sbin/php-fpm' >> /etc/rc.local > /dev/null 2>&1
    echo 'exit 0' >> /etc/rc.local > /dev/null 2>&1

    /bin/mkdir /home/fos-streaming/fos/www/hl  > /dev/null 2>&1
    chmod -R 777 /home/fos-streaming/fos/www/hl  > /dev/null 2>&1
    /bin/mkdir /home/fos-streaming/fos/www/cache  > /dev/null 2>&1
    chmod -R 777 /home/fos-streaming/fos/www/cache  > /dev/null 2>&1
    chown www-data:www-data /home/fos-streaming/fos/nginx/conf  > /dev/null 2>&1

    /bin/cp improvement/nginx.conf /home/fos-streaming/fos/nginx/conf/nginx.conf
    /bin/cp improvement/php-fpm.conf /home/fos-streaming/fos/php/etc/php-fpm.conf
    /bin/cp improvement/www.conf /home/fos-streaming/fos/php/etc/pool.d/www.conf
    /bin/cp improvement/balance.conf /home/fos-streaming/fos/nginx/conf/balance.conf

}

startfos(){
    /home/fos-streaming/fos/php/sbin/php-fpm
    /home/fos-streaming/fos/nginx/sbin/nginx_fos
    sleep 3
    curl "http://127.0.0.1:8000/install_database_tables.php?install"
    curl "http://127.0.0.1:8000/install_database_tables.php?update"
    rm -r /home/fos-streaming/fos/www/install_database_tables.php
}

ffmpeg()
{
    wget http://johnvansickle.com/ffmpeg/releases/ffmpeg-release-32bit-static.tar.xz -O /home/fos-streaming/ffmpeg-release-32bit-static.tar.xz  > /dev/null 2>&1
    tar -xJf /home/fos-streaming/ffmpeg-release-32bit-static.tar.xz -C /tmp/ > /dev/null 2>&1
    /bin/cp /tmp/ffmpeg*/ffmpeg  /usr/local/bin/ffmpeg
    /bin/cp /tmp/ffmpeg*/ffprobe /usr/local/bin/ffprobe
    chmod 755 /usr/local/bin/ffmpeg  > /dev/null 2>&1
    chmod 755 /usr/local/bin/ffprobe  > /dev/null 2>&1
    chown www-data:root /usr/local/nginx/html  > /dev/null 2>&1
}

info(){
 echo "********************************************************************************************;
    echo "FOS-Streaming installed.. \n";
    echo "visit management page: 'http://host:8000' \n";
    echo "Login: \n";
    echo "Username: admin \n";
    echo "Password: admin \n";
    echo "database details: \n";
    echo  "hostname: localhost, database_name: " $1 " , database_username: "  $2  " , database_password " $3
    echo "IMPORTANT: After you logged in, go to settings and check your ip-address. \n";
    echo "*****************************************************************************************;
}

database(){

echo ""
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


sed -i 's/xxx/'$sqldatabase'/g' /home/fos-streaming/fos/www/config.php
sed -i 's/zzz/'$sqlpasswd'/g' /home/fos-streaming/fos/www/config.php
sed -i 's/ttt/'$sqluname'/g' /home/fos-streaming/fos/www/config.php

}

echo "FOS-Streaming is installing, you need to wait till the installation gets finished"

fosstreamingexist
distro
packages_install
fos_install
database
ffmpeg
startfos
#test
info

