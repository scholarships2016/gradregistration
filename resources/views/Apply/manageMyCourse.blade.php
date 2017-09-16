@extends('layouts.default') @push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/apps/css/todo-2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">

<style type="text/css">

</style>
@endpush @section('pagebar')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="/">{{Lang::get('resource.lbMHome')}}</a>
      <i class="fa fa-circle"></i>
    </li>

    <li>
      <span>{{Lang::get('resource.lbManageCouse')}}</span>
    </li>
  </ul>
  {{--
  <div class="page-tool    bar">--}} {{--
    <div class="btn-group pull-right">--}} {{--
      <butto n type="button" class="btn green btn-sm btn-outline dropdown-toggle" --}} {{--data-toggl e="dropdown"> Actions--}} {{--
        <i class="fa f    a-angle-down"></i>--}} {{--
        </button>--}} {{--
        <ul clas s="dropdown-menu pull-right" role="menu">--}} {{--
          <li>--}} {{--
            <a href="#">-    -}}
        {{--<i cl    ass="icon-bell"></i> Action</    a>--}}
                {{--                                            </li>--}}
                    {{--                <li>--}}
                                            {{--<a href="#">--}}
        {{--<i class="icon-shield"></i> Another action</a>--}} {{--
          </li>--}} {{--
          <li>--}} {{--
            <a href="#">--}}
                {{--<i class="ico                n-user"></i> Something else h                ere</a>--}} {{--
          </li>--}} {{--
          <li class="divider"></li>--}} {{--
          <li>--}} {{--
            <a href="#">--}}
                                            {{--<i class="icon-bag"></i> Separated link</a>--}} {{--
          </li>--}} {{--
        </ul>--} } {{--
    </div>--}} {{--
  </div>--}}
</div>
@stop @section('pagetitle')
<h1 class="page-title"> {{Lang::get('resource.lbManageCouse')}}</h1> @stop @section('maincontent')


<div class="row">
  <div class="col-md-12">
    <!-- BEGIN TODO SIDEBAR -->
    <div class="todo-ui">
      <div class="todo-sidebar">
        <div class="portlet light ">
          <div class="portlet-title">
            <div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
              <span class="caption-subject font-gree  n-sharp bold uppercase">Status </span>
              <span class="caption-helper visible-sm-inline-block visible-xs-inline-block">click to view project list</span>
            </div>

          </div>
          <div class="portlet-body todo-project-list-content" style="height: auto;">
            <div class="todo-project-list">
              <ul class="nav nav-stacked">
                @foreach($CountStatus as $CountStat)
                <li>
                  <a href="javascript:;">
                                        <span class="badge badge-info"> {{$CountStat->cnum}} </span>{{(session('locale')=='th')? $CountStat->flow_name : $CountStat->flow_name_en }} </a>
                </li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>

      </div>
      <!-- END TODO SIDEBAR -->
      <!-- BEGIN TODO CONTENT -->
      <div class="todo-content">
        <div class="portlet light ">
          <!-- PROJECT HEAD -->
          <div class="portlet-title">
            <div class="caption">
              <i class="icon-bar-chart font-green-sharp hide"></i>

              <span class="caption-subject font-pink-chula bold uppercase"> {{Lang::get('resource.lbManageCouse')}}</span>
            </div>

          </div>
          <!-- end PROJECT HEAD -->
          <div class="portlet-body">
            <div class="row">
              <div class="col-md-12 col-sm-4">
                <div class="todo-tasklist">

                  @foreach ($Apps as $curDis)

                  <div class="todo-tasklist-item todo-tasklist-item-border-pink">

                    <div class="todo-tasklist-item-title">
                      <h4>
                                          <b>
                                          {{$curDis->program_id}} {{  ($curDis->thai != '')?(session('locale')=='th')?  $curDis->thai : $curDis->english:'-'   }}
                                        </b>
                                         {{  ($curDis->sub_major_id != '')?(session('locale')=='th')?' - แขนงวิชา '. $curDis->sub_major_name:' - '.$curDis->sub_major_name_en :'-'}}
                                         {{  ($curDis->major_name != '')?(session('locale')=='th')? ' - สาขาวิชา'.$curDis->major_name:' - Major in '.$curDis->major_name_en :'-'}}
                                        </h4>

                      <i class="fa fa-book"></i>
                       {!! (session('locale')=='th')?$curDis->prog_plan_name.' <small>'.$curDis->prog_plan_desc1.'</small>' : $curDis->prog_plan_name_en.' <small>'.$curDis->prog_plan_desc2.'</small>' !!}

                      <br/>
                      <i class="fa fa-mortar-board"></i> {{ (session('locale')=='th')?$curDis->prog_type_name : $curDis->prog_type_name_en }} ({{ (session('locale')=='th')?$curDis->office_time : $curDis->office_time_en }})
                    </div>
                    <div class="todo-tasklist-item-text">
                      <i class="icon-info"></i> {{ ($curDis->major_name != '')?(session('locale')=='th')? 'สาขาวิชา'.$curDis->major_name:'Major in '.$curDis->major_name_en .', ':'-'}} {{ (session('locale')=='th')? $curDis->department_name:$curDis->department_name_en.',
                      ' }} {{(session('locale')=='th')? 'คณะ'.$curDis->faculty_name:$curDis->faculty_full.' '}}
                      <!--  {{  ($curDis->degree_name != '')?(session('locale')=='th')? $curDis->degree_name:$curDis->degree_name_en :'-'}}-->

                    </div>

                    <hr/>
                     @if($curDis->flow_id>=2)
                    <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbDocID')}} <span class="label label-warning">{{ str_pad($curDis->app_id, 5, '0', STR_PAD_LEFT) }} </span> </div>
                    <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbAppNo')}} <span class="label label-warning">{{$curDis->program_id.' - '.str_pad($curDis->curriculum_num, 4, '0', STR_PAD_LEFT)}}</span> </div>
                    @endif

                    <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbStatus')}} <span class="label label-info">{{  ($curDis->flow_name != '')?(session('locale')=='th')?  $curDis->flow_name : $curDis->flow_name_en:'-'   }} </span> </div>

                    <div class="todo-tasklist-controls pull-left" id="mycourse-todolist">

                      <div class="col-md-12 col-md-offset-1 portlet mt-element-ribbon light portlet-fit bordered">
                        @if($curDis->flow_id>=2)
                        <div class="btn-group pull-right">
                          <a class="btn green" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                                                                                  <i class="fa fa-download"></i> {{Lang::get('resource.lbBtnDownload')}}
                                                                                  <i class="fa fa-angle-down"></i>
                                                                              </a>
                          <ul class="dropdown-menu">
                            <li>
                              <a target="_blank" href="{{url('apply/docMyCourse/'.Crypt::encrypt($curDis->application_id))}}"> <i class="fa fa-file-pdf-o"></i> {{Lang::get('resource.lbdocMyCourse')}}     </a>
                            </li>
                            @if($curDis->flow_id==2&& $curDis->is_active==1 && $curDis->apply_method==1 && session('Applicant')->nation_id == '001')
                            <li>
                              <a target="_blank" href="{{url('apply/docAppfeePDF/'.Crypt::encrypt($curDis->application_id)) }}"> <i class="fa fa-money"></i> {{Lang::get('resource.lbdocPayMyCourse')}}   </a>

                            </li>
                            @endif
                            @if($curDis->flow_id==2&& $curDis->is_active==1)
                            <li>

                              <a target="_blank" href="{{url('apply/docAppEnvelopPDF/'.Crypt::encrypt($curDis->application_id))}}"> <i class="fa fa-envelope"></i> {{Lang::get('resource.lbdocEnvelop')}} </a>
                            </li>
                            @endif

                          </ul>
                        </div>
                        @endif

                        <!--  <div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase">
                                          <div class="ribbon-sub ribbon-bookmark"></div>
                                          <i class="fa fa-star"></i>
                                          </div>
                                        -->
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="icon-clock font-green"></i>
                            <span class="caption-subject font-pink-chula bold uppercase">{{Lang::get('resource.lbWTodo')}}</span>
                          </div>

                        </div>
                        <div class="portlet-body">




                          <!-- ยังไม่ยืนยันการสมัคร -->
                          @if($curDis->flow_id==1 && $curDis->is_active==1)
                          <div class="mt-element-list">

                            <div class="mt-list-container list-simple">
                              <ul>
                                <li class="mt-list-item done">
                                  <div class="list-icon-container">
                                    <i class="icon-close"></i>
                                  </div>

                                  <div class="list-item-content">
                                    <h3 class="uppercase">
                                      <a href="javascript:;">{{Lang::get('resource.lbConfirmApply')}}</a>
                                    </h3>
                                    <div style="margin:10px 0px 10px 0px">
                                      <a class="btn  green" href="{{url('application/registerCourse/'.Crypt::encrypt($curDis->application_id))}}"> {{Lang::get('resource.lbConfirmApply')}}
                                        <i class="fa fa-check"></i>
                                      </a>
                                      <a class="btn btn-danger mt-sweetalert sweet-8" href="javascript:cancel({{$curDis->application_id}});">  {{Lang::get('resource.lbButtonRemoveApplication')}}
                                         <i class="fa fa-times"></i>
                                     </a>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <br/>
                          <div class="alert alert-danger">
                            <i class="icon-info"></i> {{Lang::get('resource.lbProcessTime')}} {{date('d-m-Y', strtotime($curDis->end_date )) }}
                          </div>



                          @endif @if($curDis->flow_id==2)
                          <div class="mt-element-list">

                            <div class="mt-list-container list-simple">
                              <ul>
                                <li class="mt-list-item">
                                  <div class="list-icon-container">
                                    <i class="font-red icon-close"></i>
                                  </div>

                                  <div class="list-item-content">
                                    <h3 class="uppercase">
                                                      <a href="javascript:;">{{Lang::get('resource.lbUpdateDocApply')}}</a>
                                                  </h3>
                                    <div style="margin:10px 0px 10px 0px">
                                      <a class="btn btn-circle blue btn-outline" href="{{url('application/confDocApply/'.Crypt::encrypt($curDis->application_id))}}"> {{Lang::get('resource.lbUpdateDocApply')}}
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                    </div>
                                  </div>
                                </li>
                                @if($curDis->apply_method==1 && session('Applicant')->nation_id == '001')
                                <li class="mt-list-item">
                                  <div class="list-icon-container">
                                    <i class="font-red icon-close"></i>
                                  </div>

                                  <div class="list-item-content">
                                    <h3 class="uppercase">
                                                      <a href="javascript:;">{{Lang::get('resource.lbTodolistPayment')}}</a>
                                                  </h3>
                                    <div style="margin:10px 0px 10px 0px">


                                      <span>   <i class="fa fa-money"></i><a target="_blank"  href="{{url('apply/docAppfeePDF/'.Crypt::encrypt($curDis->application_id))}}"> {{Lang::get('resource.lbBtnDownload')}} {{Lang::get('resource.lbdocPayMyCourse')}}   </a> </span>


                                    </div>
                                  </div>
                                </li>
                                @endif
                                <li class="mt-list-item">
                                  <div class="list-icon-container">
                                    <i class="font-red icon-close"></i>
                                  </div>
                                  <div class="list-item-content">
                                    <h3 class="uppercase">
                                                      <a href="javascript:;">{{Lang::get('resource.lbTodolistDocument')}}</a>
                                                  </h3>
                                    <div style="margin:10px 0px 10px 0px">
                                      @if($curDis->apply_method==1 && session('Applicant')->nation_id == '001')
                                      <span>   <i class="fa fa-money"></i><a   href="{{url('apply/docAppfeePDF/'.Crypt::encrypt($curDis->application_id))}}"> {{Lang::get('resource.lbdocPaymentEnvidence')}} ({{Lang::get('resource.lbTodolistPaymentBank')}})  </a> </span>
                                      <br/> @endif
                                      <span>    <i class="fa fa-envelope"></i> <a  href="{{url('apply/docAppEnvelopPDF/'.Crypt::encrypt($curDis->application_id))}}"> {{Lang::get('resource.lbdocEnvelop')}} </a>  </span>


                                    </div>
                                  </div>
                                </li>

                              </ul>
                            </div>
                          </div>
                          <br/>
                          <div class="alert alert-danger">
                            <i class="icon-info"></i> {{Lang::get('resource.lbProcessTime')}} {{date('d-m-Y', strtotime($curDis->end_date )) }}
                          </div>

                          @endif

                          <!-- รอพิจารณาสิทธิ์การสอบ-->
                          @if($curDis->flow_id==3 || $curDis->flow_id==4)
                          <h4 class=" text-center alert alert-success">{{Lang::get('resource.lbTodolistExamRightResultTitle')}}</h4>
                          <div class="mt-element-list">

                            <div class="mt-list-container list-simple">

                              <ul>
                                <li class="mt-list-item done">

                                  <div class="list-icon-container">
                                    {!! ($curDis->exam_id==1)? '<i class="icon-hourglass font-blue"></i>':''!!} {!! ($curDis->exam_id==2)?'<i class="icon-check font-green"></i>':''!!} {!! ($curDis->exam_id==3)?'<i class="icon-close font-red"></i>':''!!}
                                  </div>
                                  <div class="list-item-content">

                                    <h3 class="uppercase">
                                      <a href="javascript:;"> {{(session('locale')=='th')? $curDis->exam_name:$curDis->exam_name_en}}</a>
                                  </h3>
                                  @if($curDis->exam_id==2)
                                    <div style="margin:10px 0px 10px 0px">
                                      <a class="btn btn-circle blue btn-outline" id="examshow" exam="{{$curDis->exam_schedule}}" href="#exam-schedule-data" data-toggle="modal"> {{Lang::get('resource.lbTodolistViewExamTable')}}
                                        <i class="fa fa-table"></i>
                                      </a>
                                    </div>
                                    @endif
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <br/>

                          @if($curDis->exam_id==2 || $curDis->exam_id==3)
                          <div class="alert alert-info">
                            <i class="icon-info"></i> {{($curDis->exam_remark)?$curDis->exam_remark:''}}
                          </div>
                          @endif
                          <!-- Exam Table -->
                          <div id="exam-schedule-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                  <h4 class="modal-title">{{Lang::get('resource.lbTodolistViewExamTable')}}</h4>
                                </div>
                                <div class="modal-body">
                                  <p id="examtable"> </p>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif

                          <!-- รอพิจารณาสิทธิ์การเข้าศึกษา-->
                          @if($curDis->flow_id==5)
                          <h4 class=" text-center alert alert-success">{{Lang::get('resource.lbTodolistAdmissionRightResultTitle')}}</h4>
                          <div class="mt-element-list">

                            <div class="mt-list-container list-simple">

                              <ul>
                                <li class="mt-list-item done">

                                  <div class="list-icon-container">

                                    {!! ($curDis->admission_status_id=='0')? '<i class="icon-hourglass font-blue"></i>':''!!} {!! ($curDis->admission_status_id!='0' && $curDis->admission_status_id!='X')?'<i class="icon-check font-green"></i>':''!!} {!!
                                    ($curDis->admission_status_id=='X')?'
                                    <i class="icon-close font-red"></i>':''!!}
                                  </div>
                                  <div class="list-item-content">

                                    <h3 class="uppercase">
                            <a href="javascript:;">{{(session('locale')=='th')? $curDis->admission_status_name_th:$curDis->admission_status_name_en}}</a>
                        </h3>
                                    <div style="margin:10px 0px 10px 0px">
                                      <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbTodolistOrientationDate')}} <span class="label label-warning">{{$curDis->orientation_date}}</span> </div>
                                      <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbTodolistOrientationLocation')}} <span class="label label-warning">{{$curDis->orientation_location}}</span> </div>

                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <br/>
                          <div class="alert alert-info">

                            <i class="icon-info"></i> {{($curDis->admission_remark)?$curDis->admission_remark:''}}
                          </div>

                          @endif


                        </div>
                      </div>

                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="todo-tasklist-devider"> </div>

            </div>
          </div>
        </div>
      </div>
      <!-- END TODO CONTENT -->
    </div>
  </div>
  <!-- END PAGE CONTENT-->
</div>

@stop @push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>



<script type="application/javascript">
  function cancel($id) {
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this application form again!",
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, function() {
      setTimeout(function() {
        window.location.href = '{{url('apply/actionCourse/cancel')}}' + '/' + $id
      }, 100);
    });
  }
  jQuery(document).ready(function() {
    $('.todo-content').on('click', 'a', function() {
      if ($(this).attr('id') == "examshow") {
        $('#examtable').html($(this).attr('exam'));
      }
    });

  });
</script>
@endpush
