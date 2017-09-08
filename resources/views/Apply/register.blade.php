@extends('layouts.default') @push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('/assets/pages/css/search.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
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
      <span>{{Lang::get('resource.lbSearchPageTopic')}}</span>
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
<h1 class="page-title"><i class="fa fa-search"></i> {{Lang::get('resource.lbSearchPageTopic')}}
    </h1> @stop @section('maincontent')
<div class="search-page search-content-4">
  <!--START SERACH BOX-->
  <div class="search-bar bordered">
    <div id="filterSearch" style="display: none;" class="search-filter ">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label class="control-label col-md-3">{{ Lang::get('resource.lbSearchFaculty')}}</label>
            <div class="col-md-9">
              <select id="faculty_id" class="form-control input-lg">
                              <option value="" selected="">--Select--</option>
                              @foreach ($facultys as $faculty)
                              <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                              @endforeach
                          </select>
              <span class="help-block"> </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label class="control-label col-md-3">{{ Lang::get('resource.lbSearchProgramType')}}</label>
            <div class="col-md-9">
              <select id="degree_id" class="form-control input-lg">
                         <option value="" selected="" >--Select--</option>
                         @foreach ($typeofRecs as $typeofRec)
                         <option value="{{$typeofRec-> program_type_id}}">{{$typeofRec->prog_type_name}}</option>
                         @endforeach

                         </select>
              <span class="help-block">  </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label class="control-label col-md-3">{{ Lang::get('resource.lbSearchProgramId')}}</label>
            <div class="col-md-9">
              <input type="text" class="form-control spinner" id="program_id" size="4" maxlength="4" value="">
              <span class="help-block"> Input 4 digits of program ID </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="input-group">
          <input type="text" class="form-control" id="search" placeholder="{{Lang::get('resource.lbSearchPlaceHolder')}}">
          <span class="input-group-btn">
                        <button class="btn green-soft uppercase bold" id="btSearch"   >{{Lang::get('resource.lbSearch')}} <i class="fa fa-search"></i></button>
                    </span>
        </div>
      </div>
      <div class="col-md-4 extra-buttons">
        <button class="btn grey-steel uppercase bold" id="reset" type="button"> {{Lang::get('resource.lbReset').' '.Lang::get('resource.lbSearch')}} <i class="fa fa-eraser"></i></button>
        <button class="btn grey-cararra font-blue" id="btnAdvanced" type="button"> {{ Lang::get('resource.lbSAdvanced')}} <i class="fa fa-search-plus"></i></button>
      </div>
    </div>


  </div>
  <!-- END SEARCH BOX -->


  <div class="search-table ">

    <table id="tblcurr" class="table table-bordered table-striped table-condensed">
      <thead style="background: #E498B1!important;">
        <tr>
          <th width="25px">
            <a href="javascript:;">#</a>
          </th>
          <th>
            <a href="javascript:;">{{ Lang::get('resource.lbSearchResultDegreeName')}}</a>
          </th>
          <th>
            <a href="javascript:;">{{ Lang::get('resource.lbSearchResultProgramType')}}</a>
          </th>
          <th style="">
            <a href="javascript:;">{{ Lang::get('resource.lbSearchResultDetail')}}</a>
          </th>

          <th style="">
            <a href="javascript:;">{{ Lang::get('resource.lbSearchResultAction')}}</a>
          </th>

        </tr>
      </thead>

    </table>
  </div>
  <div class="search-pagination pagination-rounded">
    <ul class="pagination">
      <li class="page-active">

      </li>

    </ul>
  </div>

</div>





</div>

@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
 <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<script type="application/javascript">

//
$(document).ready(function(){
       $("#btSearch").on('click', function () {
            reloadTable();
        });

   initDatatable();
     reloadTable();
    $("#btnAdvanced").click(function(){
        $("#filterSearch").toggle(250);
    });
    $("#reset").click(function () {
  window.location.href = "{{URL('apply/register/')}}"
});

//reset background-color
$(".page-content").css("background-color","#eef1f5");

  });



    var grid;


    function initDatatable() {
        grid = new Datatable();
        grid.init({
            src: $("#tblcurr"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded

            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: '{{Lang::get('resource.lbBtnDownload')}}...',
            dataTable: {
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "{{Lang::get('resource.lbNoItems')}}",
                    "info": "{{Lang::get('resource.lbShow')}} _START_ - _END_ {{Lang::get('resource.lbShow2')}} _TOTAL_ {{Lang::get('resource.lbItems')}}",
                    "infoEmpty": "{{Lang::get('resource.lbNoItems')}}",
                    "infoFiltered": "(  _MAX_ {{Lang::get('resource.lbItemsTotal')}})",
                    "lengthMenu": "_MENU_ {{Lang::get('resource.lbItems')}}&nbsp;",
                    "search": "Search:",
                    "zeroRecords": "{{Lang::get('resource.lbNoItems')}}"
                },

                "bStateSave": true,


                "fnStateSaveParams": function (oSettings, sValue) {

                },

                "fnStateLoadParams": function (oSettings, oData) {

                },

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 50, // default record count per page
                "ajax": {
                    "url": '{!! route('manageMyCourse.data') !!}', // ajax source
                    "method": 'get'
                },
                "ordering": true,

                "order": [
                    [1, "asc"]
                ],
                "columnDefs": [{
targets: [0],
orderable: false,
className: 'table-status',

render: function (data, type, full, meta) {
return meta.settings._iDisplayStart + meta.row + 1;
} },{
targets: [1],
orderable: true,
className: 'table-desc font-blue',

render: function (data, type, full, meta) {
return (('{{session('locale')}}'=='th')? full.degreethai:full.degreeenglish) ;
} },{
targets: [2],
orderable: true,
className: 'table-desc',

render: function (data, type, full, meta) {
return '<b>'+(('{{session('locale')}}'=='th')? full.prog_type_name:full.prog_type_name_en)+'</b>'+'<br/>'+(('{{session('locale')}}'=='th')? full.office_time:full.office_time_en)+'' ;
} },{
targets: [3],
orderable: true,
className: 'table-desc',

render: function (data, type, full, meta) {
return ('{{Lang::get('resource.lbSearchResultMajor')}}'+ (('{{session('locale')}}'=='th')? full.major_name :full.major_name_en)+'<br/>'+ ''+ (('{{session('locale')}}'=='th')? full.department_name :full.department_name_en) + '<br/>'+'{{Lang::get('resource.lbSearchResultFaculty')}}'+(('{{session('locale')}}'=='th')? full.faculty_name : full.faculty_full) ) ;
}},{
targets: [4],
orderable: false,
className: 'table-downloads',

render: function (data, type, full, meta) {
return ('<a href="{{url('apply/registerDetailForapply/')}}/'+full.curr_act_id+'P'+full.program_type_id+'" class="btn btn-circle green-haze btn-outline ">'+'{{Lang::get('resource.lbSearchResultAction') }}'+ ' <i class="fa fa-arrow-circle-right"></i></a>') ;
} }] ,
            }
        });

    }




 function reloadTable() {
        grid.setAjaxParam("searchs", $('#search').val());
        grid.setAjaxParam("faculty_id", $('#faculty_id').val());
        grid.setAjaxParam("degree_id", $('#degree_id').val());
        grid.setAjaxParam("program_id", $('#program_id').val());
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }

</script>
  @endpush
