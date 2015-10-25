<?php
include('config.php');
logincheck();

$message = [];
$title = "Create useragent block";
$ipblock = new BlockedUseragent;
$edit = 0;

if(isset($_GET['id'])) {
    $title = "Edit ipblock";
    $ipblock = BlockedUseragent::find($_GET['id']);
}

if (isset($_POST['submit'])) {
    $error = 0;
    $exists = BlockedUseragent::where('name', '=', $_POST['name'])->get();
    if(empty($_POST['name'])) {
        $message['type'] = "error";
        $message['message'] = "useragent field cannot be empty";
        $error = 1;
    }

    if($error == 0) {
        $message['type'] = "success";
        if(isset($_GET['id'])) {
            $message['message'] = "useragent block edited";
        } else {
            $message['message'] = "useragent block Created";
        }


        $ipblock->name = $_POST['name'];
        $ipblock->description = $_POST['description'];
        $ipblock->save();

        redirect("manage_useragentblock.php?id=" . $ipblock->id, 2000);
    }
}

echo $template->view()->make('manage_useragentblock')
    ->with('useragentblock',  $ipblock)
    ->with('message', $message)
    ->with('title', $title)
    ->render();
