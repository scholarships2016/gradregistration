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
                <a href="#">ความพึงพอใจในการใช้งานระบบ</a>
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
                            รายงานความพึงพอใจในการใช้งานระบบ

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
                            </div>
                            <p></p>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" id="reportBt" class="btn green"><i
                                                class="fa fa-file-text-o"></i> ออกรายงาน
                                    </button>
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

                    <div class="table-container">
                        <br clear="all">
                        <div id="chartHolder">
                        </div>
                        <div class="portlet box pink-chula">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart"></i>ความคิดเห็น
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
                                            <th> ความคิดเห็น</th>
                                            <th> ผู้ให้ความคิดเห็น</th>
                                            <th> วัน-เวลา</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="4" style="text-align: center">-</td>
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
<script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
{{--<script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>--}}
<script src="{{asset('assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
{{--<script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>--}}
<script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
{{--<script src="../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>--}}
{{--<script src="../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>--}}
{{--<script src="../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>--}}


<script src="{{asset('js/Util.js')}}" type="text/javascript"></script>
<script type="application/javascript">

    var chart = null;
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

    }

    function setResult(obj) {

        $("#resultTbl tbody").empty();
        $("#resultTbl tbody").append(obj.tbody);
    }

    function setChart(obj) {

        var data = [];
        if (!obj.hasOwnProperty('chartData') || isUndefinedOrNull(obj.chartData) || obj.chartData.length == 0) {
            return;
        }

        $("#chartHolder").append('<div id="satChart" class="chart" style="height:500px"> </div>');

        $.each(obj.chartData, function (index, value) {
            data.push({"sat_desc": value.sat_desc, "amt": value.amt});
        });

        chart = AmCharts.makeChart("satChart", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": data,
            "valueField": "amt",
            "titleField": "sat_desc"
        });

        $('#satChart').closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });
    }

    function exportToFile(e) {
        var url = '{{route('admin.report.doReport13Excel')}}?';
        url += $("#searchForm").serialize() + '&fileType=' + e.value;
        location.href = url;
    }

    $(document).ready(function () {
        initForm();
        $("#reportBt").on('click', function () {
            var inputs = $("#searchForm").serializeArray();
            $.ajax({
                url: '{{route('admin.report.doReport13')}}',
                method: "get",
                data: inputs,
                success: function (result) {
                    if (!isUndefinedOrNull(chart)) {
                        chart.clear();
                        $("#chartHolder").empty();
                    }
                    setResult(result.data);
                    setChart(result.data);
                }
            });
        });

    });

</script>
@endpush
