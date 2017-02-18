<?php
include('config.php');
logincheck();

$message = [];
$title = "All Streams";

if (isset($_GET['start'])) {
    start_stream($_GET['start']);
    $message = ['type' => 'success', 'message' => 'stream started'];
} else if (isset($_GET['stop'])) {
    stop_stream($_GET['stop']);
    $message = ['type' => 'success', 'message' => 'stream stopped'];
}

if (isset($_GET['delete'])) {
    $stream = Stream::find($_GET['delete'])->delete();
    $message = ['type' => 'success', 'message' => 'stream deleted'];
}

if (isset($_POST['mass_delete']) && isset($_POST['mselect'])) {
    foreach ($_POST['mselect'] as $streamids) {
        Stream::find($streamids)->delete();
    }
    $message = ['type' => 'success', 'message' => 'streams deleted'];
}

if (isset($_POST['mass_start']) && isset($_POST['mselect'])) {
    foreach ($_POST['mselect'] as $streamids) {
        start_stream($streamids);
    }

    $message = ['type' => 'success', 'message' => 'streams started'];
}

if (isset($_POST['mass_stop']) && isset($_POST['mselect'])) {
    foreach ($_POST['mselect'] as $streamids) {
        stop_stream($streamids);
    }
    $message = ['type' => 'success', 'message' => 'Streams stopped'];
}

if (isset($_GET['running']) && $_GET['running'] == 1) {
    $title = "Running Streams";
    $stream = Stream::where('status', '=', 1)->get();

} else if (isset($_GET['running']) && $_GET['running'] == 2) {
    $title = "Stopped Streams";
    $stream = Stream::where('status', '=', 2)->get();
} else {
    $stream = Stream::all();
}

echo $template->view()->make('streams')
    ->with('streams', $stream)
    ->with('message', $message)
    ->with('title', $title)
    ->render();
