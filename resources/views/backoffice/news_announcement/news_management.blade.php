@extends('layouts.default')

@push('pageCss')
  <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
 <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">

<style type="text/css">

</style>
@endpush

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="/">{{Lang::get('resource.lbMain')}}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
          <span>{{Lang::get('resource.lbNewsTitle')}}</span>
          <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{Lang::get('resource.lbSetting').Lang::get('resource.lbNewsTitle')}}</span>
        </li>
    </ul>
    {{--<div class="page-tool    bar">--}}
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
<h1 class="page-title">{{Lang::get('resource.lbSetting').' '.Lang::get('resource.lbNewsTitle')}}
</h1>
@stop


@section('maincontent')
 <div class="row">
 <div class="col-md-12">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">{{Lang::get('resource.lbNewsTitle')}}</span>
                  </div>
                  <div class="actions">

                    <div class="btn-group pull-right">
                      <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                  <i class="fa fa-angle-down"></i>
                                              </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a href="javascript:;">
                                                          <i class="fa fa-print"></i> Print </a>
                        </li>

                        <li>
                          <a href="javascript:;">
                                                          <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="portlet-body">
                                        <div class="table-toolbar">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group">

                                                        <a href="manage-news-form.html" class="btn btn-circle green btn-outline sbold uppercase">
      <i class="fa fa-plus"></i> เพิ่มข้อมูล
    </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                        </div>
                                        <div id="sample_1_wrapper" class="dataTables_wrapper no-footer"><div class="row"><div class="col-md-6 col-sm-6"><div class="dataTables_length" id="sample_1_length"><label>Show <select name="sample_1_length" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline"><option value="5">5</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select></label></div></div><div class="col-md-6 col-sm-6"><div id="sample_1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_1"></label></div></div></div><div class="table-scrollable">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="datatable_ajax" role="grid" aria-describedby="sample_1_info">
                                            <thead>
                                                <tr role="row">
                                                   <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" ลำดับ: activate to sort column descending" style="width: 36px;"> ลำดับ</th><th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" หัวข้อ: activate to sort column ascending" style="width: 399px;"> หัวข้อ</th><th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" แสดง? : activate to sort column ascending" style="width: 42px;"> แสดง? </th><th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" ปรับปรุงเมื่อ : activate to sort column ascending" style="width: 74px;"> ปรับปรุงเมื่อ </th><th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" ปรับปรุงโดย : activate to sort column ascending" style="width: 77px;"> ปรับปรุงโดย </th><th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Actions : activate to sort column ascending" style="width: 52px;"> Actions </th></tr>
                                            </thead>
                                             
                                        </table></div><div class="row"><div class="col-md-5 col-sm-5"><div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">Showing 1 to 1 of 1 records</div></div><div class="col-md-7 col-sm-7"><div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate"><ul class="pagination" style="visibility: visible;"><li class="prev disabled"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li><li class="prev disabled"><a href="#" title="Prev"><i class="fa fa-angle-left"></i></a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#" title="Next"><i class="fa fa-angle-right"></i></a></li><li class="next disabled"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li></ul></div></div></div></div>
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
<script src="{{asset('/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>

 <script type="application/javascript">
 
     
 var table="";
var TableDatatablesAjax = function () {
    var handle1 = function () {

        var grid = new Datatable();

    table=  grid.init({
            src: $("#datatable_ajax"),
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true,
                "fnStateSaveParams":    function ( oSettings, sValue ) {
                    $("#datatable_ajax tr.filter .form-control").each(function() {
                        sValue[$(this).attr('name')] = $(this).val();
                    });

                    return sValue;
                },

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 20, // default record count per page

                "ajax": {
                    "url": "{!! route('admin.getRegisterCourse') !!}",
                    "type":"GET",
                    "async": "false",
                    "data" : {
                                curr_act_id: ($('#single').val())? $('#single').val():'-1' ,
                                sub_major_id : $('option:selected','#single').attr('smj'),
                                program_id : $('option:selected','#single').attr('pg'),
                                program_type_id : $('option:selected','#single').attr('pt'),
                                flow : '3,4',
                               _token:     '{{ csrf_token()}}'
                                               }
                },


columnDefs: [
    {
targets: [0],


name: 'rownum',
render: function (data, type, full, meta) {
return  '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" value="1" /><span></span></label>';
} },{
targets: [1],
orderable: false,

name: 'rownum',
render: function (data, type, full, meta) {
return meta.settings._iDisplayStart + meta.row + 1;
} },{
targets: [2],
orderable: false,

name: 'app_id',
render: function (data, type, full, meta) {
return  full.app_ida   ;
} },{
targets: [3],
orderable: true,

name: 'stu_first_name_stu_last_name',
render: function (data, type, full, meta) {
return (  full.name_title+full.stu_first_name + ' '+full.stu_last_name+'<br>' + full.name_title_en+full.stu_first_name_en + ' ' + full.stu_last_name_en + ' ') ;
}},{
targets: [4],
orderable: true,
className: 'sorting_1',
name: 'program_id',
render: function (data, type, full, meta) {
return    '<a onclick="javascript:setID('+full.application_id+','+full.applicant_id+');"  class="examSel"   data-type="select" data-pk="'+ full.app_id +'" data-value="' + full.exam_status + '" data-source="/exam-results" data-original-title="เลือกผลการพิจารณา"> '+ full.exam_name +' </a>'+'<input type="hidden" value="'+full.application_id+'">'  ;
} }, {

targets: [5],
orderable: true,

name: 'apply',
render: function (data, type, full, meta) {
return ('<div class="btn-group"><button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions <i class="fa fa-angle-down"></i></button><ul class="dropdown-menu pull-left" role="menu"><li><a href="javascript:mailbyapp(\''+ full.application_id + '\');"><i class="fa fa-envelope-o"></i> ส่งเมล์แจ้งผล </a> </li></ul></div>') ;
} }],
                "bDestroy": true,
                "ordering": true,
                "order": [
                    [1, "asc"]
                ]
            }
        });


    }
 
    return {
     init: function () {
             handle1();
        }

    };

}();

jQuery(document).ready(function() {
      TableDatatablesAjax.init();
  });
     </script>
@endpush
