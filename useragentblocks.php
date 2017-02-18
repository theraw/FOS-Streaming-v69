<?php
include('config.php');
logincheck();
$message = [];
if (isset($_GET['delete'])) {
    $useragentblock = BlockedUseragent::find($_GET['delete'])->delete();
    $message = ['type' => 'success', 'message' => 'Admin deleted'];
}
echo $template->view()->make('useragentblocks')
    ->with('useragentblocks', BlockedUseragent::all())
    ->with('message', $message)
    ->render();
