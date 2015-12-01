@extends('main')
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $title }}</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(count($categories) > 0)

                        @if($message)
                            <div class="alert alert-{{ $message['type'] }}">
                                {{ $message['message'] }}
                            </div>
                        @endif
                        <br>
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" role="form" action="" method="post">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="username" class="form-control col-md-7 col-xs-12"  value="{{  isset($_POST['username']) ?  $_POST['username'] : $user->username}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="password" class="form-control col-md-7 col-xs-12"  value="{{  isset($_POST['password']) ?  $_POST['password'] : $user->password}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Exp date</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="expdate" id="expdate" class="date-picker form-control col-md-7 col-xs-12" id="date01" placeholder="0000-00-00" value="{{  isset($_POST['expdate']) ?  $_POST['expdate'] : $user->exp_date }}">
                                    <span class="help-inline">Unlimited? 0000-00-00 or Leave blank</span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Max connection</label>
                                <div class="col-md-1">
                                    <input type="number" name="limit" class="form-control col-md-7 col-xs-12"  value="{{  isset($_POST['limit']) ?  $_POST['limit'] : $user->max_connections ? $user->max_connections : 1}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Active</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p style="padding: 5px;"><span><input type="checkbox" class="flat" name="active" id="" value="1" {{ $user->active ? "checked" : ""}}></span></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Categories</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="category[]" class="select2_multiple form-control" multiple="multiple">
                                    @foreach ($categories as $category)
                                        <option {{ in_array($category->id, $user->categories->lists('id')->toArray()) ? 'selected' : '' }} value="{{ $category->id }}">{{{ $category->name }}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    @else
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong> You need to create an category!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<link href="css/select/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/moment.min2.js"></script>
<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
<script src="js/select/select2.full.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    $('#expdate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4"
    }, function (start, end, label) {
    });
    $(".select2_multiple").select2({
        placeholder: "Select categories",
        allowClear: true
    });
});
</script>
@endsection