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
            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$applicant->applicant_id}}">
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
                                               class="btn btn-danger">
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
                                            <label class="control-label">สถานะการทำงาน</label>
                                            <br>
                                            <label class="mt-checkbox">
                                                <input id="app_work_status" type="checkbox" name="app_work_status"
                                                       value="1"
                                                       onclick="chkToOpen(this)"> ปัจจุบัน/ล่าสุด
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
                                                   class="btn btn-danger">
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
                                                <label class="control-label">สถานะการทำงาน</label>
                                                <br>
                                                <label class="mt-checkbox">
                                                    <input id="app_work_status" type="checkbox" name="app_work_status"
                                                           value="1" onclick="chkToOpen(this)"
                                                           @if($workExp->app_work_status == 1) checked @endif
                                                    > ปัจจุบัน/ล่าสุด
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
</div>
