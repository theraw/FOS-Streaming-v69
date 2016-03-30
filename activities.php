<?php
include('config.php');

$message = [];
if(isset($_GET['delete_all'])) {
    $del_activities = Activity::all();
    foreach($del_activities as $del_activity) {
        $del_activity->delete();
    }

    $message['type'] = "success";
    $message['message'] = "Old activities deleted";
}

if(isset($_GET['delete'])) {
    $de_activity= Activity::find($_GET['delete']);
    $de_activity->delete();

    $mssage['type'] = "success";
    $message['message'] = "Activity deleted";
}

$activity = Activity::where('date_end','<>', '0000-00-00 00:00:00')->get();


echo $template->view()->make('activities')
    ->with('activities',  $activity)
    ->with('message', $message)
    ->render();
?>
