<?php
include('config.php');
logincheck();
$message = [];
if (isset($_GET['delete'])) {
    $user = User::find($_GET['delete'])->delete();
    $message = ['type' => 'success', 'message' => 'User deleted'];
}

$users = User::all();
echo $template->view()->make('users')
    ->with('users', User::all())
    ->with('message', $message)
    ->with('setting', Setting::first())
    ->render();