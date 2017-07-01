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
  
<div class="portlet box blue" style=" margin: auto;width: 70%;padding: 10px;">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Validation States </div>
                                         
                                    </div>
                                    <div class="portlet-body form">
                                       <form method="get" action="register-3.php" name="MyForm">
    <table class="table" border="0" cellspacing="5" cellpadding="0">
        <tbody><tr>
                <td bgcolor="#FFCCFF"><strong>คณะ </strong><br>
                    Faculty</td>
                <td colspan="3"><select name="faculty_id">

                        <option value="" selected="">========== ทั้งหมด ==========</option>
                        <option value="22">ไม่สมัคร () - 22</option>

                </td>
            </tr>

            <tr>
                <td bgcolor="#FFCCFF"><strong>ภาควิชา/สหสาขา</strong> <br>
                    Department</td>
                <td><select name="department_id"><option value="221"> - 221</option><option value="226"> - 226</option><option value="229"> - 229</option></select></td>
            </tr>

            <tr>
                <td bgcolor="#FFCCFF"><strong>สาขาวิชา</strong><br>
                    Subject</td>
                <td><select name="id_deptthai"><option value="">========== ทั้งหมด ==========</option></select>
                    <script>
                        var dol = new DynamicOptionList("faculty_id", "department_id", "id_deptthai");
                        dol.setFormName("MyForm");
                        dol.forValue("1").addOptionsTextValue("========== ทั้งหมด ==========", "");


                    </script>
                </td>
            </tr>            


            <tr>
                <td bgcolor="#FFCCFF"><strong>ประเภทหลักสูตร </strong><br>
                    Degree</td>
                <td><select name="type_of_recruit_id">
                        <option value="" selected="">========== ทั้งหมด ==========</option>
                        <option value="1">== โปรดระบุ ==</option> 
                    </select>
                </td>
            </tr>

            <tr>
                <td bgcolor="#FFCCFF"><strong>รหัสหลักสูตร </strong><br>
                    Program ID</td>
                <td><input type="text" name="syllabus_id" size="10" maxlength="4" value=""></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ค้นหา Search">&nbsp;
                    <input type="button" value="ยกเลิก Cancel" onclick="document.location = 'register-4.php'">
                </td></tr>
                </tbody> </table>   
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>คำแนะนำ : กรณีที่ค้นหาไม่เจอ ให้เลือกเฉพาะคณะ แล้วกดปุ่มค้นหา
Remark : In case of no result found, please try to select only faculty and then click "Search" button </div>
                                         
                                
</form>
                                    </div>
                                </div>
 
 
<div>
                                                    <table class="table table-striped table-bordered table-hover table-checkable  dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                                            <thead>
                                                                <tr role="row">
                                                                  <th   tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 148px;"> Username </th><th   tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Email : activate to sort column ascending" style="width: 224px;"> Email </th><th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Status : activate to sort column ascending" style="width: 118px;"> Status </th><th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Joined : activate to sort column ascending" style="width: 112px;"> Joined </th><th  tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Actions : activate to sort column ascending" style="width: 116px;"> Actions </th></tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr class="gradeX odd" role="row">

                                                                    <td  > vopl </td>
                                                                    <td>
                                                                        <a href="mailto:userwow@gmail.com"> good@gmail.com </a>
                                                                    </td>
                                                                    <td>
                                                                        <span class="label label-sm label-warning"> Suspended </span>
                                                                    </td>
                                                                    <td class="center"> 12.12.2011 </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-xs green  " type="button"  > Actions
                                                                                <i class="fa fa-angle-down"></i>
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
                                                        <script type="application/javascript">

                                                        </script>
                                                        @endpush

