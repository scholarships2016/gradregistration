@extends('layouts.default')

@push('pageCss')

 <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="../assets/pages/css/search.min.css" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css">
<link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css">
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
            <span>สมัคร</span>
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
    <h1 class="page-title"> Graduate Student Registration
        
    </h1>
@stop
 

@section('maincontent')
  <div class="search-page search-content-4">
    <div class="search-bar bordered">
 

        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn green-soft uppercase bold" onclick="getData();" type="button">{{Lang::get('resource.lbSearch')}}</button>
                    </span>
                </div>
            </div>
            <div class="col-md-4 extra-buttons">
                <button class="btn grey-steel uppercase bold"   id="reset" type="button"> {{Lang::get('resource.lbReset').' '.Lang::get('resource.lbSearch')}}</button>
                <button class="btn grey-cararra font-blue" id="btnAdvanced" type="button"> {{ Lang::get('resource.lbSAdvanced')}}</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="filterSearch" style="display: none;" class="search-filter ">

                    <div class="col-md-6">
                        <div class="search-label uppercase">Faculty/คณะ</div>                       
                            <select   id="faculty_id" class="form-control"> 
                                <option value="" selected="">========== ทั้งหมด ==========</option>
                                @foreach ($facultys as $faculty)
                                <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-6">
                        <div class="search-label uppercase">ประเภทหลักสูตร/Degree</div>
                         <select   id="degree_id" class="form-control"> 
                        <option value="" selected="" >========== ทั้งหมด ==========</option>
                        @foreach ($typeofRecs as $typeofRec)
                        <option value="{{$typeofRec-> program_type_id}}">{{$typeofRec->prog_type_name}}</option>
                        @endforeach
                        </select>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="search-label uppercase">รหัสหลักสูตร/Program ID</</div>
                         <input type="text" class="form-control spinner"  id="program_id" size="10" maxlength="4" value="">
                    </div>
                    <div class="col-md-6">
                        
                    </div>

                </div>
            </div>
        </div>
        <br>
        Result :
        <div class="search-table table-responsive">
        
            
              <table id="tblcurr" class="table table-bordered table-striped table-condensed">
                <thead class="bg-blue">
                    <tr>
                        <th>
                            <a href="javascript:;">No.</a>
                        </th>
                        <th>
                            <a href="javascript:;">Degree</a>
                        </th>
                        <th>
                            <a href="javascript:;">Type</a>
                        </th>
                        <th>
                            <a href="javascript:;">Program Detail</a>
                        </th>
                        
                        <th>
                            <a href="javascript:;">View/Apply</a>
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
</div>

@stop


                                                        @push('pageJs')
                                                        <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
                                                        <script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
                                                           <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
                                                       <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
                                            <script type="application/javascript">

//
$(document).ready(function(){
    $("#btnAdvanced").click(function(){
        $("#filterSearch").toggle(250);
    }); 
    $("#reset").click(function () {
  window.location.href = "{{URL('apply/register/')}}"
});
  }); 
  
  $(function() {
     getData();
    
 
 
 
    
}); 

function getData(){
     
    var table = $('#tblcurr').DataTable({
        ajax:{ url: '{!! route('manageMyCourse.data') !!}',type:"GET", data: function(d) {
         d.search = $("#search").val()
         d.faculty_id = $("#faculty_id").val()
         d.degree_id = $("#degree_id").val()
          d.program_id = $("#program_id").val()
               
        }}
    , 
columnDefs: [{ 
targets: [0], 
orderable: false, 
className: 'table-status',
name: 'rownum',
render: function (data, type, full, meta) { 
return full.rownum; 
} },{ 
targets: [1], 
orderable: true, 
className: 'table-desc font-blue',
name: 'degree_name', 
render: function (data, type, full, meta) { 
return (('{{session('locale')}}'=='th')? full.degree_name:full.degree_name_en) ; 
} },{ 
targets: [2], 
orderable: true, 
className: 'table-title',
name: 'prog_type_name', 
render: function (data, type, full, meta) { 
return '<h3>'+(('{{session('locale')}}'=='th')? full.prog_type_name:full.prog_type_name_en)+'</h3>'+'<p>'+ full.office_time+'</p>' ; 
} },{ 
targets: [3], 
orderable: true, 
className: 'table-desc',
name: 'prog_type_name', 
render: function (data, type, full, meta) { 
return ('{{Lang::get('resource.lbFaculty')}}'+  (('{{session('locale')}}'=='th')? full.faculty_name : full.faculty_full) + ' <br>{{Lang::get('resource.lbDepartment')}} '+ (('{{session('locale')}}'=='th')? full.department_name :full.department_name_en) +'<br> {{Lang::get('resource.lbMajor')}} '+ (('{{session('locale')}}'=='th')? full.major_name :full.major_name_en)) ;
}},{ 
targets: [4], 
orderable: true, 
className: 'table-download',
name: 'apply', 
render: function (data, type, full, meta) { 
return ('<a href="{{  url('apply/registerDetailForapply/')}}/'+full.curr_act_id+'"><i class="icon-doc font-green-soft"></i></a>') ;
} }] ,   
     destroy: true,
    filter: false,
    info: false,
    ordering: false,
    processing: true,
    retrieve: false  , sPaginationType : 'full_numbers', 
     
    
    });   
       $('#tblcurr_paginate').addClass('search-pagination pagination-rounded');
}


























                                                        </script>
                                                        @endpush

