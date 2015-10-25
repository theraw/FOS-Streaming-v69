<?php
include('config.php');
$activity = Activity::where('date_end','=', '0000-00-00 00:00:00')->get();
$message = [];
if(isset($_GET['delete'])) {
    $del_activities = Activity::where('date_end', '!=', '0000-00-00 00:00:00')->get();
    foreach($del_activities as $del_activity) {
        $del_activity->delete();
    }

    $message['type'] = "success";
    $message['message'] = "Old activities deleted";
}


echo $template->view()->make('activities')
    ->with('activities',  $activity)
    ->with('message', $message)
    ->render();
?>