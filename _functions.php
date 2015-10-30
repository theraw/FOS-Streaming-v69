<?php

function redirect($url, $time) {
    echo "<script>
                window.setTimeout(function(){
                    window.location.href = '" . $url ."';
                }, " . $time .");
            </script>";
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("location: index.php");
}

function logincheck() {
    if (!isset($_SESSION['user_id'])){
        header("location: index.php");
    }
}


function checkPid($pid) {
    exec("ps $pid", $output, $result);
    return count($output) >= 2 ? true : false;
}

function stop_stream($id)
{
    $stream = Stream::find($id);
    $setting = Setting::first();

    if (checkPid($stream->pid)) {
        shell_exec("kill -9 " . $stream->pid);
        shell_exec("/bin/rm -r /home/fos-streaming/fos/www/" . $setting->hlsfolder . "/" . $stream->id . "*");
    }
    $stream->pid = "";
    $stream->running = 0;
    $stream->status = 0;

    $stream->save();
    sleep(2);
}



function getTranscode($id, $streamnumber = null) {
    $stream = Stream::find($id);
    $setting = Setting::first();

    $trans = $stream->transcode;

    $ffmpeg = $setting->ffmpeg_path;

    $url =  $stream->streamurl;
    if($streamnumber == 2) {
        $url = $stream->streamurl2;
    }
    if($streamnumber == 3) {
        $url =  $stream->streamurl3;
    }

    $endofffmpeg = "";
    $endofffmpeg .=  $stream->bitstreamfilter ? ' -bsf h264_mp4toannexb' : '';
    $endofffmpeg .= ' -hls_flags delete_segments -hls_time 10';
    $endofffmpeg .= ' -hls_list_size 8 /home/fos-streaming/fos/www/' . $setting->hlsfolder . '/'.$stream->id.'_.m3u8  > /dev/null 2>/dev/null & echo $! ';

    if($trans) {

        $ffmpeg .= ' -y';
        $ffmpeg .= ' -probesize ' . ($trans->probesize ? $trans->probesize : '15000000');
        $ffmpeg .= ' -analyzeduration ' . ($trans->analyzeduration ? $trans->analyzeduration : '12000000');
        $ffmpeg .= ' -i '.'"' . "$url" . '"' ;
        $ffmpeg .= ' -user_agent "'.($setting->user_agent ? $setting->user_agent : 'FOS-Streaming').'"';
        $ffmpeg .= ' -strict -2 -dn ';
        $ffmpeg .= $trans->scale ? ' -vf scale=' . ($trans->scale ? $trans->scale : '') : '';
        $ffmpeg .= $trans->audio_codec ? ' -acodec ' . $trans->audio_codec : ''; '';
        $ffmpeg .= $trans->video_codec ? ' -vcodec ' . $trans->video_codec : '';
        $ffmpeg .= $trans->profile ? ' -profile:v ' .  $trans->profile : '';
        $ffmpeg .= $trans->preset ? ' -preset ' .  $trans->preset_values : '';
        $ffmpeg .= $trans->video_bitrate ? ' -b:v ' . $trans->video_bitrate . 'k' : '';
        $ffmpeg .= $trans->audio_bitrate ? ' -b:a ' . $trans->audio_bitrate . 'k' : '';
        $ffmpeg .= $trans->fps ? ' -r ' . $trans->fps : '';
        $ffmpeg .= $trans->minrate ? ' -minrate ' . $trans->minrate . 'k' : '';
        $ffmpeg .= $trans->maxrate ? ' -maxrate ' . $trans->maxrate . 'k' : '';
        $ffmpeg .= $trans->bufsize ? ' -bufsize ' .$trans->bufsize . 'k' : '';
        $ffmpeg .= $trans->aspect_ratio ? ' -aspect ' . $trans->aspect_ratio : '';
        $ffmpeg .= $trans->audio_sampling_rate ? ' -ar ' . $trans->audio_sampling_rate : '';
        $ffmpeg .= $trans->crf ? ' -crf ' . $trans->crf : '';
        $ffmpeg .= $trans->audio_channel ? ' -ac ' . $trans->audio_channel : '';
        $ffmpeg .= $stream->bitstreamfilter ? ' -bsf h264_mp4toannexb' : '';
        $ffmpeg .= $trans->threads ? ' -threads ' . $trans->threads : '';
        $ffmpeg .= $trans->deinterlance ? ' -vf yadif' : '';

        $ffmpeg .= $endofffmpeg;
        return $ffmpeg;
    }

    $ffmpeg .= ' -probesize 15000000 -analyzeduration 9000000 -i "'.$url.'"';
    $ffmpeg .= ' -user_agent "'.($setting->user_agent ? $setting->user_agent : 'FOS-Streaming').'"';
    $ffmpeg .= ' -c copy -c:a libvo_aacenc -b:a 128k';
    $ffmpeg .= $endofffmpeg;
    return $ffmpeg;
}

function getTranscodedata($id) {

    $trans = Transcode::find($id);
    $setting = Setting::first();

    $ffmpeg = "ffmpeg";
    $ffmpeg .= ' -y';
    $ffmpeg .= ' -probesize ' . ($trans->probesize ? $trans->probesize : '15000000');
    $ffmpeg .= ' -analyzeduration ' . ($trans->analyzeduration ? $trans->analyzeduration : '12000000');
    $ffmpeg .= ' -i '.'"' . "[input]" . '"' ;
    $ffmpeg .= ' -user_agent "'.($setting->user_agent ? $setting->user_agent : 'FOS-Streaming').'"';
    $ffmpeg .= ' -strict -2 -dn ';
    $ffmpeg .= $trans->scale ? ' -vf scale=' . ($trans->scale ? $trans->scale : '') : '';
    $ffmpeg .= $trans->audio_codec ? ' -acodec ' . $trans->audio_codec : ''; '';
    $ffmpeg .= $trans->video_codec ? ' -vcodec ' . $trans->video_codec : '';
    $ffmpeg .= $trans->profile ? ' -profile:v ' .  $trans->profile : '';
    $ffmpeg .= $trans->preset ? ' -preset ' .  $trans->preset_values : '';
    $ffmpeg .= $trans->video_bitrate ? ' -b:v ' . $trans->video_bitrate . 'k' : '';
    $ffmpeg .= $trans->audio_bitrate ? ' -b:a ' . $trans->audio_bitrate . 'k' : '';
    $ffmpeg .= $trans->fps ? ' -r ' . $trans->fps : '';
    $ffmpeg .= $trans->minrate ? ' -minrate ' . $trans->minrate . 'k' : '';
    $ffmpeg .= $trans->maxrate ? ' -maxrate ' . $trans->maxrate . 'k' : '';
    $ffmpeg .= $trans->bufsize ? ' -bufsize ' .$trans->bufsize . 'k' : '';
    $ffmpeg .= $trans->aspect_ratio ? ' -aspect ' . $trans->aspect_ratio : '';
    $ffmpeg .= $trans->audio_sampling_rate ? ' -ar ' . $trans->audio_sampling_rate : '';
    $ffmpeg .= $trans->crf ? ' -crf ' . $trans->crf : '';
    $ffmpeg .= $trans->audio_channel ? ' -ac ' . $trans->audio_channel : '';
    $ffmpeg .= $trans->threads ? ' -threads ' . $trans->threads : '';
    $ffmpeg .= $trans->deinterlance ? ' -vf yadif' : '';

    $ffmpeg .= " output[HLS]";

    return $ffmpeg;
}



function start_stream($id)
{
    $stream = Stream::find($id);
    $setting = Setting::first();

    if($stream->restream) {
        $stream->checker = 0;
        $stream->pid = null;
        $stream->running = 1;
        $stream->status = 1;
    } else {

        

            $stream->checker = 0;
            $checkstreamurl = shell_exec('' . $setting->ffprobe_path . ' -analyzeduration 1000000 -probesize 9000000 -i "' . $stream->streamurl . '" -v  quiet -print_format json -show_streams 2>&1');
            $streaminfo = json_decode($checkstreamurl, true);

            if ($streaminfo) {

                $pid = shell_exec(getTranscode($stream->id));

                $stream->pid = $pid;
                $stream->running = 1;
                $stream->status = 1;

                $video = "";
                $audio = "";

                if (is_array($streaminfo)) {
                    foreach ($streaminfo['streams'] as $info) {
                        if ($video == '') {
                            $video = ($info['codec_type'] == 'video' ? $info['codec_name'] : '');
                        }
                        if ($audio == '') {
                            $audio = ($info['codec_type'] == 'audio' ? $info['codec_name'] : '');
                        }

                    }

                    $stream->video_codec_name = $video;
                    $stream->audio_codec_name = $audio;
                }
            } else {
                $stream->running = 1;
                $stream->status = 2;

                //TODO: need to make recursive
                if (checkPid($stream->pid)) {
                    shell_exec("kill -9 " . $stream->pid);
                    shell_exec("/bin/rm -r /home/fos-streaming/fos/www/" . $setting->hlsfolder . "/" . $stream->id . "*");
                }

                if ($stream->streamurl2) {
                    $stream->checker = 2;

                    $checkstreamurl = shell_exec('' . $setting->ffprobe_path . ' -analyzeduration 1000000 -probesize 9000000 -i "' . $stream->streamurl . '" -v  quiet -print_format json -show_streams 2>&1');
                    $streaminfo = json_decode($checkstreamurl, true);

                    if ($streaminfo) {
                        $pid = shell_exec(getTranscode($stream->id, 2));

                        $stream->pid = $pid;
                        $stream->running = 1;
                        $stream->status = 1;

                        $video = "";
                        $audio = "";

                        if (is_array($streaminfo)) {
                            foreach ($streaminfo['streams'] as $info) {
                                if ($video == '') {
                                    $video = ($info['codec_type'] == 'video' ? $info['codec_name'] : '');
                                }
                                if ($audio == '') {
                                    $audio = ($info['codec_type'] == 'audio' ? $info['codec_name'] : '');
                                }
                            }

                            $stream->video_codec_name = $video;
                            $stream->audio_codec_name = $audio;

                        }
                    } else {
                        $stream->running = 1;
                        $stream->status = 2;

                        if (checkPid($stream->pid)) {
                            shell_exec("kill -9 " . $stream->pid);
                            shell_exec("/bin/rm -r /home/fos-streaming/fos/www/" . $setting->hlsfolder . "/" . $stream->id . "*");
                        }

                        //streamurl 3 checker
                        if ($stream->streamurl3) {
                            $stream->checker = 3;
                            $checkstreamurl = shell_exec('' . $setting->ffprobe_path . ' -analyzeduration 1000000 -probesize 9000000 -i "' . $stream->streamurl . '" -v  quiet -print_format json -show_streams 2>&1');
                            $streaminfo = json_decode($checkstreamurl, true);

                            if ($streaminfo) {

                                $pid = shell_exec(getTranscode($stream->id, 3));

                                $stream->pid = $pid;
                                $stream->running = 1;
                                $stream->status = 1;

                                $video = "";
                                $audio = "";

                                if (is_array($streaminfo)) {
                                    foreach ($streaminfo['streams'] as $info) {
                                        if ($video == '') {
                                            $video = ($info['codec_type'] == 'video' ? $info['codec_name'] : '');
                                        }
                                        if ($audio == '') {
                                            $audio = ($info['codec_type'] == 'audio' ? $info['codec_name'] : '');
                                        }
                                    }

                                    $stream->video_codec_name = $video;
                                    $stream->audio_codec_name = $audio;

                                }
                            } else {
                                $stream->running = 1;
                                $stream->status = 2;
                                $stream->pid = null;
                            }
                        }
                    }
                }
            }
        }
    $stream->save();
}


function generatEginxConfPort($port) {
    ob_start();
    echo 'user  root;
    worker_processes  auto;

    error_log  logs/error.log debug;

    events {
        worker_connections  1024;
    }

    http {
        include       mime.types;
        default_type  application/octet-stream;

        sendfile        on;
        keepalive_timeout  65;

        server {
            listen '.$port.';
                    root /home/fos-streaming/fos/www/;
                    index index.php index.html index.htm;
                    server_tokens off;
                    chunked_transfer_encoding off;
                    rewrite  ^/(.*)/(.*)/(.*)$ /stream.php?username=$1&password=$2&stream=$3 break;

     location ~ \.php$ {
            try_files $uri =404;
                            fastcgi_index index.php;
                            fastcgi_pass unix:/var/run/php5-fpm.sock;
                            include fastcgi_params;
                            fastcgi_keep_conn on;
                            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                            fastcgi_param SCRIPT_NAME $fastcgi_script_name;
                    }

            error_page   500 502 503 504  /50x.html;
            location = /50x.html {
                root   html;
            }
        }
    }

    rtmp {
        server {
            listen 1935;
            ping 30s;
            notify_method get;

            application rtmp {
                live on;
            }

        }
    }';
    $file ='/usr/local/nginx/conf/nginx.conf';
    $current = ob_get_clean();
    file_put_contents($file, $current);
}
