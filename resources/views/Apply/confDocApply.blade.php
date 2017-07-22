@extends('layouts.default')

@push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
<link href="../assets/pages/css/search.min.css" rel="stylesheet" type="text/css">
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
            <span>ปรับปรุงเอกสารที่ต้องส่ง</span>
        </li>
    </ul>

</div>
@stop

@section('pagetitle')
<h1 class="page-title"> ปรับปรุงเอกสารที่ต้องส่ง/Confirmation documents apply  </h1>

@stop


@section('maincontent')

<div class="search-page search-content-2">
 
    <p>   
        
        @foreach ($Datas as $Data)
         {{Lang::get('resource.lbDegree')}}  {{(session('locale') =='th')? $Data->degree_name:$Data->degree_name_en}}
           
        {{Lang::get('resource.lbProgarmID')}}	{{$Data->program_id.'    '.(session('locale') =='th')? $Data->prog_plan_name : $Data->prog_plan_name_en }}
        {{Lang::get('resource.lbSubject')}}	 {{(session('locale') =='th')? $Data->sub_major_name : $Data->sub_major_name_en}}  
        @endforeach    
    </p>   
    <div class="row">
        <div class="col-md-12">  
        
            <div class="search-container ">
                <ul> <form  action="{!! Route('submitDocApply') !!}" method="post" enctype="multipart/form-data" id="addData">     {{csrf_field()}}
                        <input type="hidden" name="application_id" value ="{{ $programID }}">
                            
                    <li class="search-item-header">    
                           <div class="row">
                                <div class="note note-info">
                                    <p>   {{Lang::get('resource.lbUpdateDocApply')}} </p>
                                </div>
                                <div class="col-md-9">
                                      @foreach ($Groups as $Group)
                                    <div class="form-group form-md-checkboxes">
                                        <label class="col-md-3 control-label" for="form_control_{{$loop->iteration}}"> {{(session('locale') =='th')? $Group->doc_apply_group : $Group->doc_apply_group_en }}</label>
                                        <div class="col-md-9">
                                            <div class="md-checkbox-list">
                                                @foreach ($Docs as $Doc)
                                                @if($Group->doc_apply_group == $Doc->doc_apply_group   )
                                                <div class="col-md-12 md-checkbox">
                                                    
                                                    <input class="md-check" id="checkbox{{$Doc->doc_apply_id}}" value="{{$Doc->doc_apply_id}}" name="checkbox{{$Doc->doc_apply_id}}" onclick=" $('#divFile{{$Doc->doc_apply_id}}').toggle($('#checkbox{{$Doc->doc_apply_id}}:checked').length > 0);  " type="checkbox"    
                                                            {{$val=false}}
                                                           @foreach($Files as $file)
                                                              @if($Doc->doc_apply_id == $file->doc_apply_id)
                                                              {{$val=true}}
                                                               @break
                                                              @endif
                                                            @endforeach 
                                                             
                                                           {{ ($val)? 'checked="checked"':''}}
                                                           {{($Doc->doc_apply_id==1)?'disabled="disabled" checked="checked"':'' }}   >
                                                    <label for="checkbox{{$Doc->doc_apply_id}}">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>   {{ (session('locale')=='th')? $Doc->doc_apply_detail:$Doc->doc_apply_detail_en}}  </label>            {!! ($Doc->doc_apply_id == 1)? "<a href='https://www.w3schools.com' target='_blank'>  ดูใบสมัคร </a>"  : "" !!}                                          
                                                </div><br> 
                                                @if( $Doc->flag_upload == 1)
                                                <div id="divFile{{$Doc->doc_apply_id}}"  {!! (!$val)? 'style="display:none"' :'' !!}  class="btn btn-default btn-file">
                                                    @if( $Doc->doc_apply_id == 16)
                                                    <br>   
                                                   
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text"  
                                                           @foreach($Files as $file)
                                                           {{($Doc->doc_apply_id == $file->doc_apply_id)? 'value='. $file->other_val .'' :' '}}
                                                            @endforeach 
                                                              class="form-control" name="other_val">
                                                    <label for="form_control_1">Other</label>
                                                    <span class="help-block">fill in here...</span>
                                                </div>
                                                    @endif
                                                    <input id="pfile_ID{{$Doc->doc_apply_id}}" valid="{{$Doc->doc_apply_id}}" name="pfile_ID{{$Doc->doc_apply_id}}" data-max-size="2048" accept=".gif,.jpg,.jpeg,.png,.pdf " class="upload-file" type="file" >
                                                        <p class="help-block">  
                                                            @foreach($Files as $file)
                                                           {{($Doc->doc_apply_id == $file->doc_apply_id)?  $file->file_origi_name :' '}}
                                                            @endforeach   </p>
                                                 </div><br><br>
                                                 @endif
                                                @endif
                                                @endforeach     
                                            </div>
                                        </div>                                        
                                    </div>
                                      @endforeach
                                </div> 
                            </div>
                               
                       
                    </li>
                    <li class="search-item clearfix">
                        <div style=" text-align: center;">  
                              <button type="submit" class="btn btn-lg blue  margin-bottom-5"> บันทึก/Save
                                <i class="fa fa-check"></i></button>
                           
                            <a class="btn btn-lg red   margin-bottom-5" href="{{url('apply/manageMyCourse/')}}">  ยกเลิก
                                <i class="fa fa-times"></i>
                            </a>
                        </div>           

                    </li>
 </form>
                </ul>

            </div>
            </form>
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



