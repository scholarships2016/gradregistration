@extends('layouts.default')

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
            <span>นำเข้าผู้สอบได้</span>
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
<h1 class="page-title">นำเข้าผู้สอบได้

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
                    <span class="caption-subject bold uppercase">ข้อมูลผู้สอบได้</span>
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

                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group" style="padding-top:25px;">
                                    <button id="btnSearch1" href="javascript:;" class="btn btn yellow"> ค้นหา  <i class="fa fa-search"></i>
                                      </button>
                                    </div>
                              </div>


                            </div>

                          <p></p>
                        </div>
                        <div id="search-program-result" style="display:none;" class="m-heading-1 border-blue m-bordered">
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
                                  <a id="search_select" href="javascript:;"  class="btn btn-small blue"> เลือก
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
                  <div id="search-application-result" style="display:none;">

                  <hr>
                  <div class="row">
      <nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><span class="badge badge-warning">3</span> นำเข้าข้อมูลผู้สอบได้จากไฟล์ Microsoft Excel</a>
			</div>
		</div>
	</nav>
	<div class="container">
    <div id="" style="border-bottom: 1px dotted #cccccc; padding: 5px 0px 20px 0px;">
      <span class="badge badge-warning">3.1</span> ดาวน์โหลด Excel Template เพื่อกรอกข้อมูลผู้สอบได้
      <a href="{{route('admin.getMedia',['path' => Crypt::encrypt('excel-template\student-data.xlsx') ])}}" class="btn btn-circle green-haze btn-outline sbold " download><i class="fa fa-download"></i> ดาวน์โหลด Excel Template</a>
    </div>
    <div id="" style="border-bottom: 1px dotted #cccccc; padding: 10px 0px 20px 0px;">
      <span class="badge badge-warning">3.2</span> Upload ไฟล์ Excel ข้อมูลผู้สอบได้ ที่กรอกใน Excel Template ตามข้อ 3.1 เท่านั้น

      <!--		<a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
      		<a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
      		<a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>-->
      <form id="formImport" name="formImport" style="border: 1px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="#"  class="form-horizontal"   >
                       <input type="file" id="import_file"  name="import_file" placeholder="เลือกไฟล์"/>

      		</form>

     </div>
     <div id="" style="border-bottom: 1px dotted #cccccc; padding: 10px 0px 20px 0px;">
       <span class="badge badge-warning">3.3</span> เริ่มต้นนำเข้าข้อมูล
        <a id="btImport" class="btn btn-circle green-meadow"><i class="fa fa-angle-double-right"></i> โหลดข้อมูลผู้สอบได้</a>
     </div>

	</div>
</div>
                  <hr>
                   <div id="datatable_ajax_wrapper" class="dataTables_wrapper no-footer">

                       <div ><input type="hidden" value="2" id="idsave"> <input type="hidden" value="1" id="applicantid">
                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="datatable_ajax">
                    <thead>
                      <tr>
                       <th>ลำดับ</th>
                        <th>รหัสบัตรประชาชน</th>
                        <th>เลือก คำนำหน้าชื่อ</th>
                        <th>ชื่อภาษาไทย</th>
                        <th>นามสกุลภาษาไทย</th>
                        <th>ชื่อภาษาอังกฤษ</th>
                        <th>นามสกุลภาษาอังกฤษ</th>
                        <th>เพศ</th>
                        <th>สัญชาติ</th>
                        <th>วันเกิด</th>
                        <th>ศาสนา</th>
                        <th>บ้านเลขที่</th>
                        <th>หมู่บ้าน</th>
                        <th>ซอย</th>
                        <th>ถนน</th>
                        <th>จังหวัด</th>
                        <th>อำเภอ</th>
                        <th>สถานะการทำงานปัจจุบัน</th>
                        <th>ชื่อสถานที่ทำงานปัจจุบัน</th>
                        <th>ตำแหน่งการทำงานปัจจุบัน</th>
                          
                        <th>หมายเลขโทรศัพท์</th>
                        <th>เลือกสถาบันที่สอบภาษาอังกฤษ</th>
                        <th>คะแนนภาษาอังกฤษ</th>
                        <th>วันที่คะนนมีผล</th>
                        <th>สถานะการศึกษา ป.ตรี</th>
                        <th>มหาวิทยาล้ย/สถาบัน ป.ตรี</th>
                        <th>แต้มเฉลี่ย ป.ตรี</th>
                        <th>คณะ ป.ตรี</th>
                        <th>สาขาวิชา ป.ตรี</th>
                        <th>ชื่อปริญญา ป.ตรี</th>
                        <th>สถานะการศึกษา ป.โท</th>
                        <th>มหาวิทยาล้ย/สถาบัน  ป.โท</th>
                        <th>แต้มเฉลี่ย  ป.โท</th>
                        <th>คณะ  ป.โท</th>
                        <th>สาขาวิชา  ป.โท</th>
                        <th>ชื่อปริญญา  ป.โท</th>
                         
                       
<th>ประเภทการรับเข้าศึกษา</th>
                        <th> Actions </th>
                      </tr>
                    </thead>

                  </table>

                       </div></div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-4 col-md-8">
                        <a type="button" class="btn grey-steel">ยกเลิก</a>
                        <a id="btSave" type="submit" class="btn green"><i class="fa fa-check"></i> ยืนยันการนำเข้าข้อมูลผู้สอบได้</a>
                      </div>
                    </div>
                  </div>
</div>
                </div>
              </div>
              <!-- END EXAMPLE TABLE PORTLET-->
            </div>


@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>

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
                                              $("#single").append('<option cu="'+itemData.curriculum_id+'"  pt="'+itemData.program_type_id+'" pg="'+((itemData.coursecodeno!=null)?itemData.coursecodeno:'')+'" smj="'+((itemData.sub_major_id!=null)?itemData.sub_major_id:'')+'"  value="'+data[index].curr_act_id+'">'+((itemData.thai != null)? (itemData.coursecodeno+' - '+itemData.thai+', '):' ')+((itemData.sub_major_name != null)? 'แขนงวิชา'+itemData.sub_major_name+'['+itemData.sub_major_id+'], ':' ')+((itemData.major_name != null)? 'สาขาวิชา'+itemData.major_name+'['+itemData.major_id+'], ':' ')+((itemData.department_name != null)?'ภาควิชา'+itemData.department_name+'['+itemData.department_id+'], ':' ')+((itemData.faculty_name != null)?itemData.faculty_name:'-')+','+itemData.prog_type_name+'</option>')
                                               if(index==data.length-1){$("#single").append('</optgroup>');}

                                                        group = data[index].faculty_id;
                                                    } );

                                        }
				},"json");
        //Show serach program result
        $('#search-program-result').fadeIn( "slow", "linear" );
        $('#search-application-result').fadeOut( "slow", "linear" );
       });


    $('#search_select').click(function(){
        $('#search-application-result').fadeIn( "slow", "linear" );

    });





$('#datatable_ajax').on( 'click', '.btn-info', function () {
     var table2=$("#datatable_ajax").DataTable();
     table2
        .rows( $(this).parent().parents('tr') )
        .remove()
        .draw();
} );

 $('#btSave').click(function() {
          var valdata = [];
          $("#datatable_ajax").DataTable().rows().every(function(){
                valdata.push(this.data());
          });
                             $.ajax({
					type: "POST",
					url: '{!! Route('importApplicantSave') !!}',
					data :{
                                                values : JSON.stringify(valdata),
                                                curr_act_id: ($('#single').val())? $('#single').val():'-1' ,
                                                sub_major_id : $('option:selected','#single').attr('smj'),
                                                program_id : $('option:selected','#single').attr('pg'),
                                                program_type_id : $('option:selected','#single').attr('pt'),
                                                curriculum_id : $('option:selected','#single').attr('cu'),
                                                _token:     '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                            if(data=='true'){
                                        toastr.success('ดำเนินการเรียบร้อย');
                                 	window.location.href = '{!! Route('importApplication') !!}';
                                            }else{toastr.error('มีข้อผิดพลาด');}
					}
				},"json");


});


   $('#btImport').click(function() {
       var formData = new FormData();
       formData.append("import_file",   $("#import_file")[0].files[0]);

   var datas =   $("#formImport").serializeArray();
            $.ajax({
                url: '{{route('importExcel')}}',
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                },
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                 success: function (result) {

table2 = $('#datatable_ajax').dataTable({
    "aaData": result,
     "bDestroy": true,
        "columnDefs": [
                         {
                    targets: [0], name : 'row',
                    render: function (data, type, full, meta) {
                    return   meta.settings._iDisplayStart + meta.row + 1 ;
                    }},
                         {
                    targets: [1],   name : 'id_card',
                    render: function (data, type, full, meta) {
                    return   full.id_card ;
                    }},
                         {
                    targets: [2],  name : 'title_name',
                     render: function (data, type, full, meta) {
                    return   full.title_name ;
                    }},
                         {
                    targets: [3],name : 'name_th',
                     render: function (data, type, full, meta) {
                    return   full.name_th ;
                    }},
                         {
                    targets: [4],name : 'lname_th',
                    render: function (data, type, full, meta) {
                    return   full.lname_th ;
                    }},
                         {
                    targets: [5],name : 'name_en',
                     render: function (data, type, full, meta) {
                    return   full.name_en ;
                    }},
                         {
                    targets: [6],name : 'lname_en',
                    render: function (data, type, full, meta) {
                    return   full.lname_en ;
                    }},
                         {
                    targets: [7],name : 'sex',
                    render: function (data, type, full, meta) {
                    return   full.sex ;
                    }},
                         {
                    targets: [8],name : 'nationality',
                    render: function (data, type, full, meta) {
                    return   full.nationality ;
                    }},
                         {
                    targets: [9],name : 'birth_day',
                    render: function (data, type, full, meta) {
                    return   full.birth_day ;
                    }},
                         {
                    targets: [10],name : 'religion',

                    render: function (data, type, full, meta) {
                    return   full.religion ;
                    }},
                         {
                    targets: [11],name : 'address_no',
                    orderable: true,
                    render: function (data, type, full, meta) {
                    return   full.address_no ;
                    }},
                         {
                    targets: [12],name : 'address_moo',
                    render: function (data, type, full, meta) {
                    return   full.address_moo ;
                    }},
                         {
                    targets: [13],name : 'address_soi',
                    render: function (data, type, full, meta) {
                    return   full.address_soi ;
                    }},
                         {
                    targets: [14],name : 'address_str',
                    render: function (data, type, full, meta) {
                    return   full.address_str ;
                    }},
                         {
                    targets: [15],name : 'address_prov',
                    render: function (data, type, full, meta) {
                    return   full.address_prov ;
                    }},
                         {
                    targets: [16],name : 'address_dist',
                    render: function (data, type, full, meta) {
                    return   full.address_dist ;
                    }},
                         {
                    targets: [17],name : 'work_status',
                    render: function (data, type, full, meta) {
                    return   full.work_status ;
                    }},
                         {
                    targets: [18],name : 'work_place_name',
                    render: function (data, type, full, meta) {
                    return   full.work_place_name ;
                    }},
                         {
                    targets: [19],name : 'work_position',
                    render: function (data, type, full, meta) {
                    return   full.work_position ;
                    }},
                
                  
                 {
                    targets: [20],name : 'stu_phone',
                    render: function (data, type, full, meta) {
                    return   full.stu_phone ;
                    }},
                 {
                    targets: [21],name : 'eng_test_text',
                    render: function (data, type, full, meta) {
                    return   full.eng_test_text ;
                    }},
                 {
                    targets: [22],name : 'eng_test_score',
                    render: function (data, type, full, meta) {
                    return   full.eng_test_score ;
                    }},
                 {
                    targets: [23],name : 'eng_date_taken',
                    render: function (data, type, full, meta) {
                    return   full.eng_date_taken ;
                    }},
                 {
                    targets: [24],name : 'edu_pass_text',
                    render: function (data, type, full, meta) {
                    return   full.edu_pass_text ;
                    }},
                 {
                    targets: [25],name : 'university_text',
                    render: function (data, type, full, meta) {
                    return   full.Admission_Status ;
                    }},
                 {
                    targets: [26],name : 'edu_gpax',
                    render: function (data, type, full, meta) {
                    return   full.edu_gpax ;
                    }},
                 {
                    targets: [27],name : 'edu_faculty',
                    render: function (data, type, full, meta) {
                    return   full.edu_faculty ;
                    }},
                 {
                    targets: [28],name : 'edu_major',
                    render: function (data, type, full, meta) {
                    return   full.edu_major ;
                    }},
                 {
                    targets: [29],name : 'edu_degree',
                    render: function (data, type, full, meta) {
                    return   full.edu_degree ;
                    }},
                 {
                    targets: [30],name : 'edu_pass_textM',
                    render: function (data, type, full, meta) {
                    return   full.edu_pass_textM ;
                    }},
                 {
                    targets: [31],name : 'university_textM',
                    render: function (data, type, full, meta) {
                    return   full.university_textM ;
                    }},
                 {
                    targets: [32],name : 'edu_gpaxM',
                    render: function (data, type, full, meta) {
                    return   full.edu_gpaxM ;
                    }},
                 {
                    targets: [33],name : 'edu_facultyM',
                    render: function (data, type, full, meta) {
                    return   full.edu_facultyM ;
                    }},
                 {
                    targets: [34],name : 'edu_majorM',
                    render: function (data, type, full, meta) {
                    return   full.edu_majorM ;
                    }},
                 {
                    targets: [35],name : 'edu_degreeM',
                    render: function (data, type, full, meta) {
                    return   full.edu_degreeM ;
                    }},
                
                  
                     {
                    targets: [36],name : 'Admission_Status',
                    render: function (data, type, full, meta) {
                    return   full.Admission_Status ;
                    }},
                        {
                      targets: [37],
                      render: function (data, type, full, meta) {
                      return ((' <a class="btn-info" > Delete </a>  ')) ;
                      } }    ]
});
                  }
            });
  });




</script>
@endpush
