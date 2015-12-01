@extends('main')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage transcodeprofile</h2>

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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profile name <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="profilename" class="form-control col-md-7 col-xs-12"  value="{{  isset($_POST['name']) ?  $_POST['name'] : $transcode->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Analyzeduration <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="probesize" class="form-control col-md-7 col-xs-12" placeholder="15000000" value="{{  isset($_POST['probesize']) ?  $_POST['probesize'] : $transcode->probesize ? $transcode->probesize : "15000000" }}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Probesize <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="analyzeduration" class="form-control col-md-7 col-xs-12" placeholder="12000000" value="{{  isset($_POST['analyzeduration']) ?  $_POST['analyzeduration'] : $transcode->analyzeduration ? $transcode->analyzeduration : "12000000" }}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Video codec</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="video_codec" class="form-control">
                                            <option value="" {{ isset($_POST['video_codec']) ?  $_POST['video_codec']  == '' : $transcode->video_codec  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="h264" {{ isset($_POST['video_codec']) ?  $_POST['video_codec']  == 'h264' : $transcode->video_codec  == 'h264' ? "selected" : "" }}>H.264</option>
                                            <option value="copy" {{ isset($_POST['video_codec']) ?  $_POST['video_codec']  == 'copy' : $transcode->video_codec  == 'copy' ? "selected" : "" }}>Copy</option>
                                            <option value="libx265" {{ isset($_POST['video_codec']) ?  $_POST['video_codec']  == 'libx265' : $transcode->video_codec  == 'libx265' ? "selected" : "" }}>H.265</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Audio codec</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="audio_codec" class="form-control">
                                            <option value="" {{ isset($_POST['audio_codec']) ?  $_POST['audio_codec']  == '' : $transcode->audio_codec  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="libvo_aacenc" {{ isset($_POST['audio_codec']) ?  $_POST['audio_codec']  == 'libvo_aacenc' : $transcode->audio_codec  == 'libvo_aacenc' ? "selected" : "" }}>AAC</option>
                                            <option value="copy" {{ isset($_POST['audio_codec']) ?  $_POST['audio_codec']  == 'copy' : $transcode->audio_codec  == 'copy' ? "selected" : "" }}>Copy</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="profile" class="form-control">
                                            <option value="" {{ isset($_POST['profile']) ?  $_POST['profile']  == '' : $transcode->profile  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="baseline -level 3.0" {{ isset($_POST['profile']) ?  $_POST['profile']  == 'baseline' : $transcode->profile  == 'baseline' ? "selected" : "" }}>Baseline -level 3.0</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Preset</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="preset_values" class="form-control">
                                            <option value="" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == '' : $transcode->preset_values  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="ultrafast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'ultrafast' : $transcode->preset_values  == 'ultrafast' ? "selected" : "" }}>Ultrafast</option>
                                            <option value="superfast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'superfast' : $transcode->preset_values  == 'superfast' ? "selected" : "" }}>Superfast</option>
                                            <option value="veryfast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'veryfast' : $transcode->preset_values  == 'veryfast' ? "selected" : "" }}>veryfast</option>
                                            <option value="faster" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'faster' : $transcode->preset_values  == 'faster' ? "selected" : "" }}>Faster</option>
                                            <option value="fast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'fast' : $transcode->preset_values  == 'fast' ? "selected" : "" }}>Fast</option>
                                            <option value="medium" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'medium' : $transcode->preset_values  == 'medium' ? "selected" : "" }}>Medium</option>
                                            <option value="slow" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'slow' : $transcode->preset_values  == 'slow' ? "selected" : "" }}>Slow</option>
                                            <option value="slower" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'slower' : $transcode->preset_values  == 'slower' ? "selected" : "" }}>Slower</option>
                                            <option value="veryslow" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'veryslow' : $transcode->preset_values  == 'veryslow' ? "selected" : "" }}>Veryslow</option>
                                            <option value="placebo" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'placebo' : $transcode->preset_values  == 'placebo' ? "selected" : "" }}>Placebo</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Scalling</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="scalling" class="form-control">
                                            <option value="" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '' : $transcode->scale  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="1920:1080" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1920:1080' : $transcode->scale  == '1920:1080' ? "selected" : "" }}>1920x1080</option>
                                            <option value="1680:1056" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1680:1056' : $transcode->scale  == '1680:1056' ? "selected" : "" }}>1680x1056</option>
                                            <option value="1280:720" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1280:720' : $transcode->scale  == '1280:720' ? "selected" : "" }}>1280x720</option>
                                            <option value="1024:576" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1024:576' : $transcode->scale  == '1024:576' ? "selected" : "" }}>1024x576</option>
                                            <option value="960:540" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '960:540' : $transcode->scale  == '960:540' ? "selected" : "" }}>960x540</option>
                                            <option value="850:480" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '850:480' : $transcode->scale  == '850:480' ? "selected" : "" }}>850x480</option>
                                            <option value="720:576" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:576' : $transcode->scale  == '720:576' ? "selected" : "" }}>720x576</option>
                                            <option value="720:540" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:540' : $transcode->scale  == '720:540' ? "selected" : "" }}>720x540</option>
                                            <option value="720:80" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:80' : $transcode->scale  == '720:80' ? "selected" : "" }}>720x480</option>
                                            <option value="720:404" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:404' : $transcode->scale  == '720:404' ? "selected" : "" }}>720x404</option>
                                            <option value="704:576" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '704:576' : $transcode->scale  == '704:576' ? "selected" : "" }}>704x576</option>
                                            <option value="640:480" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '640:480' : $transcode->scale  == '640:480' ? "selected" : "" }}>640x480</option>
                                            <option value="640:360" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '640:360' : $transcode->scale  == '640:360' ? "selected" : "" }}>640x360</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Aspect ratio</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="aspect_ratio" class="form-control">
                                            <option value="" {{ isset($_POST['aspect_ratio']) ?  $_POST['aspect_ratio']  == '' : $transcode->aspect_ratio  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="16:9" {{ isset($_POST['aspect_ratio']) ?  $_POST['aspect_ratio']  == '16:9' : $transcode->aspect_ratio  == '16:9' ? "selected" : "" }}>16:9</option>
                                            <option value="4:3" {{ isset($_POST['aspect_ratio']) ?  $_POST['aspect_ratio']  == '4:3' : $transcode->aspect_ratio  == '4:3' ? "selected" : "" }}>4:3</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video bitrate <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="video_bitrate" class="form-control col-md-7 col-xs-12" placeholder="1500" value="{{  isset($_POST['video_bitrate']) ?  $_POST['video_bitrate'] : $transcode->video_bitrate }}" >
                                        <span class="help-inline">Kilobytes,  0 is disabled</span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Audio channel</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="audio_channel" class="form-control">
                                            <option value="" {{ isset($_POST['audio_channel']) ?  $_POST['audio_channel']  == '' : $transcode->audio_channel  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="1" {{ isset($_POST['audio_channel']) ?  $_POST['audio_channel']  == '1' : $transcode->audio_channel  == '1' ? "selected" : "" }}>Mono</option>
                                            <option value="2" {{ isset($_POST['audio_channel']) ?  $_POST['audio_channel']  == '2' : $transcode->audio_channel  == '2' ? "selected" : "" }}>Stereo</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Audio bitrate</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="audio_bitrate" class="form-control">
                                            <option value="" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '' : $transcode->audio_bitrate  == '' ? "selected" : "" }}>Disable</option>
                                            <option value="32" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '32' : $transcode->audio_bitrate  == '32' ? "selected" : "" }}>32k</option
                                            <option value="48" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '48' : $transcode->audio_bitrate  == '48' ? "selected" : "" }}>48k</option>
                                            <option value="64" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '64' : $transcode->audio_bitrate  == '64' ? "selected" : "" }}>64k</option>
                                            <option value="96" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '96' : $transcode->audio_bitrate  == '96' ? "selected" : "" }}>96k</option>
                                            <option value="128" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '128' : $transcode->audio_bitrate  == '128' ? "selected" : "" }}>128k</option>
                                            <option value="160" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '160' : $transcode->audio_bitrate  == '160' ? "selected" : "" }}>160k</option>
                                            <option value="192" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '192' : $transcode->audio_bitrate  == '192' ? "selected" : "" }}>192k</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">FPS <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="fps" class="form-control col-md-7 col-xs-12" placeholder="25" value="{{  isset($_POST['fps']) ?  $_POST['fps'] : $transcode->fps}}" >
                                        0 is disabled
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">minrate <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="minrate" class="form-control col-md-7 col-xs-12" placeholder="200" value="{{  isset($_POST['minrate']) ?  $_POST['minrate'] : $transcode->minrate}}" >
                                        0 is disabled
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">maxrate <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="maxrate" class="form-control col-md-7 col-xs-12" placeholder="2000" value="{{  isset($_POST['maxrate']) ?  $_POST['maxrate'] : $transcode->maxrate}}" >
                                        0 is disabled
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">bufsize <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="bufsize" class="form-control col-md-7 col-xs-12" placeholder="1200" value="{{  isset($_POST['bufsize']) ?  $_POST['bufsize'] : $transcode->bufsize}}" >
                                        0 is disabled
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Audio sampling rate</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="audio_sampling_rate" class="form-control">
                                            <option value="">Disable</option>
                                            <option value="32000" {{ isset($_POST['audio_sampling_rate']) ?  $_POST['audio_sampling_rate']  == '32000' : $transcode->audio_sampling_rate  == '32000' ? "selected" : "" }}>32000</option>
                                            <option value="44100" {{ isset($_POST['audio_sampling_rate']) ?  $_POST['audio_sampling_rate']  == '44100' : $transcode->audio_sampling_rate  == '44100' ? "selected" : "" }}>44100</option>
                                            <option value="48000" {{ isset($_POST['audio_sampling_rate']) ?  $_POST['audio_sampling_rate']  == '48000' : $transcode->audio_sampling_rate  == '48000' ? "selected" : "" }}>48000 </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">crf <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="crf" class="form-control col-md-7 col-xs-12" placeholder="23" value="{{  isset($_POST['crf']) ?  $_POST['crf'] : $transcode->crf}}" >
                                        0 is disabled
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">threads <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="threads" class="form-control col-md-7 col-xs-12" placeholder="0" value="{{  isset($_POST['threads']) ?  $_POST['threads'] : $threads->bufsize}}" >
                                        0 is disabled
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deinterlance</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p style="padding: 5px;"><span><input type="checkbox" class="flat" name="deinterlance" id="" value="1" {{ $transcode->deinterlance ? "checked" : ""}}></span></p>

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

