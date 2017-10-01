@extends('layouts.default') @push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/pages/css/search.min.css')}}" rel="stylesheet" type="text/css">

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
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>{{Lang::get('resource.lbConfirmationDoc')}}</span>
    </li>
  </ul>

</div>
@stop @section('pagetitle')
<h1 class="page-title">{{Lang::get('resource.lbConfirmationDoc')}}</h1> @stop @section('maincontent')

<div class="search-page search-content-2">
  <div class="row">
    <div class="col-md-12">
      <div class="note note-pink">

        <p>
          @foreach ($Datas as $Data)
          <?php
                    // print_r($Data);
                     ?>
            <div class="row static-info">
              <div class="col-md-3 name"> {{Lang::get('resource.lbMajor')}}: </div>
              <div class="col-md-9 value"> {{(session('locale') =='th')? $Data->program_id : $Data->program_id }} {{(session('locale') =='th')? $Data->thai:$Data->english}}
                <br/>
                <i class="fa fa-book"></i> {{ (session('locale')=='th')?$Data->prog_plan_name : $Data->prog_plan_name_en }}
                <br/>
                <i class="fa fa-mortar-board"></i> {{ (session('locale')=='th')?$Data->prog_type_name : $Data->prog_type_name_en }} ({{ (session('locale')=='th')?$Data->office_time : $Data->office_time_en }})

              </div>
            </div>

            <div class="row static-info">
              <div class="col-md-3 name"> {{Lang::get('resource.lbSubMajor')}}: </div>
              <div class="col-md-9 value"> {{(session('locale') =='th')? $Data->sub_major_name : $Data->sub_major_name_en}}</div>
            </div>
            <div class="row static-info">
              <div class="col-md-3 name"> {{Lang::get('resource.lbSubject')}}: </div>
              <div class="col-md-9 value">

                {{(session('locale') =='th')?'สาขาวิชา'. $Data->major_name :'Major in '. $Data->major_name_en.','}} {{(session('locale') =='th')?''. $Data->department_name : $Data->department_name_en.','}} {{(session('locale') =='th')?'คณะ'. $Data->faculty_name : $Data->faculty_full.','}}

              </div>
            </div>



            @endforeach
        </p>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="m-heading-1 border-yellow-lemon m-bordered">
        <h3>
                <span class="item">
                  <span aria-hidden="true" class="icon-info"></span>
                  {{Lang::get('resource.lbUpdateDocApply')}}

                </span>
              </h3>
                <p>  {!!Lang::get('resource.lbUpdateDocApplyInstructions')!!}</p>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="search-container ">
        <form action="{!! Route('submitDocApply') !!}" method="post" enctype="multipart/form-data" id="addData"> {{csrf_field()}}
          <input type="hidden" name="application_id" value="{{ $programID }}">
           <input type="hidden" name="Year" value="{{ $Year }}">
           <input type="hidden" name="Flo" value="{{ $Flo }}">
          <div class="row">

            <div class="col-md-9">
              @foreach ($Groups as $Group)
              <div class="form-group form-md-checkboxes">
                <label class="col-md-3 control-label" for="form_control_{{$loop->iteration}}"> {{(session('locale') =='th')? $Group->doc_apply_group : $Group->doc_apply_group_en }}</label>
                <div class="col-md-9">
                  <div class="md-checkbox-list">
                    @foreach ($Docs as $Doc) @if($Group->doc_apply_group == $Doc->doc_apply_group )
                    <div class="col-md-12 md-checkbox">

                      <input class="md-check" id="checkbox{{$Doc->doc_apply_id}}" value="{{$Doc->doc_apply_id}}" name="checkbox{{$Doc->doc_apply_id}}" onclick=" $('#divFile{{$Doc->doc_apply_id}}').toggle($('#checkbox{{$Doc->doc_apply_id}}:checked').length > 0);  " type="checkbox"
                        {{$val=false}} @foreach($Files as $file) @if($Doc->doc_apply_id == $file->doc_apply_id) {{$val=true}} @break @endif @endforeach {{ ($val)? 'checked="checked"':''}} {{($Doc->doc_apply_id==1)?'disabled="disabled"
                      checked="checked"':'' }} >
                      <label for="checkbox{{$Doc->doc_apply_id}}">
                                                     <span class="inc"></span>
                                                     <span class="check"></span>
                                                     <span class="box"></span>   {{ (session('locale')=='th')? $Doc->doc_apply_detail:$Doc->doc_apply_detail_en}}  </label> {!!($Doc->doc_apply_id == 1)? "<a href='".url('apply/docMyCourse/').'/'.$programID."' class='btn btn-circle green btn-outline' target='_blank'> <i class='fa fa-file-pdf-o'></i>  Download </a>" : "" !!}
                    </div><br> @if( $Doc->flag_upload == 1)
                    <div id="divFile{{$Doc->doc_apply_id}}" {!! (!$val)? 'style="display:none"' : '' !!} class="btn btn-default btn-file">
                      @if( $Doc->doc_apply_id == 16)
                      <br>

                      <div class="form-group form-md-line-input form-md-floating-label">
                        <input type="text" @foreach($Files as $file) {{($Doc->doc_apply_id == $file->doc_apply_id)? 'value='. $file->other_val .'' :' '}} @endforeach class="form-control" name="other_val">
                        <label for="form_control_1">Other</label>
                        <span class="help-block">fill in here...</span>
                      </div>
                      @endif
                      <input id="pfile_ID{{$Doc->doc_apply_id}}" valid="{{$Doc->doc_apply_id}}" name="pfile_ID{{$Doc->doc_apply_id}}" data-max-size="2048" accept=".gif,.jpg,.jpeg,.png,.pdf " class="upload-file" type="file" @if(session('user_type')->user_type == 'GradStaff' || session('user_type')->user_type == 'FacStaff') style="display:none;"@endif>
                      <p class="help-block">

                        @foreach($Files as $file) @if($Doc->doc_apply_id == $file->doc_apply_id) {{ $file->file_origi_name }}
                        <a href="{{route('downloadMediaFile',['file_id' => Crypt::encrypt($file->file_gen_name) ])}}" target="_blank" class="btn btn-xs green" download>
                                                              Download
                                                             <i class="fa fa-download"></i>
                                                            </a> @endif @endforeach

                      </p>
                    </div><br><br> @endif @endif @endforeach
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>



          @if(session('user_type')->user_type != 'GradStaff' && session('user_type')->user_type != 'FacStaff')
            <div style=" text-align: center;">
              <button type="submit"  {{ ($Flo > 3)?'disabled':'' }} class="btn btn-lg blue  margin-bottom-5">
                {{Lang::get('resource.lbSave')}}
                <i class="fa fa-check"></i></button>
              <a class="btn btn-lg grey-steel   margin-bottom-5" href="{{url('application/manageMyCourse/')}}">
                {{Lang::get('resource.lbCancel')}}
                <i class="fa fa-times"></i>
              </a>
            </div>
        @endif



        </form>


      </div>

    </div>

  </div>

</div>


@stop @push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
<script type="application/javascript">
</script>
@endpush
