<?php
include('config.php');
logincheck();
$message = [];
if (isset($_GET['delete'])) {
    $trans = Transcode::find($_GET['delete'])->delete();
    $message = ['type' => 'success', 'message' => 'Transcode deleted'];
}
echo $template->view()->make('transcodes')
    ->with('transcodes', Transcode::all())
    ->with('message', $message)
    ->render();
