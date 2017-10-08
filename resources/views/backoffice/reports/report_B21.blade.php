@extends('layouts.default') @push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
@endpush @section('pagebar')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="/">{{Lang::get('resource.lbMain')}}</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>จัดการข้อมูลผู้สมัคร</span>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>ปรับปรุงผู้มีสิทธิ์สอบ [GS03]</span>
    </li>
  </ul>
  {{--
  <div class="page-tool    bar">--}} {{--
    <div class="btn-group pull-right">--}} {{--
      <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" --}} {{--data-toggle="dropdown"> Actions--}}
        {{--<i class="fa fa-angle-down"></i>--}}
                  {{--</button>--}} {{--
      <ul class="dropdown-menu pull-right" role="menu">--}} {{--
        <li>--}} {{--
          <a href="#">--}}
        {{--<i class="icon-bell"></i> Action</a>--}} {{--
        </li>--}} {{--
        <li>--}} {{--
          <a href="#">--}}
        {{--<i class="icon-shield"></i> Another action</a>--}} {{--
        </li>--}} {{--
        <li>--}} {{--
          <a href="#">--}}
        {{--<i class="icon-user"></i> Something else here</a>--}} {{--
        </li>--}} {{--
        <li class="divider"></li>--}} {{--
        <li>--}} {{--
          <a href="#">--}}
        {{--<i class="icon-bag"></i> Separated link</a>--}} {{--
        </li>--}} {{--
      </ul>--}} {{--
    </div>--}} {{--
  </div>--}}
</div>
@stop @section('pagetitle')
<h1 class="page-title">รายชื่อผู้ผ่านการสอบคัดเลือกเข้าศึกษาในระดับบัณฑิตศึกษา

</h1> @stop @section('maincontent')
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="icon-settings font-dark"></i>
          <span class="caption-subject bold uppercase">ข้อมูลผู้ผ่านการสอบคัดเลือกเข้าศึกษาในระดับบัณฑิตศึกษา</span>
        </div>
        <div class="actions">
          <div class="btn-group pull-right">
            <button class="btn blue-steel  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                  <i class="fa fa-angle-down"></i>
                                              </button>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:window.print();">
                                                          <i class="fa fa-print"></i> PDF </a>
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
                </p>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>ภาคการศึกษา</label>
                      <select id="semester" name="semester" class="form-control input-small">

                                        <option value="1">ภาคต้น</option>
                                        <option value="2">ภาคปลาย</option>

                                    </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>ปีการศึกษา</label>
                      <select id="year" name="year" class="form-control input-small">

                                        @for ($i = date('Y'); $i >= date('Y')-10; $i--)
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
              <div id="search-program-result" class="m-heading-1 border-blue m-bordered" style="display:none;">
                <h3><span class="badge badge-info">2</span> เลือกหลักสูตร</h3>
                <p>

                </p>

                <div class="row">

                  <div class="col-md-11">
                    <div class="form-group">
                      <label for="single" class="control-label">เลือกหลักสูตรเพื่อดำเนินการ</label>
                      <select id="single" class="form-control select2">
                                    <option></option>

                                </select>
                    </div>
                  </div>
                  <div class="cold-md-1">
                    <div class="form-group" style="padding-top:25px;">
                      <a id="search_Select" href="javascript:;" class="btn btn-small blue"><i class="fa fa-file-text-o"></i> เลือก</a>
                    </div>
                  </div>


                </div>

                <p></p>
              </div>
            </div>
          </div>

        </div>
        <div id="search-application-result" style="display:none;">
          <h3><span class="badge badge-warning">3</span> รายละเอียดข้อมูล</h3>

          <hr>
          <div id="datatable_ajax_wrapper" class="dataTables_wrapper no-footer">

            <div><input type="hidden" id="idsave"> <input type="hidden" value="1" id="applicantid">
                <div class="caption" style="text-align: center">รายชื่อผู้ผ่านการสอบคัดเลือกเข้าศึกษาในระดับบัณฑิตศึกษา จุฬาลงกรณ์มหวิทยาลัย<br>ประจำภาคการศึกษา<label id="lbSem" name="lbSem"></label> ปีการศึกษา <label id="lbYear" name="lbYear"></label></div>
     <div class="portlet box pink-chula">
                      <div class="portlet-title">
                        <div class="caption">
                          <i class="icon-bar-chart"></i> </div>
                        <div class="tools">
                          <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                          <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                          <a class="fullscreen font-red-pink" href="javascript:;" data-original-title="" title=""> </a>

                        </div>
                      </div>
                      <div class="portlet-body">
                        <div class="table-responsive">
                          <table id="datatable_ajax" class="table table-hover table-bordered table-striped">
                            <thead>
                              <tr>
                                <th> ที่ </th>
                                <th> ชือ - นามสกุล <br> (เรียงตามเลขทีสมัคร) </th>
                                <th> สัญชาติ </th>
                                <th> สามัญ  </th>
                                <th> ทดลองศึกษา </th>
                                  <th> สํารองเรียง<br>ตามลําดับ  </th>
                                   <th> GPA เกรดเฉลีย  </th>
                                   <th> คะแนน<br>ภาษาอังกฤษ  </th>
                                     <th> หมายเหตุ </th>
                                 </tr>
                            </thead>

                          </table>
                        </div>
                          <br><br>
                          ทั้งนี้ <input type="text"   class="form-control" placeholder="รายละเอียด" id="text1" name="text1" ><br>
                          ครั้งที่ <input type="text"   class="form-control" placeholder="ครั้งที่" id="text2" name="text2" ><br>
                          วันที่ <input type="text"   class="form-control" placeholder="วันที่" id="text3" name="text3" ><br><br>
                          ชื่อผู้ลงนาม1 <input type="text"   class="form-control" placeholder="ชื่อ-สกุล ผู้ลงนาม" id="namekey" name="namekey" ><br>
                          ตำแหน่งผู้ลงนาม1<input type="text"   class="form-control" placeholder="ตำแหน่งผู้ลงนาม" id="positionkey"name="positionkey" ><br><br>
                            ชื่อผู้ลงนาม2 <input type="text"   class="form-control" placeholder="ชื่อ-สกุล ผู้ลงนาม" id="namekey2" name="namekey2" ><br>
                          ตำแหน่งผู้ลงนาม2<input type="text"   class="form-control" placeholder="ตำแหน่งผู้ลงนาม" id="positionkey2"name="positionkey2" ><br>
                      </div>
                    </div>

            </div>
          </div>

          <div class="form-actions">
            <div class="row">
              <div class="col-md-offset-4 col-md-8">
                   <a id="btnxls"  target="_blank" href="javascript:callprint('EXCEL');"  class="btn green"><i class="fa fa-file-excel-o"></i>Export เป็นไฟล์ EXCEL</a>
                 <a id="btnpdf"  target="_blank" href="javascript:callprint('PDF');"  class="btn green"><i class="fa fa-print"></i>Export เป็นไฟล์ PDF</a>
                <a id="btntxt"  target="_blank" href="javascript:callprint('TEXT');"  class="btn green"><i class="fa fa-file-text-o"></i>Export เป็นไฟล์ TEXT</a>

                </div>
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

    $('#btcloss').click(function() {
      $("#show_name").text('');
      $("#idCard").text('');
      $("#appcantid").val('');
      $("#citiz").val('');
      $("#apply_comment").val('');

  });

                  $('#btnSearch1').click(function(){
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
                                             $("#single").append('<option lbthai="'+itemData.thai+'"  cu="'+itemData.curriculum_id+'"  pt="'+itemData.program_type_id+'" pg="'+((itemData.coursecodeno!=null)?itemData.coursecodeno:'')+'" smj="'+((itemData.sub_major_id!=null)?itemData.sub_major_id:'')+'"  value="'+data[index].curr_act_id+'">'+((itemData.thai != null)?  (itemData.coursecodeno+' - '+itemData.thai+', '):' ')+((itemData.sub_major_name != null)? 'แขนงวิชา'+itemData.sub_major_name+'['+itemData.sub_major_id+'], ':' ')+((itemData.major_name != null)? 'สาขาวิชา'+itemData.major_name+'['+itemData.major_id+'], ':' ')+((itemData.department_name != null)?'ภาควิชา'+itemData.department_name+'['+itemData.department_id+'], ':' ')+((itemData.faculty_name != null)?itemData.faculty_name:'-')+','+itemData.prog_type_name+'</option>')
                                               if(index==data.length-1){$("#single").append('</optgroup>');}

                                                        group = data[index].faculty_id;
                                                    } );

                                        }
				},"json");
        //Show serach program result
        $('#search-program-result').fadeIn( "slow", "linear" );
        $('#search-application-result').fadeOut( "slow", "linear" );


      });


        function callprint(print){
            var sing = (($('#single').val())? $('#single').val():'-1');
            var submajor = (($('option:selected','#single').attr('smj'))? $('option:selected','#single').attr('smj'):null) ;
        var name =$('#namekey').val();
        var position = $('#positionkey').val();
        var name2 =$('#namekey2').val();
        var position2 = $('#positionkey2').val();
        var txt1= $('#text1').val()+'<br>ครั้งที่ '+$('#text2').val()+'  วันที่ '+$('#text3').val().replace('/','-').replace('/','-');

       window.open(("{{ url('admin/printRegisterCourseReport').'/4,5'.'/'}}"+sing+'/'+submajor+'/'+$('option:selected','#single').attr('pt')+'/'+$('option:selected','#single').attr('lbthai')+'/'+$('option:selected','#single').attr('pg')+'/'+print+'/'+name+'|'+name2 +'/'+position+'|'+position2+'/'+txt1+'/B21' ),'_blank');
        }

jQuery(document).ready(function() {
  //clear serach result
  $('#semester,#year,#roundNo').on('change', function() {
    $('#search-program-result').fadeOut( "slow", "linear" );
    $('#search-application-result').fadeOut( "slow", "linear" );
  });

});


    $('#search_Select').click(function(){
         $('#lbSem').text($('option:selected','#semester').text());
        $('#lbYear').text($('#year').val());
           TableDatatablesAjax.init();
         $('#search-application-result').fadeIn( "slow", "linear" );

       });






var table="";
var TableDatatablesAjax = function () {
    var handle1 = function () {
        var grid = new Datatable();

    table=  grid.init({
            src: $("#datatable_ajax"),
             dataTable: {
                "bStateSave": false,
                "pageLength": 1000,

                "ajax": {
                    "url": "{!! route('admin.getRegisterCourseReport') !!}",
                    "type":"GET",
                    "async": "false",
                    "data" : {
                                curr_act_id: ($('#single').val())? $('#single').val():'-1' ,
                                sub_major_id : $('option:selected','#single').attr('smj'),
                                program_id : $('option:selected','#single').attr('pg'),
                                program_type_id : $('option:selected','#single').attr('pt'),
                                 thaiDegree :$('option:selected','#single').attr('lbthai') ,
                                 flow : '4,5',
                               _token:     '{{ csrf_token()}}'
                                               }
                },


columnDefs: [
    {
targets: [0],
render: function (data, type, full, meta) {
return meta.settings._iDisplayStart + meta.row + 1;
} },{
targets: [1],
render: function (data, type, full, meta) {
return  (  full.name_title+full.stu_first_name + ' '+full.stu_last_name+'<br>' + full.name_title_en+full.stu_first_name_en + ' ' + full.stu_last_name_en + ' ')    ;
} },{
targets: [2],
render: function (data, type, full, meta) {
return   full.nation_name+'<br>['+full.nation_name_en+']' ;
}},{
targets: [3],
render: function (data, type, full, meta) {
return     ' <input type="checkbox"  disabled readonly '+((full.admission_status_id == '5'||full.admission_status_id == 'B'||full.admission_status_id == 'C')?'checked':'')+' class="checkboxes"  />'   ;
} },{
targets: [4],
render: function (data, type, full, meta) {
return   ' <input type="checkbox"  disabled readonly '+((full.admission_status_id == '7'||full.admission_status_id == 'D'||full.admission_status_id == 'E')?'checked':'')+' class="checkboxes"  />'    ;
} },{
targets: [5],
render: function (data, type, full, meta) {
return   ' <input type="checkbox"  disabled readonly '+((full.admission_status_id == 'A')?'checked':'')+' class="checkboxes"  />'    ;
} },{
targets: [6],
render: function (data, type, full, meta) {
return    full.edu_gpax  ;
} },{
targets: [7],
render: function (data, type, full, meta) {
return    ((full.eng_test_score_admin != null)?   (full.eng_test_score_admin+'('+full.engTAdmin+')' )   :  (full.eng_test_score+'('+full.engT+')'))  ;
} },{

targets: [8],
render: function (data, type, full, meta) {
return   full.admission_remark ;
}}  ],
                "bDestroy": true,
                "responsive": false,
              "paging":   false,
        "ordering": false,
        "info":     false
            },

        });
    }

    return {
     init: function () {
             handle1();
        }

    };

}();

</script>
@endpush
