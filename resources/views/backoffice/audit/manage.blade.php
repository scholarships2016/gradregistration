@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<style type="text/css">

</style>
@endpush

@section('pagebar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Logs & Stat</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Transaction Log</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        Transaction Log
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
                        <span class="caption-subject font-dark sbold uppercase">TRANSACTION LOG</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group pull-right">
                            <button class="btn blue-steel  btn-outline dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">Tools
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:window.print();">
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
                    </div>
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable"
                               id="auditTbl" style="width:100%">
                            <thead>
                            <tr role="row" class="heading">
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center"> ประเภท</th>
                                <th class="text-left"> ผู้ดำเนินการ</th>
                                <th class="text-center"> action</th>
                                <th class="text-left"> รายละเอียด</th>
                                <th class="text-left"> วัน-เวลา</th>
                                <th></th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <select id="section" name="section" class="form-control form-filter select2">
                                        @if(!empty($sections))
                                            @foreach($sections as $sec)
                                                <option value="{{$sec->section}}">{{$sec->section}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="performer"></td>
                                </td>
                                <td>
                                    <select id="audit_action_id" name="audit_action_id"
                                            class="form-control form-filter select2">
                                        @if(!empty($actions))
                                            @foreach($actions as $act)
                                                <option value="{{$act->audit_action_id}}">{{$act->audit_action_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="detail">
                                </td>
                                <td style="width: 20px">
                                    <div class="input-group input-large date-picker input-daterange"
                                         data-date="10/11/2012" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="form-control form-filter" id="from_date"
                                               name="from_date">
                                        <span class="input-group-addon"> ถึง </span>
                                        <input type="text" class="form-control form-filter" id="to_date" name="to_date">
                                    </div>
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                    <button class="btn btn-sm red btn-outline filter-cancel" onclick="clearFilter()">
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
<script src="{{asset('assets/global/plugins/jquery.pulsate.min.js" type="text/javascript')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/holder.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var grid;

    var select2Option = {
        placeholder: '--Select--',
        allowClear: true,
        width: '100%'
    };

    function initDatatable() {

        grid = new Datatable();

        grid.init({
            src: $("#auditTbl"),
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
//                    $("#auditTbl tr.filter .form-control").each(function() {
//                        sValue[$(this).attr('name')] = $(this).val();
//                    });
//                    return sValue;
                },

                // read the custom filters from saved state and populate the filter inputs
                "fnStateLoadParams": function (oSettings, oData) {
//                    $("#auditTbl tr.filter .form-control").each(function() {
//                        var element = $(this);
//                        if (oData[element.attr('name')]) {
//                            element.val( oData[element.attr('name')] );
//                        }
//                    });
//                    return true;
                },

                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here
                ],
                "pageLength": 50, // default record count per page
                "ajax": {
                    "url": '{{route('admin.audit.doPaging')}}',
                    "method": "get"
                },
                "ordering": true,
                "order": [
                    [1, "asc"]
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
                            return meta.row + 1;
                        }
                    }, {
                        targets: 1,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return full.section;
                        }
                    }, {
                        targets: 2,
                        class: 'text-left',
                        render: function (data, type, full, meta) {
                            return full.name;
                        }
                    }, {
                        targets: 3,
                        class: 'text-center',
                        render: function (data, type, full, meta) {
                            return full.audit_action_name;
                        }
                    }, {
                        targets: 4,
                        class: 'text-left',
                        render: function (data, type, full, meta) {
                            return full.detail;
                        }
                    }, {
                        targets: 5,
                        class: 'text-center',
                        width: '10%',
                        render: function (data, type, full, meta) {
                            return full.action_date;
                        }
                    }, {
                        targets: 6,
                        class: 'text-center',
                        orderable: false,
                        render: function (data, type, full, meta) {
                            return '-';
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

    function clearFilter() {
        $('#section').val(null).trigger("change");
        $('#audit_action_id').val(null).trigger("change");
    }


    $(document).ready(function () {
        $(".date-picker input[type='text']").inputmask("d-m-y");
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true,
            clearBtn: true
        });

        $(".select2").select2(select2Option);
        $("#section").val('').change();
        $("#audit_action_id").val('').change();

        initDatatable();

    });
</script>
@endpush