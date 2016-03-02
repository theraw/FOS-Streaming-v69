<?php

/**
 * Created by Tyfix 2015
 */
include('config.php');
logincheck();

//Create settings if not exists
$settings = Setting::first();
if (is_null($settings)) {
    $settings = new Setting;
    $settings->webip = $_SERVER['SERVER_ADDR'];
    $settings->webport = 8000;
    $settings->save();
}

$all = Stream::all()->count();
$online = Stream::where('running', '=', 1)->count();
$offline = Stream::where('running', '=', 0)->count();


//space
$space_free = round((disk_free_space('/')) / 1048576, 1);
$space_total = round((disk_total_space('/')) / 1048576, 1);
$space_pr = (int) (($space_total - $space_free) / 100);
$cpu_usage = "";
$cpu_total = "";


//cpu
$loads = sys_getloadavg();
$core_nums = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
$cpu_pr = round($loads[0] / ($core_nums + 1) * 100, 2);

//memory
$free_arr = explode("\n", (string) trim(shell_exec('free')));
$memory = array_merge(array_filter(explode(" ", $free_arr[1])));

$mem_usage = $memory[2];
$mem_total = $memory[1];
$mem_pr = $memory[2] / $memory[1] * 100;


$space = [];
$space['pr'] = $space_pr;
$space['count'] = $space_free;
$space['total'] = $space_total;

$cpu = [];
$cpu['pr'] = $cpu_pr;
$cpu['count'] = $cpu_usage;
$cpu['total'] = $cpu_total;

$mem = [];
$mem['pr'] = $mem_pr;
$mem['count'] = $mem_usage;
$mem['total'] = $mem_total;


echo $template->view()
        ->make('dashboard')
        ->with('all', $all)
        ->with('online', $online)
        ->with('offline', $offline)
        ->with('space', $space)
        ->with('cpu', $cpu)
        ->with('mem', $mem)
        ->render();
