# FOS-Streaming-v69
## Features:
- Streaming and restreaming (authentication, m3u8)
- Manage users (overview, add, edit, delete, enable, disable)
- Manage categories (overview, add, edit, delete)
- Manage streams (overview, add, edit, delete,start,stop)
- Manage settings (configuration)
- Autorestart (cron.php need to set manual)
- Transcode
- Last IP connected
- h264_mp4toannexb
- play stream
- Playlist import
- Multiple streams on one channel
- Limit streams on users
- IP Block
- User Agent block
- predefined transcode profiles


## Installation
1. **`SUPPORTED DISTRO : Debian 9, 64 BIT`**
2. **`curl -s https://raw.githubusercontent.com/theraw/FOS-Streaming-v69/master/install/debian9 | bash`**
3. **`Visit : http://your-ip:7777/ login with User : admin Password : admin`**
4. **`Change "Web ip: *" with your public IPv4 server ip at http://your-ip:7777/settings.php`**
5. crontab -e `*/2 * * * * /etc/alternatives/php /home/fos-streaming/fos/www/cron.php`
6. **`Mysql Password : cat /root/MYSQL_ROOT_PASSWORD`**


### Change port of panel
1. change port in webinterface -> Settings -> web Port
2. change port in /home/fos-streaming/fos/nginx/conf/nginx.conf -> listen 8000;
3. `killall nginx; killall nginx_fos`
4. `/home/fos-streaming/fos/nginx/sbin/nginx`

## How can I use it?
- Default login: admin / admin
  - Add user
  - Add stream and use defined transcode profile 1 called **Default 1**
- You can use it also in proxy mode, but that depends on how you want to use it.
- The most stable way is using transcode profile: **Default 1** without proxy mode ticket

## Sources
1. FOS-Streaming-v1
2. ffmpeg
3. nginx, nginx-rtmp-module, nginx-geoip2-module
