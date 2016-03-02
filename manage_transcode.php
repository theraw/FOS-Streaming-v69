<?php

include('config.php');
logincheck();

$message = [];
$title = "Create transcode profile";
$trans = new Transcode;
$categories = Category::all();

if (isset($_GET['id'])) {
    $title = "Edit transcode profile";
    $trans = Transcode::where('id', '=', $_GET['id'])->first();
}

if (isset($_POST['submit'])) {
    $trans->name = $_POST['profilename'];
    $trans->probesize = intval($_POST['probesize']);
    $trans->analyzeduration = intval($_POST['analyzeduration']);
    $trans->video_codec = $_POST['video_codec'];
    $trans->audio_codec = $_POST['audio_codec'];
    $trans->profile = $_POST['profile'];
    $trans->preset_values = $_POST['preset_values'];
    $trans->bufsize = intval($_POST['bufsize']);
    $trans->scale = $_POST['scalling'];
    $trans->aspect_ratio = $_POST['aspect_ratio'];
    $trans->video_bitrate = intval($_POST['video_bitrate']);
    $trans->audio_channel = intval($_POST['audio_channel']);
    $trans->audio_bitrate = intval($_POST['audio_bitrate']);
    $trans->fps = intval($_POST['fps']);
    $trans->minrate = intval($_POST['minrate']);
    $trans->maxrate = intval($_POST['maxrate']);
    $trans->bufsize = intval($_POST['bufsize']);
    $trans->audio_sampling_rate = intval($_POST['audio_sampling_rate']);
    $trans->crf = intval($_POST['crf']);
    $trans->threads = intval($_POST['threads']);

    $trans->deinterlance = 0;
    if (isset($_POST['deinterlance'])) {
        $trans->deinterlance = 1;
    }

    if (empty($_POST['profilename'])) {
        $message['type'] = "error";
        $message['message'] = "Profilename field is empty";
    } else {

        if (isset($_GET['id'])) {
            $message['type'] = "success";
            $message['message'] = "Transcode profile saved";
            $trans->save();
        } else {
            $exists = Transcode::where('name', '=', $_POST['profilename'])->get();

            if (count($exists) > 0) {
                $message['type'] = "error";
                $message['message'] = "Transcode profile name already in use";
            } else {
                $message['type'] = "success";
                $message['message'] = "Transcode created";
                $trans->save();
                redirect("manage_transcode.php?id=" . $trans->id, 1000);
            }
        }
    }
}

echo $template->view()->make('manage_transcode')
        ->with('transcode', $trans)
        ->with('categories', $categories)
        ->with('message', $message)
        ->with('title', $title)
        ->render();
