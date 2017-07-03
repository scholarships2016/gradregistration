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
                <a href="{{url('home/')}}">{{Lang::get('resource.lbMHome')}}</a>
                <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{Lang::get('resource.lbMApply')}}</span>
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
    <h1 class="page-title"> 
        {{Lang::get('resource.lbMApply')}}
    </h1>
@stop
 

@section('maincontent')
        <div class="mt-element-step">
    <div class="row step-line">
                                                  @foreach ($announcements as $announcement)
                                                                           <div data-index="{{$loop->iteration}}" class="col-md-3 mt-step-col    {{(1 == $loop->iteration)?'active':''}}  {{($loop->iteration==1)?'first':''}} {{($loop->last)?'last':''}} ">
                                                                              <div class="mt-step-number bg-white">{{$loop->iteration}}</div>
                                                                             
                                                                              <div class="mt-step-title uppercase font-grey-cascade">{{  (session('locale')=='th')?  $announcement->anno_title : $announcement->anno_title_en  }}</div>
                                                                             </div>



@endforeach    
                                                                           
                                                                          </div> </div>
   
<div class="mt-content border-grey-steel">
@foreach ($announcements as $announcement)
 <div class="anno-detail" data-index="{{$loop->iteration}}" {{ ( 1 != $loop->iteration)? '  style=display:none;  ' : '' }}  > 
     {!! (session('locale')=='th')?  $announcement->anno_detail :$announcement->anno_detail_en !!}
 </div>
 @endforeach    
                                                        </div>
<br><br>
<div style='width:100%;text-align: center;'>
<input type='hidden' value='{{$startstep}}' id='hidstep'> 
<a href="javascript:;" id="pre-btn"  class="btn btn-circle red btn-outline">{{Lang::get('resource.lbPrevious')}}</a>  
<a href="javascript:;" id="next-btn" class="btn btn-circle red btn-outline">{{Lang::get('resource.lbNext')}}</a>
</div>
<br>

                                                                          @stop


                                                                          @push('pageJs')
                                                                          <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
                                                                          <script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
                                                                          <script type="application/javascript">
                                                                             $(document).ready(function(){  
                                                                              $('#pre-btn').click(function(){ changeStep(1);  });
                                                                              $('#next-btn').click(function(){ changeStep(2);  });
                                                                                });
                                                                                function changeStep($id){
                                                                                    $oldstep = parseInt($("#hidstep").val()) ;                                                                         
                                                                                    $step = ($id==2)? ($oldstep < $('.mt-step-col').length)? $oldstep + 1 : $oldstep :($step > 1)? $oldstep - 1 : 1 ;  
                                                                                        $('.mt-step-col').each(function(index,item) { 
                                                                                            if(parseInt($(item).data('index'))==$step ){
                                                                                               $( this ).addClass( "active" );                                                                                               
                                                                                           } else{
                                                                                                $( this ).removeClass( "active" );
                                                                                           }
                                                                                           if(parseInt($(item).data('index'))<$step ){
                                                                                               $( this ).addClass( "done" );                                                                                               
                                                                                           } else{
                                                                                                $( this ).removeClass( "done" );
                                                                                           }
                                                                                         });
                                                                                         
                                                                                          $('.anno-detail').each(function(index,item) { 
                                                                                            if(parseInt($(item).data('index'))==$step ){
                                                                                               $( this ).removeAttr( 'style' );;                                                                                               
                                                                                           } else{
                                                                                                $( this ).css("display", "none")
                                                                                           }                                                                                           
                                                                                         });     
                                                                                         if($step == $('.mt-step-col').length){
                                                                                               $("#next-btn").text('สมัคร/Register');                                                                                         
                                                                                         }else{
                                                                                               $("#next-btn").text('ถัดไป/Next');
                                                                                               $("#next-btn").removeAttr('href');
                                                                                         }
                                                                                         if($oldstep==$('.mt-step-col').length){   $("#next-btn").attr('href','{{(session('user_id'))? url('apply/register/'): url('login/')}}');}                                                                                          
                                                                                         $("#hidstep").val($step);                                                                                      
                                                                                }
                                                                          </script>
                                                                          @endpush

