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
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">งานที่ต้องดำเนินการ</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        งานที่ต้องดำเนินการ
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
                        <span class="caption-subject font-dark sbold uppercase">รายการงานที่ต้องดำเนินการ</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <div id="searchFormDiv" class="m-heading-1 border-green m-bordered">
                            <h3>กำหนดเงื่อนไขการแสดงข้อมูล</h3>
                            <p>
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label>สถานะ</label>
                                        <div class="mt-checkbox-inline">

                                            <label class="mt-checkbox has-success">
                                                <input type="checkbox" name="is_approve[]" value="1" checked/>
                                                ฉบับร่าง - Draft
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" name="is_approve[]" value="2" @if(session('user_type')->user_type == 'Admin') checked @endif/>
                                                รออนุมัติ - Pending
                                                <span></span>
                                            </label>
                                            <!--
                                            <label class="mt-checkbox" @if(session('user_type')->user_type !== 'Admin') style="display:none" @endif>
                                                <input type="checkbox" name="is_approve[]" value="2" @if(session('user_type')->user_type == 'Admin') checked @endif/>
                                                Pending
                                                <span></span>
                                            </label>

                                          -->

                                            <label class="mt-checkbox">
                                                <input type="checkbox" name="is_approve[]" value="3" checked/>
                                                ส่งกลับให้แก้ไข - Rejected
                                                <span></span>
                                            </label>

                                            <label class="mt-checkbox" style="display:none">
                                                <input type="checkbox" name="is_approve[]" value="4" />
                                                อนุมัติ - Approved
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2" style="padding-top:25px;">
                                        <a href="javascript:;" id="searchBt" class="btn btn yellow"> ค้นหา
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable"
                               id="applicantTbl" style="width:100%">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    ลำดับ
                                </th>
                                <th width="5%"> ภาค</th>
                                <th width="10%"> ปีการศึกษา</th>
                                <th> รหัสหลักสูตร</th>
                                <th> ชื่อหลักสูตร</th>
                                <th> ส่งจาก</th>
                                <th> ส่งเมื่อ</th>
                                <th> สถานะ</th>
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
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<!--
<script src="{{asset('assets/global/plugins/jquery.pulsate.min.js" type="text/javascript')}}"></script>
-->
<script src="{{asset('assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/holder.js')}}" type="text/javascript"></script>

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
                    "url": '{{route('admin.backoffice.doPaging')}}',
                    "method": "get"
                },
                "ordering": true,
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
                "columnDefs": [
                    {
                        targets: 0,
                        orderable: false,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        targets: 1,
                        class: 'text-center',

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
                        targets: 2,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return full.academic_year;
                        }
                    }, {
                        targets: 3,
                        render: function (data, type, full, meta) {
                            var html = '';
                            if (full.program_ids !== null) {
                                var prog = full.program_ids.split(',');
                                prog.forEach(function (item, index) {
                                    html += '<span class="badge badge-info">' + item + '</span>';
                                });
                            }
                            return html;
                        }
                    }, {
                        targets: 4,
                        render: function (data, type, full, meta) {
                            return full.degree_name;
                        }
                    }, {
                        targets: 5,
                        render: function (data, type, full, meta) {
                            var html = '';
                            if (full.comment !== null && full.comment.length !== 0) {
                                html += '<a class="popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="' + full.comment + '" data-original-title="Comment">'
                                html += '<i class="icon-speech font-green"></i>';
                                html += '</a>&nbsp;';
                            }
                            html += full.name+' ('+full.nickname+')';
                            return html;
                        }
                    }, {
                        targets: 6,
                        render: function (data, type, full, meta) {
                            return full.created;
                        }
                    }, {
                        targets: 7,
                        render: function (data, type, full, meta) {
                            var html = '';
                            if (full.is_approve == 1) {
                                html = '<span class="label label-sm label-default">ฉบับร่าง-Draft</span>';
                            } else if (full.is_approve == 2) {
                                html = '<span class="label label-sm label-warning">รออนุมัติ-Pending</span>';
                            } else if (full.is_approve == 3) {
                                html = '<span class="label label-sm label-danger">ส่งกลับให้แก้ไข-Rejected</span>';
                            } else if (full.is_approve == 4) {
                                html = '<span class="label label-sm label-success">อนุมัติ-Approved</span>';
                            }
                            return html;
                        }
                    }, {
                        targets: 8,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            var editLink = '{{url("admin/management/curriculum/edit")}}'

                            var html = '';
                            if('{{session('user_type')->user_type}}' !== 'Admin' && full.is_approve == 2){
                              //do nothing
                            }else{

                              html += '<div class="btn-group btn-group-sm btn-group-solid">';
                              html += '<a href="' + editLink + '/' + full.curriculum_id + '" class="btn btn-xs blue">';
                              html += '<i class="fa fa-edit"></i>';
                              html += '</a>';
                              html += '</div>';
                          }
                            return html;
                        }
                    }
                ],
                "drawCallback": function (setting) {
                    $(".popovers").popover();
                }

            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
        });

        var ids = [];
        var statusIds = $("input[name='is_approve[]']:checked").serializeArray();
        statusIds.forEach(function (item, index) {
            ids.push(item.value);
        });
        grid.setAjaxParam("flow_status", ids.toString());
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();

    }

    function reloadTable() {
        var ids = [];
        var statusIds = $("input[name='is_approve[]']:checked").serializeArray();
        statusIds.forEach(function (item, index) {
            ids.push(item.value);
        });
        grid.setAjaxParam("flow_status", ids.toString());
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }


    $(document).ready(function () {
        initForm();
        initDatatable();
    });
</script>
@endpush
