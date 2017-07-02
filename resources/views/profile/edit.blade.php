@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<style type="text/css">

</style>
@endpush

@section('pagebar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/">หน้าหลัก</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>โพรไฟล์</span>
            </li>
        </ul>
        {{--<div class="page-toolbar">--}}
        {{--<div class="btn-group pull-right">--}}
        {{--<button type="button" class="btn green btn-sm btn-outline dropdown-toggle"--}}
        {{--data-toggle="dropdown"> Actions--}}
        {{--<i class="fa fa-angle-down"></i>--}}
        {{--</button>--}}
        {{--<ul class="dropdown-menu pull-right" role="menu">--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<i class="icon-bell"></i> Action</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<i class="icon-shield"></i> Another action</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<i class="icon-user"></i> Something else here</a>--}}
        {{--</li>--}}
        {{--<li class="divider"></li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<i class="icon-bag"></i> Separated link</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title"> ข้อมูลประวัติผู้สมัคร
        <small>Applicant Information</small>
    </h1>
@stop



@section('maincontent')
    <div class="m-heading-1 border-yellow-saffron bg-yellow-saffron bg-font-yellow-saffron m-bordered">
        <p class="text-center font-red-intense"><b>เลขที่บัตรประจำตัวประชาชน และหมายเลขโทรศัพท์ที่สามารถติดต่อได้นี้
                จะใช้สำหรับเข้าสู่ระบบครั้งต่อไป <br>
                <small>Your Citizen ID or Passport ID will be used to login next time.</small>
            </b></p>
    </div>
    <div class="note note-info">
        <p class="text-center">เลขที่บัตรประจำตัวประชาชน Citizen ID or Passport ID
            <b>{{$applicant->stu_citizen_card}}</b><br>
            หมายเลขโทรศัพท์ที่สามารถติดต่อได้ Contact No <b>{{$applicant->stu_phone}}</b>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('includes.profile.editPersonalInfo')
            @include('includes.profile.editPresentAddress')
            @include('includes.profile.editKnowledgeSkill')
            @include('includes.profile.editEduBackground')
            @include('includes.profile.editWorkExp')
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
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">
    var firstLoadDistrict = true;

    function setComponent() {
        $("#stu_birthdate").inputmask("d/m/y");
        $("#eng_date_taken").inputmask("d/m/y");

        if (jQuery().datepicker) {
            $('#stu_birthdate,#eng_date_taken').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
                clearBtn: true,
                format: 'dd/mm/yyyy'
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        var select2Option = {
            placeholder: '--เลือก--',
            allowClear: true,
            width: '100%'
        };

        $(".select2").select2(select2Option);


        var cascadLoadingDistrict = new Select2Cascade($('#province_id'), $('#district_code'), "{{route('masterdata.getDistrictListByProvinceId')}}?province_id=:parentId:", select2Option);
        cascadLoadingDistrict.then(function (parent, child, items) {
            // Open the child listbox immediately
            if (items.length != 0) {
                if (firstLoadDistrict) {
                    child.val($('#district_code_hidden').val()).change();
                    firstLoadDistrict = false;
                } else {
                    child.select2('open');
                }
            }
        });


    }

    function setEventHandle() {
        $('#savePersonalInfo').click(function () {
            var data = $("#personalInfoForm").serializeArray();
            $.ajax({
                url: "{{route('profile.doSavePersInfo')}}",
                method: "POST",
                data: data,
                success: function (result) {
                    var data = showToastFromAjaxResponse(result);
                }
            });
        });

        $('#savePersAddress').click(function () {
            var data = $("#presentAddressForm").serializeArray();
            $.ajax({
                url: "{{route('profile.doSavePretAddr')}}",
                method: "POST",
                data: data,
                success: function (result) {
                    var data = showToastFromAjaxResponse(result);
                }
            });
        });

        $('#saveKnowledge').click(function () {
            var data = $("#knowledgeForm").serializeArray();
            $.ajax({
                url: "{{route('profile.doSaveKnowSkill')}}",
                method: "POST",
                data: data,
                success: function (result) {
                    var data = showToastFromAjaxResponse(result);
                }
            });
        });

        $('#saveEdu').click(function () {
            var data = $("#eduBackForm").serializeArray();
            $.ajax({
                url: "{{route('profile.doSaveEduBak')}}",
                method: "POST",
                data: data,
                success: function (result) {
                    var data = showToastFromAjaxResponse(result);
                }
            });
        });

        $('#saveWorkExp').click(function () {
            var data = $("#workExpForm").serializeArray();
            $.ajax({
                url: "{{route('profile.doSaveWorkExp')}}",
                method: "POST",
                data: data,
                success: function (result) {
                    var data = showToastFromAjaxResponse(result);
                }
            });
        });
    }

    function setDefaultValue() {
        //PersonalInfo
        $("#name_title_id").val($("#name_title_id_hidden").val()).change();
        $("#stu_sex").val($("#stu_sex_hidden").val()).change();
        $("#nation_id").val($("#nation_id_hidden").val()).change();
        $("#stu_religion").val($("#stu_religion_hidden").val()).change();
        $("#stu_married").val($("#stu_married_hidden").val()).change();
        $("#province_id").val($("#province_id_hidden").val()).change();
        $("#eng_test_id").val($("#eng_test_id_hidden").val()).change();

        $("#eduBackGroup").find(".mt-repeater-item").each(function (index) {
            $(this).find("#grad_level").val($(this).find("#grad_level_hidden").val()).change();
            $(this).find("#edu_pass_id").val($(this).find("#edu_pass_id_hidden").val()).change();
            $(this).find("#university_id").val($(this).find("#university_id_hidden").val()).change();
        });

        $("#workExpGroup").find(".mt-repeater-item").each(function (index) {
            $(this).find("#work_status_id").val($(this).find("#work_status_id_hidden").val()).change();
        });
    }

    $(document).ready(function () {
        setComponent();
        setEventHandle();
        setDefaultValue();
    });
</script>
@endpush