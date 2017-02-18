<?php
include('config.php');
set_time_limit(0);
error_reporting(0);
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $agent = $_SERVER['HTTP_USER_AGENT'];
}


if (empty($_GET['username']) || empty($_GET['password'])) {
    $error = "Username or Password is invalid";
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    header('Status: 404 Not Found');
    die();
}

$user = User::where('username', '=', $_GET['username'])->where('password', '=', $_GET['password'])->where('active', '=', 1)->first();
if (!$user) {
    die();
}


$setting = Setting::first();

if (isset($_GET['e2'])) {
    echo "#NAME FOS-Streaming \r\n";
    foreach ($user->categories as $category) {
        foreach ($category->streams as $stream) {
            if ($stream->running == 1) {
                echo "#SERVICE 1:0:1:0:0:0:0:0:0:0:http%3A//" . $setting->webip . "%3A" . $setting->webport . "/live/" . $user->username . "/" . $user->password . "/" . $stream->id . "\r\n";
                echo "#DESCRIPTION " . $stream->name . "\r\n";
            }
        }
    }
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="userbouquet.favourites.tv"');
    die;
}

if (isset($_GET['m3u'])) {
    echo "#EXTM3U \r\n";
    foreach ($user->categories as $category) {
        foreach ($category->streams as $stream) {

            if ($stream->running == 1) {
                if (strlen(strstr($agent, 'Kodi')) > 0) {
                    echo "#EXTINF:0 tvg-logo=\"" . $stream->logo . "\" tvg-id=\"" . $stream->tvid . "\" ,[COLOR green]" . $stream->name . "[/COLOR]\r\n";
                } else {
                    echo "#EXTINF:0 tvg-logo=\"" . $setting->logourl . "" . $stream->logo . "\" tvg-id=\"" . $stream->tvid . "\" ," . $stream->name . "\r\n";
                }
                echo "http://" . $setting->webip . ":" . $setting->webport . "/live/" . $user->username . "/" . $user->password . "/" . $stream->id . "\r\n";
            }
        }
    }
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="tv_user.m3u"');
    die;
}

if (isset($_GET['allfrtvwindows'])) {
    echo "<?xml version=\"1.0\"?> \r\n";
    echo "<channels> \r\n";
    foreach ($user->categories as $category) {
        foreach ($category->streams as $stream) {

            if ($stream->running == 1) {
                echo "<channel>\r\n";
                echo "<name>" . $stream->name . "</name>\r\n";
                echo "<HQ>http://" . $setting->webip . ":" . $setting->webport . "/live/" . $user->username . "/" . $user->password . "/" . $stream->id . "</HQ>\r\n";
                echo "<typeHQ>hls</typeHQ>\r\n";
                echo "<recordableHQ>true</recordableHQ>\r\n";
                echo "<category>IPTV</category>\r\n";
                echo "</channels>\r\n";
            }
        }
    }
    echo "</channel>\r\n";
    header('Content-Type: text/xml');
    header('Content-Disposition: attachment; filename="allfrtvwindows.xml"');
    die;
}






















