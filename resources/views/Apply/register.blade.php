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
            <a href="/">หน้าหลัก</a>
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
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn green-soft uppercase bold" type="button">Search</button>
                    </span>
                </div>
            </div>
            <div class="col-md-4 extra-buttons">
                <button class="btn grey-steel uppercase bold"  type="button">Reset Search</button>
                <button class="btn grey-cararra font-blue" id="btnAdvanced" type="button">Advanced Search</button>
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
                         <select   id="type_of_recruit_id" class="form-control"> 
                        <option value="" selected="" >========== ทั้งหมด ==========</option>
                        @foreach ($typeofRecs as $typeofRec)
                        <option value="{{$typeofRec->	type_of_recruit_id}}">{{$typeofRec->type_of_recruit}}</option>
                        @endforeach
                    </select>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="search-label uppercase">รหัสหลักสูตร/Program ID</</div>
                         <input type="text" class="form-control spinner"  name="syllabus_id" size="10" maxlength="4" value="">
                    </div>
                    <div class="col-md-6">
                        
                    </div>

                </div>
            </div>
        </div>
        <br>
        Result :
        <div class="search-table table-responsive">
            <table class="table table-bordered table-striped table-condensed">
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
                         @if(session('user_id'))
                        <th>
                            <a href="javascript:;">View/Apply</a>
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                1
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">Master of Engineering </a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Doctor Degree Program</a>
                            </h3>
                            <p>Inter National curriculum

                            </p>
                        </td>
                        <td class="table-desc"> Faculty of Engineering <br>
                            Department of Computer <br>
                            Major in Love<br>
                        </td>
                        @if(session('user_id'))   <td class="table-download">
                            <a  href="{{url('apply/registerDetailForapply/')}}" type="button"  > 
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>   @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                2
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">Master of Engineering </a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Doctor Degree Program</a>
                            </h3>
                            <p>Inter National curriculum

                            </p>
                        </td>
                        <td class="table-desc"> Faculty of Engineering <br>
                            Department of Computer <br>
                            Major in Love<br>
                        </td>
                        @if(session('user_id'))   <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>   @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-check font-grey"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 15, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Typi non habent</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        @if(session('user_id'))   <td class="table-download">
                             <a  href="{{url('apply/registerDetailForapply/')}}" type="button"  > 
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>   @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 12, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Search Result</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        @if(session('user_id'))   <td class="table-download">
                           <a  href="{{url('apply/registerDetailForapply/')}}" type="button"  > 
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>   @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 11, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Mirum est notare</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        @if(session('user_id'))   <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>    @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-check font-grey"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 9, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Reborn</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        @if(session('user_id'))   <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>    @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-check font-grey"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 9, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Reborn</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        @if(session('user_id'))   <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>    @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 6, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Reborn Progress</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        @if(session('user_id'))   <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>    @endif
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 3, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Search Page 5</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        @if(session('user_id'))   <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>    @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="search-pagination pagination-rounded">
            <ul class="pagination">
                <li class="page-active">
                    <a href="javascript:;"> 1 </a>
                </li>
                <li>
                    <a href="javascript:;"> 2 </a>
                </li>
                <li>
                    <a href="javascript:;"> 3 </a>
                </li>
                <li>
                    <a href="javascript:;"> 4 </a>
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
                                                        <script src="{{asset('js/select2-cascade.js')}}" type="text/javascript"></script>                                             
                                                        <script type="application/javascript">


$(document).ready(function(){
    $("#btnAdvanced").click(function(){
        $("#filterSearch").toggle(250);
    });
});

//var select2Option = { 
//placeholder: '--เลือก--', 
//allowClear: true, 
//width: '100%' 
//};  
//
//$(".select2").select2(select2Option);  

//var cascadLoadingDepartment = new Select2Cascade($('#faculty_id'), $('#department_id'), "{{route('masterdata.getDepartmentByFacultyId')}}?faculty_id=:parentId:", select2Option); 
//cascadLoadingDepartment.then(function (parent, child, items) { 
// 
//if (items.length != 0) { 
//if (firstLoadDepartment) { 
//child.val($('#department_id').val()).change(); 
//firstLoadDepartment = false; 
//} else { 
//child.select2('open'); 
//} 
//} 
//});

//
// 
//var cascadLoadingCurricula = new Select2Cascade($('#department_id'), $('#curricula_id'), "{{route('masterdata.getCurriculaByDepartmentId')}}?department_id=:parentId:", select2Option); 
//cascadLoadingCurricula.then(function (parent, child, items) { 
// 
//if (items.length != 0) { 
//if (firstLoadCurricula) { 
//child.val($('#curricula_id').val()).change(); 
//firstLoadCurricula = false; 
//} else { 
//child.select2('open'); 
//} 
//} 
//}); 










                                                        </script>
                                                        @endpush

