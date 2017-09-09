@extends('layouts.default') @push('pageCss')
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
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
      <span>จัดการข้อมูลการสม้คร</span>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>ปรับปรุงการชำระเงิน และส่งเอกสาร</span>
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
<h1 class="page-title">จัดการข้อมูลการสมัคร
    <small>ปรับปรุงการชำระเงิน และปรับปรุงการส่งเอกสาร</small>
</h1> @stop @section('maincontent')
<div class="row">
  <div class="col-md-12">


    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-settings font-dark"></i>
          <span class="caption-subject font-dark sbold uppercase">ข้อมูลการสมัคร</span>
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
        <div class="table-container">
          <div class="m-heading-1 border-green m-bordered">
            <h3>กำหนดเงื่อนไขการแสดงข้อมูล</h3>
            <p>
            </p>
            <div class="row">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>ระบุ เลขที่ใบสมัคร/รหัสผู้สมัคร/ชื่อ-สกุล/รหัสโปรแกรม</label>
                  <div class="input-group input-group-sm">
                    <input type="text" id="criteria" name="criteria" class="form-control" placeholder="เลขที่ใบสมัคร/รหัสผู้สมัคร/ชื่อ-สกุล/รหัสโปรแกรม">
                    <span class="input-group-btn">
                                            <button name="btsearch" id="btsearch" class="btn btn-xs yellow" type="button">ค้นหา <i class="fa fa-search"></i></button>
                                        </span>
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>

            <p></p>
          </div>
          <div id="datatable_ajax_wrapper" class="dataTables_wrapper dataTables_extended_wrapper no-footer">
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="table-group-actions pull-right"></div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax" aria-describedby="datatable_ajax_info" role="grid">
                <thead>
                  <tr role="row" class="heading">
                    <th width="30px">
                      ลำดับ
                    </th>
                    <th> เลขที่ใบสมัคร </th>
                    <th> รหัสผู้สมัคร </th>
                    <th> ชื่อ-สกุล </th>
                    <th> รหัสหลักสูตร </th>
                    <th> ชื่อปริญญา </th>
                    <th> ธนาคาร </th>
                    <th> วันที่สมัคร </th>
                    <th> สถานะ </th>
                    <th> Actions </th>
                  </tr>

                </thead>

              </table>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>

  <div class="page-content-wrapper">


    <div class="col-md-12">
      <div class="portlet light ">
        <div class="portlet-body">
          <div tabindex="-1" class="modal fade in" id="responsive" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="addData">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button class="close" aria-hidden="true" type="button" data-dismiss="modal"></button>
                        <h4 class="modal-title">รายละเอียดการชำระเงิน</h4>
                      </div>
                      <div class="modal-body">
                        <div class="slimScrollDiv" style="width: auto; height: auto; overflow: hidden; position: relative;">
                          <div class="scroller" style="width: auto; height: auto; overflow: hidden;" data-initialized="1" data-always-visible="1" data-rail-visible1="1">
                            <div class="col-md-12">
                              <div class="form-group form-md-line-input">
                                <input type="hidden" id="application_id">


                                <div class="input-group input-medium " data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                  <input type="text" value="{{  Carbon\Carbon::now() }}" id="payment_date" class="form-control" readonly="">
                                  <span style="display:none;" class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                  <label for="form_control_1">วันที่ชำระเงิน</label>
                                  <span class="help-block">วันที่ชำระเงิน</span>
                                </div>
                                <br>
                                <div class="form-group form-md-line-input">

                                  <select id="bank_id" class="form-control">
                                      <option value="">-- เลือก --</option>
                                                                @foreach ($banks as $bank)
                                                                <option value="{{$bank->bank_id}}" >{{$bank->bank_name}}</option>
                                                                @endforeach
                                                            </select>
                                  <label for="form_control_1">ธนาคารที่ชำระเงิน</label>
                                  <span class="help-block">ธนาคารที่ชำระเงิน</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                  <span class="label label-sm label-info"> จำนวนเงินที่ชำระ [<label id="fee"></label> บาท]</span>
                                  <span class="label label-sm label-success"> ค่าธรรมเนียมธนาคาร [<label id="Bfee"></label> บาท]</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                  <input type="hidden" id="flow">
                                  <select id="status" class="form-control">
                                      <option value="" >-- เลือก --</option>
                                        <option value="3" >ชำระเงินแล้ว</option>
                                                                <option value="2" >ยังไม่ชำระเงิน</option>

                                                            </select>
                                  <label for="form_control_1">สถานะการชำระเงิน </label>

                                </div>


                              </div>

                              <div style="display:none">
                                <div class="form-group form-md-line-input">
                                  <input class="form-control" id="receipt_book" placeholder="Enter more text" rows="3"></input>
                                  <label for="form_control_1">เล่มที่ใบเสร็จรับเงิน</label>
                                  <span class="help-block">เล่มที่ใบเสร็จรับเงิน.</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                  <input class="form-control" id="receipt_no" type="text" placeholder="Enter your name">
                                  <label for="form_control_1">เลขที่ใบเสร็จรับเงิน</label>
                                  <span class="help-block">เลขที่ใบเสร็จรับเงิน.</span>
                                </div>
                              </div>


                            </div>
                          </div>
                          <div class="slimScrollBar" style="background: rgb(187, 187, 187); border-radius: 7px; top: 0px; width: 7px; height: 300px; right: 1px; display: none; position: absolute; z-index: 99; opacity: 0.4;"></div>
                          <div class="slimScrollRail" style="background: rgb(234, 234, 234); border-radius: 7px; top: 0px; width: 7px; height: 100%; right: 1px; display: none; position: absolute; z-index: 90; opacity: 0.2;"></div>
                        </div>





                        <div class="modal-footer">
                          <button class="btn dark " type="button" id="editdel" data-dismiss="modal">Close</button>
                          <button class="btn green" type="button" id="editSave" data-dismiss="modal">Save changes</button>
                        </div>

                      </div>
                </form>
                </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop


@push('pageJs')
  <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/table-datatables-ajax.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script type="application/javascript">
    $('#editSave').click(function() {
                                    $.ajax({
					type: "POST",
					url: '{!! Route('datatables.savePayment') !!}',
					data :{
                                                application_id : $('#application_id').val(),
                                                payment_date  : $('#payment_date').val(),
                                                receipt_book : $('#receipt_book').val(),
                                                receipt_no : $('#receipt_no').val(),
                                                bank_id  : $('#bank_id').val(),
                                                flow_id : ($('#flow').val()<=3)? $('#status').val():$('#flow').val(),
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
                    "data" : {
                               flow : '1,2,3',
                               semester  : $('#semester').val(),
                               year   :$('#year').val(),
                               roundNo :$('#roundNo').val(),
                               criteria :  $('#criteria').val(),
                               _token:     '{{ csrf_token()}}'
                                               }
                },


columnDefs: [{
targets: [0],
orderable: false,
className: 'table-status',
name: 'rownum',
render: function (data, type, full, meta) {
return meta.settings._iDisplayStart + meta.row + 1;
} },{
targets: [1],
orderable: true,
className: 'table-desc font-blue',
name: 'app_id',
render: function (data, type, full, meta) {
return  full.app_ida   ;
} },{
targets: [2],
orderable: true,
className: 'table-title',
name: 'stu_citizen_card',
render: function (data, type, full, meta) {
return  full.program_id+'-'+full.curriculum_numa;
} },{
targets: [3],
orderable: true,
className: 'table-desc',
name: 'stu_first_name_stu_last_name',
render: function (data, type, full, meta) {
return ( full.name_title+ full.stu_first_name+'  ' +  full.stu_last_name + '  <br>  '+full.name_title_en+full.stu_first_name_en+'  ' + full.stu_last_name_en ) ;
}},{
targets: [4],
orderable: true,
className: 'table-desc font-blue',
name: 'program_id',
render: function (data, type, full, meta) {
return    full.program_id   ;
} },{
targets: [5],
orderable: true,
className: 'table-title',
name: 'prog_type_name',
render: function (data, type, full, meta) {
return    full.degree_name ;
} },{
targets: [6],
orderable: true,
className: 'table-desc',
name: 'bank_name',
render: function (data, type, full, meta) {
return  full.bank_name   ;
}},{
targets: [7],
orderable: true,
className: 'table-desc',
name: 'created',
render: function (data, type, full, meta) {
return  full.created;
}},{
targets: [8],
orderable: true,
className: 'table-desc',
name: 'flow_name',
render: function (data, type, full, meta) {
return ('<span class="label label-sm label-'+(( full.flow_id == 1)?'danger':((full.flow_id == 6)? 'success' :'info')) +'">'+ (('{{session('locale')}}'=='th')? full.flow_name : full.flow_name_en) +'</span>');
}},{

targets: [9],
orderable: false,
className: 'table-download',
name: 'apply',
render: function (data, type, full, meta) {
return ('<a href="#responsive"  hid="' + full.application_id +'" hidd="' + full.payment_date +'" hidb="' + full.receipt_book +'" hidn="' + full.receipt_no +'" bak="' + full.bank_id+'" flo="' + full.flow_id+'" fee="' + full.apply_fee+'" Bfee="' + full.bank_fee +'"   ids="edit"  data-toggle="modal" data-original-title="จัดการยืนยันการชำระเงิน"  class="btn btn-xs green tooltips"><i class="fa fa-dollar"></i>ชำระเงิน</a>'+
   '<a target="_blank" href="{{url("admin/manageDocument/")}}/'+ full.applicant_id +'/' + full.application_id +'"  data-original-title="ปรับเอกสาร" class="btn btn-xs blue "><i class="fa fa-file-o"></i>เอกสาร</a>') ;
} }],
                "bDestroy": true,
                "ordering": true,
                "order": [
                    [1, "asc"]
                ]
            }
        });


    }


    return {
     init: function () {
             handle1();
        }

    };

}();

jQuery(document).ready(function() {

    TableDatatablesAjax.init();


   $('#datatable_ajax tbody').on( 'click', 'a', function () {
          if($(this).attr('ids')=="edit"){

                $('#application_id').val($(this).attr('hid'));
               $('#payment_date').val(($(this).attr('hidd') == 'null')? Date().format('y-m-d'):$(this).attr('hidd')) ;
               $('#receipt_book').val($(this).attr('hidb'));
               $('#receipt_no').val($(this).attr('hidn'));
               $('#bank_id').val($(this).attr('bak'));
               $('#status').val($(this).attr('flo'));
               $('#flow').val($(this).attr('flo'));
               $('#fee').text($(this).attr('fee'));
                $('#Bfee').text($(this).attr('Bfee'));
         }
    } );
});


    $('#btsearch').click(function(){
    TableDatatablesAjax.init();
    });



</script>
@endpush
