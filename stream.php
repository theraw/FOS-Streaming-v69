<?php
header("Connection: close"); // not sure we need this one
header("Content-Encoding: none");
include("config.php");

ignore_user_abort(true);
set_time_limit(0);
register_shutdown_function('shutdown');

$user_ip = $_SERVER['REMOTE_ADDR'];

$bytes = 0;
$user_activity_id = 0;
$info = array();


if (!isset($_GET['username']) || !isset($_GET['password']) || !isset($_GET['stream'])) {
    die("Error");
}

$user_agent = (empty($_SERVER['HTTP_USER_AGENT'])) ? "0" : trim($_SERVER['HTTP_USER_AGENT']);
$username = $_GET['username'];
$password = $_GET['password'];
$stream_id = intval($_GET['stream']);

BlockedIp::where('ip', '=', $user_ip)->first() ? exit("Your IP Is Blocked!") : "";
BlockedUseragent::where('name', '=', $user_agent)->first() ? exit("Your IP Is Blocked!") : "";


$user = User::where('username', '=', $username)->where('password', '=', $password)->where('active', '=', 1)->first();
!$user ? die("No User Found") : "";

$user_id = $user->id;
$user_max_connections = $user->max_connections;
$user_expire_date = $user->exp_date;
$user_activity = $user->activity()->where('date_end', '=', NULL)->get();
$active_cons = $user_activity->count();

if ($user->exp_date != "0000-00-00") {
    if ($user->exp_date <= date('Y-m-d H:i:s')) {
        die('Expired');
    }
}

if ($user_max_connections != 0 && $active_cons >= $user_max_connections) {
    $maxconntactionactivity = Activity::where("user_id", "=", $user_id)->where("user_ip", "=", $user_ip)->where("date_end", "=", null)->first();

    if ($maxconntactionactivity != null) {
        if ($maxconntactionactivity->count() > 0) {
            if (kick($maxconntactionactivity->id) === true) {
                --$active_cons;
            }
        }
    }
}

$stream = Stream::find($_GET['stream']);

if (!$stream) {
    die("stream not found2");
}

if ($user_max_connections == 0 || $active_cons < $user_max_connections) {
    $info['type'] = 'live';

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
    $user->lastconnected_ip = $user_ip;
    $user->last_stream = $stream->id;
    $user->useragent = $user_agent;
    $user->save();
    $setting = Setting::first();
    $url = $stream->streamurl;

    if ($stream->checker == 2) {
        $url = $stream->streamurl2;
    }
    if ($stream->checker == 3) {
        $url = $stream->streamurl3;
    }


    if ($stream->restream == false) {
        $folder = $setting->hlsfolder . '/';
        $segments = 8 * 2;
        if ($files = getTSFiles($setting->hlsfolder . '/' . $stream->id . '_.m3u8')) {
            foreach ($files as $file) {
                if (file_exists($folder . $file)) {
                    ClientConnected();
                    readfile($folder . $file);
                } else {
                    exit();
                }
            }

            $getFile = array_pop($files);
            preg_match("/_(.*)\\./", $getFile, $clean);

            $segment = $clean[1];
            $t = 0;

            while (($t <= $segments) && ClientConnected() && file_exists($setting->hlsfolder . '/' . $stream->id . '_.m3u8')) {
                $next = sprintf($stream->id . "_%d.ts", $segment + 1);
                $nextnext = sprintf($stream->id . "_%d.ts", $segment + 2);
                if (!file_exists($folder . $next)) {
                    sleep(1);
                    $t++;
                    continue;
                }

                $t = 0;
                $fopen = fopen($folder . $next, "r");
                while (($t <= $segments) && ClientConnected() && !file_exists($folder . $nextnext)) {
                    $line = stream_get_line($fopen, 4096);

                    if (empty($line)) {
                        sleep(1);
                        ++$t;
                        continue;
                    }

                    echo $line;
                    $t = 0;
                }

                echo stream_get_line($fopen, filesize($folder . $next) - ftell($fopen));
                fclose($fopen);
                $t = 0;
                $segment++;
            }


        }
    } else {
        $fd = fopen($url, "r");
        while (!feof($fd) && ClientConnected()) {
            echo fread($fd, 1024 * 5);
            $bytes += 1024 * 5;
            ob_flush();
            flush();
            if (connection_aborted()) {
                $activity->date_end = date('Y-m-d H:i:s');
                $activity->pid = null;
                $activity->save();
                break;
            }
        }
        fclose($fd);
        exit();
        die();

    }
} else {
    die("Total Max Connections Reached");
}

function ps_running($pid)
{
    if (empty($pid)) {
        return false;
    }

    return file_exists("/proc/$pid");
}

function kick($activity_id)
{
    $activity = Activity::find($activity_id);
    if ($activity->count() > 0) {
        if (!is_null($activity->pid)) {
            if (ps_running($activity->pid)) {
                if (posix_kill($activity->pid, 9)) {
                    $activity->date_end = date('Y-m-d H:i:s');
                    $activity->pid = null;
                    $activity->save();
                } else {
                    return posix_strerror(posix_get_last_error());
                }
            } else {
                $activity->date_end = date('Y-m-d H:i:s');
                $activity->pid = null;
                $activity->save();
            }
        }
    }
    return true;
}

function getTSFiles($file)
{
    if (file_exists($file)) {
        $file = file_get_contents($file);

        if (preg_match_all("/(.*?).ts/", $file, $data)) {
            return $data[0];
        }
    }

    return false;
}

function ClientConnected()
{
    if (connection_status() != CONNECTION_NORMAL || connection_aborted()) {
        return false;
    }

    return true;
}

function shutdown()
{
    global $user_activity_id, $info;

    if ($user_activity_id != 0) {
        $active = Activity::find($user_activity_id);
        $active->date_end = date('Y-m-d H:i:s');
        $active->save();
    }

    if (empty($info['type']) || $info['type'] == 'live') {
        fastcgi_finish_request();
        posix_kill(getmypid(), 9);

    } else {
        exit;
    }
}

?>
