<?php
error_reporting(E_ALL);
set_time_limit(0);
include("config.php");
function closed()
{
    global $user_activity_id;

    if ($user_activity_id != 0) {
        $active = Activity::find($user_activity_id);
        $active->date_end = date('Y-m-d H:i:s');
        $active->save();
    }
    fastcgi_finish_request();
    exit;
}

$user_activity_id = 0;
$user_ip = $_SERVER['REMOTE_ADDR'];
header("Access-Control-Allow-Origin: *");
register_shutdown_function('closed');
header("Content-Type: video/mp2t");
ob_end_flush();

if (isset($_GET['username']) && isset($_GET['password']) && isset($_GET['stream'])) {
    $user_agent = (empty($_SERVER['HTTP_USER_AGENT'])) ? "0" : trim($_SERVER['HTTP_USER_AGENT']);
    $username = $_GET['username'];
    $password = $_GET['password'];
    $stream_id = intval($_GET['stream']);
    if (!BlockedIp::where('ip', '=', $_SERVER['REMOTE_ADDR'])->first() || BlockedUseragent::where('name', '=', $user_agent)->first()) {
        if ($user = User::where('username', '=', $username)->where('password', '=', $password)->where('active', '=', 1)->first()) {
            if ($user->exp_date == "0000-00-00" || $user->exp_date > date('Y-m-d H:i:s')) {
                $user_id = $user->id;
                $user_max_connections = $user->max_connections;
                $user_expire_date = $user->exp_date;
                $user_activity = $user->activity()->where('date_end', '=', NULL)->get();
                $active_cons = $user_activity->count();

                if ($user_max_connections != 0 && $active_cons >= $user_max_connections) {
                    $maxconntactionactivity = Activity::where("user_id", "=", $user_id)->where("user_ip", "=", $user_ip)->where("date_end", "=", null)->first();

                    if ($maxconntactionactivity != null) {
                        if ($maxconntactionactivity->count() > 0) {
                            --$active_cons;
                        }
                    }
                }

                if ($user_max_connections == 0 || $active_cons < $user_max_connections) {
                    if ($stream = Stream::find($_GET['stream'])) {

                        if ($user_activity_id != 0) {
                            $active = Activity::find($user_activity_id);
                        } else {
                            $active = new Activity();
                        }
                        $active->user_id = $user->id;
                        $active->stream_id = $stream->id;
                        $active->user_agent = $user_agent;
                        $active->user_ip = $user_ip;
                        $active->pid = getmypid();
                        $active->bandwidth = 0;
                        $active->date_start = date('Y-m-d H:i:s');
                        $active->save();
                        $user_activity_id = $active->id;
                        $user->lastconnected_ip = $_SERVER['REMOTE_ADDR'];
                        $user->last_stream = $stream->id;
                        $user->useragent = $user_agent;
                        $user->save();
                        $setting = Setting::first();
                        if ($stream->checker == 2) {
                            $url = $stream->streamurl2;
                        } else if ($stream->checker == 3) {
                            $url = $stream->streamurl3;
                        } else {
                            $url = $stream->streamurl;
                        }

                        $folder = $setting->hlsfolder . '/';
                        $files = "";
                        $file = $setting->hlsfolder . '/' . $stream->id . '_.m3u8';
                        if (file_exists($file) && preg_match_all("/(.*?).ts/", file_get_contents($file), $data)) {
                            $files = $data[0];
                            foreach ($files as $file) {
                                if (!file_exists($folder . $file)) {
                                    exit();
                                }
                                readfile($folder . $file);
                            }
                            preg_match("/_(.*)\\./", array_pop($files), $clean);
                            $segment = $clean[1];
                            $try = 0;
                            while (($try <= 16) && file_exists($setting->hlsfolder . '/' . $stream->id . '_.m3u8')) {
                                $next = sprintf($stream->id . "_%d.ts", $segment + 1);
                                $nextnext = sprintf($stream->id . "_%d.ts", $segment + 2);
                                if (!file_exists($folder . $next)) {
                                    sleep(1);
                                    $try++;
                                    continue;
                                }
                                $try = 0;
                                $fopen = fopen($folder . $next, "r");
                                while (($try <= 16) && !file_exists($folder . $nextnext)) {
                                    $line = stream_get_line($fopen, 4096);
                                    if (empty($line)) {
                                        sleep(1);
                                        ++$try;
                                        continue;
                                    }
                                    echo $line;
                                    $t = 0;
                                }
                                echo stream_get_line($fopen, filesize($folder . $next) - ftell($fopen));
                                fclose($fopen);
                                $try = 0;
                                $segment++;
                            }
                        }
                    }
                }
            }
        }
    }
}