@extends('layouts.default')

@push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/apps/css/todo-2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">

<style type="text/css">

</style>
@endpush

@section('pagebar')
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
    {{--<div class="page-tool    bar">--}}
    {{--<div class="btn-group pull-right">--}}
    {{--<butto    n type="button" class="btn green btn-sm btn-outline dropdown-toggle"--}}
    {{--data-toggl    e="dropdown"> Actions--}}
    {{--<i class="fa f    a-angle-down"></i>--}}
    {{--</button>--}}
        {{--<ul clas    s="dropdown-menu pull-right" role="menu">--}}
        {{--<li>--}}
        {{--<a href="#">-    -}}
        {{--<i cl    ass="icon-bell"></i> Action</    a>--}}
                {{--                                            </li>--}}
                    {{--                <li>--}}
                                            {{--<a href="#">--}}
        {{--<i class="icon-shield"></i> Another action</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="#">--}}
                {{--<i class="ico                n-user"></i> Something else h                ere</a>--}}
                {{--</li>--}}
                    {{--                <li class="divider"></li>--}}
                    {{--<li>--}}
                                             {{--<a href="#">--}}
                                            {{--<i class="icon-bag"></i> Separated link</a>--}}
                {{--</li>--}}
                {{--</ul>--}                }
                                     {{--</div>--}}
                  {{--</div>--}}
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title"> {{Lang::get('resource.lbManageCouse')}}</h1>

@stop


@section('maincontent')


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

                            <span class="caption-subject font-green-sharp bold uppercase"> {{Lang::get('resource.lbManageCouse')}}</span>
                        </div>

                    </div>
                    <!-- end PROJECT HEAD -->
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-4">
                                <div class="todo-tasklist">

          @foreach ($Apps as $curDis)

                                    <div class="todo-tasklist-item todo-tasklist-item-border-green">

                                        <div class="todo-tasklist-item-title"> <h4>{{$curDis->program_id}} {{  ($curDis->thai != '')?(session('locale')=='th')?  $curDis->thai : $curDis->english:'-'   }}

                                         {{  ($curDis->sub_major_id != '')?(session('locale')=='th')?' - แขนงวิชา '. $curDis->sub_major_name:' - '.$curDis->sub_major_name_en :'-'}}
                                        </h4>

                                          <i class="fa fa-book"></i> {{ (session('locale')=='th')?$curDis->prog_plan_name : $curDis->prog_plan_name_en }}
                                            <br/>
                                          <i class="fa fa-mortar-board"></i> {{ (session('locale')=='th')?$curDis->prog_type_name : $curDis->prog_type_name_en }}
                                          ({{$curDis->office_time}})

                                          </div>
                                        <div class="todo-tasklist-item-text">
                                          {{  ($curDis->major_name != '')?(session('locale')=='th')? 'สาขาวิชา'.$curDis->major_name:'Major in '.$curDis->major_name_en .', ':'-'}}
                                          {{ (session('locale')=='th')? $curDis->department_name:$curDis->department_name_en.', '   }}

                                          {{(session('locale')=='th')? 'คณะ'.$curDis->faculty_name:$curDis->faculty_full.' '}}
                                          <!--  {{  ($curDis->degree_name != '')?(session('locale')=='th')? $curDis->degree_name:$curDis->degree_name_en :'-'}}-->

                                        </div>
                                        <br/>
                                        <div class="todo-tasklist-item-text">  {{Lang::get('resource.lbDocID')}}  <span class="label label-warning">{{$curDis->app_id}}</span> </div>
                                        <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbAppNo')}}  <span class="label label-warning">{{$curDis->curriculum_num}}</span>  </div>


                                        <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbStatus')}}   <span class="label label-success">{{  ($curDis->flow_name != '')?(session('locale')=='th')?  $curDis->flow_name : $curDis->flow_name_en:'-'   }} </span> </div>
                                        <div class="todo-tasklist-controls pull-left">
                                            <span class="todo-tasklist-date">
                                                <i class="fa fa-calendar"></i> {{$curDis->appDates}} </span>

                                                <div  class="col-md-12 col-md-offset-1 portlet mt-element-ribbon light portlet-fit bordered">
<div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase">
<div class="ribbon-sub ribbon-bookmark"></div>
<i class="fa fa-star"></i>
</div>
<div class="portlet-title">
<div class="caption">
<i class="icon-clock font-green"></i>
<span class="caption-subject font-green bold uppercase">{{Lang::get('resource.lbWTodo')}}</span>
</div>
</div>
<div class="portlet-body">  @if($curDis->flow_id==1 && $curDis->is_active==1)
                                                    <a class="btn  blue" href="{{url('apply/registerCourse/'.$curDis->application_id )}}"> {{Lang::get('resource.lbConfirmApply')}}
                                                        <i class="fa fa-check"></i>
                                                    </a>   <a class="btn btn-danger mt-sweetalert sweet-8"  href="javascript:cancel({{$curDis->application_id}});"   >  {{Lang::get('resource.lbButtonRemoveApplication')}}
                                                        <i class="fa fa-times"></i>
                                                    </a>




                            @endif
                            @if($curDis->flow_id==2)
                                                    <a class="btn  blue" href="{{url('apply/confDocApply/'.$curDis->application_id )}}"> {{Lang::get('resource.lbUpdateDocApply')}}
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                            <div class="btn-group dropup">
                                                                    <button class="btn green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Download <i class="icon-cloud-download"></i></button>
                                                                    <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                      <i class="fa fa-angle-up"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                                        <li>
                                                                            <span>  <i class="fa fa-file-o"></i> <a   href="{{url('apply/docMyCourse/'.$curDis->application_id )}}"> {{Lang::get('resource.lbdocMyCourse')}}     </a> </span>  </li>
                                                                      @if($curDis->apply_method==1 && session('Applicant')->nation_id == '001')
                                                                        <li>
                                                                          <span>   <i class="fa fa-money"></i><a   href="{{url('apply/docAppfeePDF/'.$curDis->application_id )}}"> {{Lang::get('resource.lbdocPayMyCourse')}}   </a> </span>   </li>
                                                                      @endif
                                                                        <li>
                                                                           <span>    <i class="fa fa-envelope"></i> <a  href="{{url('apply/docAppEnvelopPDF/'.$curDis->application_id )}}"> {{Lang::get('resource.lbdocEnvelop')}} </a>  </span>    </li>
                                                                    </ul>
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

@stop


@push('pageJs')
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
}, function () {
  setTimeout(function () {
   window.location.href = '{{ url('apply/actionCourse/cancel') }}' + '/' +$id
  }, 100);
});
         }



</script>
@endpush
