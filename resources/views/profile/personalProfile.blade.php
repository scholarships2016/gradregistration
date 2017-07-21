@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
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
        {{Lang::get('resource.appctInfoPageTitle')}}
    </h1>
@stop



@section('maincontent')
    <div class="profile">
        <div class="tabbable-line tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1_1" data-toggle="tab"> Overview </a>
                </li>
                <li>
                    <a href="#tab_1_3" data-toggle="tab"> Account </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-unstyled profile-nav">
                                <li>
                                    <img src="{{$profile_img}}"
                                         onerror="this.src='http://www.placehold.it/100x150/EFEFEF/AAAAAA&amp;text=no+image'"
                                         class="img-responsive pic-bordered"/>
                                    <a href="javascript:;" class="profile-edit"> edit </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Last Login ..... </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-8 profile-info">
                                    <h1 class="font-green sbold uppercase">
                                        {{$applicant->stu_first_name.' '.$applicant->stu_last_name}}
                                    </h1>
                                    <p> อธิบายสั้นๆ นะ </p>
                                    <ul class="list-inline">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            @if(!empty($applicant->nation_id))
                                                {{(session('locale')=='th')?$applicant->tblNation->nation_name :$applicant->tblNation->nation_name_en }}
                                            @else
                                                -
                                            @endif
                                        </li>
                                        <li>
                                            <i class="fa fa-calendar"></i>
                                            <span id="birthdateBrief">
                                                @if(!empty($applicant->stu_birthdate))
                                                    {{\Carbon\Carbon::createFromFormat('d/m/Y',$applicant->stu_birthdate)->format('d M Y')}}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <!--end col-md-8-->
                            {{--<div class="col-md-4">--}}
                            {{--</div>--}}
                            <!--end col-md-4-->
                            </div>
                            <!--end row-->
                            <div class="tabbable-line tabbable-custom-profile">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_11" data-toggle="tab"> Latest Customers </a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_22" data-toggle="tab"> Feeds </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_11">
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-briefcase"></i> Company
                                                    </th>
                                                    <th class="hidden-xs">
                                                        <i class="fa fa-question"></i> Descrition
                                                    </th>
                                                    <th>
                                                        <i class="fa fa-bookmark"></i> Amount
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td colspan="4">ไม่มีข้อมูล</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--tab-pane-->
                                    <div class="tab-pane" id="tab_1_22">
                                        <div class="tab-pane active" id="tab_1_1_1">
                                            <div class="scroller" data-height="290px" data-always-visible="1"
                                                 data-rail-visible1="1">
                                                <ul class="feeds">
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-success">
                                                                        <i class="fa fa-bell-o"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> You have 4 pending tasks.
                                                                        <span class="label label-danger label-sm"> Take action
                                                                                                <i class="fa fa-share"></i>
                                                                                            </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> Just now</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success">
                                                                            <i class="fa fa-bell-o"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New version v1.4 just
                                                                            lunched!
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 20 mins</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-danger">
                                                                        <i class="fa fa-bolt"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> Database server #12 overloaded.
                                                                        Please fix the issue.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 24 mins</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-info">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 30 mins</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-success">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 40 mins</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-warning">
                                                                        <i class="fa fa-plus"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New user registered.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 1.5 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-success">
                                                                        <i class="fa fa-bell-o"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> Web server hardware needs to be
                                                                        upgraded.
                                                                        <span class="label label-inverse label-sm"> Overdue </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 2 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-default">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 3 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-warning">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 5 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-info">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 18 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-default">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 21 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-info">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 22 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-default">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 21 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-info">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 22 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-default">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 21 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-info">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 22 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-default">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 21 hours</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-info">
                                                                        <i class="fa fa-bullhorn"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> New order received. Please take
                                                                        care of it.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> 22 hours</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tab_1_2-->
                <div class="tab-pane" id="tab_1_3">
                    <div class="row profile-account">
                        <div class="col-md-3">
                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab_1-1">
                                        <i class="fa fa-cog"></i> Personal info </a>
                                    <span class="after"> </span>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab_3-3">
                                        <i class="fa fa-lock"></i> Change Password </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div id="tab_1-1" class="tab-pane active">
                                    <div class="m-heading-1 border-yellow-saffron bg-yellow-saffron bg-font-yellow-saffron m-bordered">
                                        <p class="text-center font-red-intense"><b>เลขที่บัตรประจำตัวประชาชน
                                                และหมายเลขโทรศัพท์ที่สามารถติดต่อได้นี้
                                                จะใช้สำหรับเข้าสู่ระบบครั้งต่อไป <br>
                                                <small>Your Citizen ID or Passport ID will be used to login next time.
                                                </small>
                                            </b></p>
                                    </div>
                                    <div class="note note-info">
                                        <p class="text-center">เลขที่บัตรประจำตัวประชาชน Citizen ID or Passport ID
                                            <b>{{$applicant->stu_citizen_card}}</b><br>
                                            หมายเลขโทรศัพท์ที่สามารถติดต่อได้ Contact No
                                            <b>{{$applicant->stu_phone}}</b>
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


                                </div>
                                <div id="tab_3-3" class="tab-pane">
                                    <form action="#">
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" class="form-control"/></div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" class="form-control"/></div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" class="form-control"/></div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Change Password </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end col-md-9-->
                    </div>
                </div>
                <!--end tab-pane-->
                <!--end tab-pane-->
            </div>
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
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>

<script type="application/javascript">
    var firstLoadDistrict = true;
    var profilePicFileInput;
    var persInfForm;

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

        profilePicFileInput = $("#stu_profile_pic").fileinput();

    }

    function setEventHandle() {

        profilePicFileInput.on('change', function () {
                var MAX_FILE_SIZE = 524288;
                var file = $(this)[0].files[0];

                if (typeof(file) == "undefined") {
                    return;
                }

                if (!(file.size <= MAX_FILE_SIZE && file.size > 0 ) ||
                    !(file.type == 'image/jpeg' || file.type == 'image/gif' || file.type == 'image/png')) {
                    $("#profile_pic").fileinput('clear')
                    return;
                }

            }
        );

        $('#savePersonalInfo').click(function () {
            if (!persInfForm.valid()) {
                return;
            }
            var formData = new FormData();
            $.each($("#personalInfoForm").serializeArray(), function (index, field) {
                formData.append(field.name, field.value)
            });
            formData.append("stu_profile_pic", $("#stu_profile_pic")[0].files[0]);
            $.ajax({
                url: '{{route('profile.doSavePersInfo')}}',
                headers: {
                    'X-CSRF-Token': $("#personalInfoForm").find("input[name='_token']").val()
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

    function setHandleValidation() {

        persInfForm = $('#personalInfoForm');
        persInfForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                name_title_id: {
                    required: true
                },
                stu_first_name: {
                    required: true
                },
                stu_last_name: {
                    required: true
                },
                stu_last_name: {
                    required: true
                },
                stu_first_name_en: {
                    required: true
                },
                stu_last_name_en: {
                    required: true
                },
                stu_sex: {
                    required: true
                },
                nation_id: {
                    required: true
                },
                stu_religion: {
                    required: true
                },
                stu_married: {
                    required: true
                },
                stu_birthdate: {
                    required: true
                },
                stu_email: {
                    required: true,
                    email: true
                },
                fund_interesting: {
                    required: true
                },
                'app_news_id[]': {
                    required: true,
                    minlength: 1,
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(persInfForm, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".mt-checkbox-list, .mt-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".mt-radio-list, .mt-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
            }
        });
    }

    $(document).ready(function () {
        setComponent();
        setEventHandle();
        setDefaultValue();
        setHandleValidation();
    });
</script>
@endpush