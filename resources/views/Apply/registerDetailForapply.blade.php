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
            <a href="/">{{Lang::get('resource.lbMain')}}</a>
            <i class="fa fa-circle"></i>
        </li>
         <li>
            <span>{{Lang::get('resource.lbSearchPageTopic')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span> {{Lang::get('resource.lbRegDetail')}}</span>
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

<div class="invoice" id="page-program-detail">
    @if($curDiss->count()>0)
     @foreach ($curDiss as $curDis)
                            <div class="row invoice-logo">

                                <div class="col-xs-8 invoice-logo-space">
                                   @if(session('Applicant'))
                                   <div class="col-xs-10 well">
                                   <form class="forget-form" action="{{route('submitregisterDetailForapply')}}" method="post">
                                    {{csrf_field()}}

                                    @if($programs->count()> 0)
                                 <div class="form-group form-md-radios  ">
                                                   <label class="col-md-12 control-label" for="form_control_1"><strong><span class="badge badge-info">1</span> {{Lang::get('resource.lbSelProgram')}}</strong></label>
                                                   <div class="col-md-12">
                                                       <div class="md-radio-inline">

                                                            @foreach($programs as $program)

                                                           <div class="md-radio">
                                                               <input type="radio" id="checkbox_P{{ $loop->iteration}}" value="{{ $program->curr_prog_id }}" name="program_id" class="md-radiobtn">
                                                               <label for="checkbox_P{{ $loop->iteration}}">
                                                                   <span class="inc"></span>
                                                                   <span class="check"></span>
                                                                   <span class="box"></span>{{$program->program_id}} {{ (session('locale')=='th')?$program->thai : $program->english }} </label>
                                                           </div>
                                                              @endforeach
                                                       </div>
                                                   </div>
                                  </div>
                                  @endif
                                   @if($subMajors->count()> 0)
                                  <div class="form-group form-md-radios  " >
                                                    <label class="col-md-12 control-label" for="form_control_1"><strong><span class="badge badge-info">2</span> {{Lang::get('resource.lbSelSubMajor')}}</strong></label>
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


                                     <input type="hidden" name="curr_act_id" value='{{$curDis->curr_act_id}}'  >
                                     <input type="hidden" name="curriculum_id" value='{{$curDis->curriculum_id}}' >
                                    <button class="btn btn-lg blue  margin-bottom-5" href="{{url('apply/manageMyCourse/')}}"> {{Lang::get('resource.lbSelect')}}
                                      <i class="fa fa-check"></i>
                                    </button>

                                     <a class="btn btn-lg red   margin-bottom-5" href="{{url('apply/register/')}}">  {{Lang::get('resource.lbCancel')}}
                                        <i class="fa fa-times"></i>
                                    </a>

                                   </form>
                                </div>
  @endif

                                    </div>
                                <div class="col-xs-4">
                                    <p>
                                        <span class="muted" style="font-size:26px;"> {{ (session('locale')=='th')? $curDis->faculty_name:$curDis->faculty_full   }} </span>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="font-size:16px;">  <h4 style="padding-left: 15px"> <i class="fa fa-book"></i> {{Lang::get('resource.lbDetail')}} :</h4>
                              <div class="col-md-12">
                                <form class="form-horizontal">
                                  <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbYear')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static"> {{$curDis->academic_year}} </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbDepartment')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static">{{ (session('locale')=='th')? $curDis->faculty_name:$curDis->faculty_full   }}  </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbSubject')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static"> {{  ($curDis->sub_major_name != '')?(session('locale')=='th')?  $curDis->sub_major_name : $curDis->sub_major_name_en:'-'   }}  </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbMajor')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static"> {{  ($curDis->major_name != '')?(session('locale')=='th')? $curDis->major_name:$curDis->major_name_en :'-'}}  </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbMajorCode')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static">

                                            @if($programs->count()> 0)
                                            <div class="form-group form-md-radios  ">
                                                           <div class="col-md-12">
                                                               <div class="md-radio-inline">

                                                                    @foreach($programs as $program)

                                                                   <div class="md-radio">
                                                                       <input type="radio" id="checkbox_P{{ $loop->iteration}}" value="{{ $program->curr_prog_id }}" name="program_id" class="md-radiobtn">
                                                                       <label for="checkbox_P{{ $loop->iteration}}">
                                                                           <span class="inc"></span>
                                                                           <span class="check"></span>
                                                                           <span class="box"></span>{{$program->program_id}} {{ (session('locale')=='th')?$program->thai : $program->english }} </label>
                                                                   </div>
                                                                      @endforeach
                                                               </div>
                                                           </div>
                                            </div>
                                            @endif

                                          </span>
                                        </div>
                                    </div>
                                  </div>

                                </form>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover">
                                        <h4> <i class="fa fa-table"></i>  {{Lang::get('resource.lbExam_schedule')}} :  </h4>
                                       {!!  $curDis->exam_schedule  !!}
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well">
                                      <form class="form-horizontal">
                                        <div class="form-body">
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbExpectation')}} </label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{  $curDis->expected_amount  }} </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbMoreInformation')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{  $curDis->addtional_detail  }} </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbFee')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{  $curDis->apply_fee  }}  </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbTimeExam')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{$curDis->start_date}}  - {{$curDis->end_date}}  </span>
                                              </div>
                                          </div>
                                      </div>
                                    </form>


                                    </div>
                                </div>
                              <div class="col-md-12" style='text-align:center;' >

                               <a href="{{url('apply/register/')}}" class="btn grey-steel"><i class="fa fa-mail-reply"></i> {{Lang::get('resource.lbCancel')}}
                                                                            </i>
                                                                        </a>
                                @if(!session('user_id'))
                                      <a class="btn btn-success mt-sweetalert" href="javascript:getLogin();"   >  {{Lang::get('resource.lbRegisterbtn')}}
                                                        <i class="fa fa-check"></i>
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
