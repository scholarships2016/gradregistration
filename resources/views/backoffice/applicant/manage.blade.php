@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css">
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
                <a href="#">User Management</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">จัดการข้อมูลผู้สมัคร</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        จัดการข้อมูลผู้สมัคร
    </h1>
@stop



@section('maincontent')
    <div class="row">
        <div class="col-md-12">

            <!-- Begin: Demo Datatable 1 -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">ข้อมูลผู้สมัคร</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <div id="searchFormDiv" class="m-heading-1 border-green m-bordered">
                            <h3>กำหนดเงื่อนไขการแสดงข้อมูล</h3>
                            <p>
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ลงทะเบียนถึงวันที่ ถึง วันที่</label>
                                        <div class="input-group input-large date-picker input-daterange"
                                             data-date="10/11/2012" data-date-format="dd-mm-yyyy">
                                            <input type="text" class="form-control" id="from_date" name="from_date">
                                            <span class="input-group-addon"> ถึง </span>
                                            <input type="text" class="form-control" id="to_date" name="to_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ระบุ อีเมล์/เลขบัตรประจำตัวประชาชน/ชื่อ-สกุล</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="emailCitizenFullname"
                                                   name="emailCitizenFullname"
                                                   placeholder="อีเมล์/เลขบัตรประจำตัวประชาชน/ชื่อ-สกุล">
                                            <span class="input-group-btn">
                                                <button class="btn btn-xs yellow" id="searchBt" type="button">ค้นหา
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable"
                               id="applicantTbl">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    ลำดับ
                                </th>
                                <th width="5%"> เลขประจำตัวประชาชน</th>
                                <th width="15%"> ชื่อ-นามสกุล</th>
                                <th width="200"> อีเมล์</th>
                                <th width="10%"> สิทธิ์พิเศษ</th>
                                <th width="10%"> วันที่ลงทะเบียน</th>
                                <th width="10%"> ข้อมูล Login</th>
                                <th width="10%"> Actions</th>
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
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var grid;


    function initForm() {

        $(".date-picker input[type='text']").inputmask("d-m-y");
        $("#applicantTbl .date-picker").inputmask("d-m-y");
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true,
            clearBtn: true
        });


        $("#searchFormDiv #searchBt").on('click', function () {
            reloadTable();
        });
    }

    function initDatatable() {

        grid = new Datatable();

        grid.init({
            src: $("#applicantTbl"),
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
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 50, // default record count per page
                "ajax": {
                    "url": "{{route('admin.applicantManage.doPaging')}}", // ajax source
                    "method": "get"
                },
                "ordering": false,
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
                "columnDefs": [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        targets: 1,
                        render: function (data, type, full, meta) {
                            return full.stu_citizen_card;
                        }
                    },
                    {
                        targets: 2,
                        render: function (data, type, full, meta) {
                            return full.fullname_th + "<br>" + full.fullname_en;
                        }
                    }, {
                        targets: 3,
                        render: function (data, type, full, meta) {
                            return full.stu_email;
                        }
                    }, {
                        targets: 4,
                        render: function (data, type, full, meta) {
                            return '-';
                        }
                    }, {
                        targets: 5,
                        render: function (data, type, full, meta) {
                            return full.register_date;
                        }
                    }, {
                        targets: 6,
                        render: function (data, type, full, meta) {
                            return (full.login_datetime == null ? '' : full.login_datetime) + ' - ' + (full.login_ip == null ? '' : full.login_ip);
                        }
                    }, {
                        targets: 7,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            var html = '';
                            html += '<div class="btn-group">';
                            html += '<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions';
                            html += '<i class="fa fa-angle-down"></i>';
                            html += '</button>';
                            html += '<ul class="dropdown-menu pull-left" role="menu">';
                            html += '<li>';
                            html += '<a href="javascript:;">';
                            html += '<i class="fa fa-file-o"></i> View </a>';
                            html += '</li>';
                            html += '<li>';
                            html += '<a href="javascript:;">';
                            html += '<i class="fa fa-edit"></i> Edit Profile </a>';
                            html += '</li>';
                            html += '<li>';
                            html += '<a href="javascript:;">';
                            html += '<i class="fa fa-trash-o"></i> Delete </a>';
                            html += '</li>';
                            html += '<li class="divider"> </li>';
                            html += '<li>';
                            html += '<a href="javascript:;">';
                            html += '<i class="icon-flag"></i> ให้สิทธิ์สมัครกรณีพิเศษ';
                            html += '</a>';
                            html += '</li>';
                            html += '</ul>';
                            html += '</div>';
                            return html;
                        }
                    }
                ]

            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
        });

        //grid.setAjaxParam("customActionType", "group_action");
//        grid.getDataTable().ajax.reload();
        //grid.clearAjaxParams();

    }

    function reloadTable() {
        grid.setAjaxParam("from_date", $('#from_date').val());
        grid.setAjaxParam("to_date", $('#to_date').val());
        grid.setAjaxParam("emailCitizenFullname", $('#emailCitizenFullname').val());
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }

    function doDelete(id) {
        var formData = new FormData();
        formData.append('curriculum_id', id);
        $.ajax({
            url: '{{route('admin.curriculum.doDelete')}}',
            headers: {
                'X-CSRF-Token': $("#searchForm").find("input[name='_token']").val()
            },
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                if (result.status == 'success') {
                    reloadTable();
                }
            }
        });
    }


    $(document).ready(function () {
        initForm();
        initDatatable();
    });
</script>
@endpush