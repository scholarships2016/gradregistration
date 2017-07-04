@extends('layouts.default')

@push('pageCss')

 <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css">
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
  
<div class="portlet light bordered" style=" margin: auto;width: 70%;padding: 10px;">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> ค้นหาสาขาวิชา
Subject Searching </div>
                                         
                                    </div>
     <div class="portlet-body form">
                                       <form method="get" action=" " name="MyForm">
    <table class="table" border="0" cellspacing="5" cellpadding="0">
        <tbody><tr>
                <td ><strong>คณะ </strong><br>
                    Faculty</td>
                <td colspan="3">
                    <select class="select2"  id="faculty_id" class="form-control"> 
                        <option value="" selected="">========== ทั้งหมด ==========</option>
                        @foreach ($facultys as $faculty)
                        <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                        @endforeach

                </td>
            </tr>

            <tr>
                <td ><strong>ภาควิชา/สหสาขา</strong> <br>
                    Department</td>
                <td><select class="select2"  id="department_id" class="form-control">
                       
                    </select></td>
            </tr>

            <tr>
                <td ><strong>สาขาวิชา</strong><br>
                    Subject</td>
                <td>
                    <select class="select2"   id="curricula_id" class="form-control">
                         <option value="">========== ทั้งหมด ==========</option>
                         
                         
                    </select>                     
                </td>
            </tr>            


            <tr>
                <td ><strong>ประเภทหลักสูตร </strong><br>
                    Degree</td>
                <td>
                    <select class="select2"  id="type_of_recruit_id" class="form-control"> 
                        <option value="" selected="" >========== ทั้งหมด ==========</option>
                        @foreach ($typeofRecs as $typeofRec)
                        <option value="{{$typeofRec->	type_of_recruit_id}}">{{$typeofRec->type_of_recruit}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td ><strong>รหัสหลักสูตร </strong><br>
                    Program ID</td>
                <td><input type="text" class="form-control spinner"  name="syllabus_id" size="10" maxlength="4" value=""></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="btn blue btn-sm" value="ค้นหา Search">&nbsp;
                    <input type="button" value="ยกเลิก Cancel" class="btn yellow btn-sm" onclick="document.location = 'register-4.php'">
                </td></tr>
             <tr>
                <td colspan="2" align="center">  <div style="margin: 10px;  padding: 5px;  border: 1px solid orange;  background-color: #FFFFCC;">
        <b>คำแนะนำ : </b> กรณีที่ค้นหาไม่เจอ  ให้เลือกเฉพาะคณะ แล้วกดปุ่มค้นหา<br>
        <b>Remark : </b> In case of no result found, please try to select only faculty and then click "Search" button
    </div>                
                </td></tr>
                </tbody> </table>   
                                        
                        
                                
</form>
                                    </div>
                                </div>
 
<br>
<div>
                                                    <table class="table table-striped table-bordered table-hover table-checkable  dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                                            <thead>
                                                                <tr role="row">
                                                                  <th   tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"   style="width: 148px;text-align: center;">คณะ<br>Faculty </th>
                                                                  <th   tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 224px;text-align: center;">ภาควิชา-สหสาขา<br>Department </th>
                                                                  <th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 118px;text-align: center;">สาขาวิชา<br>Subject </th>
                                                                  <th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"   style="width: 112px;text-align: center;">หลักสูตร<br>Degree </th>
                                                                    <th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 112px;text-align: center;">ประเภทหลักสูตร<br>Type of Operation </th>
                                                                      <th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"   style="width: 112px;text-align: center;">รายละเอียด<br>Detail </th>
                                                                      <th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1"  style="width: 116px;text-align: center;">  </th></tr>
                                                            </thead>
                                                            <tbody>
ผลการค้นหา
Search Result
                                                                <tr class="gradeX odd" role="row">

                                                                    <td  > vopl </td>
                                                                    <td>
                                                                        <a href="mailto:userwow@gmail.com"> good@gmail.com </a>
                                                                    </td>
                                                                    <td>
                                                                        <span class="label label-sm label-warning"> Suspended </span>
                                                                    </td> 
                                                                    <td>
                                                                        <span class="label label-sm label-warning"> Suspended </span>
                                                                    </td>
                                                                     <td>
                                                                        <span class="label label-sm label-warning"> Suspended </span>
                                                                    </td>
                                                                    <td class="center"> 12.12.2011 </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <a class="btn btn-xs green " href="{{url('apply/registerCourse/')}}" type="button"  > สมัคร/Apply  
                                                                            </a>
                                                                            
                                                                        </div>
                                                                    </td>
                                                                </tr> </tbody>
                                                        </table>
</div>

@stop


                                                        @push('pageJs')
                                                        <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
                                                        <script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
                                                           <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
                                                        <script src="{{asset('js/select2-cascade.js')}}" type="text/javascript"></script>                                             
                                                        <script type="application/javascript">




var select2Option = { 
placeholder: '--เลือก--', 
allowClear: true, 
width: '100%' 
};  

$(".select2").select2(select2Option);  

var cascadLoadingDepartment = new Select2Cascade($('#faculty_id'), $('#department_id'), "{{route('masterdata.getDepartmentByFacultyId')}}?faculty_id=:parentId:", select2Option); 
cascadLoadingDepartment.then(function (parent, child, items) { 
 
if (items.length != 0) { 
if (firstLoadDepartment) { 
child.val($('#department_id').val()).change(); 
firstLoadDepartment = false; 
} else { 
child.select2('open'); 
} 
} 
});



var cascadLoadingCurricula = new Select2Cascade($('#department_id'), $('#curricula_id'), "{{route('masterdata.getCurriculaByDepartmentId')}}?department_id=:parentId:", select2Option); 
cascadLoadingCurricula.then(function (parent, child, items) { 
 
if (items.length != 0) { 
if (firstLoadCurricula) { 
child.val($('#curricula_id').val()).change(); 
firstLoadCurricula = false; 
} else { 
child.select2('open'); 
} 
} 
});










                                                        </script>
                                                        @endpush

