@extends('layouts.default')

@push('pageCss')

 <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
 
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
    <h1 class="page-title"> {{Lang::get('resource.lbRegDetail')}}</h1>
    
@stop
 

@section('maincontent')
   
<div class="invoice">
    @if($curDiss->count()>0)
     @foreach ($curDiss as $curDis)
                            <div class="row invoice-logo">
                                <div class="col-xs-6 invoice-logo-space">
                                   <div class="col-xs-10 ">
                                   <form class="forget-form" action="{{route('submitregisterDetailForapply')}}" method="post">
                                    {{csrf_field()}}
                                   @if($subMajors->count()> 0)
                                  <div class="form-group form-md-radios  ">
                                                    <label class="col-md-12 control-label" for="form_control_1"><strong>{{Lang::get('resource.lbSelSubMajor')}}</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="md-radio-inline">
                                                          
                                                             @foreach($subMajors as $subMajor)
                                                              
                                                            <div class="md-radio">
                                                                <input type="radio" id="checkbox_{{ $loop->iteration}}" value="{{ $subMajor->sub_major_id }}" name="sub_major_id" class="md-radiobtn">
                                                                <label for="checkbox_{{ $loop->iteration}}">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> {{ (session('locale')=='th')?$subMajor->sub_major_name : $subMajor->sub_major_name_en }} </label>
                                                            </div>
                                                               @endforeach                                                             
                                                        </div>
                                                    </div>
                                   </div>
                                   @endif
                                     @if($programs->count()> 0)
                                  <div class="form-group form-md-radios  ">
                                                    <label class="col-md-12 control-label" for="form_control_1"><strong>{{Lang::get('resource.lbSelProgram')}}</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="md-radio-inline">
                                                          
                                                             @foreach($programs as $program)
                                                              
                                                            <div class="md-radio">
                                                                <input type="radio" id="checkbox_P{{ $loop->iteration}}" value="{{ $program->curr_prog_id }}" name="program_id" class="md-radiobtn">
                                                                <label for="checkbox_P{{ $loop->iteration}}">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> {{ (session('locale')=='th')?$program->thai : $program->thai }} </label>
                                                            </div>
                                                               @endforeach                                                             
                                                        </div>
                                                    </div>
                                   </div>
                                   @endif
                                       @if(session('Applicant'))
                                     <input type="hidden" name="curr_act_id" value='{{$curDis->curr_act_id}}'  >
                                     <input type="hidden" name="curriculum_id" value='{{$curDis->curriculum_id}}' >                                  
                                    <button class="btn btn-lg blue  margin-bottom-5" href="{{url('apply/manageMyCourse/')}}"> {{Lang::get('resource.lbSelect')}}
                                      <i class="fa fa-check"></i>
                                    </button>
                                     
                                     <a class="btn btn-lg red   margin-bottom-5" href="{{url('apply/register/')}}">  {{Lang::get('resource.lbCancel')}}
                                        <i class="fa fa-times"></i>
                                    </a>
                                      @endif
                                   </form>
                                </div>
                                    </div>
                                <div class="col-xs-6">
                                    <p>  
                                        <span class="muted" style="font-size:26px;"> {{ (session('locale')=='th')? $curDis->faculty_name:$curDis->faculty_full   }} </span>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="font-size:16px;">  <h3 style="padding-left: 15px">{{Lang::get('resource.lbDetail')}} :</h3>
                                <div class="col-xs-3">                                    
                                    <ul class="list-unstyled">
                                        <li> {{Lang::get('resource.lbYear')}} </li>
                                        <li> {{Lang::get('resource.lbDepartment')}}</li>
                                        <li> {{Lang::get('resource.lbSubject')}} </li>
                                        <li> {{Lang::get('resource.lbMajor')}} </li>
                                        <li> {{Lang::get('resource.lbMajorCode')}} </li>
                                    </ul>
                                </div>
                                <div class="col-xs-7">                                   
                                    <ul class="list-unstyled">
                                        <li> {{$curDis->academic_year}}  </li>
                                        <li>  {{ (session('locale')=='th')? $curDis->faculty_name:$curDis->faculty_full   }}  </li>
                                        <li>  {{  ($curDis->sub_major_name != '')?(session('locale')=='th')?  $curDis->sub_major_name : $curDis->sub_major_name_en:'-'   }} </li>
                                        <li>  {{  ($curDis->major_name != '')?(session('locale')=='th')? $curDis->major_name:$curDis->major_name_en :'-'}} </li>
                                        <li>  {{  $curDis->major_code   }} </li>
                                        
                                    </ul>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-hover">
                                        <h4> {{Lang::get('resource.lbExam_schedule')}} :  </h4> 
                                       {!!  $curDis->exam_schedule  !!} 
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="well">
                                         <div class="row" style="font-size:16px;">  
                                     <div class="col-xs-4">                                    
                                    <ul class="list-unstyled">
                                        <li> {{Lang::get('resource.lbExpectation')}} </li>
                                        <li> {{Lang::get('resource.lbMoreInformation')}}</li>
                                        
                                        <li>  {{Lang::get('resource.lbFee')}} </li>
                                        <li>  {{Lang::get('resource.lbTimeExam')}} </li>
                                         <li>   </li>
                                        <li>   </li>
                                         <li>   </li> 
                                    </ul>
                                </div>
                                <div class="col-xs-8" style="color:red;">                                   
                                    <ul class="list-unstyled">
                                        <li>   {{  $curDis->expected_amount  }}  </li>
                                        <li>  {{  $curDis->addtional_detail  }} </li>
                                      
                                        <li> {{  $curDis->apply_fee  }} </li>
                                        <li>   {{$curDis->start_date}}  - {{$curDis->end_date}} </li>
                                        
                                        <li>   </li>
                                         <li>   </li> 
                                    </ul>
                                </div> 
                                         </div>
                                    </div>
                                </div>
                              <div class="col-md-12" style='text-align:center;' > 
                                @if(!session('user_id'))                            
                                      <a class="btn btn-success mt-sweetalert" href="javascript:getLogin();"   >  {{Lang::get('resource.lbRegisterbtn')}}
                                                        <i class="fa fa-user"></i>
                                                    </a> 
                                     @endif
                            </div>
                            </div>
                           
      @endforeach 
     @else
     ไม่มีข้อมูล/No Data.
     @endif
 </div>

                                                                          @stop


                                                                          @push('pageJs')
                                                                          <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
                                                                          <script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
                                                                         <script src="{{asset('/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
                                                                         <script src="{{asset('/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>

                                                                          <script type="application/javascript">
  function getLogin() {
    swal({
  title:  '{{Lang::get('resource.lbMessageBeforLogin_title')}}',
  text: '{{Lang::get('resource.lbMessageBeforLogin_text')}}' ,
  type: "warning",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true
}, function () {
  setTimeout(function () {
   window.location.href = '{{ url('/login') }}' 
  }, 100);
});
         }
         
                                                                          </script>
                                                                          @endpush



