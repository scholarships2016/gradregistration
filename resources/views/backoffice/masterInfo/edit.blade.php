@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
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
                <a href="#">จัดการข้อมูล Master</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">เพิ่ม/แก้ไข หลักสูตร</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        ฟอร์ม หลักสูตร
        <small></small>
    </h1>
@stop

@section('maincontent')
    <div class="portlet light bordered" id="mcourseBox">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-speech font-green"></i>
                <span class="caption-subject bold uppercase">ฟอร์ม หลักสูตร</span>
            </div>
            <div class="actions">

                <a href="/admin/setting/masterInfo/courseManage" class="btn btn-circle blue-steel btn-outline">
                    <i class="fa fa-mail-reply"></i> กลับหน้าหลัก </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form action="#" id="mcourseForm" class="form-horizontal">
                {{csrf_field()}}
                <div class="form-body">
                    <div class="form-group">
                        <input type="hidden" id="coursecodeno_hidden" name="coursecodeno_hidden"
                               value="@if(!empty($mcourse)){{$mcourse->coursecodeno}}@endif"/>
                        <label class="control-label col-md-3">รหัสหลักสูตร
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input type="text" id="coursecodeno"
                                   name="coursecodeno"
                                   class="form-control"
                                   value="@if(!empty($mcourse)){{$mcourse->coursecodeno}}@endif"
                            @if(isset($isEdit)&&!empty($isEdit)){{'disabled'}}@endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ชื่อหลักสูตร ภาษาไทย
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="thai" class="form-control"
                                   value="@if(!empty($mcourse)){{$mcourse->thai}}@endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ชื่อหลักสูตร ภาษาอังกฤษ
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="english" class="form-control"
                                   value="@if(!empty($mcourse)){{$mcourse->english}}@endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="plan_hidden" name="plan_hidden"
                               value="@if(!empty($mcourse)){{$mcourse->plan}}@endif"/>
                        <label class="control-label col-md-3">แผนการศึกษา
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <select class="form-control select2" id="plan" name="plan">
                                @if(!empty($planList))
                                    @foreach($planList as $plan)
                                        <option value="{{$plan->prog_plan_name}}">{{$plan->prog_plan_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="degree_hidden" name="degree_hidden"
                               value="@if(!empty($mcourse)){{$mcourse->degree}}@endif"/>
                        <label class="control-label col-md-3">ปริญญา
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <select class="form-control select2" id="degree" name="degree">
                                @if(!empty($degList))
                                    @foreach($degList as $deg)
                                        <option value="{{$deg->degree_id}}">{{$deg->degree_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="fac_hidden" name="fac_hidden"
                               value="@if(!empty($mcourse)){{$mcourse->department->faculty->faculty_id}}@endif"/>
                        <label class="control-label col-md-3">คณะ
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <select class="form-control select2" id="faculty_id" name="faculty_id">
                                @if(!empty($facList))
                                    @foreach($facList as $fac)
                                        <option value="{{$fac->faculty_id}}">{{$fac->faculty_name.' ('.$fac->faculty_full.')'}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="depcode_hidden" name="depcode_hidden"
                               value="@if(!empty($mcourse)){{$mcourse->depcode}}@endif"/>
                        <label class="control-label col-md-3">ภาควิชา
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <select class="form-control select2" id="depcode" name="depcode">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="majorcode_hidden" name="majorcode_hidden"
                               value="@if(!empty($mcourse)){{$mcourse->majorcode}}@endif"/>
                        <label class="control-label col-md-3">สาขาวิชา
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <select class="form-control select2" id="majorcode" name="majorcode">
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">สถานะ
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-9">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="status" id="statusUse" value="A"
                                           @if(!empty($mcourse) && (($mcourse->stopacadyear == '' || $mcourse->stopacadyear == NULL) && ($mcourse->lastacadyear == '' || $mcourse->lastacadyear == NULL))) checked @endif
                                    > ใช้งาน
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="status" id="statusNotUse" value=""
                                           @if(!empty($mcourse) && (($mcourse->stopacadyear != '' && $mcourse->stopacadyear != NULL) || ($mcourse->lastacadyear != '' && $mcourse->lastacadyear !=NULL))) checked @endif
                                    > ไม่ใช้งาน
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <a href="/admin/setting/masterInfo/courseManage">
                                <button type="button" class="btn grey-steel">ยกเลิก</button>
                            </a>
                            <button type="submit" class="btn green" id="submitBt">บันทึก</button>
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
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/select2-cascade.js')}}" type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var mainForm, firstLoadDep = true, firstLoadMajor = true;

    var select2Option = {
        placeholder: '--Select--',
        allowClear: true,
        width: '100%'
    };


    function initValidation() {
        $("#mcourseForm").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                coursecodeno: {
                    required: true
                },
                thai: {
                    required: true
                },
                english: {
                    required: true
                },
                plan: {
                    required: true
                },
                degree: {
                    required: true
                },
                faculty_id: {
                    required: true
                },
                depcode: {
                    required: true
                },
                majorcode: {
                    required: true
                }
            },

            errorPlacement: function (error, element) { // render error placement for each input typeW
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
            },

            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                $.ajax({
                    url: '{{route('admin.masterInfo.doSaveMcourse')}}',
                    method: "post",
                    data: $(form).serializeArray(),
                    success: function (result) {
                        var data = showToastFromAjaxResponse(result);
                        if (result.status == 'success') {
                            $("#coursecodeno_hidden").val(data.coursecodeno);
                            $("#coursecodeno").attr('disabled', 'disabled');
                        }
                    }
                });
            }


        });
    }

    function defaultValue() {
        $(".select2").select2(select2Option);

        $("#plan").val($("#plan_hidden").val()).change();
        $("#degree").val($("#degree_hidden").val()).change();


        var csLoadDep = new Select2Cascade($('#faculty_id'), $('#depcode'), "{{route('masterdata.getDepartmentByFacultyId')}}?faculty_id=:parentId:", select2Option);
        csLoadDep.then(function (parent, child, items) {
            if (items.length != 0) {
                if (firstLoadDep) {
                    child.val($('#depcode_hidden').val()).change();
                    firstLoadDep = false;
                } else {
                    child.select2('open');
                }
            }
        });

        var csLoadMajor = new Select2Cascade($('#depcode'), $('#majorcode'), "{{route('masterdata.getMajorByDepartmentIdForDropdown')}}?department_id=:parentId:", select2Option);
        csLoadMajor.then(function (parent, child, items) {
            if (items.length != 0) {
                if (firstLoadMajor) {
                    child.val($('#majorcode_hidden').val()).change();
                    firstLoadMajor = false;
                } else {
                    child.select2('open');
                }
            }
        });


        $('#faculty_id').select2(select2Option).on('change', function () {
            $('#depcode').empty();
            $('#majorcode').empty();
        });


        $('#depcode').select2(select2Option).on('change', function () {
            $('#majorcode').empty();
        });

        $("#faculty_id").val($("#fac_hidden").val()).change();


    }

    $(document).ready(function () {
        initValidation();
        defaultValue();

    });
</script>
@endpush
