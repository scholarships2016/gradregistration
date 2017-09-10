@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
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
          <span>{{Lang::get('resource.lbAnnouncementTitle')}}</span>
          <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{Lang::get('resource.lbSetting').Lang::get('resource.lbAnnouncementTitle')}}</span>
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
<h1 class="page-title">{{Lang::get('resource.lbSetting').' '.Lang::get('resource.lbAnnouncementTitle')}}
</h1>
@stop


@section('maincontent')



                        <div class="portlet light bordered">
                          <div class="portlet-title">
                                      <div class="caption">
                                          <i class="icon-speech font-green"></i>
                                          <span class="caption-subject bold font-green uppercase">ฟอร์ม ข่าว&ประกาศ</span>
                                      </div>
                                      <div class="actions">

                                          <a href="javascript:window.history.back();" class="btn btn-circle blue-steel btn-outline">
                                              <i class="fa fa-mail-reply"></i> กลับหน้าหลัก </a>

                                      </div>
                                  </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                  <form action="{!! Route('postAnnounc') !!}" id="form_sample_1" class="form-horizontal" method='post' novalidate="novalidate">
                                      <input type='hidden' id='_token' name='_token' value='{{ csrf_token() }}'>
                                      <div class="form-body">
                                              <div class="alert alert-danger display-hide">
                                                  <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                              <div class="alert alert-success display-hide">
                                                  <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                              <div class="form-group">
                                                  <label class="control-label col-md-3">รหัส    </label>
                                                  <div class="col-md-4">
                                                      <input type="text" readonly name="anno_id" value="{{$anno_id}}"  class="form-control" placeholder=""> </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label col-md-3">หัวข้อ ภาษาไทย
                                                      <span class="required" aria-required="true"> * </span>
                                                  </label>
                                                  <div class="col-md-9">
                                                      <input type="text" name="anno_title" value="{{$anno_title}}" data-required="1" class="form-control"> </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="control-label col-md-3">รายละเอียด ภาษาไทย

                                                  </label>
                                                  <div class="col-md-9">
                                                    <textarea class="ckeditor form-control" data-required="1" name="anno_detail" rows="6" data-error-container="#editor1_error">{{$anno_detail}}</textarea>
                                                        <div id="editor1_error"> </div>
                                                       </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label col-md-3">หัวข้อ ภาษาอังกฤษ
                                                      <span class="required" aria-required="true"> * </span>
                                                  </label>
                                                  <div class="col-md-9">
                                                      <input type="text" name="anno_title_en" value="{{$anno_title_en}}" data-required="1" class="form-control"> </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label col-md-3">รายละเอียด ภาษาอังกฤษ

                                                  </label>
                                                  <div class="col-md-9">
                                                    <textarea class="ckeditor form-control" name="anno_detail_en" rows="6" data-error-container="#editor2_error">{{$anno_detail_en}}</textarea>
                                                      <div id="editor2_error"> </div> </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="control-label col-md-3">ลำดับการแสดง

                                                  </label>
                                                  <div class="col-md-4">
                                                    <select class="form-control" name="anno_seq">
                                                        @for ($i = 0; $i < 20; $i++)
                                                            <option {{($anno_seq == ($i+1))?'selected':''}} value="{{$i+1}}">{{$i+1}}</option>
                                                        @endfor


                                                        </select>
                                                     </div>
                                              </div>


                                              <div class="form-group">
                                                  <label class="control-label col-md-3">เปิดแสดง?
                                                      <span class="required" aria-required="true"> * </span>
                                                  </label>
                                                  <div class="col-md-4">
                                                    <div class="mt-radio-inline" data-error-container="#form_2_membership_error">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="anno_flag" value="1" {{($anno_flag  == 1)?'checked':''}} > Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="anno_flag" value="0" {{($anno_flag  == 0)?'checked':''}}> No
                                                                <span></span>
                                                            </label>

                                                        </div>

                                                  </div>
                                              </div>


                                          </div>
                                          <div class="form-actions">
                                              <div class="row">
                                                  <div class="col-md-offset-3 col-md-9">

                                                      <a  href='javascript:window.history.back();' class="btn grey-steel">ยกเลิก</a>
                                                      <button type="submit" class="btn green">บันทึก</button>

                                                  </div>
                                              </div>
                                          </div>
                                      </form>

                                </div>
                            </div>
                        </div>





@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/table-datatables-ajax.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.mockjax.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
 <script src="{{asset('/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/ckeditor/ckeditor_full/ckeditor.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/pages/scripts/form-validation.min.js')}}" type="text/javascript"></script>
 <script type="application/javascript">

     </script>
@endpush
