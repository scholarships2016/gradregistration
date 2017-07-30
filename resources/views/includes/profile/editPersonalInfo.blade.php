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
        <form id="personalInfoForm" name="personalInfoForm" action="#" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$applicant->applicant_id}}">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                {{Lang::get('resource.perInfoTitle')}}
                            </label>
                            <div class="col-md-9">
                                <input type="hidden" id="name_title_id_hidden" name="name_title_id_hidden"
                                       value="{{$applicant->name_title_id}}">
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
                                       name="stu_first_name" value="{{$applicant->stu_first_name}}">
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
                                       name="stu_last_name" value="{{$applicant->stu_last_name}}">
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
                                       name="stu_first_name_en" value="{{$applicant->stu_first_name_en}}"
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
                                       name="stu_last_name_en" value="{{$applicant->stu_first_name_en}}">
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
                                       value="{{$applicant->stu_sex}}">
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
                                       value="{{$applicant->nation_id}}">
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
                                <input type="hidden" id="stu_religion_hidden" name="stu_religion_hidden"
                                       value="{{$applicant->stu_religion}}">
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
                                       value="{{$applicant->stu_married}}">
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
                                       name="stu_birthdate" value="{{$applicant->stu_birthdate}}">
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
                                       name="stu_birthplace" value="{{$applicant->stu_birthplace}}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                {{Lang::get('resource.perInfoEmail')}}
                            </label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="stu_email" name="stu_email"
                                       value="{{$applicant->stu_email}}">
                                <span class="help-block">
                                    <small>{{Lang::get('resource.perInfoEmailNotice')}}</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                {{Lang::get('resource.perInfoPhoto')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Chee Kin">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                {{Lang::get('resource.perInfoFundInterest')}}
                            </label>
                            <div class="col-md-8">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="fund_interesting" id="fund_interesting1"
                                               value="1"
                                               @if(!empty($applicant) && $applicant->fund_interesting == 1) checked @endif
                                        >
                                        {{Lang::get('resource.perInfoInterest')}}
                                        <span></span>
                                    </label>
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="fund_interesting" id="fund_interesting0"
                                               value="0"
                                               @if(!empty($applicant) && $applicant->fund_interesting == 0) checked @endif

                                        >
                                        {{Lang::get('resource.perInfoNotInterest')}}
                                        <span></span>
                                    </label>
                                    <label><a>ดูรายละเอียดเกี่ยวกับทุน</a></label>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                {{Lang::get('resource.perInfoMedia')}}
                            </label>
                            <div class="col-md-8">
                                <div class="mt-checkbox-list">
                                    @if(!empty($newSrcList))
                                        @foreach ($newSrcList as $newSrc)
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" name="app_news_id[]"
                                                       value="{{$newSrc->news_source_id}}"
                                                       @foreach($applicantNewsSrc as $appNewsSrc)
                                                       @if($newSrc->news_source_id == $appNewsSrc->news_source_id)
                                                       checked
                                                        @break
                                                        @endif
                                                        @endforeach
                                                >
                                                {{$newSrc->news_source_name.' - '.$newSrc->news_source_name_en}}
                                                <span></span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
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
