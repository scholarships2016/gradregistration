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

    <p>  หลักสูตร Degree	วิทยาศาสตรมหาบัณฑิต - Master of Science
        รหัสหลักสูตร Program ID	1242 - - ปริญญาโท
        สาขา Subject	สถาปัตยกรรม.      </p>   
    <div class="row">
        <div class="col-md-12">
            <div class="search-container ">
                <ul>
                    <li class="search-item-header">
                        <form id="addData">
                            <div class="row">
                                <div class="note note-info">
                                    <p> ปรับปรุงข้อมูลเอกสารที่สมัคร Please update documents for apply </p>
                                </div>
                                <div class="col-md-9">
                                      @foreach ($Groups as $Group)
                                    <div class="form-group form-md-checkboxes">
                                        <label class="col-md-3 control-label" for="form_control_1">{{$Group->doc_apply_group }}</label>
                                        <div class="col-md-9">
                                            <div class="md-checkbox-list">
                                                @foreach ($Docs as $Doc)
                                                @if($Group->doc_apply_group == $Doc->doc_apply_group)
                                                <div class="md-checkbox">
                                                    <input class="md-check" id="checkbox{{$loop->iteration}}}" type="checkbox">
                                                    <label for="checkbox1_1">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> {{$Doc->doc_apply_detail}} </label>
                                                </div>
                                                @endif
                                                @endforeach     
                                            </div>
                                        </div>                                        
                                    </div>
                                      @endforeach
                                </div> 
                            </div>
                               
                        </form>
                    </li>
                    <li class="search-item clearfix">
                        <div style=" text-align: center;">       <a class="btn btn-lg blue  margin-bottom-5" href="{{url('apply/manageMyCourse/')}}"> บันทึก/Save
                                <i class="fa fa-check"></i>
                            </a>
                            <a class="btn btn-lg red   margin-bottom-5" href="{{url('apply/manageMyCourse/')}}">  ยกเลิก
                                <i class="fa fa-times"></i>
                            </a>
                        </div>           

                    </li>

                </ul>

            </div>
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



