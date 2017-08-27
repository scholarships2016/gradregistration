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

            <!-- Begin: Demo Datatable 1 -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">ข้อมูลหลักสูตร</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{route('admin.curriculum.showAdd')}}" target="_self"
                               class="btn btn-circle green btn-outline sbold uppercase">
                                ขอเปิดหลักสูตร
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="m-heading-1 border-green m-bordered">
                        <form id="searchForm">
                            {{csrf_field()}}
                            <h3>กำหนดเงื่อนไขการแสดงข้อมูล</h3>
                            <p>
                            </p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>คณะ</label>
                                        <select id="faculty_id" name="faculty_id" class="form-control select2">
                                            @if(!empty($facList))
                                                @foreach($facList as $fac)
                                                    <option value="{{$fac->faculty_id}}">{{$fac->faculty_name.' ('.$fac->faculty_full.')'}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ประเภทหลักสูตร</label>
                                        <select id="program_type_id" name="program_type_id"
                                                class="form-control select2">
                                            @if(!empty($progTypeList))
                                                @foreach($progTypeList as $prog)
                                                    <option value="{{$prog->program_type_id}}">{{$prog->prog_type_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>ภาคการศึกษา</label>
                                        <select id="semester" name="semester"
                                                class="form-control select2">
                                            <option value="1">ภาคต้น</option>
                                            <option value="2">ภาคปลาย</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>ปีการศึกษา</label>
                                        <select id="academic_year" name="academic_year"
                                                class="form-control select2">
                                            @if(!empty($acaYearList))
                                                @foreach($acaYearList as $acaYear)
                                                    <option value="{{$acaYear->academic_year}}">{{$acaYear->academic_year}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>วีธีรับสมัคร</label>
                                        <select id="apply_method" name="apply_method"
                                                class="form-control select2">
                                            <option value="1">รับผ่านบัณฑิต</option>
                                            <option value="2">รับตรงโดยหลักสูตร</option>
                                        </select>
                                        <!-- /input-group -->
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>สถานะ</label>
                                        <select id="is_approve" name="is_approve"
                                                class="form-control select2">
                                            <option value="1">Draft</option>
                                            <option value="2">Pending</option>
                                            <option value="3">Rejected</option>
                                            <option value="4">Approved</option>
                                        </select>
                                        <!-- /input-group -->
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-top:20px;">
                                    <a href="javascript:;" id="searchBt" class="btn yellow"> ค้นหา
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>


                            <p></p>
                        </form>
                    </div>
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable"
                               id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th>ลำดับ</th>
                                <th>รหัส</th>
                                <th>คณะ</th>
                                <th>ภาควิชา</th>
                                <th>สาขาวิชา</th>
                                <th>รหัสโปรแกรม</th>
                                <th>ชื่อโปรแกรม</th>
                                <th>วิธีรับสมัคร</th>
                                <th>สถานะ</th>
                                <th>Actions</th>
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
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/select2-cascade.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var grid;

    var select2Option = {
        placeholder: '--เลือก--',
        allowClear: true,
        width: '100%'
    };

    function initForm() {
        $('.select2').select2(select2Option);
        $('#faculty_id').val('').change();
        $('#program_type_id').val('').change();
        $('#academic_year').val('').change();
        $('#semester').val('').change();
        $('#apply_method').val('').change();
        $('#is_approve').val('').change();

        $("#searchBt").on('click', function () {
            reloadTable();
        });
    }

    function initDatatable() {
        grid = new Datatable();
        grid.init({
            src: $("#datatable_ajax"),
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
            dataTable: {
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "แสดง _START_ - _END_ ของ _TOTAL_ รายการ",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(กรอง 1 จาก _MAX_ รายการทั้งหมด)",
                    "lengthMenu": "_MENU_ รายการ&nbsp;",
                    "search": "Search:",
                    "zeroRecords": "ไม่พบรายการ"
                },

                // here you can define a typical datatable settings from http://datatables.net/usage/options

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                // save datatable state(pagination, sort, etc) in cookie.
                "bStateSave": true,

                // save custom filters to the state
                "fnStateSaveParams": function (oSettings, sValue) {
//                    $("#datatable_ajax tr.filter .form-control").each(function () {
//                        sValue[$(this).attr('name')] = $(this).val();
//                    });
//
//                    return sValue;
                },

                // read the custom filters from saved state and populate the filter inputs
                "fnStateLoadParams": function (oSettings, oData) {

                    //Load custom filters
//                    $("#datatable_ajax tr.filter .form-control").each(function () {
//                        var element = $(this);
//                        if (oData[element.attr('name')]) {
//                            element.val(oData[element.attr('name')]);
//                        }
//                    });
//
//                    return true;
                },

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 50, // default record count per page
                "ajax": {
                    "url": '{{route('admin.curriculum.doPaging1')}}', // ajax source
                    "method": 'get'
                },
                "ordering": true,
                "order": [
                    [1, "asc"]
                ],
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
                            return full.curriculum_id;
                        }
                    },
                    {
                        targets: 2,
                        render: function (data, type, full, meta) {
                            return full.faculty_name;
                        }
                    }, {
                        targets: 3,
                        render: function (data, type, full, meta) {
                            return full.department_name;
                        }
                    }, {
                        targets: 4,
                        render: function (data, type, full, meta) {
                            return full.major_name;
                        }
                    }, {
                        targets: 5,
                        render: function (data, type, full, meta) {
                            return full.curriculum_progs;
                        }
                    }, {
                        targets: 6,
                        render: function (data, type, full, meta) {
                            return full.degree_name;
                        }
                    }, {
                        targets: 7,
                        render: function (data, type, full, meta) {
                            var html = '';
                            if (full.apply_method == 1) {
                                html = 'รับผ่านบัณฑิต';
                            } else if (full.apply_method == 2) {
                                html = 'รับตรงโดยหลักสูตร';
                            }
                            return html;
                        }
                    }, {
                        targets: 8,
                        render: function (data, type, full, meta) {
                            var html = '';
                            if (full.is_approve == 1) {
                                html = '<span class="label label-sm label-default">Draft</span>';
                            } else if (full.is_approve == 2) {
                                html = '<span class="label label-sm label-warning">Pending</span>';
                            } else if (full.is_approve == 3) {
                                html = '<span class="label label-sm label-danger">Rejected</span>';
                            } else if (full.is_approve == 4) {
                                html = '<span class="label label-sm label-success">Approved</span>';
                            }
                            return html;
                        }
                    }, {
                        targets: 9,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            var editLink = '{{url("admin/management/curriculum/edit")}}';
                            var html = '<div class="btn-group">';
                            html += '<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions';
                            html += '<i class="fa fa-angle-down"></i>';
                            html += '</button>';
                            html += '<ul class="dropdown-menu pull-left" role="menu">';
                            html += '<li>';
                            html += '<a href="' + editLink + '/' + full.curriculum_id + '"><i class="fa fa-file-o"></i> ดูรายละเอียด </a>';
                            html += '</li>';
                            html += '<li>';
                            html += '<a href="' + editLink + '/' + full.curriculum_id + '"><i class="fa fa-edit"></i> แก้ไข </a>';
                            html += '</li>';
                            html += '<li>';
                            html += '<a onclick="doDelete(\'' + full.curriculum_id + '\')"><i class="fa fa-trash-o"></i> ลบ </a>';
                            html += '</li>';
                            html += '<li class="divider"> </li>';
                            html += '<li>';
                            html += '<a href="javascript:;"><i class="fa fa-copy"></i> Duplicate </a>';
                            html += '</li>';
                            html += '</ul>';
                            html += '</div>';
                            return html;
                        }
                    }
                ]
            }
        });

    } 

    function reloadTable() {
        grid.setAjaxParam("faculty_id", $('#faculty_id').val());
        grid.setAjaxParam("program_type_id", $('#program_type_id').val());
        grid.setAjaxParam("academic_year", $('#academic_year').val());
        grid.setAjaxParam("semester", $('#semester').val());
        grid.setAjaxParam("apply_method", $('#apply_method').val());
        grid.setAjaxParam("is_approve", $('#is_approve').val());
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