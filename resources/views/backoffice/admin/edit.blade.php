@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css"/>
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
                <span>User Management</span>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        เพิ่ม/แก้ไข ผู้ใช้งานระบบ
        <small></small>
    </h1>
@stop

@section('maincontent')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-speech font-green"></i>
                <span class="caption-subject bold uppercase">ฟอร์มผู้ใช้งานระบบ</span>
            </div>
            <div class="actions">

                <a href="javascript:window.history.back();" class="btn btn-circle blue-steel btn-outline">
                    <i class="fa fa-mail-reply"></i> กลับหน้าหลัก </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form action="#" id="adminEditForm" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" id="user_id" name="user_id" value="@if(!empty($user)){{$user->user_id}}@endif"/>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">รหัสผู้ใช้
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="user_name" class="form-control"
                                   placeholder="รหัสผู้ใช้ชุดเดียว Chula LDAP"
                                   value="@if(!empty($user)){{$user->user_name}}@endif"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ชื่อเล่น
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="nickname" class="form-control"
                                   value="@if(!empty($user)){{$user->nickname}}@endif"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Email
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input name="user_email" type="email" class="form-control"
                                   value="@if(!empty($user)){{$user->user_email}}@endif"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ชื่อ-สกุล
                        </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name"
                                   value="@if(!empty($user)){{$user->name}}@endif"
                                   readonly>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Role
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="mt-radio-list" data-error-container="#form_2_membership_error">
                                <label class="mt-radio">
                                    <input type="radio" name="role_id" value="1"
                                           @if(!empty($user)&&$user->role_id == 1) checked @endif> Administrator
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="role_id" value="2"
                                           @if(!empty($user)&&$user->role_id == 2) checked @endif> เจ้าหน้าที่บัณฑิต
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="role_id" value="3"
                                           @if(!empty($user)&&$user->role_id == 3) checked @endif>
                                    เจ้าหน้าที่ประจำหลักสูตร
                                    <span></span>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">สิทธิ์การใช้งาน (Permission)
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div id="permissionChkDiv" class="mt-checkbox-list"
                                 data-error-container="#form_2_services_error">
                                @if(!empty($permissionList))
                                    @foreach($permissionList as $index => $value)
                                        <label class="mt-checkbox">
                                            <input type="checkbox" value="{{$value->permission_id}}"
                                                   name="permission_id[]"
                                                   @if(!empty($user->userPermission))
                                                   @foreach($user->userPermission as $userPerm)
                                                   @if($userPerm->permission_id == $value->permission_id)
                                                   checked
                                                    @endif
                                                    @endforeach
                                                    @endif
                                            >
                                            {{$value->permission_name}}
                                            <span></span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="button" class="btn grey-steel">ยกเลิก</button>
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
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var mainForm;

    function initValidation() {
        $("#adminEditForm").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                user_name: {
                    required: true
                },
                nickname: {
                    required: true
                },
                user_email: {
                    required: true
                },
                role_id: {
                    required: true
                },
                permission_id: {
                    required: true,
                    minlength: 1,
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
                    url: '{{route('admin.adminManage.doSave')}}',
                    method: "post",
                    data: $(form).serializeArray(),
                    success: function (result) {
                        var data = showToastFromAjaxResponse(result);
                        if (result.status == 'success') {
                            $("#user_id").val(data.user_id);
                        }
                    }
                });

            }
        });
    }

    function eventHandle() {

        $("input[name='role_id']").on('change', function () {
            if ($(this).val() == 1) {
                $("#permissionChkDiv input[type='checkbox']").attr('disabled', 'disabled');
            } else {
                $("#permissionChkDiv input[type='checkbox']").removeAttr('disabled');

            }
        });

    }

    $(document).ready(function () {
        initValidation();
        eventHandle();
    });
</script>
@endpush