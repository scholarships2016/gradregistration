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
            <span>รายงานแหล่งข่าว</span>
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
<h1 class="page-title">รายงานแหล่งข่าว

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




                                </div>
                                <hr>


                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <a id="search_Select" href="javascript:;" class="btn green"><i class="fa fa-file-text-o"></i> ดูรายงาน </a>
                                            <a id="btnxls"  target="_blank" href="javascript:callprint('EXCEL');"  class="btn green"><i class="fa fa-file-excel-o"></i>Export เป็นไฟล์ EXCEL</a>
                                            <a id="btntxt"  target="_blank" href="javascript:callprint('TEXT');"  class="btn green"><i class="fa fa-file-text-o"></i>Export เป็นไฟล์ TEXT</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div id="search-application-result" style="display:none;">

                    <div id="datatable_ajax_wrapper" class="dataTables_wrapper no-footer">

                        <div>

                            <input type="hidden" id="idsave"> <input type="hidden" value="1" id="applicantid">
                            <div class="portlet box pink-chula">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart"></i>รายงานแหล่งข่าว </div>
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
                                <th> ชื่อแหล่งข่าว </th>
                                <th> จำนวน </th>

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
      window.open(("{{ url('admin/printDataNewsSourceSumApplicant')}}" +'/'+ $('option:selected','#year').val()+'/'+ $('option:selected','#semester').val() +'/'+ print  ),'_blank');

    }



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
                    "url": "{!! route('admin.getDataNewsSourceSumApplicant') !!}",
                    "type":"GET",
                    "async": "false",
                    "data" : {
                                year:$('option:selected','#year').val(),
                                semester:$('option:selected','#semester').val(),
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
return    full.news_source_name ;
}},{

targets: [2],
render: function (data, type, full, meta) {
return    full.cnum   ;
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
