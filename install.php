<?php
include('config.php');
// TODO: version control
// TODO: update tables

$db = $databasemanagar;
if( isset($_GET['install'])) {

    $arraynamesexist = [];
    $tables = $databasemanagar::select('SHOW TABLES');
    foreach ($tables as $key => $val) {

        $tableName = (array)$val;
        $tableName = array_shift($tableName);

        array_push($arraynamesexist, $tableName);
    }

    if ($_GET['install'] == 'fresh') {
        $db::schema()->dropIfExists('admins');
        $db::schema()->dropIfExists('categories');
        $db::schema()->dropIfExists('category_user');
        $db::schema()->dropIfExists('settings');
        $db::schema()->dropIfExists('streams') ;
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

        echo "created admin table <br>" . PHP_EOL;
        echo "admin created: username: admin  and password: admin <br>" . PHP_EOL;
    }



    if (!in_array('categories', $arraynamesexist)) {

        $db->schema()->create('categories', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        echo "created categories table <br>" . PHP_EOL;
    }


    if (!in_array('category_user', $arraynamesexist)) {

        $db->schema()->create('category_user', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->timestamps();
        });

        echo "created category_user table <br>" . PHP_EOL;
    }



    if (!in_array('settings', $arraynamesexist)) {

        $db->schema()->create('settings', function ($table) {
            $table->increments('id');
            $table->string('ffmpeg_path')->default('/usr/local/bin/ffmpeg');
            $table->string('ffprobe_path')->default('/usr/local/bin/ffprobe');
            $table->string('webport')->default('8000');
            $table->string('webip');
            $table->string('hlsfolder')->default('hl');
            $table->string('user_agent')->default('FOS-Streaming');
            $table->timestamps();
        });

        echo "created settings table <br>" . PHP_EOL;
    }


    if (!in_array('streams', $arraynamesexist)) {

        $db->schema()->create('streams', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('streamurl');
            $table->string('streamurl2');
            $table->string('streamurl3');
            $table->tinyInteger('running');
            $table->tinyInteger('status');
            $table->integer('cat_id');
            $table->integer('trans_id');
            $table->integer('pid');
            $table->tinyInteger('restream');
            $table->string('video_codec_name');
            $table->string('audio_codec_name');
            $table->tinyInteger('bitstreamfilter');
            $table->tinyInteger('checker');
            $table->timestamps();
        });
        echo "created streams table <br>" . PHP_EOL;
    }

    if (!in_array('users', $arraynamesexist)) {

        $db->schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->tinyInteger('active');
            $table->string('lastconnected_ip');
            $table->date('exp_date');
            $table->integer('last_stream');
            $table->string('useragent');
            $table->integer('max_connections')->default('1');
            $table->timestamps();
        });

        echo "created users table <br>" . PHP_EOL;

    }


    if (!in_array('transcodes', $arraynamesexist)) {

        $db->schema()->create('transcodes', function ($table) {
            $table->increments('id');
            $table->string('name')->unique();

            $table->BigInteger('probesize');
            $table->BigInteger('analyzeduration');
            $table->string('video_codec');
            $table->string('audio_codec');
            $table->string('profile');
            $table->string('preset_values');
            $table->string('scale');
            $table->string('aspect_ratio');
            $table->BigInteger('video_bitrate');
            $table->integer('audio_channel');
            $table->BigInteger('audio_bitrate');
            $table->integer('fps');
            $table->integer('minrate');
            $table->integer('maxrate');
            $table->integer('bufsize');
            $table->integer('audio_sampling_rate');
            $table->integer('crf');
            $table->integer('threads');
            $table->tinyInteger('deinterlance');
            $table->timestamps();
        });

        echo "created transcodes table <br>" . PHP_EOL;

        $profile1 = new Transcode();
        $profile1->name = 'Default 1: Video Copy, Audio Copy';
        $profile1->probesize = 15000000;
        $profile1->analyzeduration = 12000000;
        $profile1->video_codec = 'copy';
        $profile1->audio_codec = 'copy';
        $profile1->save();
        echo "created transcode profile1 data <br>" . PHP_EOL;

        $profile2 = new Transcode();
        $profile2->name = 'Default 2: Video Copy, Audio AAC';
        $profile2->probesize = 15000000;
        $profile2->analyzeduration = 12000000;
        $profile2->video_codec = 'copy';
        $profile2->audio_codec = 'libvo_aacenc';
        $profile2->save();
        echo "created transcode profile2 data <br>" . PHP_EOL;
    }


    if (!in_array('activity', $arraynamesexist)) {

        $db->schema()->create('activity', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('stream_id');
            $table->text('user_agent');
            $table->string('user_ip');
            $table->integer('pid');
            $table->integer('bandwidth')->default(0);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->index('user_id');
            $table->index('stream_id');
            $table->index('date_end');
            $table->index('pid');
            $table->timestamps();
        });

        echo "created activity table <br>" . PHP_EOL;
    }


    if (!in_array('blocked_ips', $arraynamesexist)) {

        $db->schema()->create('blocked_ips', function ($table) {
            $table->increments('id');
            $table->string('ip')->unique();
            $table->text('description');
            $table->timestamps();
        });

        echo "created blocked_ips table <br>" . PHP_EOL;
    }

    if (!in_array('blocked_user_agents', $arraynamesexist)) {

        $db->schema()->create('blocked_user_agents', function ($table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->text('description');
            $table->timestamps();
        });

        echo "created blocked_user_agents table <br>" . PHP_EOL;
    }



}

if( isset($_GET['update'])) {

    $db->schema()->table('streams', function ($table) use ($db) {
        $db->schema()->hasColumn('streams', 'bitstreamfilter') ? '' : $table->tinyInteger('bitstreamfilter');
        $db->schema()->hasColumn('streams', 'trans_id') ? '' : $table->Integer('trans_id');

        $db->schema()->hasColumn('streams', 'streamurl2') ? '' : $table->string('streamurl2');
        $db->schema()->hasColumn('streams', 'streamurl3') ? '' : $table->string('streamurl3');
        $db->schema()->hasColumn('streams', 'checker') ? '' : $table->tinyInteger('checker');
    });

    $db->schema()->table('users', function ($table) use ($db) {
        $db->schema()->hasColumn('users', 'lastconnected_ip') ? '' : $table->string('lastconnected_ip');
        $db->schema()->hasColumn('users', 'exp_date') ? '' : $table->date('exp_date');
        $db->schema()->hasColumn('users', 'last_stream') ? '' : $table->integer('last_stream');
        $db->schema()->hasColumn('users', 'useragent') ? '' : $table->string('useragent');
        $db->schema()->hasColumn('users', 'max_connections') ? '' : $table->integer('max_connections')->default('1');


    });

    $db->schema()->table('settings', function ($table) use ($db) {
        $db->schema()->hasColumn('settings', 'less_secure') ? '' : $table->tinyInteger('less_secure');
        $db->schema()->hasColumn('settings', 'user_agent') ? '' : $table->string('user_agent')->default('FOS-Streaming');
    });

    echo "update <br>" . PHP_EOL;
}
