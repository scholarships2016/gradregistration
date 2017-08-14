@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
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
        เพิ่ม/แก้ไข การเปิดรับสมัคร
        <small></small>
    </h1>
@stop

@section('maincontent')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-speech font-green"></i>
                <span class="caption-subject bold uppercase">รายการการเปิดรับสมัคร</span>
            </div>
            <div class="actions">

                <a href="javascript:window.history.back();" class="btn btn-circle blue-steel btn-outline">
                    <i class="fa fa-mail-reply"></i> กลับหน้าหลัก </a>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <form id="applySettingForm" action="#" class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" id="isEdit" name="isEdit" value="{{$isEdit}}"/>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-5 control-label">ภาคการศึกษา</label>
                            <div class="col-md-7">
                                <input type="hidden" id="semesterHidden" name="semesterHidden" value="{{$semester}}"/>
                                <select id="semester" name="semester" class="form-control select2">
                                    <option value="1">ภาคต้น</option>
                                    <option value="2">ภาคปลาย</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-5 control-label">ปีการศึกษา</label>
                            <div class="col-md-7">
                                <input type="hidden" id="academicYearHidden" name="academicYearHidden"
                                       value="{{$academic_year}}"/>
                                <select id="academic_year" name="academic_year" class="form-control select2">
                                    @if(!empty($yearList))
                                        @foreach($yearList as $index => $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <div class="col-md-12 mt-repeater">
                            <h3 class="mt-repeater-title">รอบการเปิดรับสมัคร</h3>
                            <div data-repeater-list="apply_setting_group">
                                @if(empty($appSetList))
                                    <div data-repeater-item class="mt-repeater-item">
                                        <!-- jQuery Repeater Container -->
                                        <div class="mt-repeater-input">
                                            <label class="control-label">รอบที่</label>
                                            <br>
                                            <input type="hidden" id="apply_setting_id" name="apply_setting_id"
                                                   value=""/>
                                            <input class="form-control text-right" onblur="checkRoundNo(this)"
                                                   type="number"
                                                   id="round_no"
                                                   name="round_no" value="1">
                                        </div>
                                        <div class="mt-repeater-input">
                                            <label class="control-label">วันเปิดรับสมัคร</label>
                                            <br>
                                            <input class="form-control date-picker" type="text" id="start_date"
                                                   name="start_date">
                                        </div>
                                        <div class="mt-repeater-input">
                                            <label class="control-label">วันปิดรับสมัคร</label>
                                            <br>
                                            <input class="form-control date-picker" type="text" id="end_date"
                                                   name="end_date">
                                        </div>
                                        <div class="mt-repeater-input mt-radio-inline">
                                            <label class="control-label">สถานะ</label>
                                            <br>
                                            <label class="mt-radio">
                                                <input type="radio" name="is_active"
                                                       value="1"> Active
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="is_active"
                                                       value="0" checked> Inactive
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="mt-repeater-input mt-checkbox-inline">
                                            <label class="control-label">เปิดให้รับสมัครตอนนี้</label>
                                            <br>
                                            <label class="mt-checkbox">
                                                <input id="status" type="checkbox" name="status" value="1"
                                                       onclick="chkToOpen(this)"> Yes
                                                <span></span>
                                            </label>
                                        </div>

                                        <div class="mt-repeater-input">
                                            <a href="javascript:;" data-repeater-delete class="btn btn red"> ลบ
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    @foreach($appSetList as $index => $value)
                                        <div data-repeater-item class="mt-repeater-item">
                                            <div class="mt-repeater-input">
                                                <label class="control-label">รอบที่</label>
                                                <br>
                                                <input type="hidden" id="apply_setting_id" name="apply_setting_id"
                                                       value="{{$value->apply_setting_id}}"/>
                                                <input class="form-control text-right" onblur="checkRoundNo(this)"
                                                       type="number"
                                                       id="round_no"
                                                       name="round_no" value="{{$value->round_no}}" disabled>
                                            </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">วันเปิดรับสมัคร</label>
                                                <br>
                                                <input class="form-control date-picker" type="text" id="start_date"
                                                       name="start_date" value="{{$value->start_date}}">
                                            </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">วันปิดรับสมัคร</label>
                                                <br>
                                                <input class="form-control date-picker" type="text" id="end_date"
                                                       name="end_date" value="{{$value->end_date}}">
                                            </div>
                                            <div class="mt-repeater-input mt-radio-inline">
                                                <label class="control-label">สถานะ</label>
                                                <br>
                                                <label class="mt-radio">
                                                    <input type="radio" name="is_active"
                                                           value="1"
                                                           @if($value->is_active == 1) checked @endif
                                                    > Active
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="is_active"
                                                           value="0"
                                                           @if($value->is_active == 0) checked @endif
                                                    > Inactive
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="mt-repeater-input mt-checkbox-inline">
                                                <label class="control-label">เปิดให้รับสมัครตอนนี้</label>
                                                <br>
                                                <label class="mt-checkbox">
                                                    <input id="status" type="checkbox" value="1" name="status"
                                                           @if($value->status == 1) checked @endif
                                                           onclick="chkToOpen(this)"> Yes
                                                    <span></span>
                                                </label>
                                            </div>

                                            <div class="mt-repeater-input">
                                                <a href="javascript:;" data-repeater-delete class="btn btn red"> ลบ
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a href="javascript:;" data-repeater-create class="btn green  mt-repeater-add btn-outline">
                                <i class="fa fa-plus"></i> เพิ่มรอบ</a>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-8">
                                <button type="button" class="btn grey-steel">ยกเลิก</button>
                                <button type="button" onclick="saveForm()" class="btn green">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </form>
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
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var select2Option = {
        placeholder: '--เลือก--',
        allowClear: true,
        width: '100%'
    };


    function initFormRepeat() {

        $('.mt-repeater').each(function () {

            function showHideButton(event) {
                if ($('input[name*="round_no"]').length >= 3 && (event == 'show' || event == 'ready')) {
                    $(".mt-repeater-add").hide();
                } else {
                    $(".mt-repeater-add").show();
                }
            }

            $(this).repeater({
                show: function () {
                    $(this).slideDown();
                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        clearBtn: true,
                        format: 'dd/mm/yyyy'
                    });
                    $(".date-picker").inputmask("d/m/y");

                    var roundObj = $('input[name*="round_no"]').not($(this).find("#round_no"));
                    var no = getMaxRoundNo(roundObj);
                    $(this).find('#round_no').val(parseInt(no) + 1);
                    $(this).find('#round_no').removeAttr('disabled');

                    showHideButton('show');
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                    showHideButton('hide');

                },

                ready: function (setIndexes) {
                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        clearBtn: true,
                        format: 'dd/mm/yyyy'
                    });

                    $(".date-picker").inputmask("d/m/y");
                    showHideButton('ready');
                }

            });
        });
    }

    function initForm() {
        $('.select2').select2(select2Option);
        $('#semester').val($('#semesterHidden').val()).change();
        $('#academic_year').val($('#academicYearHidden').val()).change();
    }

    function checkRoundNo(obj) {
        var curRound = $(obj);
        var roundObj = $('input[name*="round_no"]').not(curRound);
        var isPass = true;
        var no = getMaxRoundNo(roundObj);

        $.each(roundObj, function (index, value) {
            if ($(value).val() === curRound.val() || parseInt(curRound.val()) <= 0) {
                isPass = false;
                return false;
            }
        });

        if (!isPass) {
            curRound.val(no + 1);
        }
    }

    function getMaxRoundNo(roundObj) {
        var no = 0;
        $.each(roundObj, function (index, value) {
            if (parseInt($(value).val()) > no) {
                no = parseInt($(value).val());
            }
        });
        return no;
    }

    function saveForm() {
        var formData = $("#applySettingForm").serializeArray();
        $.ajax({
            url: '{{route('admin.applysetting.doSave')}}',
            method: "post",
            data: formData,
            success: function (result) {
                var data = showToastFromAjaxResponse(result);
                if (data !== null) {

                    $("#semester").attr('disabled', 'disabled');
                    $("#academic_year").attr('disabled', 'disabled');
                    $("#semesterHidden").val($("#semester").val());
                    $("#academicYearHidden").val($("#academic_year").val());

                    // Update apply setting id
                    $.each($(".mt-repeater-item"), function (index, value) {
                        var roundNo = $(value).find("#round_no").val();
                        $(value).find("#round_no").attr('disabled', 'disabled');
                        $.each(data, function (idx, val) {
                            if (roundNo == val.round_no) {
                                $(value).find("#apply_setting_id").val(val.apply_setting_id);
                                return false;
                            }
                        });
                    });
                }
            }
        });
    }

    function disableForEditMode() {
        $("#semester").attr('disabled', 'disabled');
        $("#academic_year").attr('disabled', 'disabled');

    }

    function chkToOpen(obj) {
        var rptlist = $('.mt-repeater-item').not($(obj).closest('.mt-repeater-item'));
        $.each(rptlist, function (index, value) {
            $(value).find("#status").removeProp('checked')
        });
    }

    $(document).ready(function () {
        initForm();
        initFormRepeat();

        if ($("#isEdit").val()) {
            disableForEditMode();
        }
    });
</script>
@endpush