<?php
/**
 * Created by Tyfix 2015
 */
include('config.php');
logincheck();
$message = [];

if(isset($_GET['delete'])) {
    $useragentblock = BlockedUseragent::find($_GET['delete']);
    $useragentblock->delete();

    $message['type'] = "success";
    $message['message'] = "Admin deleted";
}

$useragentblocks = BlockedUseragent::all();

echo $template->view()->make('useragentblocks')->with('useragentblocks',  $useragentblocks)->with('message', $message)->render();
