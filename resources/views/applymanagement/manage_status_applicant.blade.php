@extends('layouts.default')

@push('pageCss')
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
 <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/> 
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css">
 
<link href="{{asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}" rel="stylesheet" type="text/css">

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
            <span>ปรับปรุงผู้มีสิทธิ์สอบ [GS03]</span>
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
<h1 class="page-title">ปรับปรุงผู้มีสิทธิ์สอบ [GS03]
   
</h1>
@stop


@section('maincontent')
 <div class="row">
            <div class="col-md-12">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">ข้อมูลผู้สมัคร</span>
                  </div>
                  <div class="actions">
                    <div class="btn-group pull-right">
                      <button class="btn blue-steel  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                  <i class="fa fa-angle-down"></i>
                                              </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a href="javascript:window.print();">
                                                          <i class="fa fa-print"></i> Print </a>
                        </li>

                        <li>
                          <a href="javascript:;">
                                                          <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="portlet-body">

                  <div class="table-toolbar">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="m-heading-1 border-green m-bordered">
                          <h3><span class="badge badge-success">1</span> ค้นหาหลักสูตร</h3>
                          <p>
                            </p><div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label>ภาคการศึกษา</label>
                                <select id="semester" name="semester" class="form-control input-small">
                                        <option value="">--เลือก--</option>
                                        <option value="1">ภาคต้น</option>
                                        <option value="2">ภาคปลาย</option>

                                    </select>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label>ปีการศึกษา</label>
                                   <select id="year" name="year" class="form-control input-small">
                                        <option value="">--เลือก--</option>
                                        @for ($i = date('Y')+1; $i >= date('Y')-10; $i--)
                                        <option value="{{ $i+543 }}"  >{{ $i+543 }}</option> 
                                        @endfor
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label>รอบที่</label>
                                 <select id="roundNo" name="roundNo" class="form-control input-small">
                                        <option value="">--เลือก--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group" style="padding-top:25px;">
                                    <button id="btnSearch1" href="javascript:;" class="btn btn yellow"> ค้นหา
                                                                                              <i class="fa fa-search"></i>
                                      </button>
                                    </div>
                              </div>


                            </div>
                          
                          <p></p>
                        </div>
                        <div class="m-heading-1 border-blue m-bordered">
                          <h3><span class="badge badge-info">2</span> เลือกหลักสูตร</h3>
                          <p>

                            </p><div class="row">

                              <div class="col-md-11">
                                <div class="form-group">
                                    <label for="single" class="control-label">เลือกหลักสูตรเพื่อดำเนินการ</label>
                                    <select id="single" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
 
                                    </select><span class="select2 select2-container select2-container--bootstrap" dir="ltr"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-single-container"><span class="select2-selection__rendered" id="select2-single-container"><span class="select2-selection__placeholder">เลือกหลักสูตร</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                              </div>
                              <div class="cold-md-1">
                                <div class="form-group" style="padding-top:25px;">
                                  <a id="search_Select" href="javascript:;"  class="btn btn-small blue"> เลือก
                                                                            <i class="fa fa-mouse-pointer"></i>
                                                                        </a>
                                </div>
                              </div>


                            </div>

                          <p></p>
                        </div>
                      </div>
                    </div>

                  </div>
                  <h3><span class="badge badge-warning">3</span> ปรับปรุงข้อมูล</h3>
                  <a href="apply-setting-form.html" class="btn btn-circle green btn-outline sbold uppercase">
<i class="fa fa-plus"></i> เพิ่มผู้สมัคร เป็นกรณีพิเศษ
</a>
                  <hr>
                   <div id="datatable_ajax_wrapper" class="dataTables_wrapper no-footer">
                       
                       <div ><input type="hidden" value="2" id="idsave"> <input type="hidden" value="1" id="applicantid">  
                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="datatable_ajax">
                    <thead>
                      <tr>
                        <th>อีเมล์?<br/>
                          <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#datatable_ajax .checkboxes" />
                                                            <span></span>
                                                        </label>
                        </th>
                        <th> No. </th>
                        <th> เลขที่ใบสมัคร </th>
                        <th> ชื่อ-สกุล </th>
                        <th> ผลการพิจารณา </th>
                        <th> หมายเหตุ </th>
                        <th> คะแนนภาษาอังกฤษ </th>
                        <th> Actions </th>
                      </tr>
                    </thead>
                    
                  </table>   
                       
                       </div></div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-4 col-md-8">
                        <button type="button" class="btn grey-steel">ยกเลิก</button>
                        <button type="submit" class="btn green"><i class="fa fa-envelope-o"></i> ส่งอีเมล์ แจ้งผลพิจารณา</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <!-- END EXAMPLE TABLE PORTLET-->
            </div>
          </div>

@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
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
 
<script type="application/javascript">
    $('#editSave').click(function() {  
                                    $.ajax({
					type: "POST",
					url: '{!! Route('datatables.savePayment') !!}',
                                         async: false,
					data :{ 
                                                application_id : $('#application_id').val(),
                                                payment_date  : $('#payment_date').val(),
                                                receipt_book : $('#receipt_book').val(),
                                                receipt_no : $('#receipt_no').val(),
                                                flow_id : 3,
                                                _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                                 $('#application_id').val(''),
                                                 $('#payment_date').val(''),
                                                 $('#receipt_book').val(''),
                                                 $('#receipt_no').val('')
                                 	  TableDatatablesAjax.init();
                                        
                                          toastr.success('ดำเนินการเรียบร้อย');
                                        }
				},"json");  });
                            
                            
                  $('#btnSearch1').click(function() {  
                                    $.ajax({
					type: "get",
                                         async: false,
					url: '{!! Route('getCourse') !!}',
					data :{ 
                                                semester  : $('#semester').val(),
                                                year   :$('#year').val(),
                                                roundNo :$('#roundNo').val(),
                                                _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){ 
                                              $("#single").empty();
                                              var group="";
                                       jQuery.each(data, function(index, itemData) {
                                              if(group != data[index].faculty_id)
                                              { 
                                                  if(index!=0){ $("#single").append('</optgroup>');}
                                                  $("#single").append('<optgroup label="'+((itemData.faculty_name != null)? itemData.faculty_name:'-')+'">');
                                              }  
                                             $("#single").append('<option value="'+data[index].curr_act_id+'">'+((itemData.thai != null)? (itemData.thai+'['+itemData.coursecodeno+'], '):' ')+((itemData.sub_major_name != null)? 'แขนงวิชา'+itemData.sub_major_name+'['+itemData.sub_major_id+'], ':' ')+((itemData.major_name != null)? 'สาขาวิชา'+itemData.major_name+'['+itemData.major_id+'], ':' ')+((itemData.department_name != null)?'ภาควิชา'+itemData.department_name+'['+itemData.department_id+'], ':' ')+((itemData.faculty_name != null)?itemData.faculty_name:'-')+'</option>')
                                               if(index==data.length-1){$("#single").append('</optgroup>');}
                                               
                                                        group = data[index].faculty_id;
                                                    } );
                                              
                                        }
				},"json");  });           
                            
                           
                            
    
 var table="";   
var TableDatatablesAjax = function () { 
    var handle1 = function () {

        var grid = new Datatable();

    table=  grid.init({
            src: $("#datatable_ajax"),
            loadingMessage: 'Loading...',
            dataTable: {  
                "bStateSave": true,  
                "fnStateSaveParams":    function ( oSettings, sValue ) {
                    $("#datatable_ajax tr.filter .form-control").each(function() {
                        sValue[$(this).attr('name')] = $(this).val();
                    });
                   
                    return sValue;
                },
                
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 20, // default record count per page
           
                "ajax": {
                    "url": "{!! route('admin.getRegisterCourse') !!}",
                    "type":"GET",
                    "async": "false",
                    "data" : {  
                                curr_act_id: ($('#single').val())? $('#single').val():'-1' ,
                               _token:     '{{ csrf_token()}}'
                                               }                 
                },
               
        
columnDefs: [
    { 
targets: [0], 

 
name: 'rownum',
render: function (data, type, full, meta) { 
return  '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" value="1" /><span></span></label>'; 
} },{ 
targets: [1], 
orderable: false, 
 
name: 'rownum', 
render: function (data, type, full, meta) { 
return full.rownum; 
} },{ 
targets: [2], 
orderable: false, 
 
name: 'app_id', 
render: function (data, type, full, meta) { 
return  full.app_ida   ; 
} },{ 
targets: [3], 
orderable: false, 
 
name: 'stu_first_name_stu_last_name', 
render: function (data, type, full, meta) { 
return (  full.stu_first_name + '['+full.stu_first_name_en+']   ' + full.stu_last_name + '[' + full.stu_last_name_en + ']') ;
}},{ 
targets: [4], 
orderable: false, 
className: 'sorting_1',
name: 'program_id',
render: function (data, type, full, meta) { 
return    '<a href="javascript:setID('+full.application_id+','+full.applicant_id+');"  class="examSel"   data-type="select" data-pk="'+ full.app_id +'" data-value="' + full.exam_status + '" data-source="/exam-results" data-original-title="เลือกผลการพิจารณา"> '+ full.exam_name +' </a>'  ; 
} },{ 
targets: [5], 
orderable: false, 
 
name: 'prog_type_name', 
render: function (data, type, full, meta) { 
return    '<a href="javascript:setID('+full.application_id+','+full.applicant_id+');" class="commentsExam" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-original-title="Enter comments" class="editable editable-pre-wrapped editable-click">'+ (( full.exam_remark !== null )? full.exam_remark : '') +' </a>' ; 
} },{ 
targets: [6],  
 
name: 'bank_name', 
render: function (data, type, full, meta) { 
return  ' <a href="javascript:setID('+full.application_id+','+full.applicant_id+');" class="scoreExam" data-type="text" data-pk="1" data-original-title="กรอกคะแนนภาษาอังกฤษ" class="editable editable-click"> '+ ((full.eng_test_score_admin)? full.eng_test_score_admin : full.eng_test_score)+' </a><br>  <a href="javascript:setID('+full.application_id+','+full.applicant_id+');" class="typeExam" data-type="select" data-pk="1" data-value="'+ full.eng_test_id_admin +'" data-original-title="เลือก ประเภทคะแนน" class="editable editable-click" style="color: gray;">'+((full.eng_test_score_admin)? full.engTAdmin : full.engT)+'</a> <br>เมื่อ <a href="javascript:setID('+full.application_id+','+full.applicant_id+');" class="vacation" data-type="date" data-viewformat="yyyy/mm/dd" data-pk="1" data-value="'+((full.eng_date_taken_admin)? full.eng_date_taken_admin : full.eng_date_taken)+'" data-placement="right" data-original-title="วันที่คะแนนมีผล" class="editable editable-click"> '+((full.eng_date_taken_admin)? full.eng_date_taken_admin : full.eng_date_taken)+'</a>'  ;
}},{  
 
targets: [7], 
orderable: false, 
 
name: 'apply', 
render: function (data, type, full, meta) { 
return ('<a href="#responsive"  hid="' + full.application_id +'" hidd="' + full.payment_date +'" hidb="' + full.receipt_book +'" hidn="' + full.receipt_no +'" bak="' + full.bank_id+'" flo="' + full.flow_id+'" fee="' + full.apply_fee+'" Bfee="' + full.bank_fee +'"   id="edit"  data-toggle="modal" data-original-title="จัดการยื่นยันการชำระเงิน"  class="btn btn-icon-only blue tooltips"><i class="fa fa-dollar"></i></a>'+
   '<a href="{{url("admin/manageDocument/")}}/'+ full.applicant_id +'/' + full.application_id +'"  data-original-title="ปรับเอกสาร" class="btn btn-icon-only blue tooltips"><i class="fa fa-file-o"></i></a>') ;
} }],      
                "bDestroy": true,
                "ordering": false,
                "order": [
                    [1, "asc"]
                ] 
            }
        });

       
    }
  
 setInterval(function(){FormEditable.init(); }, 2000);
    return {
     init: function () {
             handle1();      
        }

    };

}();

var exam_status="";
var EngTest="";

jQuery(document).ready(function() {
  
   $('#datatable_ajax tbody').on( 'click', 'a', function () {
          if($(this).attr('id')=="edit"){
               $('#application_id').val($(this).attr('hid'));
               $('#payment_date').val($(this).attr('hidd')) ;
               $('#receipt_book').val($(this).attr('hidb')); 
               $('#receipt_no').val($(this).attr('hidn'));
         } 
    } );
    
        $.ajax({
            type: "GET",
            data: {_token:'{{ csrf_token() }}'},
             async: false,
            url: "{{url('admin/getStatusExam')}}",         
          success : function(data){                               
                jsonObj = [];
               jQuery.each(data, function(index, itemData) {
                   item = {};
                    item ["text"] = itemData.exam_name;
                    item ["value"] = itemData.exam_id;
                    jsonObj.push(item);
               });             
             exam_status=jsonObj;
        } 
            
        })  ;
        
         $.ajax({
            type: "GET",
            data: {_token:'{{ csrf_token() }}'},
             async: false,
            url: "{{url('admin/getEngTest')}}",         
          success : function(data){                               
               jsonObj = [];
               jQuery.each(data, function(index, itemData) {
                   item = {};
                    item ["text"] = itemData.eng_test_name;
                    item ["value"] = itemData.eng_test_id;
                    jsonObj.push(item);
               });             
             EngTest=jsonObj;
          
            } 
            
        })  ;
     
 
});

 
    $('#search_Select').click(function(){
    TableDatatablesAjax.init(); 
    });
 
 

 function setID(appid,cantid){
     $('#idsave').val(appid);  
     $('#applicantid').val(cantid);
 }
  

  function GetDateFormat(date) {
            var month = (date.getMonth() + 1).toString();
            month = month.length > 1 ? month : '0' + month;
            var day = date.getDate().toString();
            day = day.length > 1 ? day : '0' + day;
            return date.getFullYear()+'-'+month + '-' + day ;
        }
 
 
 
 var FormEditable = function() {

    $.mockjaxSettings.responseTime = 500;

    var log = function(settings, response) {
        var s = [],
            str;
        s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
        for (var a in settings.data) {
            if (settings.data[a] && typeof settings.data[a] === 'object') {
                str = [];
                for (var j in settings.data[a]) {
                    str.push(j + ': "' + settings.data[a][j] + '"');
                }
                str = '{ ' + str.join(', ') + ' }';
            } else {
                str = '"' + settings.data[a] + '"';
            }
            s.push(a + ' = ' + str);
        }
        s.push('RESPONSE: status = ' + response.status);

        if (response.responseText) {
            if ($.isArray(response.responseText)) {
                s.push('[');
                $.each(response.responseText, function(i, v) {
                    s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
                });
                s.push(']');
            } else {
                s.push($.trim(response.responseText));
            }
        }
        s.push('--------------------------------------\n');
        $('#console').val(s.join('\n') + $('#console').val());
    }


        
    var initAjaxMock = function() {
        //ajax mocks

        $.mockjax({
            url: '/post',
            async: false,
            response: function(settings) {
                log(settings, this);
            }
        });
  
        $.mockjax({
            url: '/exam-results',
            async: false,
            response: function(settings) {               
        this.responseText = exam_status;
        
                log(settings, this);
            }
        });
        
    }

    var initEditables = function() {

        //set editable mode based on URL parameter
        if (App.getURLParameter('mode') == 'inline') {
            $.fn.editable.defaults.mode = 'inline';
            $('#inline').attr("checked", true);
        } else {
            $('#inline').attr("checked", false);
        }

        //global settings
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        //editables element samples
        $('.scoreExam').editable({
            url: '/post',
            type: 'text',
            pk: 1,
            name: 'scoreExam',
            title: 'Enter Your Score'
        });
          $('.scoreExam').on('save', function(e, params) {
            
                  $.ajax({
					type: "POST",
					url: '{!! Route('updateApplication') !!}',
                                         async: false,
					data :{ 
                                                eng_test_score_admin : params.newValue,
                                                applicant_id  : $('#applicantid').val()  , 
                                                _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                                 $('#idsave').val('');  
                                                  $('#applicantid').val(''); 
                                 	}
				},"json");
                 
         });
 
        $('.typeExam').editable({
             prepend: "เลือกสถาบัน",
            inputclass: 'form-control',
            async: false,
            source: EngTest,
            display: function(value, sourceData) {
                var colors = {
                        "": "gray",
                        1: "green",
                        2: "blue"
                    },
                    elem = $.grep(sourceData, function(o) {
                        return o.value == value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css("color", colors[value]);
                } else {
                    $(this).empty();
                }
            }
        });
         
        $('.typeExam').on('save', function(e, params) {
                 $.ajax({
					type: "POST",
					url: '{!! Route('updateApplication') !!}',
                                         async: false,
					data :{ 
                                                eng_test_id_admin : params.newValue,
                                                applicant_id  : $('#applicantid').val()  , 
                                                _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                                 $('#idsave').val(''); 
                                                  $('#applicantid').val(''); 
                                 	}
				},"json");
                 
         });

    
        $('.examSel').editable({
            showbuttons: false
        });
         $('.examSel').on('save', function(e, params) {
                  $.ajax({
					type: "POST",
					url: '{!! Route('updateApplication') !!}',
                                         async: false,
					data :{ 
                                                exam_status : params.newValue,
                                                application_id  : $('#idsave').val(), 
                                                _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                                 $('#idsave').val('');   
                                                  $('#applicantid').val(''); 
                                 	}
				},"json");
                 
         });
        $('.vacation').editable({
            rtl: App.isRTL(),
            async: false
        });
        
         $('.vacation').on('save', function(e, params) {
                    $.ajax({
					type: "POST",
					url: '{!! Route('updateApplication') !!}',
                                         async: false,
					data :{ 
                                                 eng_date_taken_admin : GetDateFormat(params.newValue) ,
                                                 applicant_id  : $('#applicantid').val()  ,  
                                                _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                                 $('#idsave').val('');  
                                                  $('#applicantid').val('');   
                                 	}
				},"json");
                 
         });

         
        $('.commentsExam').editable({
            showbuttons: 'bottom'
        });
          $('.commentsExam').on('save', function(e, params) {
                  $.ajax({
					type: "POST",
					url: '{!! Route('updateApplication') !!}',
                                         async: false,
					data :{ 
                                                exam_remark : params.newValue,
                                                application_id  : $('#idsave').val(), 
                                                _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                                 $('#idsave').val('');  
                                                  $('#applicantid').val(''); 
                                 	}
				},"json");
                 
         });
 
    }

    return {       
        init: function() {
        initAjaxMock();
        initEditables();
    }

    };

}();
 
 

</script>
@endpush