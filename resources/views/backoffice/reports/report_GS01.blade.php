@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css">
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<style type="text/css">
</style>
@endpush

@section('pagebar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Management</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">รายงาน</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">รายงาน รายชื่อผู้สมัครเข้าศึกษา (GS01)</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
    </h1>
@stop

@section('maincontent')
    <div class="row">
        <div class="col-md-12">

            <!-- Begin: Demo Datatable 1 -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart"></i>
                        <span class="caption-subject font-dark sbold uppercase">
                            รายงาน รายชื่อผู้สมัครเข้าศึกษา (GS01)
                        </span>
                    </div>
                    <div class="actions">
                        <div class="btn-group pull-right">
                            <button class="btn blue-steel  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:window.print();">
                                        <i class="fa fa-print"></i> Print </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-text-o"></i> Export to Text </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="portlet-body">
                    <form id="searchForm">

                        <div class="m-heading-1 border-green m-bordered">
                            {{csrf_field()}}
                            <h3>
                                กำหนดเงื่อนไขการแสดงรายงาน
                            </h3>
                            <p>
                            </p>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>ภาคการศึกษา</label>
                                        <select id="semester" name="semester"
                                                class="form-control select2">
                                            <option value="1"
                                                    @if(!empty($param) && !empty($param['semester']) &&
                                                                     $param['semester'] == "1")
                                                    selected
                                                    @endif
                                            >ภาคต้น
                                            </option>
                                            <option value="2"
                                                    @if(!empty($param) && !empty($param['semester']) &&
                                                                             $param['semester'] == "2")
                                                    selected
                                                    @endif
                                            >ภาคปลาย
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>ปีการศึกษา</label>
                                        <select id="academic_year" name="academic_year"
                                                class="form-control select2">
                                            @if(!empty($acaYears))
                                                @foreach($acaYears as $acaYear)
                                                    <option value="{{$acaYear->academic_year}}"
                                                            @if(!empty($param) && !empty($param['academic_year']) &&
                                                             $param['academic_year'] == $acaYear->academic_year)
                                                            selected
                                                            @endif
                                                    >
                                                        {{$acaYear->academic_year}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>รอบที่</label>
                                        <select id="round" name="round"
                                                class="form-control select2">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <!-- /input-group -->
                                        <input type="hidden" id="round_hide" name="round_hide"
                                               value="@if(!empty($param) && !empty($param['round'])){{$param['round']}}@endif"/>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>คณะ</label>
                                        <select id="faculty_id" name="faculty_id" class="form-control select2">
                                            @if(!empty($facs))
                                                @foreach($facs as $fac)
                                                    <option value="{{$fac->faculty_id}}">{{$fac->faculty_full}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" id="faculty_id_hide" name="faculty_id_hide"
                                               value="@if(!empty($param) && !empty($param['faculty_id'])){{$param['faculty_id']}}@endif"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>รหัสหลักสูตร</label>
                                        <input type="text" class="form-control input" name="program_id" placeholder=""
                                               value="@if(!empty($param) && !empty($param['program_id'])){{$param['program_id']}}@endif">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>รหัสแขนง(ถ้ามี)</label>
                                        <input type="text" class="form-control input" name="sub_major_id" placeholder=""
                                               value="@if(!empty($param) && !empty($param['sub_major_id'])){{$param['sub_major_id']}}@endif">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ประเภทหลักสูตร</label>
                                        <select id="program_type_id" name="program_type_id"
                                                class="form-control select2">
                                            @if(!empty($progs))
                                                @foreach($progs as $prog)
                                                    <option value="{{$prog->program_type_id}}">{{$prog->prog_type_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" id="program_type_id_hide" name="program_type_id_hide"
                                               value="@if(!empty($param) && !empty($param['program_type_id'])){{$param['program_type_id']}}@endif"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>วันที่ชำระเงิน ตั้งแต่วันที่ ถึง วันที่</label>
                                        <div class="input-group input-large date-picker input-daterange"
                                             data-date="10/11/2012" data-date-format="dd-mm-yyyy">
                                            <input type="text" class="form-control" id="from_date" name="from_date">
                                            <span class="input-group-addon"> ถึง </span>
                                            <input type="text" class="form-control" id="to_date" name="to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" id="reportBt" class="btn green"><i
                                                class="fa fa-file-text-o"></i> ออกรายงาน
                                    </button>
                                    <button type="button" id="excelBt" value="xls" onclick="exportToFile(this)" class="btn green">
                                        <i class="fa fa-file-excel-o"></i> Export เป็นไฟล์ Excel
                                    </button>
                                    <button type="button" id="txtBt" value="txt" onclick="exportToFile(this)" class="btn green">
                                        <i class="fa fa-file-text-o"></i> Export เป็นไฟล์ Text
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-container">
                        <br clear="all">
                        <div class="portlet box pink-chula">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart"></i>รายชื่อผู้สมัครเข้าศึกษา (GS01)
                                </div>
                                <div class="tools">
                                    <a class="fullscreen font-red-pink" href="javascript:;" data-original-title=""
                                       title="">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="resultTbl" class="table table-hover table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> ปีการศึกษาที่เข้า</th>
                                            <th> เลขที่ ปชช</th>
                                            <th> ชื่อ ไทย/อังกฤษ</th>
                                            <th> นามสกุล ไทย/อังกฤษ</th>
                                            <th> เพศ</th>
                                            <th> สัญชาติ</th>
                                            <th> คะแนนภาษาอังกฤษ</th>
                                            <th> ประเภท ENG</th>
                                            <th> มหาวิทยาลัยที่จบ</th>
                                            <th> สถานะการทำงาน</th>
                                            <th> รหัสหลักสูตรที่สมัคร</th>
                                            <th> สถานะผู้สมัคร</th>
                                            <th> สถานะ</th>
                                            <th> ชื่อสาขาที่สมัคร</th>
                                            <th> คณะ</th>
                                            <th> ประเภทหลักสูตรที่สมัคร</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="17" style="text-align: center">-</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var select2Option = {
        placeholder: '--เลือก--',
        allowClear: true,
        width: '100%'
    };

    function initForm() {
        $('select').select2(select2Option);
        $('#round').val($('#round_hide').val()).change();
        $('#faculty_id').val($('#faculty_id_hide').val()).change();
        $('#program_type_id').val($('#program_type_id_hide').val()).change();

        $(".date-picker input[type='text']").inputmask("d-m-y");
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true,
            clearBtn: true
        });
    }

    function setResult(obj) {

        $("#resultTbl tbody").empty();
        $("#resultTbl tbody").append(obj.tbody);
        $("#resultTbl tfoot").empty();
        $("#resultTbl tfoot").append(obj.tfoot);
    }

    function exportToFile(e){
        var url = '{{route('admin.report.doReport02Excel')}}?';
        url += $("#searchForm").serialize()+'&fileType='+e.value;
        location.href = url;
    }

    $(document).ready(function () {
        initForm();
        $("#reportBt").on('click', function () {
            var inputs = $("#searchForm").serializeArray();
            $.ajax({
                url: '{{route('admin.report.doReport02')}}',
                method: "get",
                data: inputs,
                success: function (result) {
                    setResult(result.data)
                }
            });
        });

    });

</script>
@endpush
