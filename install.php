<?php

include('config.php');
// TODO: version control
// TODO: update tables

$db = $databasemanagar;
if (isset($_GET['install'])) {

    $arraynamesexist = [];
    $tables = $databasemanagar::select('SHOW TABLES');
    foreach ($tables as $key => $val) {

        $tableName = (array) $val;
        $tableName = array_shift($tableName);

        array_push($arraynamesexist, $tableName);
    }

    if ($_GET['install'] == 'fresh') {
        $db::schema()->dropIfExists('admins');
        $db::schema()->dropIfExists('categories');
        $db::schema()->dropIfExists('category_user');
        $db::schema()->dropIfExists('settings');
        $db::schema()->dropIfExists('streams');
        $db::schema()->dropIfExists('users');
        $db::schema()->dropIfExists('transcodes');
        $db::schema()->dropIfExists('activity');
        $db::schema()->dropIfExists('blocked_ips');
        $db::schema()->dropIfExists('blocked_user_agents');
        $arraynamesexist = [];
    }

    if (!in_array('admins', $arraynamesexist)) {

        $db->schema()->create('admins', function ($table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        $admin = new Admin;
        $admin->username = 'admin';
        $admin->password = md5('admin');
        $admin->save();

        echo "created admin table " . PHP_EOL;
        echo "admin created: username: admin  and password: admin " . PHP_EOL;
    }



    if (!in_array('categories', $arraynamesexist)) {

        $db->schema()->create('categories', function ($table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->timestamps();
        });

        $category = new Category;
        $category->name = 'Default';
        $category->save();

        echo "created categories table " . PHP_EOL;
    }


    if (!in_array('category_user', $arraynamesexist)) {

        $db->schema()->create('category_user', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->timestamps();
        });

        echo "created category_user table " . PHP_EOL;
    }



    if (!in_array('settings', $arraynamesexist)) {

        $db->schema()->create('settings', function ($table) {
            $table->increments('id');
            $table->string('ffmpeg_path')->default('/usr/bin/ffmpeg');
            $table->string('ffprobe_path')->default('/usr/bin/ffprobe');
            $table->string('webport')->default('8000');
            $table->string('webip')->default('');
            $table->string('hlsfolder')->default('streams');
            $table->string('user_agent')->default('FOS-Streaming');
            $table->timestamps();
        });

        echo "created settings table " . PHP_EOL;
    }


    if (!in_array('streams', $arraynamesexist)) {

        $db->schema()->create('streams', function ($table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('streamurl')->default('');
            $table->string('streamurl2')->default('');
            $table->string('streamurl3')->default('');
            $table->tinyInteger('running')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->integer('cat_id')->default(0);
            $table->integer('trans_id')->default(0);
            $table->integer('pid')->default(0);
            $table->tinyInteger('restream')->default(0);
            $table->string('video_codec_name')->default('');
            $table->string('audio_codec_name')->default('');
            $table->tinyInteger('bitstreamfilter')->default(0);
            $table->tinyInteger('checker')->default(0);
            $table->timestamps();
        });
        echo "created streams table " . PHP_EOL;
    }

    if (!in_array('users', $arraynamesexist)) {

        $db->schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->tinyInteger('active')->default(1);
            $table->string('lastconnected_ip')->default('');
            $table->date('exp_date')->default('0000-00-00');
            $table->integer('last_stream')->default(0);
            $table->string('useragent')->default('');
            $table->integer('max_connections')->default(1);
            $table->timestamps();
        });

        echo "created users table " . PHP_EOL;
    }


    if (!in_array('transcodes', $arraynamesexist)) {

        $db->schema()->create('transcodes', function ($table) {
            $table->increments('id');
            $table->string('name')->unique();

            $table->BigInteger('probesize')->default(0);
            $table->BigInteger('analyzeduration')->default(0);
            $table->string('video_codec')->default('');
            $table->string('audio_codec')->default('');
            $table->string('profile')->default('');
            $table->string('preset_values')->default('');
            $table->string('scale')->default('');
            $table->string('aspect_ratio')->default('');
            $table->BigInteger('video_bitrate')->default(0);
            $table->integer('audio_channel')->default(0);
            $table->BigInteger('audio_bitrate')->default(0);
            $table->integer('fps')->default(0);
            $table->integer('minrate')->default(0);
            $table->integer('maxrate')->default(0);
            $table->integer('bufsize')->default(0);
            $table->integer('audio_sampling_rate')->default(0);
            $table->integer('crf')->default(0);
            $table->integer('threads')->default(0);
            $table->tinyInteger('deinterlance')->default(0);
            $table->timestamps();
        });

        echo "created transcodes table" . PHP_EOL;

        $profile1 = new Transcode();
        $profile1->name = 'Default 1: Copy, Copy';
        $profile1->probesize = 12000000;
        $profile1->analyzeduration = 5000000;
        $profile1->video_codec = 'copy';
        $profile1->audio_codec = 'copy';
        $profile1->save();
        echo "created transcode profile1 data" . PHP_EOL;

        $profile2 = new Transcode();
        $profile2->name = 'Default 2: H264, AAC';
        $profile2->probesize = 12000000;
        $profile2->analyzeduration = 5000000;
        $profile2->video_codec = 'h264';
        $profile2->audio_codec = 'libfaac';
        $profile2->save();
        echo "created transcode profile2 data" . PHP_EOL;
        
                $profile3 = new Transcode();
        $profile2->name = 'Default 2: H265, AAC';
        $profile2->probesize = 12000000;
        $profile2->analyzeduration = 5000000;
        $profile2->video_codec = 'libx265';
        $profile2->audio_codec = 'libfaac';
        $profile2->save();
        echo "created transcode profile3 data" . PHP_EOL;
    }


    if (!in_array('activity', $arraynamesexist)) {

        $db->schema()->create('activity', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('stream_id');
            $table->text('user_agent');
            $table->string('user_ip')->default('');
            $table->integer('pid')->default(0);
            $table->integer('bandwidth')->default(0);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->index('user_id');
            $table->index('stream_id');
            $table->index('date_end');
            $table->index('pid');
            $table->timestamps();
        });

        echo "created activity table" . PHP_EOL;
    }


    if (!in_array('blocked_ips', $arraynamesexist)) {

        $db->schema()->create('blocked_ips', function ($table) {
            $table->increments('id');
            $table->string('ip')->unique();
            $table->text('description');
            $table->timestamps();
        });

        echo "created blocked_ips table" . PHP_EOL;
    }

    if (!in_array('blocked_user_agents', $arraynamesexist)) {

        $db->schema()->create('blocked_user_agents', function ($table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->text('description');
            $table->timestamps();
        });

        echo "created blocked_user_agents table" . PHP_EOL;
    }
}

if (isset($_GET['update'])) {

    $db->schema()->table('streams', function ($table) use ($db) {
        $db->schema()->hasColumn('streams', 'bitstreamfilter') ? '' : $table->tinyInteger('bitstreamfilter')->default(0);
        $db->schema()->hasColumn('streams', 'trans_id') ? '' : $table->Integer('trans_id');

        $db->schema()->hasColumn('streams', 'streamurl2') ? '' : $table->string('streamurl2')->default('');
        $db->schema()->hasColumn('streams', 'streamurl3') ? '' : $table->string('streamurl3')->default('');
        $db->schema()->hasColumn('streams', 'checker') ? '' : $table->tinyInteger('checker')->default(0);
    });

    $db->schema()->table('users', function ($table) use ($db) {
        $db->schema()->hasColumn('users', 'lastconnected_ip') ? '' : $table->string('lastconnected_ip');
        $db->schema()->hasColumn('users', 'exp_date') ? '' : $table->date('exp_date');
        $db->schema()->hasColumn('users', 'last_stream') ? '' : $table->integer('last_stream')->default(0);
        $db->schema()->hasColumn('users', 'useragent') ? '' : $table->string('useragent')->default('');
        $db->schema()->hasColumn('users', 'max_connections') ? '' : $table->integer('max_connections')->default(1);
    });

    $db->schema()->table('settings', function ($table) use ($db) {
        $db->schema()->hasColumn('settings', 'less_secure') ? '' : $table->tinyInteger('less_secure')->default(0);
        $db->schema()->hasColumn('settings', 'user_agent') ? '' : $table->string('user_agent')->default('FOS-Streaming');
    });

    echo "update done" . PHP_EOL;
}
