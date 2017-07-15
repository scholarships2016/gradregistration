@extends('layouts.default')

@push('pageCss')

 <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
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
        <li>
            <span>รายละเอียดหลักสูตร</span>
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
    <h1 class="page-title"> รายละเอียดหลักสูตร</h1>
    
@stop
 

@section('maincontent')
   
<div class="invoice">
                            <div class="row invoice-logo">
                                <div class="col-xs-6 invoice-logo-space">
                                   <div class="col-xs-10 ">
                                    <ul class="list-unstyled amounts">
                                        <li>
                                            <strong>เลือกรหัสหลักสูตร(แขนงวิชา)/ Select program (subject)</strong> </li><br>
                                        <li>                                            
                                        <li>
                                             <select class="select2"  id="type_of_recruit_id" class="form-control"> 
                        <option value="" selected="" >========== ทั้งหมด ==========</option>                        
                         <option value="" selected="" >2086 - ปริญยาโท</option> 
                                             </select>
                                        </li>
                                    </ul>
                                   
                                    <a class="btn btn-lg blue  margin-bottom-5" href="{{url('apply/manageMyCourse/')}}"> เลือก/Select
                                      <i class="fa fa-check"></i>
                                    </a>
                                  <a class="btn btn-lg red   margin-bottom-5" href="{{url('apply/register/')}}">  ยกเลิก
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                                    </div>
                                <div class="col-xs-6">
                                    <p>  
                                        <span class="muted" style="font-size:26px;">  วิศวกรรมศาสตร์ (Faculty of Engineering) </span>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="font-size:16px;">  <h3 style="padding-left: 15px">รายละเอียด :</h3>
                                <div class="col-xs-3">                                    
                                    <ul class="list-unstyled">
                                        <li> ปีการศึกษา(พ.ศ.)/year </li>
                                        <li> ภาควิชา-สาขา/Department</li>
                                        <li> สาขาวิชา/Subject </li>
                                        <li> หลักสูตร/Syllabus </li>
                                        <li> รหัสหลักสูตร/Syllabus ID </li>
                                    </ul>
                                </div>
                                <div class="col-xs-7">                                   
                                    <ul class="list-unstyled">
                                        <li> 2558 </li>
                                        <li> วิศวกรรมอุตสาหการ </li>
                                        <li> วิศวกรรมอุตสาหการ </li>
                                        <li> วิศวกรรมศาสตร์มหาบัณฑิต - Master of Engineering </li>
                                        <li> 2086 - ปริญญาโท </li>
                                        
                                    </ul>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-hover">
                                        <h4>ตารางสอบ : <p style="color: red;"> รับสมัคร วันที่ 15 มิถุนายน 2559 - 19 มิถุนายน 2559</p></h4> 
                                        <thead>
                                            <tr>
                                                <th> วิชาที่สอบ </th>
                                                <th> วันและเวลาที่ทำการทดสอบ </th>
                                                <th class="hidden-xs"> สถานที่สอบ </th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                                <td> พื้นฐานสถิติสำหรับวิศวกรรอุตสาหกรรม </td>
                                                <td class="hidden-xs"> 28 มิถุนายน 2559 (13:00 - 16:00)</td>
                                                <td class="hidden-xs"> อาคารเจริญวิศวกรรม คณะวิศวกรรมศาสตร์ </td>
                                                 
                                            </tr>
                                            <tr>
                                               <td> ประกาศผลสอบข้อเขียน </td>
                                                <td class="hidden-xs"> 30 มิถุนายน 2559 (14:00)</td>
                                                <td class="hidden-xs"> อาคารเจริญวิศวกรรม คณะวิศวกรรมศาสตร์ </td>
                                            </tr>
                                            <tr>
                                                <td> สอบสัมภาษณ์(เฉพาะผู้สอบผ่านข้อเขียนเท่านั้น) </td>
                                                <td class="hidden-xs"> 1 กรกฏาคม 2559 (09:00 - 11:00)</td>
                                                <td class="hidden-xs"> อาคารเจริญวิศวกรรม คณะวิศวกรรมศาสตร์ </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="well">
                                         <div class="row" style="font-size:16px;">  
                                     <div class="col-xs-4">                                    
                                    <ul class="list-unstyled">
                                        <li> จำนวนนิสิตที่คาดว่าจะรับ/Expectation </li>
                                        <li> รายละเอียดเพิ่มเติม/More Information</li>
                                        <li> ค่าธรรมเนียม/Fee </li>
                                        <li>  ระยะเวลาที่เปิดรับสมัคร </li>
                                         <li>   </li>
                                        <li>   </li>
                                         <li>   </li> 
                                    </ul>
                                </div>
                                <div class="col-xs-8" style="color:red;">                                   
                                    <ul class="list-unstyled">
                                        <li> 20 คน </li>
                                        <li>  <br> </li>
                                        <li> 500 บาท </li>
                                        <li> วัน พุธ ที่ 3 มิถุนายน 2559 - วันศุกร์ ที่ 19 ตุลาคม 2559 </li>
                                        <li>   </li>
                                        <li>   </li>
                                         <li>   </li> 
                                    </ul>
                                </div> 
                                         </div>
                                    </div>
                                </div>
                             
                            </div>
                        </div>

                                                                          @stop


                                                                          @push('pageJs')
                                                                          <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
                                                                          <script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
                                                                          <script type="application/javascript">
                                                                             
                                                                          </script>
                                                                          @endpush



