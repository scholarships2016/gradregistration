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
    <h1 class="page-title"> Graduate Student Registration
        
    </h1>
@stop
 

@section('maincontent')
        <div class="mt-element-step">
    <div class="row step-line">
                                                  @foreach ($announcements as $announcement)
                                                                           <div data-index="{{$loop->iteration}}" class="col-md-3 mt-step-col    {{(1 == $loop->iteration)?'active':''}}  {{($loop->iteration==1)?'first':''}} {{($loop->last)?'last':''}} ">
                                                                              <div class="mt-step-number bg-white">{{$loop->iteration}}</div>
                                                                             
                                                                              <div class="mt-step-title uppercase font-grey-cascade">{{explode('<br>', $announcement->anno_title, 2)[0]}}</div>
                                                                              <div class="mt-step-content font-grey-cascade">{{(explode('<br>', $announcement->anno_title, 2)[1])?explode('<br>', $announcement->anno_title, 2)[1]:''}}</div>
                                                                          </div>



@endforeach    
                                                                           
                                                                          </div> </div>
   
<div class="mt-content border-grey-steel">
@foreach ($announcements as $announcement)
 <div class="anno-detail" data-index="{{$loop->iteration}}" {{ ( 1 != $loop->iteration)? '  style=display:none;  ' : '' }}  > 
     {!! $announcement->anno_detail !!}
 </div>
 @endforeach    
                                                        </div>
<br><br>
<div style='width:100%;text-align: center;'>
<input type='hidden' value='{{$startstep}}' id='hidstep'> 
<a href="javascript:;" id="pre-btn"  class="btn btn-circle red btn-outline">ก่อนหน้า/Previous</a>  
<a href="javascript:;" id="next-btn" class="btn btn-circle red btn-outline">ถัดไป/Next</a>
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
                                                                                         if($oldstep==$('.mt-step-col').length){   $("#next-btn").attr('href','apply/register/');}                                                                                          
                                                                                         $("#hidstep").val($step);                                                                                      
                                                                                }
                                                                          </script>
                                                                          @endpush

