<div class="portlet box red-pink">
    <div class="portlet-title">
        <div class="caption">
            {{--<i class="fa fa-user"></i>--}}
            ประสบการณ์การทำงาน
            <small>Work Experience</small>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="javascript:;" class="reload"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <form id="workExpForm" name="workExpForm" action="#" class="mt-repeater form-horizontal">
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
                    <div data-repeater-list="workexp-group">
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
                                        <label class="control-label">ประเภท
                                            &nbsp;<small>Work Status</small>
                                        </label>
                                        <select name="select-input" class="form-control select2">
                                            @if(!empty($workStatusList))
                                                @foreach ($workStatusList as $workStatus)
                                                    <option value="{{$workStatus->work_status_id}}">{{$workStatus->work_status_name.' - '.$workStatus->work_status_name_en}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">
                                            สถานที่ทำงาน&nbsp;<small>Work Place</small>
                                        </label>
                                        <input class="form-control" type="text">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="control-label">ตำแหน่ง/หน้าที่
                                            &nbsp;<small>Postion</small>
                                        </label>
                                        <input type="text" class="form-control"
                                               placeholder="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">
                                            ระยะเวลาในการทำงาน&nbsp;<small>Period&nbsp;of&nbsp;Time&nbsp;Working</small>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control"
                                                   placeholder="">
                                            <span class="input-group-addon">
                                                            <small>ปี Year</small>
                                                        </span>
                                            <input type="number" class="form-control"
                                                   placeholder="">
                                            <span class="input-group-addon">
                                                            <small>เดือน Month</small>
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="control-label">เงินเดือนที่ได้รับ
                                            &nbsp;<small>Salary</small>
                                        </label>
                                        <input class="form-control" type="text">
                                        <span class="help-block"><small>บาท Baht</small></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">
                                            โทรศัพท์&nbsp;<small>Contact No</small>
                                        </label>
                                        <input class="form-control" type="text">
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
                                <button type="submit" class="btn green">บันทึก</button>
                                <button type="reset" class="btn default">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </form>
    </div>
</div>
