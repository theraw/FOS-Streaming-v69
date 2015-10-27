<?php
include('config.php');
logincheck();

$message = [];
$title = "Create admin";
$admin = new Admin;
$edit = 0;

if(isset($_GET['id'])) {
    $title = "Edit admin";
    $admin = Admin::find($_GET['id']);
}

if (isset($_POST['submit'])) {
    $error = 0;
    $exists = Admin::where('username', '=', $_POST['username'])->get();
    if(empty($_POST['username'])) {
        $message['type'] = "error";
        $message['message'] = "username field cannot be empty";
        $error = 1;
    }
    else if(!isset($_GET['id']) &&  $_POST['password'] == "") {
        $message['type'] = "error";
        $message['message'] = "password error";
        $error = 1;
    }

    if($error == 0) {
        $message['type'] = "success";
        if(isset($_GET['id'])) {
            $message['message'] = "admin edited";
        } else {
            $message['message'] = "admin Created";
        }

        $admin->username = $_POST['username'];
        if($_POST['password'] != "") {

            $admin->password = md5($_POST['password']);
        }
        $admin->save();
        redirect("manage_admin.php?id=" . $admin->id, 2000);
    }
}

echo $template->view()->make('manage_admin')
    ->with('admin',  $admin)
    ->with('message', $message)
    ->with('title', $title)
    ->render();
