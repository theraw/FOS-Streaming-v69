@extends('main')
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Settings</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                @if($message)
                    <div class="alert alert-{{ $message['type'] }}">
                        {{ $message['message'] }}
                    </div>
                @endif
                <br>
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" role="form" action="" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Path to ffmpeg: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12"  name="ffmpeg_path" value="{{  isset($_POST['ffmpeg_path']) ?  $_POST['ffmpeg_path'] : $setting->ffmpeg_path}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Path to ffprobe <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12"  name="ffprobe_path" value="{{  isset($_POST['ffprobe_path']) ?  $_POST['ffprobe_path'] : $setting->ffprobe_path}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Web ip: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="webip" value="{{  isset($_POST['webip']) ?  $_POST['webip'] : $setting->webip}}">
                        </div>
                        (Without backslash on the end) example: example.com (NOT example.com/)
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Web port: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="webport" value="{{  isset($_POST['webport']) ?  $_POST['webport'] : $setting->webport}}">
                            <span class="label label-important">Important: restart nginx manualy ( killall -9 nginx && /usr/local/nginx/sbin/nginx )</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">HLS folder: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="hlsfolder" value="{{  isset($_POST['hlsfolder']) ?  $_POST['hlsfolder'] : $setting->hlsfolder}}">
                            <span class="label label-important">Important: cannot be changed (BUG) hl</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">User agent <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="user_agent" value="{{  isset($_POST['user_agent']) ?  $_POST['user_agent'] : $setting->user_agent}}">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

