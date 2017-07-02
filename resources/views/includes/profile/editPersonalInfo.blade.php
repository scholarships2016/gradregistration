<div class="portlet box red-pink">
    <div class="portlet-title">
        <div class="caption">
            {{--<i class="fa fa-user"></i>--}}
            ข้อมูลทั่วไปผู้สมัคร
            <small>Personal Information</small>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="javascript:;" class="reload"> </a>
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
                            <label class="control-label col-md-3">คำนำหน้าชื่อ
                                <div>
                                    <small>Title</small>
                                </div>
                            </label>
                            <div class="col-md-9">
                                <input type="hidden" id="name_title_id_hidden" name="name_title_id_hidden" value="{{$applicant->name_title_id}}">
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
                            <label class="control-label col-md-3">ชื่อ
                                <div>
                                    <small>Name&nbsp;(Th)</small>
                                </div>
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
                            <label class="control-label col-md-3">นามสกุล
                                <div>
                                    <small>Surname&nbsp;(Th)</small>
                                </div>
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
                                Name&nbsp;(En)
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
                                Surname&nbsp;(En)
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
                            <label class="control-label col-md-3">เพศ
                                <div>
                                    <small>Sex</small>
                                </div>
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
                            <label class="control-label col-md-3">สัญชาติ
                                <div>
                                    <small>Citizenship</small>
                                </div>
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
                            <label class="control-label col-md-3">ศาสนา
                                <div>
                                    <small>Religion</small>
                                </div>
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
                            <label class="control-label col-md-3">สถานภาพสมรส
                                <div>
                                    <small>Marital&nbsp;Status</small>
                                </div>
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
                            <label class="control-label col-md-3">วัน/เดือน/ปีเกิด
                                <div>
                                    <small>Birthdate</small>
                                </div>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="stu_birthdate"
                                       name="stu_birthdate" value="{{$applicant->stu_birthdate}}">
                                <span class="help-block"><small>วัน/เดือน/ปี คศ. ตัวอย่างการกรอก เช่น 20 มกราคม 2520 --> 20/1/1977</small></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">สถานที่เกิด&nbsp;(จังหวัด)
                                <div>
                                    <small>Place&nbsp;of&nbsp;Birth</small>
                                </div>
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
                            <label class="control-label col-md-3">อีเมล
                                <div>
                                    <small>E-Mail</small>
                                </div>
                            </label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="stu_email" name="stu_email"
                                       value="{{$applicant->stu_email}}">
                                <span class="help-block"><small>ต้องกรอกอีเมล์ที่สามารถติดต่อได้จริง บัณฑิตวิทยาลัยจะแจ้งผลการสมัครทางอีเมล์นี้<br>
                                                Please fill in your valid email, graduate school will inform application result via this email.</small></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">รูปถ่าย
                                <div>
                                    <small>Photo</small>
                                </div>
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
                            <label class="col-md-4 control-label">ท่านสนใจสมัครทุนอุดหนุนการศึกษา
                                เฉพาะค่าเล่าเรียนหรือไม่?
                                <div>
                                    <small>Do you want fund?</small>
                                </div>
                            </label>
                            <div class="col-md-8">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="fund_interesting" id="fund_interesting1"
                                               value="1"
                                               @if(!empty($applicant) && $applicant->fund_interesting == 1) checked @endif
                                        > สนใจ
                                        <div>
                                            <small>Interesting</small>
                                        </div>
                                        <span></span>
                                    </label>
                                    <label class="mt-radio mt-radio-outline">
                                        <input type="radio" name="fund_interesting" id="fund_interesting0"
                                               value="0"
                                               @if(!empty($applicant) && $applicant->fund_interesting == 0) checked @endif

                                        > ไม่สนใจ
                                        <div>
                                            <small>Not interesting</small>
                                        </div>
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
                            <label class="col-md-4 control-label">ท่านทราบข้อมูลการรับสมัครจากสื่อใด?
                                <div>
                                    <small>How can you know this news?</small>
                                </div>
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
                                <button type="button" id="savePersonalInfo" class="btn green">บันทึก</button>
                                <button type="reset" class="btn default">ยกเลิก</button>
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
