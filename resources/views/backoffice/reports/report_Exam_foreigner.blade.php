@extends('layouts.default') @push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
@endpush @section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="/">{{Lang::get('resource.lbMain')}}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>รายงาน</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>ผู้สมัครต่างชาติ</span>
        </li>
    </ul>
    {{--
  <div class="page-tool    bar">--}} {{--
    <div class="btn-group pull-right">--}} {{--
      <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" --}} {{--data-toggle="dropdown"> Actions--}}
    {{--<i class="fa fa-angle-down"></i>--}}
    {{--</button>--}} {{--
      <ul class="dropdown-menu pull-right" role="menu">--}} {{--
        <li>--}} {{--
          <a href="#">--}}
    {{--<i class="icon-bell"></i> Action</a>--}} {{--
        </li>--}} {{--
        <li>--}} {{--
          <a href="#">--}}
    {{--<i class="icon-shield"></i> Another action</a>--}} {{--
        </li>--}} {{--
        <li>--}} {{--
          <a href="#">--}}
    {{--<i class="icon-user"></i> Something else here</a>--}} {{--
        </li>--}} {{--
        <li class="divider"></li>--}} {{--
        <li>--}} {{--
          <a href="#">--}}
    {{--<i class="icon-bag"></i> Separated link</a>--}} {{--
        </li>--}} {{--
      </ul>--}} {{--
    </div>--}} {{--
  </div>--}}
</div>
@stop @section('pagetitle')
<h1 class="page-title">ผู้สมัครต่างชาติ

</h1> @stop @section('maincontent')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-body">

                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="m-heading-1 border-green m-bordered">
                                <h3>  กำหนดเงื่อนไขการแสดงรายงาน</h3>
                                <p>
                                </p>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ภาคการศึกษา</label>
                                            <select id="semester" name="semester" class="form-control input-small">

                                                <option value="1">ภาคต้น</option>
                                                <option value="2">ภาคปลาย</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ปีการศึกษา</label>
                                            <select id="year" name="year" class="form-control input-small">

                                                @for ($i = date('Y'); $i >= date('Y')-10; $i--)
                                                <option value="{{ $i+543 }}"  >{{ $i+543 }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>รอบที่</label>
                                            <select id="roundNo" name="roundNo" class="form-control input-small">
                                                <option value="null">--เลือก--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>คณะ</label>
                                            <select id="faculty_id" name="faculty_id" class="form-control input">
                                                <option value="">--เลือก--</option>
                                                @foreach($facs as $fac)
                                                <option value="{{$fac->faculty_id}}">{{$fac->faculty_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>รหัสหลักสูตร</label>
                                            <input type="text" id="major_id" name="major_id" class="form-control input" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>รหัสแขนง(ถ้ามี)</label>
                                            <input type="text" id="sub_major_id" name="sub_major_id" class="form-control input" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>ประเภทหลักสูตร</label>
                                            <select id="program_type_id" name="program_type_id" class="form-control input">
                                                <option value="null">--เลือก--</option>
                                                @foreach($progTypes as $val)
                                                <option value="{{$val->program_type_id}}">{{$val->prog_type_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <a id="search_Select" href="javascript:;" class="btn green"><i class="fa fa-file-text-o"></i> ดูรายงาน </a>
                                            <a id="btnxls"  target="_blank" href="javascript:callprint('EXCEL');"  class="btn green"><i class="fa fa-file-excel-o"></i>EXCEL</a>
                                            <a id="btntxt"  target="_blank" href="javascript:callprint('TEXT');"  class="btn green"><i class="fa fa-file-text-o"></i>TEXT</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div id="search-application-result" style="display:none;">
                    <h3><span class="badge badge-warning">3</span> รายละเอียดข้อมูล</h3>

                    <hr>
                    <div id="datatable_ajax_wrapper" class="dataTables_wrapper no-footer">

                        <div>

                            <input type="hidden" id="idsave"> <input type="hidden" value="1" id="applicantid">
                            <div class="portlet box pink-chula">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart"></i>ผู้สมัครต่างชาติ </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                        <a class="fullscreen font-red-pink" href="javascript:;" data-original-title="" title=""> </a>

                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table id="datatable_ajax" class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th> # </th>
                                                    <th> เลขประจำตัวประชาชน </th>
                                                    <th> ชื่อ-สกุล </th>
                                                    <th> สัญชาติ </th>
                                                    <th> รหัสหลักสูตร </th>
                                                    <th> ชื่อหลักสูตร </th>
                                                    <th> ประเภทหลักสูตร </th>
                                                    <th> สาขาวิชา </th>
                                                    <th> ภาควิชา </th>
                                                    <th> คณะ </th>
                                                    <th> สถานะ </th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

</div>
@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/table-datatables-ajax.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.mockjax.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/components-select2-gs03-gs05.js')}}" type="text/javascript"></script>

<script type="application/javascript">


        function callprint(print){
        var faculty =   ( $('option:selected','#faculty_id').val()=="")?'null':$('option:selected','#faculty_id').val();
       var sub_major_id = ($('#sub_major_id').val() =="")?'null':$('#sub_major_id').val();
       var  major_id = ($('#major_id').val() =="")?'null':$('#major_id').val();
      window.open(("{{ url('admin/printForeignerReport')}}" +'/'+ $('option:selected','#year').val()+'/'+ $('option:selected','#semester').val()+'/'+ $('option:selected','#roundNo').val()+'/'+ faculty+'/'+ '1,2,3,4,5'+'/'+  sub_major_id +'/'+ $('option:selected','#program_type_id').val()+'/'+ major_id +'/'+ print  ),'_blank');

    }

jQuery(document).ready(function() {
  //clear serach result
  $('#semester,#year,#roundNo').on('change', function() {
    $('#search-program-result').fadeOut( "slow", "linear" );
    $('#search-application-result').fadeOut( "slow", "linear" );
  });

});


    $('#search_Select').click(function(){
         $('#lbSem').text($('option:selected','#semester').text());
        $('#lbYear').text($('#year').val());
           TableDatatablesAjax.init();
         $('#search-application-result').fadeIn( "slow", "linear" );

       });






var table="";
var TableDatatablesAjax = function () {
    var handle1 = function () {
        var grid = new Datatable();

    table=  grid.init({
            src: $("#datatable_ajax"),
             dataTable: {
                "bStateSave": false,
                "pageLength": 1000,

                "ajax": {
                    "url": "{!! route('admin.getforeignerReport') !!}",
                    "type":"GET",
                    "async": "false",
                    "data" : {
                                year:$('option:selected','#year').val(),
                                semester:$('option:selected','#semester').val(),
                                roundNo:$('option:selected','#roundNo').val(),
                                sub_major_id : $('#sub_major_id').val(),
                                faculty_id : $('option:selected','#faculty_id').val(),
                                program_type_id : $('option:selected','#program_type_id').val(),
                                major_id :$('#major_id').val() ,
                                flow : '1,2,3,4,5',
                               _token:     '{{ csrf_token()}}'
                                               }
                },


columnDefs: [
    {
targets: [0],
render: function (data, type, full, meta) {
return meta.settings._iDisplayStart + meta.row + 1;
} },{
targets: [1],
render: function (data, type, full, meta) {
return    full.stu_citizen_card ;
}},{
targets: [2],
render: function (data, type, full, meta) {
return  (  full.name_title+full.stu_first_name + ' '+full.stu_last_name+'<br>' + full.name_title_en+full.stu_first_name_en + ' ' + full.stu_last_name_en + ' ')    ;
} },{
targets: [3],
render: function (data, type, full, meta) {
return    full.nation_name+'  '+full.nation_name_en  ;
} },{
targets: [4],
render: function (data, type, full, meta) {
return    full.majorcode   ;
} },{
targets: [5],
render: function (data, type, full, meta) {
return     full.prog_name   ;
} },{
targets: [6],
render: function (data, type, full, meta) {
return    full.cond_id+'  '+full.degree_level_name+' '+full.office_time  ;
} },{
targets: [7],
render: function (data, type, full, meta) {
return    full.major_name  ;
} } ,{
targets: [8],
render: function (data, type, full, meta) {
return    full.department_name  ;
} } ,{
targets: [9],
render: function (data, type, full, meta) {
return    full.faculty_name  ;
} } ,{
targets: [10],
render: function (data, type, full, meta) {
return    full.flow_name  ;
} }   ],
                "bDestroy": true,
                "responsive": false,
              "paging":   false,
        "ordering": false,
        "info":     false
            },

        });
    }

    return {
     init: function () {
             handle1();
        }

    };

}();

</script>
@endpush
