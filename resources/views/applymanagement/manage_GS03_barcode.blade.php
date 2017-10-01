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
            <span>ปรับปรุงการชำระเงิน</span>
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
<h1 class="page-title">ปรับปรุงการชำระเงิน

</h1>
@stop


@section('maincontent')
 <div class="row">
        
         
 
 <div class="row">
                                                             <div class="col-md-4 col-md-offset-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-barcode"></i>
                                                                </span>
                                                                <input type="text" id="barcode" onblur="this.focus()" autofocus class="form-control" placeholder="Barcode-Scan">  
                                                               <input type="hidden" id="subbarcode">
                                                                <span class="input-group-btn">
                                                            <a class="btn blue" id="userSearch" type="button">ตรวจสอบ</a>
                                                        </span>
                                                            </div> </div>
</div>
      <div id="datatable_ajax_wrapper" class="dataTables_wrapper dataTables_extended_wrapper no-footer"><div class="row">
                            <div class="col-md-4 col-sm-12"><div class="table-group-actions pull-right"></div></div></div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer" id="datatable_ajax" aria-describedby="datatable_ajax_info" role="grid">
                                <thead>
                                    <tr role="row" class="heading"><th width="30px" class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                                       ลำดับ
                                                                       ">
                                            ลำดับ
                                        </th><th class="sorting_asc" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" เลขที่ใบสมัคร : activate to sort column descending"> เลขที่ใบสมัคร </th><th class="sorting" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-label=" รหัสผู้สมัคร : activate to sort column ascending"> รหัสผู้สมัคร </th><th class="sorting" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-label=" ชื่อ-สกุล : activate to sort column ascending"> ชื่อ-สกุล </th><th class="sorting" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-label=" รหัสโปรแกรม : activate to sort column ascending"> รหัสโปรแกรม </th><th class="sorting" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-label=" ชื่อโปรแกรม : activate to sort column ascending"> ชื่อโปรแกรม </th><th class="sorting" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-label=" ธนาคาร : activate to sort column ascending"> ธนาคาร </th><th class="sorting" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-label=" วันที่สมัคร : activate to sort column ascending"> วันที่สมัคร </th><th class="sorting" tabindex="0" aria-controls="datatable_ajax" rowspan="1" colspan="1" aria-label=" สถานะ : activate to sort column ascending"> สถานะ </th> </tr>
                                    
                                </thead>
                                 
                            </table></div> 
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
    
$('#barcode').keyup(function (e) {
    if (e.keyCode === 13) {
           updateVal();     
    }
  });
 $('#userSearch').click(function (e) {
            updateVal();     
     
  }); 
  
  function updateVal(){
      $.ajax({
					type: "POST",
					url: '{!! Route('savePaymentBarcode') !!}',
					data :{ 
                                                application_id : (($('#barcode').val()!='' && $('#barcode').val()!= null )?$('#barcode').val():'-99'),
                                                 _token: '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                               if(data=='true'){
                                          $('#subbarcode').val($('#barcode').val());
                                 	  TableDatatablesAjax.init();
                                          $('#barcode').val(''); 
                                           toastr.success('ดำเนินการเรียบร้อย');
                                               }else if(data=='have'){
                                                    $('#subbarcode').val($('#barcode').val());
                                 	  TableDatatablesAjax.init();
                                          $('#barcode').val(''); 
                                               toastr.warning('ผู้สมัครชำระเงินเรียบร้อยแล้ว');
                                                  }else{
                                                $('#barcode').val('');
                                                 toastr.error('ไม่สามารถทำรายการได้');
                                               }
                                           }
				},"json");
  }
  
  
    
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
                    "url": "{!! route('admin.getRegisterCourseBarcode') !!}",
                    "type":"GET",
                    "data" : {  
                                application_id : (($('#subbarcode').val()!='' && $('#subbarcode').val()!= null )?$('#subbarcode').val():'-99'),
                                _token:     '{{ csrf_token()}}'
                                               }                 
                },
               
        
columnDefs: [{ 
targets: [0], 
orderable: false, 
className: 'table-status',
name: 'rownum',
render: function (data, type, full, meta) { 
return full.rownum; 
} },{ 
targets: [1], 
orderable: false, 
className: 'table-desc font-blue',
name: 'app_id', 
render: function (data, type, full, meta) { 
return  full.app_ida   ; 
} },{ 
targets: [2], 
orderable: false, 
className: 'table-title',
name: 'stu_citizen_card', 
render: function (data, type, full, meta) { 
return  full.stu_citizen_card; 
} },{ 
targets: [3], 
orderable: false, 
className: 'table-desc',
name: 'stu_first_name_stu_last_name', 
render: function (data, type, full, meta) { 
return (  full.stu_first_name + '['+full.stu_first_name_en+']   ' + full.stu_last_name + '[' + full.stu_last_name_en + ']') ;
}},{ 
targets: [4], 
orderable: false, 
className: 'table-desc font-blue',
name: 'program_id',
render: function (data, type, full, meta) { 
return    full.program_id   ; 
} },{ 
targets: [5], 
orderable: false, 
className: 'table-title',
name: 'prog_type_name', 
render: function (data, type, full, meta) { 
return    full.prog_type_name ; 
} },{ 
targets: [6], 
orderable: false, 
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
orderable: false, 
className: 'table-desc',
name: 'flow_name', 
render: function (data, type, full, meta) { 
return ('<span class="label label-sm label-'+(( full.flow_id == 1)?'danger':((full.flow_id == 6)? 'success' :'info')) +'">'+ (('{{session('locale')}}'=='th')? full.flow_name : full.flow_name_en) +'</span>');
}}],      
                "bDestroy": true,
                "ordering": false,
                
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


</script>
@endpush
