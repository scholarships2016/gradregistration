<div class="portlet box red-pink">
    <div class="portlet-title">
        <div class="caption">
            {{--<i class="fa fa-user"></i>--}}
            ประวัติการศึกษา
            <small>Educational Background</small>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="javascript:;" class="reload"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <form id="eduBackForm" name="eduBackForm" action="#" class="mt-repeater form-horizontal">
            {{csrf_field()}}
            <div class="form-body">
                <div class="mt-repeater">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="javascript:;" data-repeater-create
                               class="btn btn-success mt-repeater-add">
                                <i class="fa fa-plus"></i> เพิ่ม</a>
                        </div>
                    </div>
                    <hr>
                    <div data-repeater-list="eduback-group">
                        @if(empty($applicantEduList))
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
                                                <i class="fa fa-close">ลบ</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="control-label">ระดับการศึกษา
                                                &nbsp;<small>Level</small>
                                            </label>
                                            <input type="hidden" id="grad_level_hidden_0" name="grad_level_hidden"
                                                   value="">
                                            <select id="grad_level" name="grad_level" class="form-control select2">
                                                <option value="BACHELOR">ปริญญาตรี - Bachelor Degree</option>
                                                <option value="MASTER">ปริญญาโท - Master Degree</option>
                                                <option value="DOCTOR">ปริญญาเอก - Doctor Degree</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">
                                                สถานะ&nbsp;<small>Status</small>
                                            </label>
                                            <input type="hidden" id="edu_pass_id_hidden_0" name="edu_pass_id_hidden"
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
                                            <label class="control-label">มหาวิทยาลัย/สถาบันอุดมศึกษา
                                                &nbsp;<small>Institution</small>
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
                                            <label class="control-label">คณะ
                                                &nbsp;<small>Faculty</small>
                                            </label>
                                            <input class="form-control" id="edu_faculty" name="edu_faculty" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <label class="control-label">ปีที่สำเร็จ
                                                &nbsp;<small>Year Graduated</small>
                                            </label>
                                            <input class="form-control" id="edu_year" name="edu_year" type="text">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">แต้มเฉลี่ย
                                                &nbsp;<small>GPAX</small>
                                            </label>
                                            <input class="form-control" id="edu_gpax" name="edu_gpax" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="control-label">สาขาวิชาเอก
                                                &nbsp;<small>Major Subjects</small>
                                            </label>
                                            <input class="form-control" id="edu_major" name="edu_major" type="text">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">ประกาศนียบัตร/ปริญญาบัตร
                                                &nbsp;<small>Title of Degree</small>
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
                                                    <i class="fa fa-close">ลบ</i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <label class="control-label">ระดับการศึกษา
                                                    &nbsp;<small>Level</small>
                                                </label>
                                                <input type="hidden" id="grad_level_hidden{{$index}}" name="grad_level_hidden"
                                                       value="">
                                                <select id="grad_level{{$index}}" name="grad_level" class="form-control select2">
                                                    <option value="BACHELOR">ปริญญาตรี - Bachelor Degree</option>
                                                    <option value="MASTER">ปริญญาโท - Master Degree</option>
                                                    <option value="DOCTOR">ปริญญาเอก - Doctor Degree</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">
                                                    สถานะ&nbsp;<small>Status</small>
                                                </label>
                                                <input type="hidden" id="edu_pass_id_hidden{{$index}}" name="edu_pass_id_hidden"
                                                       value="">
                                                <select id="edu_pass_id{{$index}}" name="edu_pass_id"
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
                                                <label class="control-label">มหาวิทยาลัย/สถาบันอุดมศึกษา
                                                    &nbsp;<small>Institution</small>
                                                </label>
                                                <input type="hidden" id="university_id_hidden{{'_'.$index}}"
                                                       name="university_id_hidden">
                                                <select name="university_id" id="university_id{{'_'.$index}}"
                                                        class="form-control select2">
                                                    @if(!empty($uniList))
                                                        @foreach ($uniList as $uni)
                                                            <option value="{{$uni->university_id}}">{{$uni->university_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">คณะ
                                                    &nbsp;<small>Faculty</small>
                                                </label>
                                                <input class="form-control" id="edu_faculty{{'_'.$index}}" name="edu_faculty"
                                                       type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="col-md-6">
                                                <label class="control-label">ปีที่สำเร็จ
                                                    &nbsp;<small>Year Graduated</small>
                                                </label>
                                                <input class="form-control" id="edu_year{{'_'.$index}}" name="edu_year" type="text">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">แต้มเฉลี่ย
                                                    &nbsp;<small>GPAX</small>
                                                </label>
                                                <input class="form-control" id="edu_gpax{{'_'.$index}}" name="edu_gpax" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <label class="control-label">สาขาวิชาเอก
                                                    &nbsp;<small>Major Subjects</small>
                                                </label>
                                                <input class="form-control" id="edu_major{{'_'.$index}}" name="edu_major" type="text">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">ประกาศนียบัตร/ปริญญาบัตร
                                                    &nbsp;<small>Title of Degree</small>
                                                </label>
                                                <input class="form-control" id="edu_degree{{'_'.$index}}" name="edu_degree"
                                                       type="text">
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
                                <button type="button" id="saveEdu" class="btn green">บันทึก</button>
                                <button type="reset" id="clearEdu" class="btn default">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </form>
    </div>
</div>
