@extends('layouts.default')

@push('pageCss')
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
        <p class="text-center">เลขที่บัตรประจำตัวประชาชน Citizen ID or Passport ID <b>994949</b><br>
            หมายเลขโทรศัพท์ที่สามารถติดต่อได้ Contact No <b>23423423</b>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                    <form action="#" class="form-horizontal">
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
                                            <select class="form-control">
                                                <option value="">Male</option>
                                                <option value="">Female</option>
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
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                            <select class="form-control">
                                                <option value="">Male</option>
                                                <option value="">Female</option>
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
                                            <select class="form-control">
                                                <option value="">Male</option>
                                                <option value="">Female</option>
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
                                            <select class="form-control">
                                                <option value="">Male</option>
                                                <option value="">Female</option>
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
                                            <select class="form-control">
                                                <option value="">Male</option>
                                                <option value="">Female</option>
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
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                                <label class="mt-radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios25"
                                                           value="option1" checked=""> สนใจ
                                                    <div>
                                                        <small>Interesting</small>
                                                    </div>
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios26"
                                                           value="option2" checked=""> ไม่สนใจ
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
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios25"
                                                           value="option1" checked=""> สนใจ
                                                    <div>
                                                        <small>Interesting</small>
                                                    </div>
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios26"
                                                           value="option2" checked=""> ไม่สนใจ
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
                    <!-- END FORM-->
                </div>
            </div>
            <div class="portlet box red-pink">
                <div class="portlet-title">
                    <div class="caption">
                        {{--<i class="fa fa-user"></i>--}}
                        ที่อยู่ที่สามารถติดต่อได้
                        <small>Present Address</small>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="reload"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">เลขที่/หมู่
                                            <div>
                                                <small>No/Moo</small>
                                            </div>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Chee Kin">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">หมู่บ้าน
                                            <div>
                                                <small>Village</small>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ตรอก/ซอย
                                            <div>
                                                <small>Soi</small>
                                            </div>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Chee Kin">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ถนน
                                            <div>
                                                <small>Road</small>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">จังหวัด
                                            <div>
                                                <small>Province</small>
                                            </div>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Chee Kin">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">อำเภอ
                                            <div>
                                                <small>District</small>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ตำบล
                                            <div>
                                                <small>Subdistrict</small>
                                            </div>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Chee Kin">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">รหัสไปรษณีย์
                                            <div>
                                                <small>Zipcode</small>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">โทรศัพท์อื่นๆ ที่สามารถติดต่อได้
                                            <div>
                                                <small>Other Contact No.</small>
                                            </div>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Chee Kin">
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
                                            <button type="submit" class="btn green">บันทึก</button>
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
            <div class="portlet box red-pink">
                <div class="portlet-title">
                    <div class="caption">
                        {{--<i class="fa fa-user"></i>--}}
                        การทดสอบความรู้ความสามารถ
                        <small>Knowledge Skill</small>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="reload"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="#" class="form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ภาษาอังกฤษ
                                            <div>
                                                <small>English</small>
                                            </div>
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control input-small">
                                                <option value="">Male</option>
                                                <option value="">Female</option>
                                            </select> <span class="help-block">(ตัวอย่างการเทียบคะแนน Example)</span>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-6">
                                                        <label class="control-label">คะแนน
                                                            <div>
                                                                <small>Score</small>
                                                            </div>
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label">เมื่อวันที่
                                                            <div>
                                                                <small>Date Taken</small>
                                                            </div>
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ภาษาไทย
                                            <div>
                                                <small>Thai</small>
                                            </div>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Chee Kin">
                                            <span class="help-block">คะแนน&nbsp;<small>Score</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ความถนัดทางธุรกิจ (CU-BEST)
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Chee Kin">
                                            <span class="help-block">คะแนน&nbsp;<small>Score</small></span>
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
                    <form action="#" class="mt-repeater form-horizontal">
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
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label class="control-label">วุฒิการศึกษา
                                                        &nbsp;<small>Degree</small>
                                                    </label>
                                                    <select name="select-input" class="form-control">
                                                        <option value="A" selected>Marketing</option>
                                                        <option value="B">Creative</option>
                                                        <option value="C">Development</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">
                                                        สถานะ&nbsp;<small>Status</small>
                                                    </label>
                                                    <select name="select-input" class="form-control input-small">
                                                        <option value="A" selected>Marketing</option>
                                                        <option value="B">Creative</option>
                                                        <option value="C">Development</option>
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
                                                    <select name="select-input" class="form-control">
                                                        <option value="A" selected>Marketing</option>
                                                        <option value="B">Creative</option>
                                                        <option value="C">Development</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">อื่นๆ
                                                        &nbsp;<small>Other</small>
                                                    </label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label class="control-label">คณะ
                                                        &nbsp;<small>Faculty</small>
                                                    </label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">ปีที่สำเร็จ
                                                        &nbsp;<small>Year Graduated</small>
                                                    </label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label class="control-label">แต้มเฉลี่ย
                                                        &nbsp;<small>GPAX</small>
                                                    </label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">สาขาวิชาเอก
                                                        &nbsp;<small>Major Subjects</small>
                                                    </label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label class="control-label">ประกาศนียบัตร/ปริญญาบัตร
                                                        &nbsp;<small>Title of Degree</small>
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
                    <form action="#" class="mt-repeater form-horizontal">
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
                                                    <select name="select-input" class="form-control">
                                                        <option value="A" selected>กกก</option>
                                                        <option value="B">กก</option>
                                                        <option value="C">กก</option>
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
                                                    <select name="select-input" class="form-control">
                                                        <option value="A" selected>กกก</option>
                                                        <option value="B">กก</option>
                                                        <option value="C">กก</option>
                                                    </select>
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
        </div>
    </div>
@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
<script type="application/javascript">
</script>
@endpush