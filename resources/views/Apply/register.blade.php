@extends('layouts.default')

@push('pageCss')

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
            <span>วิธีการสมัคร</span>
        </li>
    </ul>
    {{--<div class="page-tool    bar">--}}
    {{--<div class="btn-group pull-right">--}}
    {{--<butto    n type="button" class="btn green btn-sm btn-outline dropdown-toggle"--}}
    {{--data-toggl    e="dropdown"> Actions--}}
    {{--<i class="fa f    a-a                            ngle-down"></i>--}}
                                            {{--</button>--}}
                                        {{--<ul cl                            ass="dropdown-menu pu                            ll-right" role="menu">--}}
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
                                                        {{--                                                        <i class="icon-bag"></i> Separated link</a>--}}
                                                                                                {{--</li>--}}
                                                               {{--</ul>--}}
    {{--</div>--}}
        {{--</div>--}}
    </div>
@stop

@section('pagetitle')
    <h1                                                        class="page-title"> Graduate Student Registration
        
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
                                       <form method="get" action="register-3.php" name="MyForm">
    <table class="table" border="0" cellspacing="5" cellpadding="0">
        <tbody><tr>
                <td ><strong>คณะ </strong><br>
                    Faculty</td>
                <td colspan="3">
                    <select class="select2"  id="faculty_id" class="form-control"> 
                        <option value="" selected="">========== ทั้งหมด ==========</option>
                        @foreach ($provinces as $province)
                        <option value="{{$province->province_id}}">{{$province->province_name}}</option>
                        @endforeach

                </td>
            </tr>

            <tr>
                <td ><strong>ภาควิชา/สหสาขา</strong> <br>
                    Department</td>
                <td><select class="select2"  id="department_id" class="form-control">
                        <option value="221"> - 221</option>
                        <option value="226"> - 226</option>
                        <option value="229"> - 229</option>
                    </select></td>
            </tr>

            <tr>
                <td ><strong>สาขาวิชา</strong><br>
                    Subject</td>
                <td>
                    <select class="select2"   id="id_deptthai" class="form-control">
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
                        <option value="1">== โปรดระบุ ==</option> 
                    </select>
                </td>
            </tr>

            <tr>
                <td ><strong>รหัสหลักสูตร </strong><br>
                    Program ID</td>
                <td><input type="text" class="form-control spinner" name="syllabus_id" size="10" maxlength="4" value=""></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ค้นหา Search">&nbsp;
                    <input type="button" value="ยกเลิก Cancel" onclick="document.location = 'register-4.php'">
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
                                                                            <button class="btn btn-xs green  " type="button"  > สมัคร/Apply  
                                                                            </button>
                                                                            
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

var cascadLoadingDistrict = new Select2Cascade($('#faculty_id'), $('#id_deptthai'), "{{route('masterdata.getDistrictListByProvinceId')}}?province_id=:parentId:", select2Option); 
cascadLoadingDistrict.then(function (parent, child, items) { 
// Open the child listbox immediately 
if (items.length != 0) { 
if (firstLoadDistrict) { 
child.val($('#id_deptthai').val()).change(); 
firstLoadDistrict = false; 
} else { 
child.select2('open'); 
} 
} 
});













                                                        </script>
                                                        @endpush

