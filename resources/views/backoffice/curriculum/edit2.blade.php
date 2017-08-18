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
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">จัดการข้อมูลหลักสูตร</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">กรอกฟอร์มขอเปิดหลักสูตร</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
    </h1>
@stop



@section('maincontent')
    <div class="modal fade bs-modal-lg" id="transCommentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">หมายเหตุ</h4>
                </div>
                <div class="modal-body">
                    <form id="wfTransForm">
                        <textarea id="comment" class="form-control" name="comment" rows="5"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">ปิด</button>
                    <button type="button" id="modalSaveBt" class="btn green">บันทึก</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase">แบบฟอร์มขอเปิดหลักสูตร</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                   data-original-title="" title=""> </a>
                <a href="{{url('admin/management/curriculum/manage')}}" class="btn btn-circle blue-steel btn-outline">
                    <i class="fa fa-mail-reply"></i> กลับหน้าหลัก </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="progSettingForm" role="form" class="form-horizontal"
                  method="post">
                {{csrf_field()}}
                <input type="hidden" id="curriculum_id" name="curriculum_id"
                       value="@if(!empty($curriculum)){{$curriculum->curriculum_id}}@endif"/>
                <input type="hidden" id="curr_flow_status" name="curr_flow_status"
                       value="@if(!empty($curriculum)){{$curriculum->is_approve}}@endif"/>

                <div class="form-body">
                    {{--Section1 START--}}
                    <div id="section1">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="col-md-5 control-label"
                                       for="apply_setting_id"><strong>ภาคการศึกษาและปีการศึกษาที่เปิดรับสมัคร</strong>
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="hidden" id="semester_hidden" name="semester_hidden"
                                           value="@if(!empty($semAcaYr)){{$semAcaYr->semester.'|'.$semAcaYr->academic_year}}@endif"/>
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
                                            <input type="radio" name="apply_method" value="1"
                                                   @if(!empty($curriculum) && $curriculum->apply_method == 1) checked @endif
                                            > รับผ่านบัณฑิต
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="apply_method" value="2"
                                                   @if(!empty($curriculum) && $curriculum->apply_method == 2) checked @endif
                                            > รับตรงโดยหลักสูตร
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
                                        <input type="hidden" id="project_id_hidden" name="project_id_hidden"
                                               value="@if(!empty($curriculum)){{$curriculum->project_id}}@endif"/>
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
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="faculty_id"><strong>คณะ</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="hidden" id="faculty_id_hidden" name="faculty_id_hidden"
                                               value="@if(!empty($curriculum)){{$curriculum->faculty_id}}@endif"/>
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
                                           for="department_id"><strong>ภาควิชา/สหสาขา</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="hidden" id="department_id_hidden" name="department_id_hidden"
                                               value="@if(!empty($curriculum)){{$curriculum->department_id}}@endif"/>
                                        <select name="department_id" id="department_id" class="form-control">
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="major_id"><strong>สาขาวิชา</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="hidden" id="major_id_hidden" name="major_id_hidden"
                                               value="@if(!empty($curriculum)){{$curriculum->major_id}}@endif"/>
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

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label offset-col-md-3 col-md-2"
                                           for="degree_id"><strong>ชื่อหลักสูตร</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="hidden" id="degree_id_hidden" name="degree_id_hidden"
                                               value="@if(!empty($curriculum)){{$curriculum->degree_id}}@endif"/>
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
                          <hr>
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
                    </div>
                    {{--Section1 END--}}

                    {{--Section2 START--}}

                    <div id="section2">
                        <div id="roundFormDiv">
                            {{--For Round Form--}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3"
                                           for="additional_detail"><strong>รายละเอียดเพิ่มเติม</strong></label>
                                    <div class="col-md-9">
                                    <textarea id="additional_detail" class="form-control" name="additional_detail"
                                              rows="5">@if(!empty($curriculum)){{$curriculum->additional_detail}}@endif</textarea>
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
                                           for="mailing_address"><strong>ที่อยู่สำหรับส่งเอกสาร</strong></label>
                                    <div class="col-md-9">
                                <textarea id="mailing_address" class="form-control" name="mailing_address"
                                          rows="5">@if(!empty($curriculum)){{$curriculum->mailing_address}}@endif</textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3"
                                           for="additional_question"><strong>ข้อมุลที่ต้องการเพิ่มเติมจากผู้สมัคร</strong></label>
                                    <div class="col-md-9">
                                    <textarea id="additional_question" class="form-control" name="additional_question"
                                              rows="5">@if(!empty($curriculum)){{$curriculum->additional_question}}@endif</textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4"
                                           for="apply_fee"><strong>ค่าธรรมเนียม</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="number" id="apply_fee" name="apply_fee"
                                               class="form-control"
                                               value="@if(!empty($curriculum)){{$curriculum->apply_fee}}@endif">
                                        <span class="help-block">(บาท)</span>
                                    </div>
                                </div>

                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4"
                                           for="expected_amount"><strong>จำนวนนิสิตที่คาดว่าจะรับ</strong>
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="number" id="expected_amount"
                                               name="expected_amount"
                                               class="form-control"
                                               value="@if(!empty($curriculum)){{$curriculum->expected_amount}}@endif">
                                        <span class="help-block">(คน)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4"><strong>เอกสารประกอบหลักสูตร</strong></label>
                                    <div class="col-md-8">
                                        <div id="fileuploadDiv"
                                             class="fileinput @if(!empty($curriculum)&&!empty($curriculum->file))fileinput-exists @else fileinput-new @endif"
                                             data-provides="fileinput">
                                            <input type="hidden" id="canDownload" name="canDownload"
                                                   value="@if(!empty($curriculum)&&!empty($curriculum->file)){{1}}@endif"/>
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-large"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span id="fileuploadName"
                                                          class="fileinput-filename">@if(!empty($curriculum)&&!empty($curriculum->file)){{$curriculum->file->file_origi_name}}@endif</span>
                                                </div>
                                                <span id="fileuploadBtnGrp"
                                                      class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new"> เลือก </span>
                                                                    <span class="fileinput-exists"> เปลี่ยน </span>
                                                                    <input type="file" id="document_file"
                                                                           name="document_file"> </span>
                                                <a href="javascript:;"
                                                   class="input-group-addon btn red fileinput-exists"
                                                   data-dismiss="fileinput" id="fileinputRmvBtn"> ลบ </a>
                                                <a href="@if(!empty($curriculum)&&!empty($curriculum->file)){{route('admin.curriculum.downloadCurriculumDoc').'?curriculum_id='.$curriculum->curriculum_id}}@endif"
                                                   id="fileinputDownloadBtn"
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
                                                   class="form-control"
                                                   value="@if(!empty($curriculum)){{$curriculum->comm_appr_name}}@endif">
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
                                                   class="form-control"
                                                   value="@if(!empty($curriculum)){{$curriculum->comm_appr_no}}@endif">
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
                                                   class="form-control form-control-inline input-medium date-picker"
                                                   value="@if(!empty($curriculum)){{$curriculum->comm_appr_date->format('d/m/Y')}}@endif">
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
                                           class="form-control"
                                           value="@if(!empty($curriculum)){{$curriculum->contact_tel}}@endif">
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
                                            <input type="radio" name="status" value="1"
                                                   @if(!empty($curriculum) && $curriculum->status == 1) checked @endif
                                            > เปิดให้ลงทะเบียน
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" name="status" value="2"
                                                   @if(!empty($curriculum) && $curriculum->status == 2) checked @endif
                                            > ไม่เปิดให้ลงทะเบียน
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
                    </div>

                    {{--Section2 END--}}
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <a id="cancelBtn" href="{{url('admin/management/curriculum/manage')}}" class="btn default">
                                ยกเลิก
                            </a>
                            <a id="saveBtn" onclick="submit_form()" class="btn blue">บันทึก
                            </a>
                            <a id="sendToApprBtn" onclick="prepareModal('SEND_APPR')" href="#transCommentModal"
                               class="btn blue">
                                ส่งอนุมัติ
                            </a>
                            <a id="apprBtn" onclick="prepareModal('APPR')" class="btn green">อนุมัติ</a>
                            <a id="rejectBtn" onclick="prepareModal('REJECT')" class="btn yellow">ส่งกลับแก้ไข</a>
                            <a id="delBtn" onclick="doDelete()" class="btn red">ลบ
                            </a>

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
    var firstLoadRound = true;
    var firstLoadSubmajor = true;
    var firstLoadCourse = true;
    var firstLoad = true;
    var firstLoadForm = true;


    var firstRenderTbl = true;
    var courseTable;
    var programTypeData = '{!! $progTypeList !!}';
    var fileLinkUrl = '{{route('admin.curriculum.downloadCurriculumDoc').'?curriculum_id='}}';

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
                        html += '<input type="checkbox" name="program_id" class="checkboxes" value="' + full.program_id + '"';
                        if (full.curr_prog_id !== null && full.curr_prog_id !== '') {
                            html += 'checked';
                        }
                        html += ' />';
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
                firstLoadRound = false;
                return;
            }
            var splited = selected.split("|");
            var semester = splited[0];
            var academicYear = splited[1];

            if (firstLoadRound && $("#curriculum_id").val() !== "") {
                $.ajax({
                    url: '{{route('admin.curriculum.getCurrActByCurriculumId')}}',
                    method: "get",
                    data: 'curriculum_id=' + $("#curriculum_id").val(),
                    success: function (result) {

                        if (result != null) {
                            genRoundCheckboxAndRoundForm(result);
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
                firstLoadRound = false;
            } else {
                $.ajax({
                    url: '{{route('masterdata.getApplySettingBySemesterAndAcademicYear')}}',
                    method: "get",
                    data: 'semester=' + semester + '&academic_year=' + academicYear,
                    success: function (result) {
                        if (result != null) {
                            genRoundCheckboxAndRoundForm(result);
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
            }

        });

        $('#semester').val($('#semester_hidden').val()).change();

        $('#project_id').val($('#project_id_hidden').val()).change();


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

        $('#degree_id').val($("#degree_id_hidden").val()).change();

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
            var curriculumId = $("#curriculum_id").val();

            //Get SubMajor
            //To Do Set First Load
            if (firstLoadSubmajor && curriculumId !== '') {
                $.ajax({
                    url: '{{route('admin.curriculum.getCurrSubMajorByCurriculumId')}}',
                    method: "get",
                    data: 'curriculum_id=' + curriculumId,
                    success: function (result) {
                        if (result != null) {
                            var listCheckBox = '';
                            $.each(result, function (index, value) {
                                listCheckBox += '<label class="mt-checkbox mt-checkbox-outline">';
                                listCheckBox += '<input type="checkbox" name="sub_major_id[]" value="' + index + '"';
                                if (value.curr_sub_major_id !== null) {
                                    listCheckBox += 'checked'
                                }
                                listCheckBox += '> ';
                                listCheckBox += '(' + value.sub_major_id + ') ' + value.sub_major_name;
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
                firstLoadSubmajor = false;
            } else {
                $.ajax({
                    url: '{{route('masterdata.getSubMajorByMajorIdForDropdown')}}',
                    method: "get",
                    data: 'major_id=' + majorId,
                    success: function (result) {
                        if (result != null) {
                            var listCheckBox = '';
                            $.each(result, function (index, value) {

                                listCheckBox += '<label class="mt-checkbox mt-checkbox-outline">';
                                listCheckBox += '<input type="checkbox" name="sub_major_id[]" value="' + index + '"> ';
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
            }
            // Get Related Course
            if (firstLoadCourse && curriculumId !== '') {
                $.ajax({
                    url: '{{route('admin.curriculum.getCurrProgListByCurriculumId')}}',
                    method: "get",
                    data: 'curriculum_id=' + curriculumId,
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
                firstLoadCourse = false;
            } else {
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
            }
        });


        $("#document_file").on('change', function () {
            $("#fileuploadDiv #canDownload").val(0);
        });

    }

    function addDataToCourseTable(obj) {
        courseTable.fnAddData({
            'curr_prog_id': obj.hasOwnProperty('curr_prog_id') ? obj.curr_prog_id : '',
            'program_id': obj.hasOwnProperty('coursecodeno') ? obj.coursecodeno : '',
            'thai': obj.hasOwnProperty('thai') ? obj.thai : '',
            'plan': obj.hasOwnProperty('plan') ? obj.plan : '',
            'program_type_id': obj.hasOwnProperty('program_type_id') ? obj.program_type_id : '',
        }, false);
    }

    function genRoundCheckboxAndRoundForm(obj) {

        $('#roundListDiv').html('-');

        var html = '';
        var roundHtml = '';
        var openRoundNo = 0;

        $.each(obj, function (index, value) {
            if (value.status == 1 && value.round_no > openRoundNo) {
                openRoundNo = value.round_no;
                return true;
            }
        });

        $.each(obj, function (index, value) {
            html += '<label class="mt-checkbox mt-checkbox-outline">';
            if (value.hasOwnProperty('curr_act_id') && (value.curr_act_id !== null && value.curr_act_id !== '')) {
                html += '<input checked ';
            } else {
                html += '<input';
            }
            html += ''
            if (value.is_active == 0 || value.round_no < openRoundNo) {
                html += ' type="checkbox" name="app_set_round[]" value="' + value.round_no + '" data-id="' + value.apply_setting_id + '" onchange="onRoundChange(this);" disabled/>รอบที่ ' + value.round_no + ' - ตั้งแต่ ' + value.start_date + ' ถึง ' + value.end_date;
                html += '&nbsp;&nbsp;<div class="label label-danger">ปิด</div>';
            } else if (value.round_no == openRoundNo) {
                html += ' type="checkbox" name="app_set_round[]" value="' + value.round_no + '" data-id="' + value.apply_setting_id + '" onchange="onRoundChange(this);"/>รอบที่ ' + value.round_no + ' - ตั้งแต่ ' + value.start_date + ' ถึง ' + value.end_date;
                html += '&nbsp;&nbsp;<div class="label label-success">เปิด</div>';
            } else {
                html += ' type="checkbox" name="app_set_round[]" value="' + value.round_no + '" data-id="' + value.apply_setting_id + '" onchange="onRoundChange(this);"/>รอบที่ ' + value.round_no + ' - ตั้งแต่ ' + value.start_date + ' ถึง ' + value.end_date;
            }
            html += '<span></span>';
            html += '</label>';

            roundHtml += roundFormGenerate(value);
        });

        $('#roundListDiv').html(html);
        $('#roundFormDiv').html(roundHtml);
    }

    function submit_form() {

        if ($("input[name='app_set_round']:visible").length > 0) {
            mainForm.validate().element($("input[name='app_set_round']"));
        }

        if ($("input[name='program_id']:visible").length > 0) {
            mainForm.validate().element($("input[name='program_id']"));
        }

        if (!mainForm.valid()) {
            return;
        }

        var formData = prepareData();

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
                if (data !== null) {
                    if (data.curriculum !== null) {
                        $('#curriculum_id').val(data.curriculum.curriculum_id);
                        if (data.curriculum.file_id !== null) {

                            $('#fileuploadDiv #canDownload').val(1);
                            $('#fileuploadDiv').removeClass('fileinput-new');
                            $('#fileuploadDiv').addClass('fileinput-exists');
                            $("#fileuploadDiv #fileuploadName").text(data.curriculum.file_origi_name);
                            $("#fileuploadDiv #fileinputDownloadBtn").attr("href", fileLinkUrl + data.curriculum.curriculum_id);
                            $("#fileuploadDiv #document_file").val(null);
                        } else {
                            $('#fileuploadDiv #canDownload').val(0);
                        }
                    }


                    if (data.curriculum_activity !== null && data.curriculum_activity.length > 0) {
                        var roundHtml = '';
                        $.each(data.curriculum_activity, function (index, value) {
                            roundHtml += roundFormGenerate(value);
                        });
                        $('#roundFormDiv').html(roundHtml);
                    }

                    if (data.curriculum_program !== null && data.curriculum_program.length > 0) {
                        courseTable.fnClearTable(false);
                        firstRenderTbl = true;
                        $.each(data.curriculum_program, function (index, value) {
                            addDataToCourseTable(value);
                        });
                        courseTable.fnDraw();
                    }
                }

                setActionButtonAndDisableForm();
            }
        });

    }

    function roundFormGenerate(obj) {
        var roundHtml = '';
        if (obj.hasOwnProperty('curr_act_id') && (obj.curr_act_id !== null && obj.curr_act_id !== '')) {
            roundHtml += '<div class="row round-row" id="formRound' + obj.round_no + '">';
            roundHtml += '<input type="hidden" id="curr_act_id" name="curr_act_id" value="' + obj.curr_act_id + '"/>';
        } else {
            roundHtml += '<div class="row round-row" id="formRound' + obj.round_no + '" style="display:none">';
            roundHtml += '<input type="hidden" id="curr_act_id" name="curr_act_id" value=""/>';
        }
        roundHtml += '<input type="hidden" id="apply_setting_id" name="apply_setting_id" value="' + obj.apply_setting_id + '"/>';
        roundHtml += '<div class="col-md-12">';
        roundHtml += '<div class="portlet green-meadow box">';
        roundHtml += '<div class="portlet-title">';
        roundHtml += '<div class="caption">';
        roundHtml += '<i class="fa fa-table"></i>การเปิดรับสมัครรอบที่ ' + obj.round_no;
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
        roundHtml += '<label class="control-label  col-md-2"';
        roundHtml += 'for="exam_schedule"><strong>ตารางสอบ</strong></label>';
        roundHtml += '<div class="col-md-10">';
        roundHtml += '<textarea id="exam_schedule" class="form-control"';
        roundHtml += 'name="exam_schedule"';
        roundHtml += 'rows="5">';
        if (obj.hasOwnProperty('exam_schedule') && (obj.exam_schedule !== null && obj.exam_schedule !== '')) {
            roundHtml += obj.exam_schedule;
        }
        roundHtml += '</textarea>';
        roundHtml += '</div>';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';

        roundHtml += '<div class="col-md-12">';
        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-4"';
        roundHtml += 'for="announce_admission_date"><strong>วันที่ประกาศรายชื่อผู้มีสิทธิ์สอบ</strong></label>';
        roundHtml += '<div class="col-md-8">';
        roundHtml += '<input type="text" id="announce_admission_date"';
        roundHtml += 'name="announce_admission_date"';
        roundHtml += 'class="form-control date-picker" value="';
        if (obj.hasOwnProperty('announce_admission_date') && (obj.announce_admission_date !== null && obj.announce_admission_date !== '')) {
            roundHtml += obj.announce_admission_date;
        }
        roundHtml += '">';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-4"';
        roundHtml += 'for="announce_exam_date"><strong>วันที่ประกาศผลการสอบคัดเลือก</strong></label>';
        roundHtml += '<div class="col-md-8">';
        roundHtml += '<input type="text" id="announce_exam_date"';
        roundHtml += 'name="announce_exam_date"';
        roundHtml += 'class="form-control date-picker" value="';
        if (obj.hasOwnProperty('announce_exam_date') && (obj.announce_exam_date !== null && obj.announce_exam_date !== '')) {
            roundHtml += obj.announce_exam_date;
        }
        roundHtml += '">';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '<div class="col-md-12">';
        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-4"';
        roundHtml += 'for="orientation_date"><strong>วันที่ปฐมนิเทศ</strong></label>';
        roundHtml += '<div class="col-md-8">';
        roundHtml += '<input type="text" id="orientation_date"';
        roundHtml += 'name="orientation_date"';
        roundHtml += 'class="form-control date-picker" value="';
        if (obj.hasOwnProperty('orientation_date') && (obj.orientation_date !== null && obj.orientation_date !== '')) {
            roundHtml += obj.orientation_date;
        }
        roundHtml += '">';
        roundHtml += '<span class="help-block"></span>';
        roundHtml += '</div>';
        roundHtml += '</div>';
        roundHtml += '<div class="form-group col-md-6">';
        roundHtml += '<label class="control-label col-md-4"';
        roundHtml += 'for="orientation_location"><strong>สถานที่ปฐมนิเทศ</strong></label>';
        roundHtml += '<div class="col-md-8">';
        roundHtml += '<input type="text" id="orientation_location"';
        roundHtml += 'name="orientation_location"';
        roundHtml += 'class="form-control" value="';
        if (obj.hasOwnProperty('orientation_location') && (obj.orientation_location !== null && obj.orientation_location !== '')) {
            roundHtml += obj.orientation_location;
        }
        roundHtml += '">';
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

            }

        });

    }

    function setActionButtonAndDisableForm() {
        var currFlowStatus = $("#curr_flow_status").val();

        //Hard Code
        var isStaff = false;


        $("#cancelBtn").hide();
        $("#saveBtn").hide();
        $("#apprBtn").hide();
        $("#delBtn").hide();
        $("#rejectBtn").hide();
        $("#sendToApprBtn").hide();

        if (isStaff) {
            if (currFlowStatus == null || currFlowStatus == "") {
                $("#cancelBtn").show();
                $("#saveBtn").show();
            } else if (currFlowStatus == 1) { //draft
                $("#cancelBtn").show();
                $("#saveBtn").show();
                $("#sendToApprBtn").show();
                $("#delBtn").show();
            } else if (currFlowStatus == 2) { //pending
                $("#cancelBtn").show();
                section1Disable();
                section2Disable();
            } else if (currFlowStatus == 3) { //rejected
                $("#cancelBtn").show();
                $("#saveBtn").show();
                $("#sendToApprBtn").show();
            } else if (currFlowStatus == 4) { //approved
                $("#cancelBtn").show();
                $("#saveBtn").show();
                section1Disable();
            }
        } else {
            if (currFlowStatus == null || currFlowStatus == "") {
                $("#cancelBtn").show();
                $("#saveBtn").show();
            } else if (currFlowStatus == 1) { //draft
                $("#cancelBtn").show();
                $("#saveBtn").show();
                $("#sendToApprBtn").show();
                $("#delBtn").show();
            } else if (currFlowStatus == 2) { //pending
                $("#cancelBtn").show();
                $("#saveBtn").show();
                $("#rejectBtn").show();
                $("#apprBtn").show();
            } else if (currFlowStatus == 3) { //rejected
                $("#cancelBtn").show();
                $("#saveBtn").show();
                $("#sendToApprBtn").show();
            } else if (currFlowStatus == 4) { //approved
                $("#cancelBtn").show();
                $("#saveBtn").show();
                $("#semester").attr('disabled', 'disabled');
            }
        }

    }

    function section1Disable() {
        $("#section1").find("input").attr('disabled', 'disabled');
        $("#section1").find("select").attr('disabled', 'disabled');
        $("#section1").find("textarea").attr('disabled', 'disabled');
    }

    function section2Disable() {
        $("#section2").find("input").attr('disabled', 'disabled');
        $("#section2").find("select").attr('disabled', 'disabled');
        $("#section2").find("textarea").attr('disabled', 'disabled');
    }

    function prepareData() {
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

        return formData;
    }

    function prepareModal(action) {
        $("#comment").val('');
        $("#transCommentModal").modal('show');
        if (action == 'SEND_APPR') {
            $("#modalSaveBt").attr("onclick", "doSendToApprove() ");
        } else if (action == 'APPR') {
            $("#modalSaveBt").attr("onclick", "doApprove() ");
        } else if (action == 'REJECT') {
            $("#modalSaveBt").attr("onclick", "doReject() ");
        }

    }

    function doSendToApprove() {
        var dataObj = prepareData();
        dataObj.append('comment', $("#comment").val());
        $.ajax({
            url: '{{route('admin.curriculum.doSendToApprove')}}',
            headers: {
                'X-CSRF-Token': $("#progSettingForm").find("input[name='_token']").val()
            },
            method: "POST",
            data: dataObj,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                if (data !== null) {
                    $("#curr_flow_status").val(data.workflow_status_id);
                }
                setActionButtonAndDisableForm();
                $("#transCommentModal").modal('hide');
            }
        });
    }

    function doApprove() {
        var dataObj = prepareData();
        dataObj.append('comment', $("#comment").val());

        $.ajax({
            url: '{{route('admin.curriculum.doApprove')}}',
            headers: {
                'X-CSRF-Token': $("#progSettingForm").find("input[name='_token']").val()
            },
            method: "POST",
            data: dataObj,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                if (data !== null) {
                    $("#curr_flow_status").val(data.workflow_status_id);
                }
                setActionButtonAndDisableForm();
                $("#transCommentModal").modal('hide');
            }
        });
    }

    function doReject() {
        var dataObj = prepareData();
        dataObj.append('comment', $("#comment").val());

        $.ajax({
            url: '{{route('admin.curriculum.doReject')}}',
            headers: {
                'X-CSRF-Token': $("#progSettingForm").find("input[name='_token']").val()
            },
            method: "POST",
            data: dataObj,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                if (data !== null) {
                    $("#curr_flow_status").val(data.workflow_status_id);
                }
                setActionButtonAndDisableForm();
                $("#transCommentModal").modal('hide');
            }
        });
    }

    function doDelete() {
        var dataObj = prepareData();
        $.ajax({
            url: '{{route('admin.curriculum.doDelete')}}',
            headers: {
                'X-CSRF-Token': $("#progSettingForm").find("input[name='_token']").val()
            },
            method: "POST",
            data: dataObj,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                if (data !== null) {
                }
                setActionButtonAndDisableForm();
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

    $(document).ajaxStop(function () {
        if (firstLoadForm) {
            setActionButtonAndDisableForm();
            firstLoadForm = false;
        }
    });

</script>
@endpush
