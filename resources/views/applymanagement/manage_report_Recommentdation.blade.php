@extends('layouts.defaultNoMenu')

@push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
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
            <span>ฟอร์มออกหนังสือรับรอง</span>
        </li>
    </ul>
    {{--<div class="page-tool    bar">--}}
    {{--<div class="btn-group pull-right">--}}
    {{--<button type="button" class="btn green btn-sm btn-outline dropdown-toggle"--}}
    {{--data-toggle="dropdown"> Actions--}}
    {{--<i class=         "fa                             fa-angle-down"></i>--}}
                            {{--</button>--}}
                                              {{--<ul                            class="dropdown-menu pull-ri                            ght" role="menu">--}}
                                              {{--<li>--}}
                                              {{--<a href="#">--}}
                                    {{--<i class="icon-bell"></i>  Action</a>--}}
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
                                                                                                                             {{--                                                                                                                                       </div>--}}
                                                                                                                             {{--</div>--}}
    </div>
@stop

@section('pagetitle')
<h1 class ="page-title">ฟอร์มออกหนังสือรับรอง</h1>
@stop


@section('maincontent')
 <div class="row">
            <div class="col-md-12">
                                                                                                                                                               <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                                                                                                                                                       <div class="portlet light bordered">
                                                                                                                                                                                                           <div class="portlet-title">
                                                                                                                                                                                                               <div class="caption font-dark">
                                                                                                                <i class="icon-settings font-dark"></i>
                                                                                                                <span class="caption-subject bold uppercase">ฟอร์มออกหนังสือรับรอง</span> 
                                                                                                            </div>

                                                                                                        </div>
                                                                                                        <div class="portlet-body">
 <form action="{!! Route('docRecommenPDF') !!}" method="GET" target="_blank" class="form-horizontal">
                                                                                                                               
                                                                                                            <div class="table-toolbar">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12">

                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-12 text-center">
                                                                                                                                <h3>บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย</h3>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-12">
                                                                                                                                    <div class="form-body">
                                                                                                                                        <br>
                                                                                                                                        <div class="row">
                                                                                                                                            <label class="col-md-1 control-label">ที่</label>
                                                                                                                                            <div class="col-md-1">
                                                                                                                                                <input type="text" id='round'  name='round' value="{{$round}}" class="form-control input-xsmall" placeholder="">
                                                                                                                                            </div>
                                                                                                                                            <label class="col-md-1 control-label">/</label>
                                                                                                                                            <div class="col-md-1">
                                                                                                                                                <input type="text" value="{{$year}}" id='year' name='year' class="form-control input-xsmall" placeholder="">
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <br>
                                                                                                                                        <br>
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-md-12 text-center font-bold">
                                                                                                                                                <h4>หนังสือรับรอง<br>บัณฑิตวิทยาลัย ขอรับรองว่า</h4>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <br>
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-md-1 col-md-offset-4">
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <input type="text" class="form-control input-xsmall" value="{{$title}}" id='title' name='title' placeholder="">
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            <div clsss="col-md-4">
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <h4>{{$name}}</h4>
                                                                                                                                                    <input type="hidden" id="names" name="names" value="{{$name}}">
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>


                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-md-12">
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <textarea class="form-control" id='detail' name='detail'   rows="3">{{$detail}} </textarea>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <br>
                                                                                                                                        <br>
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="form-group">
                                                                                                                                                <label class="col-md-3 col-md-offset-1 control-label">ให้ไว้ ณ วันที่</label>
                                                                                                                                                <div class="col-md-4">
                                                                                                                                                    <input type="text" id='dateMake' name='dateMake'  value="{{$dateMake}}" class="form-control input" placeholder="">
                                                                                                                                                </div>
                                                                                                                                            </div>

                                                                                                                                        </div>
                                                                                                                                        <br>
                                                                                                                                        <br>
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="form-group">
                                                                                                                                                <label class="col-md-3 col-md-offset-1 control-label">ลงชื่อ</label>
                                                                                                                                                <div class="col-md-6">
                                                                                                                                                    <select class="form-control" name="doctor">
                                                                                                                                                        @foreach($approves as $approve) 
                                                                                                                                                        <option>{{$approve->cert_appr_name}}|{{$approve->cert_appr_position}}{{($approve->cert_appr_position_desc)?'|'.$approve->cert_appr_position_desc:''}}</option>
                                                                                                                                                        @endforeach

                                                                                                                                                    </select>
                                                                                                                                                </div>
                                                                                                                                            </div>

                                                                                                                                        </div>

                                                                                                                                    </div>
                                                                                                                                

                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                            <hr>
                                                                                                            <div class="form-actions">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-offset-4 col-md-8">
                                                                                                                        <a href="javascript:window.open('','_self').close();" class="btn grey-steel">ยกเลิก</a>
                                                                                                                        <button  type="submit" value='submit'   class="btn green"><i class="fa fa-file-text-o"></i> ออกรายงาน</button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
</form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- END EXAMPLE TABLE PORTLET-->
                                                                                                </div>
                                                                                            </div>
                                                                                            @stop


                                                                                            @push('pageJs')
                                                                                            <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>

                                                                                            <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
                                                                                            <script src="{{asset('assets/pages/scripts/table-datatables-ajax.js')}}" type="text/javascript"></script>
                                                                                            <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
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
                                                                                            <script src="{{asset('js/components-select2-gs03-gs05.js')}}" type="text/javascript"></script>

                                                                                            <script type="application/javascript">
     
                                                                                            
                                                                                             
                                                                                            </script>
                                                                                            @endpush
