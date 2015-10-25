<?php
/**
 * Created by Tyfix 2015
 */
include('config.php');
logincheck();
$message = [];

if(isset($_GET['delete'])) {
    $ipblock = BlockedIp::find($_GET['delete']);
    $ipblock->delete();

    $message['type'] = "success";
    $message['message'] = "Admin deleted";
}

$ipblocks = BlockedIp::all();

echo $template->view()->make('ipblocks')->with('ipblocks',  $ipblocks)->with('message', $message)->render();
