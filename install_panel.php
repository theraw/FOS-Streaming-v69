<?php

$we_root = trim(shell_exec("whoami"));
if (strcmp($we_root, "root") !== 0) {
    echo "Please execute this script as root! Exitting...";
    exit;
}

$release_info = shell_exec("lsb_release -i -s");
$arch = shell_exec("uname -m");
echo "Welcome \n";
echo "FOS-Streaming will be installed on your system \n";
echo "Please don't close this session until it's finished \n \n";
echo "1. [Distribution Detection:] ";
echo " [############";

if (strcmp($release_info, "Ubuntu") || strcmp($release_info, "Debian")) {
    echo "]PASS \n";
} else {
    echo "]FAIL. Need Ubuntu or Debian!!! \n";
    //exit();
}
echo "3. [Installing needed files:]";
echo " [#";
$packages = [
    "libxml2-dev",
    "libbz2-dev",
    "libcurl4-openssl-dev ",
    "libmcrypt-dev",
    "libmhash2",
    "libmhash-dev",
    "libpcre3",
    "libpcre3-dev",
    "make",
    "build-essential",
    "libxslt1-dev git",
    "libssl-dev",
    "git",
    "php5",
    "unzip",
    "python-software-properties",
    "libpopt0",
    "libpq-dev",
    "libpq5",
    "libpspell-dev",
    "libpthread-stubs0-dev",
    "libpython-stdlib",
    "libqdbm-dev",
    "libqdbm14",
    "libquadmath0",
    "librecode-dev",
    "librecode0",
    "librtmp-dev",
    "librtmp0",
    "libsasl2-dev",
    "libsasl2-modules",
    "libsctp-dev",
    "libsctp1",
    "libsensors4",
    "libsensors4-dev",
    "libsm-dev",
    "libsm6",
    "libsnmp-base",
    "libsnmp-dev",
    "libsnmp-perl",
    "libsnmp30",
    "libsqlite3-dev",
    "libssh2-1",
    "libssh2-1-dev",
    "libssl-dev",
    "libstdc++-4.8-dev",
    "libstdc++6-4.7-dev",
    "libsybdb5",
    "libtasn1-3-dev",
    "libtasn1-6-dev",
    "libterm-readkey-perl",
    "libtidy-0.99-0",
    "libtidy-dev",
    "libtiff5",
    "libtiff5-dev",
    "libtiffxx5",
    "libtimedate-perl",
    "libtinfo-dev",
    "libtool",
    "libtsan0",
    "libunistring0",
    "libvpx-dev",
    "libvpx1",
    "libwrap0-dev",
    "libx11-6",
    "libx11-data",
    "libx11-dev",
    "libxau-dev",
    "libxau6",
    "libxcb1",
    "libxcb1-dev",
    "libxdmcp-dev",
    "libxdmcp6",
    "libxml2",
    "libxml2-dev",
    "libxmltok1",
    "libxmltok1-dev",
    "libxpm-dev",
    "libxpm4",
    "libxslt1-dev",
    "libxslt1.1",
    "libxt-dev",
    "libxt6",
    "linux-libc-dev",
    "m4",
    "make",
    "man-db",
    "netcat-openbsd",
    "odbcinst1debian2",
    "openssl",
    "patch",
    "pkg-config",
    "po-debconf",
    "python",
    "python-minimal",
    "python2.7",
    "python2.7-minimal",
    "re2c",
    "unixodbc",
    "unixodbc-dev",
    "uuid-dev",
    "x11-common",
    "x11proto-core-dev",
    "x11proto-input-dev",
    "x11proto-kb-dev",
    "xorg-sgml-doctools",
    "libjpeg8",
    "xtrans-dev",
    "zlib1g-dev",
    "php5-fpm"];
$pak_inst = 0;
foreach ($packages as $package) {
    $pack_status = shell_exec('dpkg-query -W -f=\'${Status}\\n\' ' . $package);
    $c = preg_match("/install ok installed/i", $pack_status);
    if ($c == 0) {
        shell_exec("apt-get install -y -f --force-yes $package");
    }
    $pak_inst++;
    if ($pak_inst == 4) {
        echo "#";
        $pak_inst = 0;
    }
}
echo "]PASS \n";

$filename = '/home/fos-streaming';
if (file_exists($filename)) {
    shell_exec("killall -9 ffmpeg php5-fpm php-fpm nginx_fos nginx");
    shell_exec("service php5-fpm stop");
    shell_exec("/bin/rm -r /usr/src/FOS-Streaming");
    shell_exec("/bin/rm -r /usr/src/ffmpeg");
    shell_exec("/bin/rm -r /usr/bin/composer.phar");
    shell_exec("/bin/rm -r /usr/src/installer*");
    shell_exec("/bin/rm -r /home/fos-streaming/*");
    shell_exec("deluser fosstreaming -q");
    shell_exec("delgroup fosstreaming -q");
}


echo "4. [FOS-Panel Installation:] ";
echo " [#";

shell_exec("/usr/sbin/useradd -s /sbin/nologin -U -d /home/fos-streaming -m fosstreaming");
shell_exec("mkdir /home/fos-streaming/fos");
shell_exec("mkdir /home/fos-streaming/fos/www");

echo "##";

function GetFos() {
    shell_exec("git clone https://github.com/zgelici/FOS-Streaming-v1.git /usr/src/FOS-Streaming/");
    shell_exec("/bin/mv /usr/src/FOS-Streaming/* /home/fos-streaming/fos/www/");
    shell_exec("wget https://getcomposer.org/installer -O /usr/src/installer ");
    shell_exec("/usr/bin/php /usr/src/installer --quiet");
    shell_exec("/bin/cp /tmp/composer.phar /usr/bin/composer.phar");
	shell_exec("chmod +x /usr/bin/composer.phar");
    shell_exec("/usr/bin/composer.phar install  -d  /home/fos-streaming/fos/www/");
}

function AddSudo() {
    shell_exec("echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffmpeg' >> /etc/sudoers");
    shell_exec("echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffprobe' >> /etc/sudoers");
    shell_exec("echo '*/2 * * * * www-data /usr/bin/php /home/fos-streaming/fos/www/cron.php' >> /etc/crontab");
}

function AddRCLocal() {
    shell_exec("sed --in-place '/exit 0/d' /etc/rc.local");
    shell_exec("echo 'sleep 10' >> /etc/rc.local");
    shell_exec("echo '/home/fos-streaming/fos/nginx/sbin/nginx_fos' >> /etc/rc.local");
    shell_exec("echo '/home/fos-streaming/fos/php/sbin/php-fpm' >> /etc/rc.local");
    shell_exec("echo 'exit 0' >> /etc/rc.local");
}

function BuildWeb() {
    shell_exec("mkdir /home/fos-streaming/fos/streams ");
    shell_exec("chmod -R 777 /home/fos-streaming/fos/streams ");
    shell_exec("/bin/mkdir /home/fos-streaming/fos/www/cache ");
    shell_exec("chmod -R 777 /home/fos-streaming/fos/www/cache ");
    shell_exec("chown www-data:www-data /home/fos-streaming/fos/nginx/conf ");

    shell_exec("/home/fos-streaming/fos/php/sbin/php-fpm");
    shell_exec("/home/fos-streaming/fos/nginx/sbin/nginx_fos");
}

function GetFOSResources($arch) {
    if (stristr($arch, '64')) {
        $fos = "fos-streaming_unpack_x84_64.tar.gz";
    } else {
        $fos = "fos-streaming_unpack_i686.tar.gz";
    }
    shell_exec("wget http://198.20.126.212/{$fos} -O /home/fos-streaming/{$fos} ");
    shell_exec("tar -xzf /home/fos-streaming/{$fos} -C /home/fos-streaming/");
    shell_exec("/bin/rm -r /home/fos-streaming/{$fos} ");
    shell_exec("/bin/mkdir /usr/src/FOS-Streaming");
}

function CleanUP() {
    shell_exec("/bin/rm -r /home/fos-streaming/*-static.tar.xz  ");
    shell_exec("/bin/rm -r /usr/src/composer.phar");
    shell_exec("/bin/rm -r /usr/src/ffmpeg");
    shell_exec("/bin/rm -r /usr/src/FOS-Streaming");
    shell_exec("/bin/rm -r /usr/src/installer*");
}

function GetIP() {
    $ip_address = explode("\n", shell_exec("/sbin/ifconfig | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'"));

    foreach ($ip_address as $addr) {
        if (strncmp("127", $addr, 3) !== 0) {
            $result = $addr;
            break;
        }
    }
    return $result;
}

function DeployFF() {
    shell_exec("/bin/cp /usr/src/ffmpeg/ffmpeg  /usr/local/bin/ffmpeg");
    shell_exec("/bin/cp /usr/src/ffmpeg/ffprobe /usr/local/bin/ffprobe");
	shell_exec("chmod 755 /usr/local/bin/ffmpeg ");
    shell_exec("chmod 755 /usr/local/bin/ffprobe ");
}

GetFOSResources($arch);
echo "##";
GetFos();
echo "#";
AddSudo();
echo "#";
AddRCLocal();
echo "#";
BuildWeb();
echo "#";
if (stristr($arch, '64')) {
    $ffmpeg = "ffmpeg-x86_64-static.tar.xz";
} else {
    $ffmpeg = "ffmpeg-i686-static.tar.xz";
}
shell_exec("wget -q http://198.20.126.212/{$ffmpeg} -O /home/fos-streaming/{$ffmpeg}");
shell_exec("/bin/mkdir /usr/src/ffmpeg");
shell_exec("/bin/tar -xJf /home/fos-streaming/{$ffmpeg} -C /usr/src/ffmpeg");
echo "##";
DeployFF();
echo "#";
shell_exec("chown www-data:root /home/fos-streaming/fos/nginx/html ");
echo "#";
CleanUP();
echo "]PASS \n";

$srv_ip = GetIP();
echo "******************************************************************************************** \n";
echo "FOS-Streaming installed.. \n";
echo "visit management page: 'http://{$srv_ip}:8000' \n";
echo "Login: \n";
echo "Username: admin \n";
echo "Password: admin \n";
echo "IMPORTANT: After you logged in, go to settings and check your ip-address. \n";
echo "******************************************************************************************** \n";
