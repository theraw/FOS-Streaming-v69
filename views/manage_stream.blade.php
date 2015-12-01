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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="name" class="form-control col-md-7 col-xs-12"  name="name" value="{{  isset($_POST['name']) ?  $_POST['name'] : $stream->name}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Streamurl <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="streamurl" class="form-control col-md-7 col-xs-12"  name="streamurl" value="{{  isset($_POST['streamurl']) ?  $_POST['streamurl'] : $stream->streamurl }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Streamurl 2 (backup)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="streamurl2" class="form-control col-md-7 col-xs-12"  name="streamurl2" value="{{  isset($_POST['streamurl2']) ?  $_POST['streamurl2'] : $stream->streamurl2}}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Streamurl 3 (backup
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="streamurl3" class="form-control col-md-7 col-xs-12"  name="streamurl3" value="{{  isset($_POST['streamurl3']) ?  $_POST['streamurl3'] : $stream->streamurl3}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Proxy</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p style="padding: 5px;"><span><input type="checkbox" class="flat" name="restream" id="" value="1" {{ $stream->restream ? "checked" : ""}}></span></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Bit stream filter:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p style="padding: 5px;"><span><input type="checkbox" class="flat" name="bitstreamfilter" id="" value="1" {{ $stream->bitstreamfilter ? "checked" : ""}}></span></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="category" class="form-control">
                                            <option value='{{ $stream->category ? $stream->category->id : "" }}'>{{ $stream->category ? $stream->category->name : "Select" }}</option>
                                            @foreach($categories as $category)
                                                <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Transcode profile</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="transcode" class="form-control">
                                            <option value='0'>No transcode</option>
                                            @foreach($transcodes as $trans)
                                                <option value='{{ $trans->id }}' {{ $stream->trans_id  == $trans->id ? "selected" : "" }}>{{ $trans->name }}</option>
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

