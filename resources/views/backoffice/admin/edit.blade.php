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
                <span>dddd</span>
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
            <form action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button>
                        Your form validation is successful!
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">รหัสผู้ใช้
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="username" data-required="1" class="form-control"
                                   placeholder="รหัสผู้ใช้ชุดเดียว Chula LDAP"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ชื่อ
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="name" data-required="1" class="form-control"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ชื่อ-สกุล

                        </label>
                        <div class="col-md-4">
                            <input type="text" name="name" data-required="1" class="form-control" readonly=""></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Email

                        </label>
                        <div class="col-md-4">
                            <input name="email" type="text" class="form-control" readonly=""></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Role
                            <span class="required" aria-required="true"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="mt-radio-list" data-error-container="#form_2_membership_error">
                                <label class="mt-radio">
                                    <input type="radio" name="membership" value="1"> Administrator
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="membership" value="2"> เจ้าหน้าที่บัณฑิต
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="membership" value="3"> เจ้าหน้าที่ประจำหลักสูตร
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
                            <div class="mt-checkbox-list" data-error-container="#form_2_services_error">
                                <label class="mt-checkbox">
                                    <input type="checkbox" value="1" name="service"> Service 1
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" value="2" name="service"> Service 2
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" value="3" name="service"> Service 3
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">

                            <button type="button" class="btn grey-steel">ยกเลิก</button>
                            <button type="submit" class="btn green">บันทึก</button>

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


    $(document).ready(function () {

    });
</script>
@endpush