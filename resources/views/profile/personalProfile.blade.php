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
        <div class="pull-right">
          <a href="apply/"><button class="btn btn-info" type="button"><i class="fa fa-check"></i> {{Lang::get('resource.btnContinueToApply')}}  </button></a>
        </div>
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
                    <a href="#tab_1_1" data-toggle="tab"> {{Lang::get('resource.lbTabOverview')}} </a>
                </li>

                <li class="">
                    <a href="#tab_1_3" data-toggle="tab">{{Lang::get('resource.lbTabProfileInfo')}}</a>
                </li>
                <li class="">
                    <a href="#tab_1_4" data-toggle="tab"> {{Lang::get('resource.lbTabChangePassword')}} </a>
                </li>

            </ul>
            <div class="tab-content active">
                <div class="tab-pane active" id="tab_1_1">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-unstyled profile-nav">
                                <li>

                                    <img src="{{route('profile.getProfileImg',['applicant_id' => Crypt::encrypt($applicant->applicant_id) ])}}"
                                         onerror="this.src='http://www.placehold.it/100x150/EFEFEF/AAAAAA&amp;text=no+image'"
                                         class="img-responsive pic-bordered"/>

                                    <a href="#tab_1_3" data-toggle="tab" aria-expanded="false" class="profile-edit"> edit </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Last Login  {{$applicant->last_login->format('d/m/Y H:i')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 profile-info" id="view-basic-info">
                                    <h1 class="font-blue sbold uppercase">
                                        {{$applicant->name_title_en}} {{$applicant->stu_first_name_en.' '.$applicant->stu_last_name_en}}
                                        <br/><h4
                                                class="font-blue">{{$applicant->name_title}} {{$applicant->stu_first_name.' '.$applicant->stu_last_name}}</h4>
                                    </h1>
                                    <p>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <i class="fa fa-user font-blue"
                                               title="Citizen ID/Passport ID"></i> {{$applicant->stu_citizen_card}}
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-envelope font-blue"></i> {{$applicant->stu_email}}
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-phone font-blue"></i> {{$applicant->stu_phone}}
                                        </div>
                                    </div>
                                    </p>
                                    <ul class="list-inline">
                                        <li title="Nation">
                                            <i class="fa fa-map-marker"></i>
                                            @if(!empty($applicant->nation_id))
                                                {{(session('locale')=='th')?$applicant->tblNation->nation_name :$applicant->tblNation->nation_name_en }}
                                            @else
                                                -
                                            @endif
                                        </li>
                                        <li title="Date of Birth">
                                            <i class="fa fa-birthday-cake"></i>
                                            <span id="birthdateBrief">
                                                @if(!empty($applicant->stu_birthdate))
                                                    {{$applicant->stu_birthdate->format('d/m/Y')}}
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
                                <a title="{{Lang::get('resource.lbManageCouse')}}" href="application/manageMyCourse"
                                   class="btn btn-circle red-pink btn-outline">
                                    <i class="icon-briefcase"></i> {{Lang::get('resource.lbManageCouse')}}</a>

                                <ul class="nav nav-tabs">

                                    <li class="">

                                    </li>


                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane " id="tab_1_11">
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-briefcase"></i> Program
                                                    </th>
                                                    <th class="hidden-xs">
                                                        <i class="fa fa-question"></i> Major
                                                    </th>
                                                    <th>
                                                        <i class="fa fa-bookmark"></i> Status
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


                                    <!--tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tab_1_2-->
                <div class="tab-pane " id="tab_1_3">
                    <div class="row profile-account">
                      <!--
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
                      -->
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div id="tab_1-1" class="tab-pane active">
                                    <!--
                                      <div class="m-heading-1 border-yellow-saffron bg-yellow-saffron bg-font-yellow-saffron m-bordered">
                                          <p class="text-center font-red-intense"><b>เลขที่บัตรประจำตัวประชาชน
                                                  และหมายเลขโทรศัพท์ที่สามารถติดต่อได้นี้
                                                  จะใช้สำหรับเข้าสู่ระบบครั้งต่อไป <br>
                                                  <small>Your Citizen ID or Passport ID will be used to login next time.
                                                  </small>
                                              </b></p>
                                      </div>
                                    -->
                                    <div class="row alert alert-info text-center">



                                          <div class="col-md-6">
                                          {{Lang::get('resource.lbCitizen')}} :

                                            <b>{{$applicant->stu_citizen_card}}</b>

                                        </div>
                                        <div class="col-md-6">
                                          Email :

                                               <b>{{$applicant->stu_email}}</b>

                                             </div>





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
                                    <div class="row">
                                      <div class="col-md-12 text-center">
                                        <a href="apply/"><button class="btn btn-info" type="button"><i class="fa fa-check"></i> {{Lang::get('resource.btnContinueToApply')}}  </button></a>
                                      </div>
                                      </div>


                                </div>
                                <!--
                                <div id="tab_3-3" class="tab-pane" style="display:none;">
                                    <form id="changePasswordForm" action="#">
                                        <input type="hidden" name="applicant_id" id="applicant_id"
                                               value="{{$applicant->applicant_id}}">
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" id="current_password" name="current_password"
                                                   class="form-control"/></div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" id="password" name="password" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" id="confirm_password" name="confirm_password"
                                                   class="form-control"/></div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" id="changePassBt" class="btn green"> Change
                                                Password </a>
                                            <button type="reset" class="btn default"> Cancel</button>
                                        </div>
                                    </form>
                                </div>
                              -->
                            </div>
                        </div>
                        <!--end col-md-9-->
                    </div>
                </div>
                <!--end tab-pane-->
                <!--end tab-pane-->
                <div class="tab-pane" id="tab_1_4">
                  <form id="changePasswordForm" action="#">
                      <input type="hidden" name="applicant_id" id="applicant_id"
                             value="{{$applicant->applicant_id}}">
                      <div class="form-group">
                          <label class="control-label">{{Lang::get('resource.lbCurrentPassword')}}</label>
                          <input type="password" id="current_password" name="current_password"
                                 class="form-control"/></div>
                      <div class="form-group">
                          <label class="control-label">{{Lang::get('resource.lbNewPassword')}}</label>
                          <input type="password" id="password" name="password" class="form-control"/>
                      </div>
                      <div class="form-group">
                          <label class="control-label">{{Lang::get('resource.lbConfirmNewPassword')}}</label>
                          <input type="password" id="confirm_password" name="confirm_password"
                                 class="form-control"/></div>
                      <div class="margin-top-10">
                          <a href="javascript:;" id="changePassBt" class="btn green"> {{Lang::get('resource.lbBtnChangePassword')}} </a>

                      </div>
                  </form>
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
    var changePassForm;

    function setComponent() {
        $("#stu_birthdate").inputmask("d/m/y");
        $("#eng_date_taken").inputmask("d/m/y");
        $("#eng_date_taken_admin").inputmask("d/m/y");


        if (jQuery().datepicker) {
            $('#stu_birthdate,#eng_date_taken,#eng_date_taken_admin').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
                clearBtn: true,
                format: 'dd/mm/yyyy'
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        var select2Option = {
            placeholder: '--Select--',
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
                    $("#stu_profile_pic").fileinput('clear')
                    return;
                }
                $("#hasImg").val(1);
            }
        );

        $("#delPicBt").on('click', function () {
            $("#hasImg").val(0);
            $("#reqDelImg").val(1);
        });


        $('#savePersonalInfo').click(function () {
            if (!persInfForm.valid()) {
                return;
            }
            var formData = new FormData();
            $.each($("#personalInfoForm").serializeArray(), function (index, field) {
                formData.append(field.name, field.value)
            });
            formData.append("stu_profile_pic", isUndefinedOrNull($("#stu_profile_pic")[0].files[0]) ? "" : $("#stu_profile_pic")[0].files[0]);
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

        $('#changePassBt').click(function () {
            if (!changePassForm.valid()) {
                return;
            }
            var data = $("#changePasswordForm").serializeArray();
            $.ajax({
                url: '{{route('profile.doChangePassword')}}',
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                },
                method: "POST",
                data: data,
                success: function (result) {
                    var data = showToastFromAjaxResponse(result);
                    if (result.status == 'success') {
                        $("#current_password").val('');
                        $("#password").val('');
                        $("#confirm_password").val('');
                    }
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

        //Hide Section
        $("#adminScoreDiv").hide();
        $("#adminScoreDiv input").attr('disabled','disabled');
        $("#adminScoreDiv select").attr('disabled','disabled');

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
//                if (element.is(':checkbox')) {
//                    error.insertAfter(element.closest(".mt-checkbox-list, .mt-checkbox-inline, .checkbox-list, .checkbox-inline"));
//                } else if (element.is(':radio')) {
//                    error.insertAfter(element.closest(".mt-radio-list, .mt-radio-inline, .radio-list,.radio-inline"));
//                } else {
//                    error.insertAfter(element); // for other inputs, just perform default behavior
//                }
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


        changePassForm = $('#changePasswordForm');
        changePassForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                current_password: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(changePassForm, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
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

    function chkToOpen(obj) {
        var rptlist = $('#workExpGroup .mt-repeater-item').not($(obj).closest('.mt-repeater-item'));
        $.each(rptlist, function (index, value) {
            $(value).find("#app_work_status").removeProp('checked')
        });
    }


function disablePersonalInfo() {
        $("#personalInfoForm input").attr('disabled', 'disabled');
        $("#personalInfoForm select").attr('disabled', 'disabled');
        $("#personalInfoForm textarea").attr('disabled', 'disabled');
        $("#personalInfoForm button").attr('disabled', 'disabled');

    }

    function disablePresentAddress() {
        $("#presentAddressForm input").attr('disabled', 'disabled');
        $("#presentAddressForm select").attr('disabled', 'disabled');
        $("#presentAddressForm textarea").attr('disabled', 'disabled');
        $("#presentAddressForm button").attr('disabled', 'disabled');

    }

    function disableKnowledgeSkill() {
        $("#knowledgeForm input").attr('disabled', 'disabled');
        $("#knowledgeForm select").attr('disabled', 'disabled');
        $("#knowledgeForm textarea").attr('disabled', 'disabled');
        $("#knowledgeForm button").attr('disabled', 'disabled');

    }

    function disableEduBackground() {
        $("#eduBackForm input").attr('disabled', 'disabled');
        $("#eduBackForm select").attr('disabled', 'disabled');
        $("#eduBackForm textarea").attr('disabled', 'disabled');
        $("#eduBackForm button").attr('disabled', 'disabled');
        $("#eduBackForm .mt-repeater-add").hide();
        $("#eduBackForm .repeater-delete-bt").hide();


    }

    function disableWorkExp() {
        $("#workExpForm input").attr('disabled', 'disabled');
        $("#workExpForm select").attr('disabled', 'disabled');
        $("#workExpForm textarea").attr('disabled', 'disabled');
        $("#workExpForm button").attr('disabled', 'disabled');
        $("#workExpForm .mt-repeater-add").hide();
        $("#workExpForm .repeater-delete-bt").hide();

    }


  function disableAll() {
        disablePersonalInfo();
        disablePresentAddress();
        disableKnowledgeSkill();
        disableEduBackground();
        disableWorkExp();
      }








    $(document).ready(function () {
        setComponent();
        setEventHandle();
        setDefaultValue();
        setHandleValidation();
<!--        @if($application>0)
        disableAll();
        @endif-->
    });







</script>
@endpush
