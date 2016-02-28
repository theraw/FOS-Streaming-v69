# FOS-Streaming-v1
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

## Installation options:
### Option 1: Fresh installation
1. `wget http://fos-streaming.com/fresh_install.sh`
2. `chmod 755 fresh_install.sh`
3. `./fresh_install.sh`

### Option 2: Old FOS-Streaming to (NEW) FOS-Streaming V
1. `wget http://fos-streaming.com/old2new_install.sh`
2. `chmod 755 old2new_install.sh`
3. `./old2new_install.sh`
  - remove /usr/local/nginx/sbin/nginx in /etc/rc.local

If someone have problem after reboot that old panel starts, then use this command: rm -r /etc/init.d/nginx

### Change port of panel
1. change port in webinterface -> Settings -> web Port
2. change port in /home/fos-streaming/fos/nginx/conf/nginx.conf -> listen 8000;
3. `killall -9 nginx_fos`
4. `/home/fos-streaming/fos/nginx/sbin/nginx_fos`

## How can I use it?
- Default login: admin / admin
  - Add user
  - Add stream and use defined transcode profile 1 called **Default 1**
- You can use it also in proxy mode, but that depends on how you want to use it.
- The most stable way is using transcode profile: **Default 1** without proxy mode ticket

## Updater
1. `wget http://fos-streaming.com/update_fos.sh`
2. `chmod 755 update_fos.sh`
3. `./update_fos.sh`

Are there bugs?
You can report it here or on official website

Bug List:
- Stream (activity, limit connection)
- Stream kill active stream, switch
- Problems with database?
- dpkg-reconfigure mysql-server-5.5# FOS-Streaming

## Commercial rights
- You may charge for installation, support and modification.
- You may Any significant modifications must be sent back to the author (me), under Open Source agreement.
- You may not Rename the plugin.
- You may not sell this plugin to anyone.

## Contribution
Contribution are always **welcome and recommended**! Here is how:

1. Fork the repository ([here is the guide](https://help.github.com/articles/fork-a-repo/)).
2. Clone to your machine `git clone https://github.com/YOUR_USERNAME/FOS-Streaming-v1.git`
3. Make your changes
4. Create a pull request

### Contribution Requirements:

- When you contribute, you agree to give a non-exclusive license to Tyfix to use that contribution in any context as we (Tyfix) see appropriate.
- If you use content provided by another party, it must be appropriately licensed using an [open source](http://opensource.org/licenses) license.
- Contributions are only accepted through Github pull requests.

## License
Fos-Streamining is an open source project by [Tyfix](https://tyfix.nl that is licensed under [MIT](http://opensource.org/licenses/MIT). Tyfix
reserves the right to change the license of future releases.


Donations are **greatly appreciated!**

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif "Tyfix ")](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ATJFKYPFY65W "Donate")
