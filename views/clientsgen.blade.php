@extends('main')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Client</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="">
                        <br>
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" role="form" action="" method="post">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">M3u8
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="username" class="form-control col-md-7 col-xs-12" value="http://{{ $setting->webip }}:{{ $setting->webport }}/playlist.php?username={{ $user->username }}&password={{ $user->password }}&m3u" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">E2
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="password" class="form-control col-md-7 col-xs-12"  value="http://{{ $setting->webip }}:{{ $setting->webport }}/playlist.php?username={{ $user->username }}&password={{ $user->password }}&e2" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @stop

