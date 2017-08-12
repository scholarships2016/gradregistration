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
            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$applicant->applicant_id}}">
            <div class="form-body">
                <div class="mt-repeater">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <a title="เพิ่มข้อมูลประวัติการศึกษา" href="javascript:;" data-repeater-create
                               class="btn btn-circle green-haze btn-outline btn-success mt-repeater-add">
                                <i class="fa fa-plus"></i> {{Lang::get('resource.lbAdd')}}</a>
                        </div>
                    </div>
                    <hr>
                    <div id="eduBackGroup" data-repeater-list="eduback-group">
                        @if(empty($applicantEduList) || sizeof($applicantEduList) == 0)
                            <div data-repeater-item class="mt-repeater-item row">
                                <!-- jQuery Repeater Container -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 text-right">
                                            <label class="control-label">
                                                &nbsp;
                                            </label>
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn btn-danger">
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
                                            <input class="form-control" id="edu_year" name="edu_year" type="text">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">{{Lang::get('resource.lbGPAX')}}
                                            </label>
                                            <input class="form-control" id="edu_gpax" name="edu_gpax" type="text">
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
                            <div data-repeater-item class="mt-repeater-item row">
                                <!-- jQuery Repeater Container -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 text-right">
                                            <label class="control-label">
                                                &nbsp;
                                            </label>
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn btn-danger">
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
                                                <option value="BACHELOR">ปริญญาตรี - Bachelor Degree</option>
                                                <option value="MASTER" selected>ปริญญาโท - Master Degree</option>
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
                                            <input class="form-control" id="edu_year" name="edu_year" type="text">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">{{Lang::get('resource.lbGPAX')}}
                                            </label>
                                            <input class="form-control" id="edu_gpax" name="edu_gpax" type="text">
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 text-right">
                                                <label class="control-label">
                                                    &nbsp;
                                                </label>
                                                <a href="javascript:;" data-repeater-delete=""
                                                   class="btn btn-danger">
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
                                                       type="text" value="{{$appEdu->edu_year}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">{{Lang::get('resource.lbGPAX')}}
                                                </label>
                                                <input class="form-control" id="edu_gpax" name="edu_gpax"
                                                       type="text" value="{{$appEdu->edu_gpax}}">
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
                                <button type="button" id="saveEdu" class="btn green">{{Lang::get('resource.lbSave')}}</button>
                                <button type="reset" id="clearEdu" class="btn default">{{Lang::get('resource.lbCancel')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </form>
    </div>
</div>
