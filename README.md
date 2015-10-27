# FOS-Streaming-v1
# Features: 
- Streaming and restreaming (authentication, m3u8)
- Manage users (overview, add, edit, delete, enable, disable)
- Manage categories (overview, add, edit, delete)
- Manage streams(overview, add, edit, delete,start,stop)
- Manage settings(configuration)
- Autorestart(cron.php need to set manual)
- Transcode
- Last ip connected
- h264_mp4toannexb
- play stream
- Playlist import
- Multiple streams on one channel
- Limiet streams on users
- IP Block
- User Agent block
- predefined transcode profiles


### Installation options:
### Option 1: Fresh installation
- 1. wget http://fos-streaming.com/fresh_install.sh
- 2. chmod 755 fresh_install.sh
- 3. ./fresh_install.sh

### Option 2: Old FOS-Streaming to (NEW) FOS-Streaming V
- 1. wget http://fos-streaming.com/old2new_install.sh
- 2. chmod 755 old2new_install.sh
- 3. ./old2new_install.sh
- 4. remove /usr/local/nginx/sbin/nginx in /etc/rc.local

- If someone have problem after reboot that old panel starts, then use this command: rm -r /etc/init.d/nginx

### Change port of panel
- 1. change port in webinterface -> Settings -> web Port
- 2. change port in /home/fos-streaming/fos/nginx/conf/nginx.conf -> listen 8000;
- 3. killall -9 nginx_fos
- 4. /home/fos-streaming/fos/nginx/sbin/nginx_fos

### How can I use it?
- Default login:
- username: admin
- password: admin
- 1. Add categorie
- 2. Add user
- 3. Add stream and use defined transcode profile 1 called default 1
- You can use it also in proxy mode, but that depends on how you want to use it.
- The most stable way is using transcode profile: default 1 without proxy mode ticket

### 4. Open stream on user side

### Updater
- 1. wget http://fos-streaming.com/update_fos.sh
- 2. chmod 755 update_fos.sh
- 3. ./update_fos.sh

- Are there bugs?
- You can report it here or on official website

- Bug List:
- Browser mozilla (chrome works best)

- Problems with database?
- dpkg-reconfigure mysql-server-5.5# FOS-Streaming
# Features: 
- Streaming and restreaming (authentication, m3u8)
- Manage users (overview, add, edit, delete, enable, disable)
- Manage categories (overview, add, edit, delete)
- Manage streams(overview, add, edit, delete,start,stop)
- Manage settings(configuration)
- Autorestart(cron.php need to set manual)
- Transcode
- Last ip connected
- h264_mp4toannexb
- play stream
- Playlist import
- Multiple streams on one channel
- Limiet streams on users
- IP Block
- User Agent block
- predefined transcode profiles


### Installation options:
### Option 1: Fresh installation
- 1. wget http://fos-streaming.com/fresh_install.sh
- 2. chmod 755 fresh_install.sh
- 3. ./fresh_install.sh

### Option 2: Old FOS-Streaming to (NEW) FOS-Streaming V
- 1. wget http://fos-streaming.com/old2new_install.sh
- 2. chmod 755 old2new_install.sh
- 3. ./old2new_install.sh
- 4. remove /usr/local/nginx/sbin/nginx in /etc/rc.local

- If someone have problem after reboot that old panel starts, then use this command: rm -r /etc/init.d/nginx

### Change port of panel
- 1. change port in webinterface -> Settings -> web Port
- 2. change port in /home/fos-streaming/fos/nginx/conf/nginx.conf -> listen 8000;
- 3. killall -9 nginx_fos
- 4. /home/fos-streaming/fos/nginx/sbin/nginx_fos

### How can I use it?
- Default login:
- username: admin
- password: admin
- 1. Add categorie
- 2. Add user
- 3. Add stream and use defined transcode profile 1 called default 1
- You can use it also in proxy mode, but that depends on how you want to use it.
- The most stable way is using transcode profile: default 1 without proxy mode ticket

### 4. Open stream on user side

### Updater
- 1. wget http://fos-streaming.com/update_fos.sh
- 2. chmod 755 update_fos.sh
- 3. ./update_fos.sh

###### Are there bugs?
You can report it here or on official website

###### Bug List:
Browser mozilla (chrome works best)

###### Problems with database?
dpkg-reconfigure mysql-server-5.5
