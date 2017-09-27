@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
      type="text/css"/>
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
                <a href="/">{{Lang::get('resource.lbMHome')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{Lang::get('resource.lbMProfile')}}</span>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
    </h1>
@stop



@section('maincontent')
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase">แบบฟอร์มขอเปิดหลักสูตร</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only blue" href="javascript:;">
                    <i class="icon-cloud-upload"></i>
                </a>
                <a class="btn btn-circle btn-icon-only green" href="javascript:;">
                    <i class="icon-wrench"></i>
                </a>
                <a class="btn btn-circle btn-icon-only red" href="javascript:;">
                    <i class="icon-trash"></i>
                </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                   data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="progSettingForm" role="form" class="form-horizontal"
                  method="post">
                {{csrf_field()}}
                <input type="hidden" id="curriculum_id" name="curriculum_id" value=""/>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="col-md-5 control-label"
                                   for="apply_setting_id"><strong>ภาคการศึกษาและปีการศึกษาที่เปิดรับสมัคร</strong>
                                <span class="required" aria-required="true"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="hidden" id="semester_hidden" name="semester_hidden" value=""/>
                                <select id="semester" name="semester" class="form-control">
                                    @if(!empty($applySemesterList))
                                        @foreach($applySemesterList as $value)
                                            <option value="{{$value->semester.'|'.$value->academic_year}}">{{$value->semester_th.' / '.$value->academic_year}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="roundDiv" class="row">
                        <input type="hidden" id="openRoundNo" name="openRoundNo"/>
                        <div class="col-md-12 form-group">
                            <label class="col-md-5 control-label"
                                   for="round_no"><strong>รอบที่เปิดรับสมัคร</strong>
                                <span class="required" aria-required="true"> * </span>
                            </label>
                            <div class="col-md-6">
                                <div id="roundListDiv" class="mt-checkbox-list">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label col-md-3"><strong>วิธีรับสมัคร</strong>
                                <span class="required" aria-required="true"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="apply_method" value="1"> รับผ่านบัณฑิต
                                        <span></span>
                                    </label>
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="apply_method" value="2"> รับตรงโดยหลักสูตร
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="project_id"><strong>โครงการ</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <select name="project_id" id="project_id" class="form-control">
                                        @if(!empty($projList))
                                            @foreach($projList as $proj)
                                                <option value="{{$proj->project_id}}">{{$proj->project_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="project_id"><strong>คณะ</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="hidden" id="faculty_id_hidden" name="faculty_id_hidden" value=""/>
                                    <select name="faculty_id" id="faculty_id" class="form-control">
                                        @if(!empty($facList))
                                            @foreach($facList as $fac)
                                                <option value="{{$fac->faculty_id}}">{{$fac->faculty_name.' ('.$fac->faculty_full.')'}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"
                                       for="project_id"><strong>ภาควิชา/สหสาขา</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="hidden" id="department_id_hidden" name="department_id_hidden"
                                           value=""/>
                                    <select name="department_id" id="department_id" class="form-control">
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="project_id"><strong>สาขาวิชา</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="hidden" id="major_id_hidden" name="major_id_hidden"
                                           value=""/>
                                    <select name="major_id" id="major_id" class="form-control">
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"
                                       for="sub_major_id"><strong>แขนงวิชา</strong></label>
                                <div class="col-md-9">
                                    <div id="sub_major" class="mt-checkbox-list">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label offset-col-md-3 col-md-2"
                                       for="project_id"><strong>ชื่อหลักสูตร</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-8">
                                    <input type="hidden" id="degree_id_hidden" name="degree_id_hidden" value=""/>
                                    <select name="degree_id" id="degree_id" class="form-control">
                                        @if(!empty($degList))
                                            @foreach($degList as $deg)
                                                <option value="{{$deg->degree_id}}">{{$deg->degree_name.' ('.$deg->degree_name_en.')'}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="currProgramTbl">
                                <thead>
                                <tr>
                                    <th style="width:50px">
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable"
                                                   data-set="#currProgramTbl .checkboxes"/>
                                            <span></span>
                                        </label>
                                    </th>
                                    <th style="width:60px"> รหัสหลักสูตร</th>
                                    <th style="width:170px"> ชื่อหลักสูตร</th>
                                    <th style="width:50px"> แผน</th>
                                    <th> ประเภท</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div id="roundFormDiv">
                        {{--For Round Form--}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-3"
                                       for="project_id"><strong>รายละเอียดเพิ่มเติม</strong></label>
                                <div class="col-md-9">
                                    <textarea id="additional_detail" class="form-control" name="additional_detail"
                                              rows="5"></textarea>
                                    <div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-3"
                                       for="project_id"><strong>ที่อยู่สำหรับส่งเอกสาร</strong></label>
                                <div class="col-md-9">
                                <textarea id="mailing_address" class="form-control" name="mailing_address"
                                          rows="5"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-3"
                                       for="project_id"><strong>ข้อมุลที่ต้องการเพิ่มเติมจากผู้สมัคร</strong></label>
                                <div class="col-md-9">
                                    <textarea id="additional_question" class="form-control" name="additional_question"
                                              rows="5"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"
                                       for="project_id"><strong>ค่าธรรมเนียม</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="number" id="apply_fee" name="apply_fee"
                                           class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"
                                       for="project_id"><strong>จำนวนนิสิตที่คาดว่าจะรับ</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-8">
                                    <input type="number" id="expected_amount"
                                           name="expected_amount"
                                           class="form-control">
                                    <span class="help-block">(คน)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"><strong>เอกสารประกอบหลักสูตร</strong></label>
                                <div class="col-md-9">

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <input type="hidden" id="canDownload" name="canDownload" value=""/>
                                        <div class="input-group input-large">
                                            <div class="form-control uneditable-input input-fixed input-large"
                                                 data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new"> เลือก </span>
                                                                    <span class="fileinput-exists"> เปลี่ยน </span>
                                                                    <input type="file" id="document_file"
                                                                           name="document_file"> </span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists"
                                               data-dismiss="fileinput"> ลบ </a>
                                            <a href="" id="fileinputDownloadBtn"
                                               class="input-group-addon btn green fileinput-exists"
                                               onclick="downloadFile(this)" target="_blank" download> ดาวน์โหลด </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 well">
                            <div class="col-md-12 text-left">
                                <h4><u>ผ่านมติ</u></h4>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-3"
                                           for="comm_appr_name"><strong>คณะกรรมการ</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" id="comm_appr_name" name="comm_appr_name"
                                               class="form-control">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-3"
                                           for="comm_appr_no"><strong>ครั้งที่</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" id="comm_appr_no" name="comm_appr_no"
                                               class="form-control">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-3"
                                           for="comm_appr_date"><strong>วันที่</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" id="comm_appr_date" name="comm_appr_date"
                                               class="form-control form-control-inline input-medium date-picker">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label col-md-3"
                                   for="project_id"><strong>ติดต่อเจ้าหน้าที่โทร</strong>
                                <span class="required" aria-required="true"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="contact_tel" name="contact_tel"
                                       class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label col-md-3"><strong>สถานะหลักสูตร</strong>
                                <span class="required" aria-required="true"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="status" value="1"> เปิดให้ลงทะเบียน
                                        <span></span>
                                    </label>
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="status" value="2"> ไม่เปิดให้ลงทะเบียน
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"
                                       for="project_id"><strong>Special User</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <select name="" id="" class="form-control">
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="button" class="btn default">ยกเลิก</button>
                                <button type="button" onclick="submit_form()" class="btn blue">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/select2-cascade.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
        type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var mainForm;
    var firstLoadDep = true;
    var firstLoadMajor = true;

    var firstRenderTbl = true;
    var courseTable;
    var programTypeData = '{!! $progTypeList !!}';


    function initCurrProgramTbl() {


        // begin first table
        courseTable = $('#currProgramTbl').dataTable({

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
            searching: true,
            paging: false,
            pagingType: "bootstrap_full_number",
            columnDefs: [
                {
                    targets: [0],
                    className: 'text-center',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '<div class="form-group">'
                        html += '<input type="hidden" id="curr_prog_id" name="curr_prog_id" value="' + full.curr_prog_id + '"/>';
                        html += '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                        html += '<input type="checkbox" name="program_id" class="checkboxes" value="' + full.program_id + '" />';
                        html += '<span></span>';
                        html += '</label>';
                        html += '</div>';
                        return html;
                    }
                }, {
                    targets: [1],
                    className: 'text-center',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return full.program_id;
                    }
                }, {
                    targets: [2],
                    className: 'text-left',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return full.thai;
                    }
                }, {
                    targets: [3],
                    className: 'text-center',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
//                        html += '<input type="hidden" name="program_plan_id" value="' + full.plan + '"/>';
                        html += full.plan;
                        return html;
                    }
                }
                , {
                    targets: [4],
                    className: 'text-left',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var progTypeObj = JSON.parse(programTypeData);
                        var html = '<input type="hidden" id="program_type_hidden_' + meta.row + '" name="program_type_hidden" value="' + full.program_type_id + '">';
                        html += '<select class="datatable-dropdown" id="program_type_id_' + meta.row + '" name="program_type_id">';
                        $.each(progTypeObj, function (index, value) {
                            if (index == full.program_type_id) {
                                html += '<option value="' + index + '">' + value + '</option>';
                            } else {
                                html += '<option value="' + index + '">' + value + '</option>';
                            }
                        });
                        html += '</select>';
                        return html;
                    }
                }],
            columns: [
                {data: 'curr_prog_id'},
                {data: 'program_id'},
                {data: 'thai'},
                {data: 'plan'},
                {data: 'program_type_id'}
            ],
            order: [
                [1, "asc"]
            ],
            drawCallback: function (setting) {
                var select2Option = {
                    placeholder: '--เลือก--',
                    allowClear: true,
                    width: '100%'
                };

                $('.datatable-dropdown').select2(select2Option);
                if (firstRenderTbl) {
                    $('.datatable-dropdown').each(function (index, value) {
                        $(value).val($(value).siblings('input[name=program_type_hidden]').val()).change();
                    });
                }
//
//                $('.datatable-dropdown').on('change', function (event) {
//                    var changedSelect = $(event.currentTarget);
//                    var tr = $(this).closest("tr");
//                    courseTable.fnUpdate(changedSelect.val(), tr, 4, false);
//                });


            }
        });

        var tableWrapper = $('#currProgramTbl_wrapper');

        courseTable.find('.group-checkable').change(function () {
            var set = $(this).attr("data-set");
            var checked = $(this).is(":checked");
            $(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
        });

        courseTable.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    function initForm() {

        var select2Option = {
            placeholder: '--เลือก--',
            allowClear: true,
            width: '100%'
        };

        $('select').select2(select2Option);

        $('#semester').select2(select2Option).on('change', function () {

            var selected = $('#semester').val();

            if (selected == '' || selected == null) {
                $('#roundDiv').hide();
                $('#roundFormDiv').hide();
                return;
            }
            var splited = selected.split("|");
            var semester = splited[0];
            var academicYear = splited[1];

            $.ajax({
                url: '{{route('masterdata.getApplySettingBySemesterAndAcademicYear')}}',
                method: "get",
                data: 'semester=' + semester + '&academic_year=' + academicYear,
                success: function (result) {
                    if (result != null) {
                        $('#roundListDiv').html('-');

                        var html = '';
                        var roundHtml = '';
                        var openRoundNo = 0;

                        $.each(result, function (index, value) {
                            if (value.is_active == 1 && value.round_no > openRoundNo) {
                                openRoundNo = value.round_no;
                                return true;
                            }
                        });

                        $.each(result, function (index, value) {
                            html += '<label class="mt-checkbox mt-checkbox-outline">';
                            if (value.status == 0 || value.round_no < openRoundNo) {
                                html += '<input type="checkbox" name="app_set_round[]" value="' + value.round_no + '" data-id="' + value.apply_setting_id + '" onchange="onRoundChange(this);" disabled/>รอบที่ ' + value.round_no + ' - ตั้งแต่ ' + value.start_date + ' ถึง ' + value.end_date;
                                html += '&nbsp;&nbsp;<div class="label label-danger">ปิด</div>';
                            } else if (value.round_no == openRoundNo) {
                                html += '<input type="checkbox" name="app_set_round[]" value="' + value.round_no + '" data-id="' + value.apply_setting_id + '" onchange="onRoundChange(this);"/>รอบที่ ' + value.round_no + ' - ตั้งแต่ ' + value.start_date + ' ถึง ' + value.end_date;
                                html += '&nbsp;&nbsp;<div class="label label-success">เปิด</div>';
                            } else {
                                html += '<input type="checkbox" name="app_set_round[]" value="' + value.round_no + '" data-id="' + value.apply_setting_id + '" onchange="onRoundChange(this);"/>รอบที่ ' + value.round_no + ' - ตั้งแต่ ' + value.start_date + ' ถึง ' + value.end_date;
                            }
                            html += '<span></span>';
                            html += '</label>';

                            roundHtml += roundFormGenerate(value);
                        });

                        $('#roundListDiv').html(html);
                        $('#roundFormDiv').html(roundHtml);

                        $(".date-picker").inputmask("d/m/y");

                        $('.date-picker').datepicker({
                            rtl: App.isRTL(),
                            orientation: "left",
                            autoclose: true,
                            clearBtn: true,
                            format: 'dd/mm/yyyy'
                        });
                        $('#roundFormDiv').show();
                    } else {
                        $("#roundListDiv").html('-');
                        $('#roundFormDiv').html('');
                        $('#roundFormDiv').hide();
                    }
                    $('#roundDiv').show();

                }
            });

        });

        $('#semester').val($('#semester_hidden').val()).change();


        $('#faculty_id').select2(select2Option).on('change', function () {
            $('#department_id').empty();
            $('#major_id').empty();
            $("#sub_major").html("-");
            courseTable.fnClearTable();
        });


        $('#department_id').select2(select2Option).on('change', function () {
            $('#major_id').empty();
            $("#sub_major").html("-");
            courseTable.fnClearTable();
        });

        $('#faculty_id').val($("#faculty_id_hidden").val()).change();


        var csLoadDep = new Select2Cascade($('#faculty_id'), $('#department_id'), "{{route('masterdata.getDepartmentByFacultyId')}}?faculty_id=:parentId:", select2Option);
        csLoadDep.then(function (parent, child, items) {
            if (items.length != 0) {
                if (firstLoadDep) {
                    child.val($('#department_id_hidden').val()).change();
                    firstLoadDep = false;
                } else {
                    child.select2('open');
                }
            }
        });

        var csLoadMajor = new Select2Cascade($('#department_id'), $('#major_id'), "{{route('masterdata.getMajorByDepartmentIdForDropdown')}}?department_id=:parentId:", select2Option);
        csLoadMajor.then(function (parent, child, items) {
            if (items.length != 0) {
                if (firstLoadMajor) {
                    child.val($('#major_id_hidden').val()).change();
                    firstLoadMajor = false;
                } else {
                    child.select2('open');
                }
            }
        });

        $(".date-picker").inputmask("d/m/y");

        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            clearBtn: true,
            format: 'dd/mm/yyyy'
        });


        $('#major_id').on('change', function (event) {
            var majorId = $("#major_id").val();

            //Get SubMajor
            $.ajax({
                url: '{{route('masterdata.getSubMajorByMajorIdForDropdown')}}',
                method: "get",
                data: 'major_id=' + majorId,
                success: function (result) {
                    if (result != null) {
                        var listCheckBox = '';
                        $.each(result, function (index, value) {

                            listCheckBox += '<label class="mt-checkbox mt-checkbox-outline">';
                            listCheckBox += '<input type="checkbox" name="sub_major_id" value="' + index + '"> ';
                            listCheckBox += '(' + index + ') ' + value;
                            listCheckBox += '<span></span>';
                            listCheckBox += '</label>';
                        });

                        if (listCheckBox != '') {
                            $("#sub_major").html(listCheckBox);
                        } else {
                            $("#sub_major").html('-');
                        }

                    } else {
                        $("#sub_major").html('-');
                    }
                }
            });

            // Get Related Course
            $.ajax({
                url: '{{route('masterdata.getMcourseStudyByMajorId')}}',
                method: "get",
                data: 'major_id=' + majorId,
                success: function (result) {
                    if (result != null) {
                        courseTable.fnClearTable(false);
                        firstRenderTbl = true;
                        $.each(result, function (index, value) {
                            addDataToCourseTable(value);
                        });
                        courseTable.fnDraw();
                        firstRenderTbl = false;
                    }
                }
            });
        });


        $("#document_file").on('change', function () {
            $("#fileuploadDiv #canDownload").val(0);
        });

    }

    function addDataToCourseTable(obj) {
        courseTable.fnAddData({
            'curr_prog_id': '',
            'program_id': obj.coursecodeno,
            'thai': obj.thai,
            'plan': obj.plan,
            'program_type_id': '',
        }, false);
    }

    function submit_form() {


//        console.log(mainForm);
//        return;

        if ($("input[name='app_set_round']:visible").length > 0){
            mainForm.validate().element($("input[name='app_set_round']"));
        }

        if($("input[name='program_id']:visible").length > 0){
            mainForm.validate().element($("input[name='program_id']"));
        }

        if (!mainForm.valid()) {
            return;
        }

        var formData = new FormData();

        //All Field
        $.each($("#progSettingForm").serializeArray(), function (index, field) {
            if (field.name == 'program_id' || field.name == 'program_type_id' ||
                field.name == 'exam_schedule' || field.name == 'announce_admission_date' ||
                field.name == 'announce_exam_date' || field.name == 'orientation_date' ||
                field.name == 'orientation_location') {
                return true;
            }
            formData.append(field.name, field.value)
        });

        //Program For Regis
        var programs = [];
        var rows = courseTable.$('tbody tr');
        $.each(rows, function (index, value) {
            var chkbox = $(value).find('input[name=program_id]')[0];
            if (chkbox.checked) {
                programs.push(serializeObject($(value).find('input,select').serializeArray()));
            }
        });
        formData.append('programs', JSON.stringify(programs));


        //Round For Regis
        var roundForms = [];
        $.each($('#roundFormDiv .round-row:visible'), function (index, value) {
            roundForms.push(serializeObject($(value).find('input,select,textarea').serializeArray()))
        });
        formData.append('rounds', JSON.stringify(roundForms));

        //FileUpload
        if ($("#document_file").val() !== '') {
            formData.append("document_file", $("#document_file")[0].files[0]);
        }

        $.ajax({
            url: '{{route('admin.curriculum.doSave')}}',
            headers: {
                'X-CSRF-Token': $("#progSettingForm").find("input[name='_token']").val()
            },
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
            }
        });

    }

    function roundFormGenerate(obj) {
        var roundHtml = '<div class="row round-row" id="formRound' + obj.round_no + '" style="display:none">';
        roundHtml += '<input type="hidden" id="curr_act_id" name="curr_act_id" value=""/>';
        roundHtml += '<input type="hidden" id="apply_setting_id" name="apply_setting_id" value="' + obj.apply_setting_id + '"/>';
        roundHtml += '<div class="col-md-12">';
        roundHtml += '<div class="portlet green-meadow box">';
        roundHtml += '<div class="portlet-title">';
        roundHtml += '<div class="caption">';
        roundHtml += '<i class="fa fa-cogs"></i>รอบที่ ' + obj.round_no;
        roundHtml += '</div>';
        roundHtml += '<div class="actions">';
//        roundHtml += '<a href="javascript:;" class="btn btn-default btn-sm">';
//        roundHtml += '<i class="fa fa-pencil"></i> Edit </a>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '<div class="portlet-body">';
        roundHtml += '<div class="row">';
        roundHtml += '<div class="col-md-12">';
        roundHtml += '<div class="col-md-12">';
        roundHtml += '<div class="form-group col-md-12">';
        roundHtml += '<label class="control-label col-md-offset-1 col-md-1"';
        roundHtml += 'for="exam_schedule"><strong>ตารางสอบ</strong></label>';
        roundHtml += '<div class="col-md-10">';
        roundHtml += '<textarea id="exam_schedule" class="form-control"';
        roundHtml += 'name="exam_schedule"';
        roundHtml += 'rows="5"></textarea>';
        roundHtml += '</div>';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';

        roundHtml += '<div class="col-md-12">';

        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-3"';
        roundHtml += 'for="project_id"><strong>วันที่ประกาศรายชื่อผู้มีสิทธิ์สอบ</strong></label>';
        roundHtml += '<div class="col-md-9">';
        roundHtml += '<input type="text" id="announce_exam_date"';
        roundHtml += 'name="announce_exam_date"';
        roundHtml += 'class="form-control date-picker">';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-3"';
        roundHtml += 'for="project_id"><strong>วันที่ประกาศผลการสอบคัดเลือก</strong></label>';
        roundHtml += '<div class="col-md-9">';
        roundHtml += '<input type="text" id="announce_admission_date"';
        roundHtml += 'name="announce_admission_date"';
        roundHtml += 'class="form-control date-picker">';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '<div class="col-md-12">';
        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-3"';
        roundHtml += 'for="project_id"><strong>วันที่ปฐมนิเทศ</strong></label>';
        roundHtml += '<div class="col-md-9">';
        roundHtml += '<input type="text" id="orientation_date"';
        roundHtml += 'name="orientation_date"';
        roundHtml += 'class="form-control date-picker">';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-3"';
        roundHtml += 'for="project_id"><strong>ที่</strong></label>';
        roundHtml += '<div class="col-md-9">';
        roundHtml += '<input type="text" id="orientation_location"';
        roundHtml += 'name="orientation_location"';
        roundHtml += 'class="form-control">';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';

        return roundHtml;
    }

    function onRoundChange(event) {
        var formId = '#formRound' + $(event)[0].value;
        if ($(event)[0].checked) {
            $(formId).show();
        } else {
            $(formId).hide();
        }
    }

    function downloadFile(obj) {
        if ($('#canDownload').val() !== '1') {
            event.stopPropagation();
            event.preventDefault();
            toastr.warning('ไม่สามารถ Download ข้อมูลได้');
            return false;
        }
    }

    function initValidation() {
        mainForm = $('#progSettingForm');
//
//        var error3 = $('.alert-danger', mainForm);
//        var success3 = $('.alert-success', mainForm);

        mainForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {

                semester: {
                    required: true
                },
                app_set_round: {
                    required: true,
                    minlength: 1
                },
                apply_method: {
                    required: true
                },
                project_id: {
                    required: true
                },
                faculty_id: {
                    required: true
                },
                department_id: {
                    required: true
                },
                major_id: {
                    required: true
                },
                sub_major_id: {
                    required: true,
                    minlength: 1
                },
                degree_id: {
                    required: true
                },

                //Program Table
                program_id: {
                    required: true,
                    minlength: 1
                },
                //Program Type Id Need Ex Method

                //Round Info
//                exam_schedule: {
//                    required: true
//                },
//                announce_admission_date: {
//                    required: true
//                },
//                announce_exam_date: {
//                    required: true
//                },
//                orientation_date: {
//                    required: true
//                },
//                orientation_location: {
//                    required: true
//                },
//                mailing_address: {
//                    required: true
//                },
                apply_fee: {
                    required: true
                },
                expected_amount: {
                    required: true
                },
                comm_appr_name: {
                    required: true
                },
                comm_appr_no: {
                    required: true
                },
                comm_appr_date: {
                    required: true
                },
                contact_tel: {
                    required: true
                },
                status: {
                    required: true
                }

            },

//            messages: { // custom messages for radio buttons and checkboxes
//                membership: {
//                    required: "Please select a Membership type"
//                },
//                service: {
//                    required: "Please select  at least 2 types of Service",
//                    minlength: jQuery.validator.format("Please select  at least {0} types of Service")
//                }
//            },

            errorPlacement: function (error, element) { // render error placement for each input typeW
//                if (element.parents('.mt-radio-list').size() > 0 || element.parents('.mt-checkbox-list').size() > 0) {
//                    if (element.parents('.mt-radio-list').size() > 0) {
//                        error.appendTo(element.parents('.mt-radio-list')[0]);
//                    }
//                    if (element.parents('.mt-checkbox-list').size() > 0) {
//                        error.appendTo(element.parents('.mt-checkbox-list')[0]);
//                    }
//                } else if (element.parents('.mt-radio-inline').size() > 0 || element.parents('.mt-checkbox-inline').size() > 0) {
//                    if (element.parents('.mt-radio-inline').size() > 0) {
//                        error.appendTo(element.parents('.mt-radio-inline')[0]);
//                    }
//                    if (element.parents('.mt-checkbox-inline').size() > 0) {
//                        error.appendTo(element.parents('.mt-checkbox-inline')[0]);
//                    }
//                } else if (element.parent(".input-group").size() > 0) {
//                    error.insertAfter(element.parent(".input-group"));
//                } else if (element.attr("data-error-container")) {
//                    error.appendTo(element.attr("data-error-container"));
//                } else {
//                    error.insertAfter(element); // for other inputs, just perform default behavior
//                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
//                success3.hide();
//                error3.show();
//                App.scrollTo(error3, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
//                success3.show();
//                error3.hide();
                //form[0].submit(); // submit the form
            }

        });

    }

    $(document).ready(function () {
        initCurrProgramTbl();
        initValidation();
        initForm();

        $('select', mainForm).change(function () {
            mainForm.validate().element($(this));
        });
    });

</script>
@endpush
