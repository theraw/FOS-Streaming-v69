@extends('main')
@section('content')

<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Users </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a class="btn btn-round btn-primary" href="manage_user.php" title="Add">
                            Add user
                        </a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="">
                    @if(count($users) > 0)

                        @if($message)
                            <div class="alert alert-{{ $message['type'] }}">
                                {{ $message['message'] }}
                            </div>
                        @endif
                        <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                    <th>Exp date</th>
                                    <th>Category</th>
                                    <th>File</th>
                                    <th>Last viewed channel</th>
                                    <th>Limit</th>
                                    <th>IP</th>
                                    <th>User agent</th>
                                    <th class=" no-link last"><span class="nobr">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td class="center">{{ $user->password }}</td>
                                    <td class="center">
                                        @if($user->active)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-important">Not Active</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($user->exp_date != '0000-00-00')
                                            @if($user->exp_date <=  Carbon\Carbon::today())
                                                <span class="label label-important">{{ $user->exp_date }}</span>
                                            @else
                                                <span class="label label-success">{{ $user->exp_date }}</span>
                                            @endif
                                        @else
                                            <span class="label label-success">Unlimited</span>
                                        @endif
                                    </td>
                                    <td class="center">{{ $user->category_names }}</td>
                                    <td class="center">
                                        <a href="getfile.php?m3u=true&id={{ $user->id }}" title="GET M3U"><span class="label label-success">M3U</span></a>
                                        <a href="getfile.php?e2=true&id={{ $user->id }}" title="GET E2"><span class="label label-success">E2</span></a>
                                        <a href="getfile.php?tv=true&id={{ $user->id }}" title="GET TV"><span class="label label-success">TV</span></a>
                                        <a href="clientsgen.php?id={{ $user->id }}" title="Clients"><span class="label label-success">Clients</span></a>
                                        <a href="javascript:;" data-toggle="modal" data-target="#autoenigma2"><span class="label label-success">Auto Enigma2</span></a>
                                    </td>
                                    <td class="center"> @if($user->laststream) {{ $user->laststream->name }} @else Never connected @endif </td>
                                    <td class="center">{{ $user->max_connections }}</td>


                                    <td class="center"> @if($user->lastconnected_ip) {{ $user->lastconnected_ip }} @else Never connected @endif </td>
                                    <td class="center"> @if($user->useragent) {{ $user->useragent }} @else Never connected @endif </td>
                                    <td class="center">
                                        <a class="btn btn-info" href="manage_user.php?id={{ $user->id }}" title="Edit">Edit</a>
                                        <a class="btn btn-danger" href="users.php?delete={{ $user->id }}" title="Delete" onclick="return confirm('Are you sure?')">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            No users found
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="autoenigma2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">automatic enigma2 oe2</h4>
                </div>
                <div class="modal-body">
                    <p><textarea name="" id="" class="col-md-12" rows="3">wget -O /etc/enigma2/iptv.sh "http://{{ $setting->webip }}:{{ $setting->webport }}/retrieve.php?username={{ $user->username }}&password={{ $user->password }}&type=auto_enigma2_oe2&output=mpegts" && chmod 777 /etc/enigma2/iptv.sh && /etc/enigma2/iptv.sh</textarea></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
@section('js')
<script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
<script>


$(document).ready(function () {
    $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
});

var asInitVals = new Array();
$(document).ready(function () {
    var oTable = $('#example').dataTable({
        "oLanguage": {
            "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0]
            } //disables sorting for column one
        ],
        'iDisplayLength': 50,
        "sPaginationType": "full_numbers"
    });
    $("tfoot input").keyup(function () {
        /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
    });
    $("tfoot input").each(function (i) {
        asInitVals[i] = this.value;
    });
    $("tfoot input").focus(function () {
        if (this.className == "search_init") {
            this.className = "";
            this.value = "";
        }
    });
    $("tfoot input").blur(function (i) {
        if (this.value == "") {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    });
});
</script>
@endsection