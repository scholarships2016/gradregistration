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
                <a href="#">ข้อมูลส่ง สทป.</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title">
        ข้อมูลส่ง สำนักทะเบียนและประมวลผล
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
                            ส่งออกข้อมูลสำหรับ สำนักทะเบียนและประมวลผล
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ภาควิชา</label>
                                        <select id="department_id" name="department_id" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>สาขาวิชา</label>
                                        <select id="major_id" name="major_id" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>รหัสหลักสูตร</label>
                                        <input type="text" class="form-control input" name="program_id" placeholder=""
                                               value="@if(!empty($param) && !empty($param['program_id'])){{$param['program_id']}}@endif">
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ประเภทรายงาน</label>
                                        <div class="mt-radio-inline">
                                            <label class="mt-radio">
                                                <input type="radio" name="rpt_type" id="rpt_type1" value="1"
                                                       checked=""> สทป. 1
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="rpt_type" id="rpt_type2" value="2">
                                                สทป.
                                                2
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="rpt_type" id="rpt_type3" value="3">
                                                นโยบายและแผน
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" id="excelBt" value="xls" onclick="exportToFile(this)"
                                            class="btn green">
                                        <i class="fa fa-file-excel-o"></i> Export เป็นไฟล์ Excel
                                    </button>
                                    <button type="button" id="txtBt" value="txt" onclick="exportToFile(this)"
                                            class="btn green">
                                        <i class="fa fa-file-text-o"></i> Export เป็นไฟล์ Text
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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


        var csLoadDep = new Select2Cascade($('#faculty_id'), $('#department_id'), "{{route('masterdata.getDepartmentByFacultyId')}}?faculty_id=:parentId:", select2Option);
        csLoadDep.then(function (parent, child, items) {
            if (items.length != 0) {
                if (firstLoadDep) {
                    child.val($('#department_id_hidden').val()).change();
                } else {
                    child.select2('open');
                }
            }
        });

        var csLoadMajor = new Select2Cascade($('#department_id'), $('#major_id'), "{{route('masterdata.getMajorByDepartmentIdForDropdown')}}?department_id=:parentId:", select2Option);
        csLoadMajor.then(function (parent, child, items) {
            if (items.length != 0) {
                if (firstLoadMajor) {
                    child.val($('#major_id_hidden').val()).change();
                } else {
                    child.select2('open');
                }
            }
        });

        $('#faculty_id').select2(select2Option).on('change', function () {
            $('#department_id').empty();
            $('#major_id').empty();
        });

    }

    function exportToFile(e) {
        var url = '{{route('admin.report.doReport14Excel')}}?';
        url += $("#searchForm").serialize() + '&fileType=' + e.value;
        location.href = url;
    }

    $(document).ready(function () {
        initForm();
    });

</script>
@endpush
