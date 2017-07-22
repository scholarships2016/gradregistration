@extends('layouts.default')

@push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/apps/css/todo-2.min.css')}}" rel="stylesheet" type="text/css">
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
                            <span class="caption-subject font-gree                    n-sharp bold uppercase">Status </span>
                            <span class="caption-helper visible-sm-inline-block visible-xs-inline-block">click to view project list</span>
                        </div>

                    </div>
                    <div class="portlet-body todo-project-list-content" style="height: auto;">
                        <div class="todo-project-list">
                            <ul class="nav nav-stacked">
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-info"> 5 </span>รอผู้สมัครยืนยัน </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-success"> 0 </span>รอผู้สมัครชำระค่าธรรมเนียม และส่งเอกสาร</a>
                                </li>
                                <li  >
                                    <a href="javascript:;">
                                        <span class="badge badge-success"> 0 </span> ได้รับค่าธรรมเนียมแล้ว</a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-default"> 0 </span> บัณฑิตได้รับเอกสารแล้ว </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-info"> 0 </span> รอประกาศผล </a>
                                </li>

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

                            <span class="caption-subject font-green-sharp bold uppercase">หลักสูตรที่สมัคร</span>
                        </div>

                    </div>
                    <!-- end PROJECT HEAD -->
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-4">
                                <div class="todo-tasklist">

          @foreach ($Apps as $curDis)
                         
                                    <div class="todo-tasklist-item todo-tasklist-item-border-green">

                                        <div class="todo-tasklist-item-title"> {{Lang::get('resource.lbMajor')}} {{  ($curDis->sub_major_name != '')?(session('locale')=='th')?  $curDis->sub_major_name : $curDis->sub_major_name_en:'-'   }}. </div>
                                        <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbDocID')}}  [{{$curDis->app_id}}]  </div>
                                        <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbMajorCode')}} : {{  $curDis->major_code   }} {{Lang::get('resource.lbMajor')}}{{  ($curDis->major_name != '')?(session('locale')=='th')? $curDis->major_name:$curDis->major_name_en :'-'}}     {{Lang::get('resource.lbSubject')}}{{  ($curDis->sub_major_name != '')?(session('locale')=='th')?  $curDis->sub_major_name : $curDis->sub_major_name_en:'-'   }}   </div>
                                        <div class="todo-tasklist-item-text"> {{Lang::get('resource.lbStatus')}} : {{  ($curDis->flow_name != '')?(session('locale')=='th')?  $curDis->flow_name : $curDis->flow_name_en:'-'   }} </div>
                                        <div class="todo-tasklist-controls pull-left">
                                            <span class="todo-tasklist-date">
                                                <i class="fa fa-calendar"></i> {{$curDis->appDates}} </span>
                                               
                                                <div  class="col-md-12 col-md-offset-4 portlet mt-element-ribbon light portlet-fit bordered"> 
<div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase"> 
<div class="ribbon-sub ribbon-bookmark"></div> 
<i class="fa fa-star"></i> 
</div> 
<div class="portlet-title"> 
<div class="caption"> 
<i class=" icon-layers font-green"></i> 
<span class="caption-subject font-green bold uppercase">{{Lang::get('resource.lbWTodo')}}</span> 
</div> 
</div> 
<div class="portlet-body">  @if($curDis->flow_id==1)
                                                    <a class="btn  blue" href="{{url('apply/registerCourse/'.$curDis->application_id )}}"> {{Lang::get('resource.lbConfApp')}}
                                                        <i class="fa fa-check"></i>
                                                    </a>   <a class="btn red " href="{{url('apply/actionCourse/cancel/'.$curDis->application_id )}}">  {{Lang::get('resource.lbCancel')}}
                                                        <i class="fa fa-times"></i>
                                                    </a> 
                           @endif 
                            @if($curDis->flow_id==2)
                                                    <a class="btn  blue" href="{{url('apply/confDocApply/'.$curDis->application_id )}}"> {{Lang::get('resource.lbUpdateDoc')}}
                                                        <i class="fa fa-check"></i>
                                                    </a>    
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
<script type="application/javascript">

</script>
@endpush



