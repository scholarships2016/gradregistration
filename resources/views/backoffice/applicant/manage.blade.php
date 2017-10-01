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
                <a href="#">ผู้ใช้งาน</a>
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
    @include('includes.applicant.applicantAuth')
    @include('includes.applicant.applicantProgramInfoActionRemove')
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
                               id="applicantTbl" style="width:100%">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    ลำดับ
                                </th>
                                <th width=""> เลขประจำตัวประชาชน</th>
                                <th width="25%"> ชื่อ-นามสกุล</th>
                                <th> อีเมล์&หมายเลขโทรศัพท์</th>
                                <th> หลักสูตรที่สมัคร</th>
                                <th> วันที่ลงทะเบียน</th>
                                <th> ข้อมูล Login</th>
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

<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var grid;

    var user_id = '{{session('user_id')}}'
    var user_role = '{{session('user_type')->user_type}}';

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
                "ordering": true,
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
                "columnDefs": [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            return meta.row + 1 +(user_id==full.creator?'<br/><i class="fa fa-pencil" title="ข้อมูลผู้สอบได้ นำเข้าด้วย Excel สามารถแก้ไขปรับปรุงได้"></i>':'');
                        }
                    },
                    {
                        targets: 1,
                        orderable: true,
                        render: function (data, type, full, meta) {
                            return full.stu_citizen_card;
                        }
                    },
                    {
                        targets: 2,
                        orderable: true,
                        render: function (data, type, full, meta) {
                            var html = '';
                            if (full.fullname_th !== null) {
                                html += full.fullname_th + "<br>";
                            }

                            if (full.fullname_en !== null) {
                                html += full.fullname_en
                            }

                            return html;

                        }
                    }, {
                        targets: 3,
                        orderable: true,
                        render: function (data, type, full, meta) {
                            var html = full.stu_email == null ? '' : full.stu_email;
                            if (full.stu_phone !== null) {
                                html += "<br>";
                                html += full.stu_phone;
                            }
                            return html;
                        }
                    }, {
                        targets: 4,
                        orderable: true,
                        render: function (data, type, full, meta) {
                            var html = '';
                            if (full.curriculum_progs !== null) {
                                var currProg = full.curriculum_progs.split(',');
                                currProg.forEach(function (item, index) {
                                    var progInfos = item.split('|');
                                    html += '<a onclick="prepareProgramInfo(this)" data-application_id="' + progInfos[0] + '" data-curr_prog_id="' + progInfos[1] + '"><span class="badge badge-info">' + progInfos[2] + '</span></a>';
                                });
                            }
                            return html;
                        }
                    }, {
                        targets: 5,
                        orderable: true,
                        render: function (data, type, full, meta) {
                            return full.register_date;
                        }
                    }, {
                        targets: 6,
                        orderable: true,
                        render: function (data, type, full, meta) {
                            return (full.login_datetime == null ? '' : full.login_datetime) + ' - ' + (full.login_ip == null ? '' : full.login_ip);
                        }
                    }, {
                        targets: 7,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            var editLink = '{{url("admin/setting/applicantManage/edit")}}'
                            var viewLink = '{{url("admin/setting/applicantManage/view")}}';
                            var html = '';
                            html += '<div class="btn-group">';
                            html += '<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions';
                            html += '<i class="fa fa-angle-down"></i>';
                            html += '</button>';
                            html += '<ul class="dropdown-menu pull-right" role="menu">';
                            html += '<li>';
                            html += '<a target="_blank" href="' + viewLink + '/' + full.applicant_id + '">';
                            html += '<i class="fa fa-file-o"></i> ดูรายละเอียด </a>';
                            html += '</li>';
                            if(user_role=="Admin" || user_id==full.creator ){
                            html += '<li>';
                            html += '<a target="_blank"  href="' + editLink + '/' + full.applicant_id + '#tab_1_3">';
                            html += '<i class="fa fa-edit"></i> แก้ไข </a>';
                            html += '</li>';
                            html += '<li>';
                            html += '<a onclick="doDelete(\'' + full.applicant_id + '\')">';
                            html += '<i class="fa fa-trash-o"></i> ลบ </a>';
                            html += '</li>';
                            html += '<li class="divider"> </li>';
                            html += '<li>';
                            }
                            if(user_role=="Admin"){
                            html += '<a href="javascript:;" onclick="prepareApplicantAuth(\'' + full.applicant_id + '\')">';
                            html += '<i class="icon-flag"></i> ให้สิทธิ์สมัครกรณีพิเศษ';
                            html += '</a>';
                            }
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

                var formData = new FormData();
                formData.append('applicant_id', id);
                $.ajax({
                    url: '{{route('admin.applicantManage.doDelete')}}',
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    success: function (result) {
                        swal({
                            html: true,
                            title: result.message,
                            text: "",
                            type: result.status
                        });
                        if (result.status == 'success') {
                            reloadTable();
                        }
                    }
                });
            }
        );
    }

    function prepareProgramInfo(obj) {
        //Clear Data
        var modalInfo = $("#applicationProgramInfoActionRemoveModal");
        modalInfo.find("#application_id").val(null);
        modalInfo.find("#curr_prog_id").val(null);
        modalInfo.find("#flow_name_p").text('');
        modalInfo.find("#program_id_p").text('');
        modalInfo.find("#prog_name_p").text('');
        modalInfo.find("#plan_p").text('');
        modalInfo.find("#prog_type_name_p").text('');


        modalInfo.find("#ajaxLoading").show();
        modalInfo.find("#applicationInfoForm").hide();
        modalInfo.find("#deleteBtn").attr('disabled', 'disabled');
        modalInfo.find("#downloadDocButton").attr('href', '');
        modalInfo.modal('show');

        var param = $(obj).data();
        $.ajax({
            url: '{{route('admin.applicantManage.getApplicationAndProgramInfo')}}',
            method: "GET",
            data: param,
            success: function (result) {
                if (result.status == 'success') {
                    var data = result.data;
                    var modalInfo = $("#applicationProgramInfoActionRemoveModal");
                    modalInfo.find("#application_id").val(data.application_id);
                    modalInfo.find("#curr_prog_id").val(data.curr_prog_id);
                    modalInfo.find("#flow_name_p").html(data.flow_name == null ? '-' : data.flow_name
                    + (data.flow_id=='4'&&data.exam_status=='2'? ' : <b>มีสิทธิ์สอบ</b>' : (data.flow_id=='4'&&data.exam_status=='3'?' : <b>ไม่มีสิทธิ์สอบ</b>':''))
                    + (data.flow_id=='5'&&data.admission_status_name_th != null ? ' : <b>'+data.admission_status_name_th +'</b>' : ''));
                    modalInfo.find("#program_id_p").text(data.program_id == null ? '-' : data.program_id);
                    modalInfo.find("#prog_name_p").text(data.prog_name == null ? '-' : data.prog_name);
                    modalInfo.find("#plan_p").text(data.plan == null ? '-' : data.plan);
                    modalInfo.find("#prog_type_name_p").text(data.prog_type_name == null ? '-' : data.prog_type_name);
                    modalInfo.find("#downloadDocButton").attr('href', '{{url("admin/docMyCourse/")}}/'+ data.applicant_id +'/' + data.application_id);
                    modalInfo.find("#ajaxLoading").hide();
                    if(user_role=="Admin" || user_id==data.creator ){
                    modalInfo.find("#deleteBtn").removeAttr('disabled', 'disabled');
                  }else{
                    //no permission
                    $("#deleteBtn").css("display","none");
                  }
                    modalInfo.find("#applicationInfoForm").show();
                }
            }
        });
    }

    function deleteApplication(event) {
        var modalInfo = $("#applicationProgramInfoActionRemoveModal");
        modalInfo.modal('hide');

        swal({
                html: true,
                title: "ต้องการจะลบใบสมัคร ?",
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
//                    modalInfo.modal('show');
                    return;
                }

                var data = $("#applicationProgramInfoActionRemoveModal #applicationInfoForm").serializeArray();
                $.ajax({
                    url: '{{route('admin.applicantManage.doDeleteApplication')}}',
                    method: "POST",
                    data: data,
                    success: function (result) {
                        swal({
                            html: true,
                            title: result.message,
                            text: "",
                            type: result.status
                        });
                        if (result.status == 'success') {
                            reloadTable();
                        }
                    }
                });

            }
        );

    }

    function prepareApplicantAuth($id) {
        $("#applicantAuthModal").modal('show');
    }


    $(document).ready(function () {
        initForm();
        initDatatable();
    });
</script>
@endpush
