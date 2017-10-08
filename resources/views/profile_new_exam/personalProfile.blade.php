@extends('layouts.defaultNoMenu')

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
 
@stop

@section('pagetitle')
<h1 class="page-title">
    เพิ่มผู้สอบได้เป็นกรณีพิเศษ
</h1>
@stop



@section('maincontent')
<div class="profile">
    <div class="tabbable-line tabbable-full-width">
        <ul class="nav nav-tabs">

            <li class="">
                <a href="#tab_1_1" data-toggle="tab">{{Lang::get('resource.lbTabProfileInfo')}}</a>
            </li>

        </ul>
        <div class="tab-content active">

            <div class="tab-pane active" id="tab_1_1">
                <div class="row profile-account">

                    <div class="col-md-12">
                        <div class="tab-content">
                            <div id="tab_1-1" class="tab-pane active">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box red-pink">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    {{Lang::get('resource.perInfoSectionTitle')}}
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <input type="hidden" id="curr_act_id" name="curr_act_id" value="{{$curr_act_id }}">
                                                <input type="hidden" id="sub_major_id" name="sub_major_id" value="{{$sub_major_id }}">
                                                <input type="hidden" id="program_id" name="program_id" value="{{$program_id }}">
                                                <input type="hidden" id="program_type_id" name="program_type_id" value="{{$program_type_id }}">
                                                <input type="hidden" id="curriculum_id" name="curriculum_id" value="{{$curriculum_id }}">
                                                <input type="hidden" id="apply_comment" name="apply_comment" value="{{$apply_comment }}">
                                                

                                                <form id="personalInfoForm" name="personalInfoForm" action="#" class="form-horizontal">
                                                    {{csrf_field()}}

                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.lbCitizen')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="applicant_ID" name="applicant_ID">
                                                                        <input type="text" name="stu_citizen_card" class="form-control"  id="stu_citizen_card"  >
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoTitle')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="name_title_id_hidden" name="name_title_id_hidden"  >
                                                                        <select class="form-control select2" id="name_title_id"
                                                                                name="name_title_id">
                                                                            @if(!empty($nameTitleList))
                                                                            @foreach ($nameTitleList as $nameTitle)
                                                                            <option value="{{$nameTitle->name_title_id}}">{{$nameTitle->name_title." - ".$nameTitle->name_title_en}}</option>
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
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoName')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_first_name"
                                                                               name="stu_first_name" >
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoSurname')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_last_name"
                                                                               name="stu_last_name" >
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoNameEn')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_first_name_en"
                                                                               name="stu_first_name_en" 
                                                                               onkeyup="return this.value = this.value.toUpperCase()">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoSurnameEn')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_last_name_en"
                                                                               onkeyup="return this.value = this.value.toUpperCase()"
                                                                               name="stu_last_name_en"  >
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoSex')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="stu_sex_hidden" name="stu_sex_hidden"
                                                                               >
                                                                        <select class="form-control select2" id="stu_sex" name="stu_sex">
                                                                            <option value="1">ชาย [Male] - Male</option>
                                                                            <option value="2">หญิง [Female] - Female</option>
                                                                        </select>
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoCitizenship')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="nation_id_hidden" name="nation_id_hidden"
                                                                               >
                                                                        <select class="form-control select2" id="nation_id" name="nation_id">
                                                                            @if(!empty($nationList))
                                                                            @foreach ($nationList as $nation)
                                                                            <option value="{{$nation->nation_id}}">{{$nation->nation_name." - ".$nation->nation_name_en}}</option>
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
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoReligion')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="stu_religion_hidden" name="stu_religion_hidden">
                                                                        <select class="form-control select2" id="stu_religion" name="stu_religion">
                                                                            @if(!empty($religionList))
                                                                            @foreach ($religionList as $religion)
                                                                            <option value="{{$religion->religion_id}}">{{$religion->religion_name." - ".$religion->religion_name_en}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoMaritalStatus')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="stu_married_hidden" name="stu_married_hidden"
                                                                               >
                                                                        <select class="form-control select2" id="stu_married" name="stu_married">
                                                                            <option value="โสด">โสด - Single</option>
                                                                            <option value="สมรส">สมรส - Married</option>
                                                                            <option value="หม้าย">หม้าย - Divorced</option>
                                                                            <option value="อื่นๆ">อื่นๆ - Other</option>
                                                                        </select>
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoBirthdate')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_birthdate"
                                                                               name="stu_birthdate"
                                                                               >
                                                                        <span class="help-block"><small>{{Lang::get('resource.perInfoBirthdateEx')}}</small></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoPlaceOfBirth')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_birthplace"
                                                                               name="stu_birthplace" >
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        {{Lang::get('resource.perInfoPlaceOfBirth')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_birthplace"
                                                                               name="stu_birthplace" >
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" >
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">
                                                                        เบอร์โทรศัพท์
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="stu_phone" name="stu_phone"
                                                                               >
                                                                        <span class="help-block">
                                                                            <small>{{Lang::get('resource.perInfoEmailNotice')}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr/>


                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-3 col-md-9">
                                                                            <button type="button" id="savePersonalInfo" class="btn green">
                                                                                {{Lang::get('resource.lbSave')}}
                                                                            </button>
                                                                            <button type="reset" class="btn default">
                                                                                {{Lang::get('resource.lbCancel')}}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6"></div>
                                                            </div>
                                                        </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                        <div class="portlet box red-pink">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    {{--<i class="fa fa-user"></i>--}}
                                                    {{Lang::get('resource.lbPerAddress')}}

                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>

                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form id="presentAddressForm" name="presentAddressForm" action="#" class="form-horizontal">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="applicant_id" id="applicant_id" >
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbNoMoo')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="stu_addr_no" name="stu_addr_no"
                                                                               value="" class="form-control">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbVillage')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="stu_addr_village" name="stu_addr_village"
                                                                               value="" class="form-control">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbSoi')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="stu_addr_soi" name="stu_addr_soi"
                                                                               value="" class="form-control">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbRoad')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="stu_addr_road" name="stu_addr_road"
                                                                               value="" class="form-control">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbProvince')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="province_id_hidden" name="province_id_hidden"
                                                                               value="">
                                                                        <select class="form-control select2" id="province_id"
                                                                                name="province_id">
                                                                            @if(!empty($provinceList))
                                                                            @foreach ( $provinceList as $prov )
                                                                            <option value="{{$prov->province_id}}">{{$prov->province_name}} - {{$prov->province_name_en}} </option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbDistrict')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="district_code_hidden" name="district_code_hidden"
                                                                               value="">
                                                                        <select class="form-control select2" id="district_code"
                                                                                name="district_code">
                                                                        </select>
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbSubdistrict')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="stu_addr_tumbon" name="stu_addr_tumbon"
                                                                               value="" class="form-control">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbZipcode')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="stu_addr_pcode" maxlength="5" name="stu_addr_pcode"
                                                                               value="" class="form-control">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbOtherContactNo')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="stu_phone" name="stu_phone" value=""
                                                                               class="form-control">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="button" class="btn green" id="savePersAddress">{{Lang::get('resource.lbSave')}}</button>
                                                                        <button type="reset" class="btn default" id="clearPersAddress">{{Lang::get('resource.lbCancel')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>

                                        <div class="portlet box red-pink">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    {{--<i class="fa fa-user"></i>--}}
                                                    {{Lang::get('resource.lbSkill')}}
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>

                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form id="knowledgeForm" name="knowledgeForm" action="#" class="form-horizontal">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="applicant_id" id="applicant_id">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbEnglish')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="hidden" id="eng_test_id_hidden" name="eng_test_id_hidden"
                                                                               value=""/>
                                                                        <select class="form-control input-small select2" id="eng_test_id" name="eng_test_id">
                                                                            @if(!empty($engTestList))
                                                                            @foreach ($engTestList as $engTest)
                                                                            <option value="{{$engTest->eng_test_id}}">{{$engTest->eng_test_name}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select> <span class="help-block"><a
                                                                                href="http://www.eurogates.nl/en-TOEFL-IELTS-score-conversion/"
                                                                                target="_">{{Lang::get('resource.lbExScoreTest')}}</a></span>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">{{Lang::get('resource.lbScore')}}
                                                                                    </label>
                                                                                    <input type="text" class="form-control input-small" id="eng_test_score"
                                                                                           name="eng_test_score" value="">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">{{Lang::get('resource.lbDateTaken')}}
                                                                                    </label>
                                                                                    <input type="text" class="form-control input-small" id="eng_date_taken"
                                                                                           name="eng_date_taken"
                                                                                           value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbThai')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control input-small" id="thai_test_score"
                                                                               name="thai_test_score"
                                                                               value="">
                                                                        <span class="help-block">{{Lang::get('resource.lbScore')}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">{{Lang::get('resource.lbCUBEST')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control input-small" id="cu_best_score"
                                                                               name="cu_best_score" value="">
                                                                        <span class="help-block">{{Lang::get('resource.lbScore')}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="adminScoreDiv">
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3">Admin&nbsp;{{Lang::get('resource.lbEnglish')}}
                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="hidden" id="eng_test_id_admin_hidden" name="eng_test_id_admin_hidden"
                                                                                   value=""/>
                                                                            <select class="form-control input-small select2" id="eng_test_id_admin" name="eng_test_id_admin">
                                                                                @if(!empty($engTestList))
                                                                                @foreach ($engTestList as $engTest)
                                                                                <option value="{{$engTest->eng_test_id}}">{{$engTest->eng_test_name}}</option>
                                                                                @endforeach
                                                                                @endif
                                                                            </select> <span class="help-block"><a
                                                                                    href="http://www.eurogates.nl/en-TOEFL-IELTS-score-conversion/"
                                                                                    target="_">{{Lang::get('resource.lbExScoreTest')}}</a></span>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="col-md-6">
                                                                                        <label class="control-label">{{Lang::get('resource.lbScore')}}
                                                                                        </label>
                                                                                        <input type="text" class="form-control input-small" id="eng_test_score_admin"
                                                                                               name="eng_test_score_admin" value="">
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label class="control-label">{{Lang::get('resource.lbDateTaken')}}
                                                                                        </label>
                                                                                        <input type="text" class="form-control input-small" id="eng_date_taken_admin"
                                                                                               name="eng_date_taken_admin"
                                                                                               value="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="button" id="saveKnowledge" name="saveKnowledge"
                                                                                class="btn green">{{Lang::get('resource.lbSave')}}</button>
                                                                        <button type="reset" id="clearKnowledge" name="clearKnowledge"
                                                                                class="btn default">{{Lang::get('resource.lbCancel')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                        <div class="portlet box red-pink">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    {{--<i class="fa fa-user"></i>--}}
                                                    {{Lang::get('resource.lbEduBackground')}}
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>

                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form id="eduBackForm" name="eduBackForm" action="#" class="mt-repeater form-horizontal">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="applicant_id" id="applicant_id" >
                                                    <div class="form-body">
                                                        <div class="mt-repeater">
                                                            <div class="row">
                                                                <div class="col-md-2 text-left">
                                                                    <a title="เพิ่มข้อมูลประวัติการศึกษา" href="javascript:;" data-repeater-create
                                                                       class="btn btn-circle green-haze btn-outline btn-success mt-repeater-add">
                                                                        <i class="fa fa-plus"></i> {{Lang::get('resource.lbAdd')}}</a>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="note note-danger text-center">
                                                                        <i class="fa  fa-info-circle"></i> {{Lang::get('resource.lbEduRemark')}} </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div id="eduBackGroup" data-repeater-list="eduback-group">
                                                                @if(empty($applicantEduList) || sizeof($applicantEduList) == 0)
                                                                <div data-repeater-item class="mt-repeater-item row">
                                                                    <!-- jQuery Repeater Container -->
                                                                    <input type="hidden" id="app_edu_id" name="app_edu_id" value=""/>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-12 text-right">
                                                                                <label class="control-label">
                                                                                    &nbsp;
                                                                                </label>
                                                                                <a href="javascript:;" data-repeater-delete=""
                                                                                   class="btn btn-danger repeater-delete-bt">
                                                                                    <i class="fa fa-close"> {{Lang::get('resource.lbDel')}}</i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" id="app_edu_id" name="app_edu_id" value=""/>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbDegreeLevel')}}
                                                                                </label>
                                                                                <input type="hidden" id="grad_level_hidden" name="grad_level_hidden"
                                                                                       value="">
                                                                                <select id="grad_level" name="grad_level" class="form-control select2">
                                                                                    <option value="BACHELOR" selected>ปริญญาตรี - Bachelor Degree</option>
                                                                                    <option value="MASTER">ปริญญาโท - Master Degree</option>
                                                                                    <option value="DOCTOR">ปริญญาเอก - Doctor Degree</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbStatus')}}
                                                                                </label>
                                                                                <input type="hidden" id="edu_pass_id_hidden" name="edu_pass_id_hidden"
                                                                                       value="">
                                                                                <select id="edu_pass_id" name="edu_pass_id"
                                                                                        class="form-control input-small select2">
                                                                                    @if(!empty($eduPassList))
                                                                                    @foreach ($eduPassList as $eduPass)
                                                                                    <option value="{{$eduPass->edu_pass_id}}">{{$eduPass->edu_pass_name.' - '.$eduPass->edu_pass_name_en}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">  {{Lang::get('resource.lbInstitution')}}
                                                                                </label>
                                                                                <input type="hidden" id="university_id_hidden" name="university_id_hidden">
                                                                                <select name="university_id" id="university_id"
                                                                                        class="form-control select2">
                                                                                    @if(!empty($uniList))
                                                                                    @foreach ($uniList as $uni)
                                                                                    <option value="{{$uni->university_id}}">{{$uni->university_name}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbFaculty')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_faculty" name="edu_faculty" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">

                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbYearGraduated')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_year" maxlength="4" size="4" name="edu_year" type="text">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbGPAX')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_gpax" maxlength="8" size="8" name="edu_gpax" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbMajorSubjects')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_major" name="edu_major" type="text">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbTitleDegree')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_degree" name="edu_degree" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @else
                                                                @foreach($applicantEduList as $index => $appEdu)
                                                                <div data-repeater-item class="mt-repeater-item row">
                                                                    <!-- jQuery Repeater Container -->
                                                                    <input type="hidden" id="app_edu_id" name="app_edu_id"
                                                                           value="{{$appEdu->app_edu_id}}"/>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-12 text-right">
                                                                                <label class="control-label">
                                                                                    &nbsp;
                                                                                </label>
                                                                                <a href="javascript:;" data-repeater-delete=""
                                                                                   class="btn btn-danger repeater-delete-bt">
                                                                                    <i class="fa fa-close"> {{Lang::get('resource.lbDel')}}</i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" id="app_edu_id" name="app_edu_id"
                                                                           value="{{$appEdu->app_edu_id}}"/>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbDegreeLevel')}}
                                                                                </label>
                                                                                <input type="hidden" id="grad_level_hidden"
                                                                                       name="grad_level_hidden"
                                                                                       value="{{$appEdu->grad_level}}">
                                                                                <select id="grad_level" name="grad_level"
                                                                                        class="form-control select2">
                                                                                    <option value="BACHELOR">ปริญญาตรี - Bachelor Degree</option>
                                                                                    <option value="MASTER">ปริญญาโท - Master Degree</option>
                                                                                    <option value="DOCTOR">ปริญญาเอก - Doctor Degree</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbStatus')}}
                                                                                </label>
                                                                                <input type="hidden" id="edu_pass_id_hidden"
                                                                                       name="edu_pass_id_hidden"
                                                                                       value="{{$appEdu->edu_pass_id}}">
                                                                                <select id="edu_pass_id" name="edu_pass_id"
                                                                                        class="form-control input-small select2">
                                                                                    @if(!empty($eduPassList))
                                                                                    @foreach ($eduPassList as $eduPass)
                                                                                    <option value="{{$eduPass->edu_pass_id}}">{{$eduPass->edu_pass_name.' - '.$eduPass->edu_pass_name_en}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label"> {{Lang::get('resource.lbInstitution')}}
                                                                                </label>
                                                                                <input type="hidden" id="university_id_hidden"
                                                                                       name="university_id_hidden"
                                                                                       value="{{$appEdu->university_id}}">
                                                                                <select name="university_id" id="university_id"
                                                                                        class="form-control select2">
                                                                                    @if(!empty($uniList))
                                                                                    @foreach ($uniList as $uni)
                                                                                    <option value="{{$uni->university_id}}">{{$uni->university_name}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbFaculty')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_faculty"
                                                                                       name="edu_faculty"
                                                                                       type="text" value="{{$appEdu->edu_faculty}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">

                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbYearGraduated')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_year" name="edu_year"
                                                                                       type="text" maxlength="4" size="4" value="{{$appEdu->edu_year}}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbGPAX')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_gpax" name="edu_gpax"
                                                                                       type="text" maxlength="8" size="8" value="{{$appEdu->edu_gpax}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbMajorSubjects')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_major"
                                                                                       name="edu_major" type="text" value="{{$appEdu->edu_major}}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbTitleDegree')}}
                                                                                </label>
                                                                                <input class="form-control" id="edu_degree"
                                                                                       name="edu_degree"
                                                                                       type="text" value="{{$appEdu->edu_degree}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="button" id="saveEdu"
                                                                                class="btn green">{{Lang::get('resource.lbSave')}}</button>
                                                                        <button type="reset" id="clearEdu"
                                                                                class="btn default">{{Lang::get('resource.lbCancel')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="portlet box red-pink">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    {{--<i class="fa fa-user"></i>--}}
                                                    {{Lang::get('resource.lbWorkExp')}}
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>

                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form id="workExpForm" name="workExpForm" action="#" class="mt-repeater form-horizontal">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="applicant_id" id="applicant_id" >
                                                    <div class="form-body">
                                                        <div class="mt-repeater">
                                                            <div class="row">
                                                                <div class="col-md-12 text-left">
                                                                    <a title="เพิ่มข้อมูลประวัติการทำงาน" href="javascript:;" data-repeater-create
                                                                       class="btn btn-circle green-haze btn-outline  btn-success mt-repeater-add">
                                                                        <i class="fa fa-plus"></i> {{Lang::get('resource.lbAdd')}}</a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div id="workExpGroup" data-repeater-list="workexp-group">
                                                                @if(empty($applicantWorkExpList) || sizeof($applicantWorkExpList) == 0)
                                                                <div data-repeater-item class="mt-repeater-item row">
                                                                    <!-- jQuery Repeater Container -->
                                                                    <input type="hidden" id="app_work_id" name="app_work_id" value=""/>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-12 text-right">
                                                                                <label class="control-label">
                                                                                    &nbsp;
                                                                                </label>
                                                                                <a href="javascript:;" data-repeater-delete=""
                                                                                   class="btn btn-danger repeater-delete-bt">
                                                                                    <i class="fa fa-close"> {{Lang::get('resource.lbDel')}}</i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label"> {{Lang::get('resource.lbWorkStatus')}}
                                                                                </label>
                                                                                <input type="hidden" id="work_status_id_hidden"
                                                                                       name="work_status_id_hidden" value="">
                                                                                <select id="work_status_id" name="work_status_id"
                                                                                        class="form-control select2">
                                                                                    @if(!empty($workStatusList))
                                                                                    @foreach ($workStatusList as $workStatus)
                                                                                    <option value="{{$workStatus->work_status_id}}">{{$workStatus->work_status_name.' - '.$workStatus->work_status_name_en}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbWorkPlace')}}
                                                                                </label>
                                                                                <input class="form-control" id="work_stu_detail" name="work_stu_detail"
                                                                                       type="text" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbPosition')}}
                                                                                </label>
                                                                                <input type="text" class="form-control" id="work_stu_position"
                                                                                       name="work_stu_position" value="">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbPeriodWorking')}}
                                                                                </label>
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control text-right" id="work_stu_yr"
                                                                                           name="work_stu_yr" value="">
                                                                                    <span class="input-group-addon">
                                                                                        {{Lang::get('resource.lbPeriodWorkingYear')}}
                                                                                    </span>
                                                                                    <input type="number" class="form-control text-right" id="work_stu_mth"
                                                                                           name="work_stu_mth" value="">
                                                                                    <span class="input-group-addon">
                                                                                        {{Lang::get('resource.lbPeriodWorkingMonth')}}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbSalary')}}
                                                                                </label>
                                                                                <input class="form-control text-right" type="text" id="work_stu_salary"
                                                                                       name="work_stu_salary" value="">
                                                                                <span class="help-block"><small>{{Lang::get('resource.lbSalaryCurrency')}}</small></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbContactNo')}}
                                                                                </label>
                                                                                <input class="form-control" type="text" id="work_stu_phone"
                                                                                       name="work_stu_phone" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbCurrentWorkStatusTitle')}}</label>
                                                                                <br>
                                                                                <label class="mt-checkbox">
                                                                                    <input id="app_work_status" type="checkbox" name="app_work_status"
                                                                                           value="1"
                                                                                           onclick="chkToOpen(this)"> {{Lang::get('resource.lbCurrentWorkStatus')}}
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @else
                                                                @foreach($applicantWorkExpList as $index => $workExp )
                                                                <div data-repeater-item class="mt-repeater-item row">
                                                                    <!-- jQuery Repeater Container -->
                                                                    <input type="hidden" id="app_work_id" name="app_work_id" value="{{$workExp->app_work_id}}"/>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-12 text-right">
                                                                                <label class="control-label">
                                                                                    &nbsp;
                                                                                </label>
                                                                                <a href="javascript:;" data-repeater-delete=""
                                                                                   class="btn btn-danger repeater-delete-bt">
                                                                                    <i class="fa fa-close"> {{Lang::get('resource.lbDel')}}</i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbWorkStatus')}}
                                                                                </label>
                                                                                <input type="hidden" id="work_status_id_hidden"
                                                                                       name="work_status_id_hidden"
                                                                                       value="{{$workExp->work_status_id}}">
                                                                                <select id="work_status_id" name="work_status_id"
                                                                                        class="form-control select2">
                                                                                    @if(!empty($workStatusList))
                                                                                    @foreach ($workStatusList as $workStatus)
                                                                                    <option value="{{$workStatus->work_status_id}}">{{$workStatus->work_status_name.' - '.$workStatus->work_status_name_en}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbWorkPlace')}}
                                                                                </label>
                                                                                <input class="form-control" id="work_stu_detail" name="work_stu_detail"
                                                                                       type="text" value="{{$workExp->work_stu_detail}}">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbPosition')}}
                                                                                </label>
                                                                                <input type="text" class="form-control" id="work_stu_position"
                                                                                       name="work_stu_position" value="{{$workExp->work_stu_position}}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbPeriodWorking')}}
                                                                                    </small>
                                                                                </label>
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control text-right" id="work_stu_yr"
                                                                                           name="work_stu_yr" value="{{$workExp->work_stu_yr}}">
                                                                                    <span class="input-group-addon">
                                                                                        <small>{{Lang::get('resource.lbPeriodWorkingYear')}}</small>
                                                                                    </span>
                                                                                    <input type="number" class="form-control text-right" id="work_stu_mth"
                                                                                           name="work_stu_mth" value="{{$workExp->work_stu_mth}}">
                                                                                    <span class="input-group-addon">
                                                                                        <small>{{Lang::get('resource.lbPeriodWorkingMonth')}}</small>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbSalary')}}
                                                                                </label>
                                                                                <input class="form-control" type="text" id="work_stu_salary"
                                                                                       name="work_stu_salary" value="{{$workExp->work_stu_salary}}">
                                                                                <span class="help-block"><small>{{Lang::get('resource.lbSalaryCurrency')}}</small></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">
                                                                                    {{Lang::get('resource.lbContactNo')}}
                                                                                </label>
                                                                                <input class="form-control" type="text" id="work_stu_phone"
                                                                                       name="work_stu_phone" value="{{$workExp->work_stu_phone}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">{{Lang::get('resource.lbCurrentWorkStatusTitle')}}</label>
                                                                                <br>
                                                                                <label class="mt-checkbox">
                                                                                    <input id="app_work_status" type="checkbox" name="app_work_status"
                                                                                           value="1" onclick="chkToOpen(this)"
                                                                                           @if($workExp->app_work_status == 1) checked @endif
                                                                                           > {{Lang::get('resource.lbCurrentWorkStatus')}}
                                                                                           <span></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="button" id="saveWorkExp"
                                                                                class="btn green">{{Lang::get('resource.lbSave')}}</button>
                                                                        <button type="reset" id="clearWorkExp"
                                                                                class="btn default">{{Lang::get('resource.lbCancel')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                           <div class="portlet box red-pink">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    {{--<i class="fa fa-user"></i>--}}
                                                    หมายเหตุผู้สอบได้เป็นกรณีพิเศษ
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>

                                                </div>
                                            </div>
                                                <form id="addData">
                                            
                                                        <div class="modal-content">
                                                             
                                                            
                                                            <div class="modal-body">

                                                              

                                 
                                                                <div class="form-group">
                                                                    <label>หมายเหตุ</label>
                                                                    <textarea class="form-control" id="apply_comment" rows="3"></textarea>
                                                                </div>
                                                                <br>

 <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="button" id="btSaveNewExam"
                                                                                class="btn green">{{Lang::get('resource.lbConfirmApply')}}</button>
                                                                        <button type="reset" id="btclossNewExam"
                                                                                class="btn default">{{Lang::get('resource.lbCancel')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                        </div>
                                                    </div>
                                                                

                                                            </div>

                                                        
                                                    </div>  </form>
                                            </div>
                                        </div>


                                    </div>
                                </div>


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
$('#btSaveNewExam').click(function() {
    
                                $.ajax({
                                        type: "POST",
                                        url: '{!! Route('addUserExamGS05') !!}',
                                         async: false,
                                        data :{
                                                curr_act_id: $('#curr_act_id').val() ,
                                                sub_major_id : $('#sub_major_id').val(),
                                                program_id : $('#program_id').val(),
                                                program_type_id : $('#program_type_id').val(),
                                                curriculum_id : $('#curriculum_id').val(),
                                                applicant_ID  : $('#presentAddressForm #applicant_id').val(),
                                                 stu_citizen_card  : $("#stu_citizen_card").val(),
                                                 apply_comment: $('#apply_comment').val(),
                                                _token: '{{ csrf_token() }}'
                                               } ,
                                        success : function(data){
                                           toastr.success('ดำเนินการเรียบร้อย');
//                                           window.top.close();
                                           }
                                },"json");
    });
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
            $.ajax({
                url: '{{route('doSavePersonalInfomationNewExam')}}',
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
                    
                    var data =  result.aplicant_id;         
                    $("#personalInfoForm #applicant_id").val(data);
                     $("#presentAddressForm #applicant_id").val(data);
                     $("#knowledgeForm #applicant_id").val(data);
                     $("#eduBackForm #applicant_id").val(data);
                     $("#workExpForm #applicant_id").val(data);
                      toastr.success('ดำเนินการเรียบร้อย');
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
                stu_citizen_card: {
                    required: true
                },
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

    $(document).ready(function () {
        setComponent();
        setEventHandle();
        setDefaultValue();
        setHandleValidation();
    });
</script>
@endpush
