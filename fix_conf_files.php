<?php
$cpCommands = [
    "improvement/nginx.conf /home/fos-streaming/fos/nginx/conf/nginx.conf",
    "improvement/php-fpm.conf /home/fos-streaming/fos/php/etc/php-fpm.conf",
    "improvement/www.conf /home/fos-streaming/php/fos/etc/pool.d/www.conf",
    "improvement/balance.conf /home/fos-streaming/fos/nginx/balance.conf"
];
foreach($cpCommands as $command) {
    shell_exec("/bin/cp " . $command);
}