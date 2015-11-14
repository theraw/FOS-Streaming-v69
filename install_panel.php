<?php
if (strtolower(substr(PHP_OS, 0, 5)) === 'linux')
{
    $release_info = array();
    $files = glob('/etc/*-release');

    foreach ($files as $file)
    {
        $lines = array_filter(array_map(function($line) {
            $parts = explode('=', $line);
            if (count($parts) !== 2) return false;
            $parts[1] = str_replace(array('"', "'"), '', $parts[1]);
            return $parts;

        }, file($file)));

        foreach ($lines as $line)
            $release_info[$line[0]] = $line[1];
    }

#print_r($release_info);
}
$arch = shell_exec( "uname -m" );
echo "Welcome \n";
echo "FOS-Streaming will be installed on your system \n";
echo "Please don't close this session until it's finished \n \n";
echo "1. [Distribution Detection:] ";
echo " [############";
if (trim($release_info["DISTRIB_ID"]) == "Ubuntu") {
    echo "]PASS \n";
}
elseif (trim($release_info["DISTRIB_ID"]) == "Debian") {
    echo "]PASS \n";
}
else {
    echo "]FAIL \n";
    echo "///////////////////////////////////////////////////// \n";
    echo " Report this problem on www.fos-streaming.com \n";
    echo ' Distro: ' . $release_info["DISTRIB_ID"] . "\n ";
    echo 'Version: ' . $release_info["DISTRIB_RELEASE"]  . "\n ";
    echo 'Codename: ' . $release_info["DISTRIB_CODENAME"]  . "\n ";
    echo 'Discription: ' . $release_info["DISTRIB_DESCRIPTION"] . "\n ";
    echo $arch;
    echo "///////////////////////////////////////////////////// \n";
    die();
}
echo "2. [Arch Detection:]         ";
echo " [############";
if(trim($arch) == "x86_64") {
    echo "]PASS \n";
    echo "3. [Installing needed files:]";
    echo " [#";
    shell_exec("apt-get install -y --force-yes libxml2-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libbz2-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libcurl4-openssl-dev   > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libmcrypt-dev  > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libmhash2 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libmhash-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpcre3  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpcre3-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes make  > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes build-essential  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxslt1-dev git > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssl-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes git > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes php5  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes unzip > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes python-software-properties > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpopt0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpq-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpq5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpspell-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libpthread-stubs0-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpython-stdlib > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libqdbm-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libqdbm14 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libquadmath0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librecode-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librecode0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librtmp-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librtmp0 > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libsasl2-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsasl2-modules > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsctp-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsctp1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsensors4 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsensors4-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsm-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsm6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsnmp-base > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsnmp-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libsnmp-perl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsnmp30 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsqlite3-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssh2-1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssh2-1-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssl-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libstdc++-4.8-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libstdc++6-4.7-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libsybdb5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtasn1-3-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtasn1-6-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libterm-readkey-perl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtidy-0.99-0 > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libtidy-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtiff5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtiff5-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtiffxx5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtimedate-perl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtinfo-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtool > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtsan0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libunistring0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libvpx-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libvpx1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libwrap0-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libx11-6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libx11-data > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libx11-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxau-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxau6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxcb1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxcb1-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libxdmcp-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxdmcp6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxml2 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxml2-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxmltok1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxmltok1-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxpm-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxpm4 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxslt1-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxslt1.1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxt-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxt6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes linux-libc-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes m4 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes make > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes man-db > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes netcat-openbsd > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes odbcinst1debian2 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes openssl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes patch > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes pkg-config > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes po-debconf > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python-minimal > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python2.7 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python2.7-minimal > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes re2c > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes unixodbc > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes unixodbc-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes uuid-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes x11-common > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes x11proto-core-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes x11proto-input-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes x11proto-kb-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes xorg-sgml-doctools > /dev/null 2>&1");
    shell_exec("apt-get install -y libjpeg8 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes xtrans-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes zlib1g-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes php5-fpm  > /dev/null 2>&1");
    echo "]PASS \n";

    echo "4. [FOS-Panel Installation:] ";
    echo " [#";

    $filename =  '/usr/src/FOS-Streaming';
    if (file_exists($filename)) {
        shell_exec("/bin/rm -r /usr/src/FOS-Streaming > /dev/null 2>&1");
    } else {

    }
    shell_exec("/usr/sbin/useradd -s /sbin/nologin -U -d /home/fos-streaming -m fosstreaming > /dev/null");
    echo "##";
    shell_exec("wget http://fos-streaming.com/fos-streaming_unpack_x84_64.tar.gz -O /home/fos-streaming/fos-streaming_unpack_x84_64.tar.gz  > /dev/null 2>&1");
    shell_exec("tar -xzf /home/fos-streaming/fos-streaming_unpack_x84_64.tar.gz -C /home/fos-streaming/ > /dev/null 2>&1");
    shell_exec("/bin/rm -r /home/fos-streaming/fos-streaming_unpack_x84_64.tar.gz  > /dev/null 2>&1");
    shell_exec("/bin/mkdir /usr/src/FOS-Streaming > /dev/null 2>&1");
    echo "##";
    shell_exec("git clone https://github.com/zgelici/FOS-Streaming-v1.git /usr/src/FOS-Streaming/ > /dev/null 2>&1");
    shell_exec("/bin/mv /usr/src/FOS-Streaming/* /home/fos-streaming/fos/www/ > /dev/null 2>&1");
    shell_exec("wget https://getcomposer.org/installer -O /usr/src/installer  > /dev/null 2>&1");
    shell_exec("/usr/bin/php /usr/src/installer > /dev/null 2>&1");
    shell_exec("/bin/cp /usr/src/composer.phar /usr/bin/composer.phar > /dev/null 2>&1");
    shell_exec("/usr/bin/composer.phar install  -d  /home/fos-streaming/fos/www/ > /dev/null 2>&1");
    echo "#";
    shell_exec("echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffmpeg' >> /etc/sudoers");
    shell_exec("echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffprobe' >> /etc/sudoers");
    shell_exec("echo '*/2 * * * * www-data /usr/bin/php /home/fos-streaming/fos/www/cron.php' >> /etc/crontab");
    echo "#";
    shell_exec("sed --in-place '/exit 0/d' /etc/rc.local");
    shell_exec("echo 'sleep 10' >> /etc/rc.local");
    shell_exec("echo '/home/fos-streaming/fos/nginx/sbin/nginx_fos' >> /etc/rc.local");
    shell_exec("echo '/home/fos-streaming/fos/php/sbin/php-fpm' >> /etc/rc.local");
    shell_exec("echo 'exit 0' >> /etc/rc.local");

    echo "#";
    shell_exec("/bin/mkdir /home/fos-streaming/fos/www/hl  > /dev/null 2>&1");
    shell_exec("chmod -R 777 /home/fos-streaming/fos/www/hl  > /dev/null 2>&1");
    shell_exec("/bin/mkdir /home/fos-streaming/fos/www/cache  > /dev/null 2>&1");
    shell_exec("chmod -R 777 /home/fos-streaming/fos/www/cache  > /dev/null 2>&1");
    shell_exec("chown www-data:www-data /home/fos-streaming/fos/nginx/conf  > /dev/null 2>&1");

    shell_exec("/home/fos-streaming/fos/php/sbin/php-fpm");
    shell_exec("/home/fos-streaming/fos/nginx/sbin/nginx_fos");
    echo "#";
    shell_exec("wget http://johnvansickle.com/ffmpeg/releases/ffmpeg-release-64bit-static.tar.xz -O /home/fos-streaming/ffmpeg-release-64bit-static.tar.xz  > /dev/null 2>&1");
    shell_exec("/bin/mkdir /usr/src/ffmpeg > /dev/null 2>&1");
    shell_exec("tar -xJf /home/fos-streaming/ffmpeg-release-64bit-static.tar.xz -C /usr/src/ffmpeg > /dev/null 2>&1");
    shell_exec("/bin/cp /usr/src/ffmpeg/ffmpeg*/ffmpeg  /usr/local/bin/ffmpeg");
    echo "#";
    shell_exec("/bin/cp /usr/src/ffmpeg/ffmpeg*/ffprobe /usr/local/bin/ffprobe");
    echo "#";
    shell_exec("chmod 755 /usr/local/bin/ffmpeg  > /dev/null 2>&1");
    shell_exec("chmod 755 /usr/local/bin/ffprobe  > /dev/null 2>&1");
    echo "#";
    shell_exec("chown www-data:root /usr/local/nginx/html  > /dev/null 2>&1");
    echo "#";
#shell_exec("/bin/rm -r /usr/src/ffmpeg  > /dev/null 2>&1");
#shell_exec("/bin/rm -r /home/fos-streaming/ffmpeg-release-64bit-static.tar.xz   > /dev/null 2>&1");
    echo "]PASS \n";
    echo "******************************************************************************************** \n";
    echo "FOS-Streaming installed.. \n";
    echo "visit management page: 'http://host:8000' \n";
    echo "Login: \n";
    echo "Username: admin \n";
    echo "Password: admin \n";
    echo "database details: \n";
    echo "IMPORTANT: After you logged in, go to settings and check your ip-address. \n";
    echo "******************************************************************************************** \n";


}
elseif(trim($arch) == "i686") {
    echo "]PASS \n";

    echo "3. [Installing needed files:]";
    echo " [#";
    shell_exec("apt-get install -y --force-yes libxml2-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libbz2-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libcurl4-openssl-dev   > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libmcrypt-dev  > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libmhash2 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libmhash-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpcre3  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpcre3-dev  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes make  > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes build-essential  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxslt1-dev git > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssl-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes git > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes php5  > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes unzip > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes python-software-properties > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpopt0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpq-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpq5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpspell-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libpthread-stubs0-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libpython-stdlib > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libqdbm-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libqdbm14 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libquadmath0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librecode-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librecode0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librtmp-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes librtmp0 > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libsasl2-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsasl2-modules > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsctp-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsctp1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsensors4 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsensors4-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsm-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsm6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsnmp-base > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsnmp-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libsnmp-perl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsnmp30 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libsqlite3-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssh2-1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssh2-1-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libssl-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libstdc++-4.8-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libstdc++6-4.7-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libsybdb5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtasn1-3-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtasn1-6-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libterm-readkey-perl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtidy-0.99-0 > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libtidy-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtiff5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtiff5-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtiffxx5 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtimedate-perl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtinfo-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtool > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libtsan0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libunistring0 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libvpx-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libvpx1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libwrap0-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libx11-6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libx11-data > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libx11-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxau-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxau6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxcb1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxcb1-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes libxdmcp-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxdmcp6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxml2 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxml2-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxmltok1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxmltok1-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxpm-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxpm4 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxslt1-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxslt1.1 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxt-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes libxt6 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes linux-libc-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes m4 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes make > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes man-db > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes netcat-openbsd > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes odbcinst1debian2 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes openssl > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes patch > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes pkg-config > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes po-debconf > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python-minimal > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python2.7 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes python2.7-minimal > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes re2c > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes unixodbc > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes unixodbc-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes uuid-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes x11-common > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes x11proto-core-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes x11proto-input-dev > /dev/null 2>&1");
    echo "#";
    shell_exec("apt-get install -y --force-yes x11proto-kb-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes xorg-sgml-doctools > /dev/null 2>&1");
    shell_exec("apt-get install -y libjpeg8 > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes xtrans-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes zlib1g-dev > /dev/null 2>&1");
    shell_exec("apt-get install -y --force-yes php5-fpm  > /dev/null 2>&1");
    echo "]PASS \n";

    echo "4. [FOS-Panel Installation:] ";
    echo " [#";

    $filename =  '/usr/src/FOS-Streaming';
    if (file_exists($filename)) {
        shell_exec("/bin/rm -r /usr/src/FOS-Streaming > /dev/null 2>&1");
    } else {

    }
    shell_exec("/usr/sbin/useradd -s /sbin/nologin -U -d /home/fos-streaming -m fosstreaming > /dev/null");
    echo "##";
    shell_exec("wget http://fos-streaming.com/fos-streaming_unpack_i686.tar.gz -O /home/fos-streaming/fos-streaming_unpack_i686.tar.gz  > /dev/null 2>&1");
    shell_exec("tar -xzf /home/fos-streaming/fos-streaming_unpack_i686.tar.gz -C /home/fos-streaming/ > /dev/null 2>&1");
    shell_exec("/bin/rm -r /home/fos-streaming/fos-streaming_unpack_i686.tar.gz  > /dev/null 2>&1");
    shell_exec("/bin/mkdir /usr/src/FOS-Streaming > /dev/null 2>&1");
    echo "##";
    shell_exec("git clone https://github.com/zgelici/FOS-Streaming-v1.git /usr/src/FOS-Streaming/ > /dev/null 2>&1");
    shell_exec("/bin/mv /usr/src/FOS-Streaming/* /home/fos-streaming/fos/www/ > /dev/null 2>&1");
    shell_exec("wget https://getcomposer.org/installer -O /usr/src/installer  > /dev/null 2>&1");
    shell_exec("/usr/bin/php /usr/src/installer > /dev/null 2>&1");
    shell_exec("/bin/cp /usr/src/composer.phar /usr/bin/composer.phar > /dev/null 2>&1");
    shell_exec("/usr/bin/composer.phar install  -d  /home/fos-streaming/fos/www/ > /dev/null 2>&1");
    echo "#";
    shell_exec("echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffmpeg' >> /etc/sudoers");
    shell_exec("echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffprobe' >> /etc/sudoers");
    shell_exec("echo '*/2 * * * * www-data /usr/bin/php /home/fos-streaming/fos/www/cron.php' >> /etc/crontab");
    echo "#";
    shell_exec("sed --in-place '/exit 0/d' /etc/rc.local");
    shell_exec("echo 'sleep 10' >> /etc/rc.local");
    shell_exec("echo '/home/fos-streaming/fos/nginx/sbin/nginx_fos' >> /etc/rc.local");
    shell_exec("echo '/home/fos-streaming/fos/php/sbin/php-fpm' >> /etc/rc.local");
    shell_exec("echo 'exit 0' >> /etc/rc.local");

    echo "#";
    shell_exec("/bin/mkdir /home/fos-streaming/fos/www/hl  > /dev/null 2>&1");
    shell_exec("chmod -R 777 /home/fos-streaming/fos/www/hl  > /dev/null 2>&1");
    shell_exec("/bin/mkdir /home/fos-streaming/fos/www/cache  > /dev/null 2>&1");
    shell_exec("chmod -R 777 /home/fos-streaming/fos/www/cache  > /dev/null 2>&1");
    shell_exec("chown www-data:www-data /home/fos-streaming/fos/nginx/conf  > /dev/null 2>&1");

    shell_exec("/home/fos-streaming/fos/php/sbin/php-fpm");
    shell_exec("/home/fos-streaming/fos/nginx/sbin/nginx_fos");
    echo "#";
    shell_exec("wget http://johnvansickle.com/ffmpeg/releases/ffmpeg-release-32bit-static.tar.xz -O /home/fos-streaming/ffmpeg-release-32bit-static.tar.xz  > /dev/null 2>&1");
    shell_exec("/bin/mkdir /usr/src/ffmpeg > /dev/null 2>&1");
    shell_exec("tar -xJf /home/fos-streaming/ffmpeg-release-32bit-static.tar.xz -C /usr/src/ffmpeg > /dev/null 2>&1");
    shell_exec("/bin/cp /usr/src/ffmpeg/ffmpeg*/ffmpeg  /usr/local/bin/ffmpeg");
    echo "#";
    shell_exec("/bin/cp /usr/src/ffmpeg/ffmpeg*/ffprobe  /usr/local/bin/ffprobe");
    echo "#";
    shell_exec("chmod 755 /usr/local/bin/ffmpeg  > /dev/null 2>&1");
    shell_exec("chmod 755 /usr/local/bin/ffprobe  > /dev/null 2>&1");
    echo "#";
    shell_exec("chown www-data:root /usr/local/nginx/html  > /dev/null 2>&1");
    echo "#";
#shell_exec("/bin/rm -r /usr/src/ffmpeg");
#shell_exec("/bin/rm -r /home/fos-streaming/ffmpeg-release-32bit-static.tar.xz   > /dev/null 2>&1");
    echo "]PASS \n";
    echo "******************************************************************************************** \n";
    echo "FOS-Streaming installed.. \n";
    echo "visit management page: 'http://host:8000' \n";
    echo "Login: \n";
    echo "Username: admin \n";
    echo "Password: admin \n";
    echo "database details: \n";
    echo "IMPORTANT: After you logged in, go to settings and check your ip-address. \n";
    echo "******************************************************************************************** \n";



}
else {
    echo "]FAIL \n";
    echo "///////////////////////////////////////////////////// \n";
    echo " Report this problem on www.fos-streaming.com \n";
    echo ' Distro: ' . $release_info["DISTRIB_ID"] . "\n ";
    echo 'Version: ' . $release_info["DISTRIB_RELEASE"]  . "\n ";
    echo 'Codename: ' . $release_info["DISTRIB_CODENAME"]  . "\n ";
    echo 'Discription: ' . $release_info["DISTRIB_DESCRIPTION"] . "\n ";
    echo $arch;
    echo "///////////////////////////////////////////////////// \n";
    die();
}
?>
