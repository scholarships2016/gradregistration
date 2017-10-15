@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css">
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
                <a href="#">จัดการข้อมูล Master</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">ข้อมูลหลักสูตร</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        ตั้งค่า ข้อมูลหลักสูตร
    </h1>
@stop



@section('maincontent')
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: Demo Datatable 1 -->
            <div class="portlet light portlet-fit portlet-datatable bordered" id="mcourseBox">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">รายการ ข้อมูลหลักสูตร</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">

                                    <a href="{{route('admin.masterInfo.showMCourseAddPage')}}"
                                       class="btn btn-circle green btn-outline sbold uppercase">
                                        <i class="fa fa-plus"></i> เพิ่มข้อมูล
                                    </a>
                                    <a href="javascript:;" id="btn-syn-data"
                                       class="btn btn-circle blue btn-outline sbold uppercase">
                                        <i class="fa fa-exchange"></i> ดึงข้อมูลจากฐานข้อมูลกลาง
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable"
                               id="courseTbl" style="width:100%">
                            <thead>
                            <tr role="row" class="heading">
                                <th>
                                    No.
                                </th>
                                <th class="text-center"> รหัสหลักสูตร</th>
                                <th> ชื่อหลักสูตร</th>
                                <th class="text-center"> แผน</th>
                                <th> สังกัด</th>
                                <th class="text-center"> สถานะ</th>
                                <th> Actions</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="mcoursecode">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="thai"></td>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="plan"></td>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="owner">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="status">
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                    <button class="btn btn-sm red btn-outline filter-cancel">
                                        <i class="fa fa-times"></i> Reset
                                    </button>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<!--
<script src="{{asset('assets/global/plugins/jquery.pulsate.min.js" type="text/javascript')}}"></script>
-->
<script src="{{asset('assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/holder.js')}}" type="text/javascript"></script>

<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var grid;

    function initDatatable() {

        grid = new Datatable();

        grid.init({
            src: $("#courseTbl"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'กำลังโหลด...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                // save datatable state(pagination, sort, etc) in cookie.
                "bStateSave": true,

                // save custom filters to the state
                "fnStateSaveParams": function (oSettings, sValue) {

                },

                // read the custom filters from saved state and populate the filter inputs
                "fnStateLoadParams": function (oSettings, oData) {

                },

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, 'All'] // change per page values here
                ],
                "pageLength": 50, // default record count per page
                "ajax": {
                    "url": '{{route('admin.masterInfo.getMCourseData')}}',
                    "method": "get"
                },
                "ordering": true,
                "order": [
                    [5, "desc"]
                ],// set first column as a default sort by asc
                "language": {
                    "loadingRecords": "กำลังโหลด ...",
                    "zeroRecords": "ไม่พบรายการ",
                    "emptyTable": "ไม่มีรายการ",
                    "info": "&nbsp;&nbsp;แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
                    "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                },
                "columnDefs": [
                    {
                        targets: 0,
                        orderable: false,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return full.rownum;
                        }
                    }, {
                        targets: 1,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return full.coursecodeno;
                        }
                    }, {
                        targets: 2,
                        class: 'text-left',
                        render: function (data, type, full, meta) {
                            return full.thai;
                        }
                    }, {
                        targets: 3,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return full.plan;
                        }
                    }, {
                        targets: 4,
                        class: 'text-left',
                        render: function (data, type, full, meta) {
                            return full.full_owner;
                        }
                    }, {
                        targets: 5,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return full.status;
                        }
                    }, {
                        targets: 6,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            var editLink = '{{url("admin/setting/masterInfo/edit")}}';

                            var html = '';
                            html += '<div class="btn-group btn-group-sm btn-group-solid">';
                            html += '<a class="btn btn-xs red" onclick="doDelete(\'' + full.coursecodeno + '\')">ลบ<i class="fa fa-trash-o"></i></a>';
                            html += '<a href="' + editLink + '/' + full.coursecodeno +
                                '" class="btn btn-xs blue">แก้ไข<i class="fa fa-edit"></i></a>';
                            html += '</div>';
                            return html;
                        }
                    }
                ],
                "drawCallback": function (setting) {
                }

            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
        });

    }

    function doDelete(id) {

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
                $.ajax({
                    url: '{{route('admin.masterInfo.doDelete')}}',
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    method: "POST",
                    data: 'coursecodeno=' + id,
                    success: function (result) {
                        swal({
                            html: true,
                            title: result.message,
                            text: "",
                            type: result.status
                        });
                        if (result.status == 'success') {
                            grid.getDataTable().ajax.reload();
                        }
                    }
                });
            }
        );
    }

    function updateMcourse() {
        $.ajax({
            url: '{{route('admin.masterInfo.updateMcourse')}}',
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            },
            method: "POST",
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                App.unblockUI('#mcourseBox');
            }
        });
    }


    $(document).ready(function () {
        initDatatable();

        $('#btn-syn-data').click(function () {
            App.blockUI({
                target: '#mcourseBox',
                animate: true
            });
            updateMcourse();
        });

    });
</script>
@endpush
