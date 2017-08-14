@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet"
      type="text/css"/>
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
                <a href="#">จัดการข้อมูลหลักสูตร</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">รายการหลักสูตร</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        จัดการข้อมูลหลักสูตร
    </h1>
@stop



@section('maincontent')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">รายการการเปิดรับสมัคร</span>
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
                                    <a href="{{route('admin.applysetting.showAdd')}}"
                                       class="btn btn-circle green btn-outline sbold uppercase">
                                        <i class="fa fa-plus"></i> เพิ่มการเปิดรับสมัคร
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="applySettingTbl" style="width: 100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th class="text-center" style="width: 20px"> No.</th>
                            <th class="text-center" style="width: 100px"> ภาคการศึกษา</th>
                            <th class="text-center" style="width: 80px"> ปีการศึกษา</th>
                            <th class="text-center"> รอบที่ 1</th>
                            <th class="text-center"> รอบที่ 2</th>
                            <th class="text-center"> รอบที่ 3</th>
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
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var editUrl = "{{route('admin.applysetting.showEdit')}}";

    var applySettingTbl;

    function initForm() {
    }

    function initDatatable() {

        applySettingTbl = $('#applySettingTbl').dataTable({
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
                        var html = '';
                        if (full.semester == 1) {
                            html += 'ต้น';
                        } else if (full.semester == 2) {
                            html += 'ปลาย';
                        }
                        return html;
                    }
                },
                {
                    targets: [3],
                    className: 'text-center',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return full.academic_year;
                    }
                }, {
                    targets: [4],
                    className: 'text-center',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        if (full.round_1 === '-') {
                            return full.round_1;
                        }
                        var roundArr = full.round_1.split('|');
                        var html = roundArr[0];

                        if (roundArr[1] == 0 || (1 < full.is_open_round && full.is_open_round !== 0)) {
                            html += '&nbsp;&nbsp;<div class="label label-danger">ปิด</div>';
                        } else if (1 == full.is_open_round) {
                            html += '&nbsp;&nbsp;<div class="label label-success">เปิด</div>';
                        }

                        return html;
                    }
                }, {
                    targets: [5],
                    className: 'text-center',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        if (full.round_2 === '-') {
                            return full.round_2;
                        }
                        var roundArr = full.round_2.split('|');
                        var html = roundArr[0];

                        if (roundArr[1] == 0 || (2 < full.is_open_round && full.is_open_round !== 0)) {
                            html += '&nbsp;&nbsp;<div class="label label-danger">ปิด</div>';
                        } else if (2 == full.is_open_round) {
                            html += '&nbsp;&nbsp;<div class="label label-success">เปิด</div>';
                        }

                        return html;
                    }
                }, {
                    targets: [6],
                    className: 'text-center',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        if (full.round_3 === '-') {
                            return full.round_3;
                        }
                        var roundArr = full.round_3.split('|');
                        var html = roundArr[0];

                        if (roundArr[1] == 0 || (3 < full.is_open_round && full.is_oepn_round !== 0)) {
                            html += '&nbsp;&nbsp;<div class="label label-danger">ปิด</div>';
                        } else if (3 == full.is_open_round) {
                            html += '&nbsp;&nbsp;<div class="label label-success">เปิด</div>';
                        }

                        return html;
                    }
                }
                , {
                    targets: [7],
                    className: 'text-center',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<div class="btn-group btn-group-sm btn-group-solid">';
                        html += '<a class="btn red" onclick="doDelete(this)">ลบ';
                        html += '<i class="fa fa-trash-o"></i>';
                        html += '</a>';
                        html += '<a href="' + editUrl + '?semester=' + full.semester + '&academic_year=' + full.academic_year + '" class="btn blue">แก้ไข';
                        html += '<i class="fa fa-edit"></i>';
                        html += '</a>';
                        html += '</div>';
                        return html;
                    }
                }
            ]
        });
    }

    function addDataToApplySettingTbl(obj) {
        var roundsStr;
        var rounds;
        var isOpenRound = 0;
        if (obj.hasOwnProperty('dateranges')) {
            roundsStr = obj.dateranges;
            rounds = roundsStr.split(',');
            $.each(rounds, function (index, value) {
                var buff = value.split('|');
                if (buff[2] == 1) {
                    isOpenRound = index + 1;
                    return false;
                }
            });
        }
        applySettingTbl.fnAddData({
            'academic_year': obj.hasOwnProperty('academic_year') ? obj.academic_year : '',
            'semester': obj.hasOwnProperty('semester') ? obj.semester : '',
            'round_1': isUndefinedOrNull(rounds[0]) ? '-' : rounds[0],
            'round_2': isUndefinedOrNull(rounds[1]) ? '-' : rounds[1],
            'round_3': isUndefinedOrNull(rounds[2]) ? '-' : rounds[2],
            'is_open_round': isOpenRound
        }, false);
    }

    function doLoadData() {
        $.ajax({
            url: '{{route('admin.applysetting.doPaging')}}',
            method: "get",
            success: function (result) {
                applySettingTbl.fnClearTable();
                $.each(result, function (index, value) {
                    addDataToApplySettingTbl(value);
                });
                applySettingTbl.fnDraw();
            }
        });
    }

    function doDelete(obj) {
        var tr = $(obj).closest('tr');
        var data = applySettingTbl.fnGetData(tr);
        $.ajax({
            url: '{{route('admin.applysetting.doDelete')}}',
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            },
            method: "POST",
            data: 'semester=' + data.semester + '&academic_year=' + data.academic_year,
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                if (result.status == 'success') {
                    doLoadData();
                }
            }
        });
    }

    $(document).ready(function () {
        initForm();
        initDatatable();
        doLoadData();
    });
</script>
@endpush