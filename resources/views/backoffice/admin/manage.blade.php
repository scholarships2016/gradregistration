@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<style type="text/css">
</style>
@endpush

@section('pagebar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">ผู้ใช้งาน</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">จัดการผู้ใช้งานระบบ</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        จัดการผู้ใช้งานระบบ
    </h1>
@stop



@section('maincontent')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">รายการผู้ใช้งานระบบ</span>
                    </div>
                    <div class="actions">

                        <div class="btn-group pull-right">
                            <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-print"></i> Print </a>
                                </li>

                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{route('admin.adminManage.showAdd')}}"
                                       class="btn btn-circle green btn-outline sbold uppercase">
                                        <i class="fa fa-plus"></i> เพิ่มผู้ใช้
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="userTbl" style="width: 100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th class="text-center" style="width: 20px"> ลำดับ</th>
                            <th class="text-center"> รหัสผู้ใช้</th>
                            <th class="text-center"> ชื่อ</th>
                            <th class="text-center"> Role</th>
                            <th class="text-center"> Permission</th>
                            <th class="text-center"> การเข้าระบบ</th>
                            <th class="text-center"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


@push('pageJs')
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/select2-cascade.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var editLink = '{{url("admin/setting/adminManage/edit")}}';

    var userTbl;

    function initForm() {
    }

    function initDatatable() {

        userTbl = $('#userTbl').dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            language: {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "ไม่พบข้อมูล",
                "info": "แสดง _START_ จาก _END_ ของ _TOTAL_ รายการ",
                "infoEmpty": "ไม่พบรายการ",
                "infoFiltered": "(filtered1 จาก _MAX_ รายการทั้งหมด)",
                "lengthMenu": "Show _MENU_",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่สอดคล้อง",
                "paginate": {
                    "previous": "Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            bStateSave: true, // save datatable state(pagination, sort, etc) in cookie.

            lengthMenu: [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            order: [],
            searching: true,
            paging: true,
            pagingType: "bootstrap_full_number"
            ,
            columnDefs: [
                {
                    targets: [0],
                    className: 'text-center',
                    orderable: false,
                    visible: false,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    targets: [1],
                    className: 'text-center',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    targets: [2],
                    className: 'text-center',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return full.user_name;
                    }
                },
                {
                    targets: [3],
                    className: 'text-left',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return full.name;
                    }
                }, {
                    targets: [4],
                    className: 'text-left',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        if (full.role_id == 1) {
                            return 'Administrator';
                        } else if (full.role_id == 2) {
                            return 'เจ้าหน้าที่บัณฑิต';
                        } else if (full.role_id == 3) {
                            return 'เจ้าหน้าที่ประจำหลักสูตร';
                        } else {
                            return '';
                        }
                    }
                }, {
                    targets: [5],
                    className: 'text-left',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        if (full.role_id == 1) {
                            return 'All';
                        }

                        var pers = full.permission.split(',');
                        var html = '';
                        var isFirstRow = true;
                        $.each(pers, function (index, value) {
                            if (isFirstRow) {
                                html += value;
                                isFirstRow = false;
                            } else {
                                html += '<br>' + value;
                            }
                        });

                        return html;
                    }
                }
                , {
                    targets: [6],
                    className: 'text-left',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        if (full.last_login !== null) {
                            return full.last_login;
                        } else {
                            return '-';
                        }
                    }
                }, {
                    targets: [7],
                    className: 'text-center',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<div class="btn-group btn-group-sm btn-group-solid">';
                        html += '<a class="btn btn-xs red" onclick="doDelete(this)">ลบ';
                        html += '<i class="fa fa-trash-o"></i>';
                        html += '</a> ';
                        html += '<a href="' + editLink + '/' + full.user_id + '" class="btn btn-xs blue">แก้ไข';
                        html += '<i class="fa fa-edit"></i>';
                        html += '</a>';
                        html += '</div>';
                        return html;
                    }
                }
            ]
        });
    }

    function addDataToTbl(obj) {
        userTbl.fnAddData({
            'user_id': obj.hasOwnProperty('user_id') ? obj.user_id : null,
            'user_name': obj.hasOwnProperty('user_name') ? obj.user_name : null,
            'name': obj.hasOwnProperty('name') ? obj.name + ' (' + obj.nickname + ')' : null,
            'role_id': obj.hasOwnProperty('role_id') ? obj.role_id : null,
            'permission': obj.hasOwnProperty('permission') ? obj.permission : null,
            'last_login': obj.hasOwnProperty('last_login') ? obj.last_login : null
        }, false);
    }

    function doLoadData() {
        $.ajax({
            url: '{{route('admin.adminManage.doPaging')}}',
            method: "get",
            success: function (result) {
                if (result.status == 'success') {
                    userTbl.fnClearTable();
                    $.each(result.data, function (index, value) {
                        addDataToTbl(value);
                    });
                    userTbl.fnDraw();
                } else {
                    userTbl.fnClearTable();
                    userTbl.fnDraw();
                }
            }
        });
    }

    function doDelete(obj) {

        swal({
                html: true,
                title: "ต้องการจะลบข้อมูล ?",
                text: "",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#E7505A",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก"
            },
            function (isConfirm) {
                if (!isConfirm) {
                    return;
                }

                var tr = $(obj).closest('tr');
                var data = userTbl.fnGetData(tr);
                $.ajax({
                    url: '{{route('admin.adminManage.doDelete')}}',
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    method: "POST",
                    data: 'user_id=' + data.user_id,
                    success: function (result) {
                        swal({
                            html: true,
                            title: result.message,
                            text: "",
                            type: result.status
                        });
                        if (result.status == 'success') {
                            doLoadData();
                        }
                    }
                });
            }
        );

    }

    $(document).ready(function () {
        initForm();
        initDatatable();
        doLoadData();
    });
</script>
@endpush
