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

                                <div id="select-program-area" class="col-md-9 invoice-logo-space">
                                   @if(session('Applicant'))
                                   <div class="col-xs-10 note note-danger">
                                   <form class="choose-program-form" action="{{route('submitregisterDetailForapply')}}" method="post">
                                    {{csrf_field()}}

                                    @if($programs->count()> 0)

                                                 <div class="form-group form-md-radios  ">
                                                   <label class="col-md-12 control-label" for="form_control_1">
                                                     <h4><span class="badge badge-info">1</span> {{Lang::get('resource.lbSelProgram')}}</h4>
                                                   </label>
                                                   <div class="col-md-12">
                                                       <div class="md-radio-inline font-blue">

                                                            @foreach($programs as $program)

                                                           <div class="md-radio">
                                                               <input type="radio" id="checkbox_P{{ $loop->iteration}}" value="{{ $program->program_id.'|'.$program->curr_prog_id }}" name="program_data" class="md-radiobtn">
                                                               <label for="checkbox_P{{ $loop->iteration}}">
                                                                   <span class="inc"></span>
                                                                   <span class="check"></span>
                                                                   <span class="box"></span>
                                                                   <b>{{$program->program_id}} {{ (session('locale')=='th')?$program->thai : $program->english }}</b>
                                                                    <br/>
                                                                    <i class="fa fa-book"></i> {{ (session('locale')=='th')?$program->prog_plan_name : $program->prog_plan_name_en }}
                                                                      <br/>
                                                                    <i class="fa fa-mortar-board"></i> {{ (session('locale')=='th')?$program->prog_type_name : $program->prog_type_name_en }}
                                                                    ({{$program->office_time}})
                                                                 </label>
                                                           </div>
                                                              @endforeach
                                                       </div>
                                                   </div>
                                  </div>
                                  @endif
                                  <br/>

                                   @if($subMajors->count()> 0)

                                  <div class="form-group form-md-radios" >
                                                    <label class="col-md-12 control-label" for="form_control_1">
                                                      <h4><span class="badge badge-info">2</span> {{Lang::get('resource.lbSelSubMajor')}}</h4></label>
                                                    <div class="col-md-12">
                                                        <div class="md-radio-inline">

                                                             @foreach($subMajors as $subMajor)

                                                            <div class="md-radio">
                                                                <input type="radio" id="checkbox_{{ $loop->iteration}}" value="{{ $subMajor->sub_major_id }}" name="sub_major_id" class="md-radiobtn">
                                                                <label for="checkbox_{{ $loop->iteration}}">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    <b>{{ (session('locale')=='th')?$subMajor->sub_major_name : $subMajor->sub_major_name_en }}
                                                                    </b>
                                                                     </label>
                                                            </div>
                                                               @endforeach
                                                        </div>
                                                    </div>
                                   </div>
                                   @endif


                                     <input type="hidden" name="curr_act_id" value='{{$curDis->curr_act_id}}'  >
                                     <input type="hidden" name="curriculum_id" value='{{$curDis->curriculum_id}}' >
                                    <button  class="btn btn-lg blue  margin-bottom-5" href="{{url('apply/manageMyCourse/')}}"> {{Lang::get('resource.lbSelect')}}
                                      <i class="fa fa-check"></i>
                                    </button>

                                     <a class="btn btn-lg grey-steel   margin-bottom-5" href="{{url('apply/register/')}}">  {{Lang::get('resource.lbCancel')}}
                                        <i class="fa fa-times"></i>
                                    </a>

                                   </form>
                                </div>
  @endif

                                    </div>
                                <div class="col-md-3">
                                    <p>
                                        <span class="muted" style="font-size:26px;"> {{Lang::get('resource.lbSearchResultFaculty')}}{{ (session('locale')=='th')? $curDis->faculty_name:$curDis->faculty_full   }} </span>
                                    </p>
                                </div>
                            </div>
                            <hr>


                            <div class="row" >

                              <div class="col-md-12">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                      <h3 class="panel-title"><i class="fa fa-book"></i> {{Lang::get('resource.lbInfo')}}</h3>
                                  </div>
                                  <div class="panel-body">
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
                                          <span class="form-control-static">{{ (session('locale')=='th')? $curDis->department_name:$curDis->department_name_en   }}  </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbSubject')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static">{{  ($curDis->major_name != '')?(session('locale')=='th')? $curDis->major_name:$curDis->major_name_en :'-'}}   </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbMajor')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static"> {{  ($curDis->degree_name != '')?(session('locale')=='th')? $curDis->degree_name:$curDis->degree_name_en :'-'}}  </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbMajorCode')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static">
                                            @if($programs->count()> 0)
                                            <div class="form-group form-md-radios  ">
                                                           <div class="col-md-12">
                                                             <div class="todo-tasks-container">
                                                            	  <ul class="todo-tasks-content">
                                                                    @foreach($programs as $program)
                                                                      <li class="todo-tasks-item">
                                                                  			<div class="todo-inline">
                                                                  				 {{$program->program_id}} {{ (session('locale')=='th')?$program->thai : $program->english }}
                                                                           <br/>
                                                                           <i class="fa fa-book"></i> {{ (session('locale')=='th')?$program->prog_plan_name : $program->prog_plan_name_en }}
                                                                             <br/>
                                                                           <i class="fa fa-mortar-board"></i> {{ (session('locale')=='th')?$program->prog_type_name : $program->prog_type_name_en }}
                                                                           ({{$program->office_time}})
                                                                        </div>
                                                                  		</li>
                                                                      @endforeach
                                                                    </ul>
                                                                </div>


                                                           </div>
                                            </div>
                                            @endif

                                          </span>
                                        </div>
                                    </div>
                                      @if($subMajors->count()> 0)
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{Lang::get('resource.lbSubMajor')}}</label>
                                        <div class="col-md-8">
                                          <span class="form-control-static">

                                           <div class="form-group form-md-radios  " >
                                                             <div class="col-md-12">


                                                               <div class="todo-tasks-container">
                                                              	  <ul class="todo-tasks-content">
                                                                        @foreach($subMajors as $subMajor)
                                                                        <li class="todo-tasks-item">
                                                                    			<div class="todo-inline">
                                                                    				 {{ (session('locale')=='th')?$subMajor->sub_major_name : $subMajor->sub_major_name_en }}
                                                                    			</div>
                                                                    		</li>
                                                                        @endforeach
                                                                      </ul>
                                                                  </div>


                                                             </div>
                                            </div>

                                          </span>
                                        </div>
                                    </div>
                                      @endif
                                  </div>

                                </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover">
                                        <h4> <i class="fa fa-table"></i>  {{Lang::get('resource.lbExam_schedule')}} :  </h4>
                                       {!!  $curDis->exam_schedule  !!}
                                    </table>
                                </div>
                            </div>
                          -->
                            <div class="row">
                              <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-table"></i>  {{Lang::get('resource.lbExam_schedule')}}</h3>
                                    </div>
                                    <div class="panel-body">  {!!  $curDis->exam_schedule  !!} </div>
                                </div>
                              </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                  <!--
                                  <h4> <i class="fa fa-table"></i>  {{Lang::get('resource.lbExam_schedule')}} :  </h4>
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
                                                <span class="form-control-static">{!!  $curDis->additional_detail  !!} </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbFee')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{  $curDis->apply_fee  }}  {{Lang::get('resource.lbBaht')}}</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbTimeExam')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{$curDis->start_date}}  - {{$curDis->end_date}}  </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbProgDetailDocument')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static"> {{$curDis->document_file}}
                                                  <a href="javascript:;" class="btn btn-circle btn-xs blue btn-outline">
                                                                            <i class="fa fa-file-word-o"></i> Download </a>
                                                 </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbProgDetailCommAppr')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{$curDis->comm_appr_name}} ครั้งที่ {{$curDis->comm_appr_no}} วันที่ {{$curDis->comm_appr_date}} </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4 control-label">{{Lang::get('resource.lbProgDetailContactTel')}}</label>
                                              <div class="col-md-8">
                                                <span class="form-control-static">{{$curDis->contact_tel}} </span>
                                              </div>
                                          </div>
                                      </div>
                                      </form>

                                    </div>
                                  -->
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="icon-info"></i>  {{Lang::get('resource.lbAdditionalInfo')}}</h3>
                                        </div>
                                        <div class="panel-body">
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
                                                    <span class="form-control-static">{!!  $curDis->additional_detail  !!} </span>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-4 control-label">{{Lang::get('resource.lbFee')}}</label>
                                                  <div class="col-md-8">
                                                    <span class="form-control-static">{{  $curDis->apply_fee  }}  {{Lang::get('resource.lbBaht')}}</span>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-4 control-label">{{Lang::get('resource.lbTimeExam')}}</label>
                                                  <div class="col-md-8">
                                                    <span class="form-control-static">{{$curDis->start_date}}  - {{$curDis->end_date}}  </span>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-4 control-label">{{Lang::get('resource.lbProgDetailDocument')}}</label>
                                                  <div class="col-md-8">
                                                    <span class="form-control-static"> {{$curDis->document_file}}
                                                      <a href="javascript:;" class="btn btn-circle btn-xs blue btn-outline">
                                                                                <i class="fa fa-file-word-o"></i> Download </a>
                                                     </span>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-4 control-label">{{Lang::get('resource.lbProgDetailCommAppr')}}</label>
                                                  <div class="col-md-8">
                                                    <span class="form-control-static">{{$curDis->comm_appr_name}} ครั้งที่ {{$curDis->comm_appr_no}} วันที่ {{$curDis->comm_appr_date}} </span>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-4 control-label">{{Lang::get('resource.lbProgDetailContactTel')}}</label>
                                                  <div class="col-md-8">
                                                    <span class="form-control-static">{{$curDis->contact_tel}} </span>
                                                  </div>
                                              </div>
                                          </div>
                                          </form>
                                         </div>
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

                                                                          <script src="{{asset('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
                                                                          <script src="{{asset('/assets/pages/scripts/registerDetailForapply.validate.js')}}" type="text/javascript"></script>


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
