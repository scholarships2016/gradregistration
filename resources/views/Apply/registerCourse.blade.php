@extends('layouts.default')
<meta name="_token" content="{{ csrf_token() }}"/>
@push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/search.min.css')}}" rel="stylesheet" type="text/css">

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
            <span>ยืนยันการสมัคร</span>
        </li>
    </ul>
 
    </div>
@stop
                
@section('pagetitle')
 <h1 class="page-title"> ยืนยันการสมัคร  </h1>
    
@stop
 

@section('maincontent')
   <div class="page-container">{{csrf_field()}}
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
 <div class="search-page search-content-2">
                        <div  class="search-bar ">
                            <div class="row">
                                <div class="col-md-14">
                                                                                  <div class="note note-info">
                                                                <p>  ธนาคารที่ต้องการชำระเงิน.      </p>
                                                            </div>                       
                                                            <select   id="bank_id" class="form-control">                                
                                                                @foreach ($banks as $bank)
                                                                <option value="{{$bank->bank_id}}" {{ $Datas->bank_id == $bank->bank_id ? 'selected="selected"' : '' }}>{{$bank->bank_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
 
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="search-container ">
                                                            <ul>
                                                                <li class="search-item-header"> 
                                                                    <div class="row">
                                                                        <div class="note note-info">
                                                                            <p>   บุคคลอ้างอิง (สำหรับผู้สมัครระดับปริญญาเอกและมีภาควิชาต้องการหนังสือรับรองคุณสมบัติฯ ให้ระบุชื่อและที่อยู่ของผู้รับรองทั้งหมด) Reference  <a class="btn yellow  " href="#responsive" data-toggle="modal"> เพิ่มบุคคลอ้างอิง </a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                               
                                        <div class="table-scrollable">
                                        <table id="tblpeople" class="table table-striped table-bordered table-advance table-hover">
                                              <thead>
                                                <tr>
                                                    
                                                    <th>
                                                        <i class="fa fa-user"></i> ชื่อ </th>
                                                    <th class="hidden-xs">
                                                        <i class="fa fa-pencil"></i> ตำแหน่ง </th>
                                                    <th>
                                                        <i class="fa fa-phone"></i> เบอร์โทรศัพท์ </th>
                                                    <th> </th><th> </th>
                                                </tr>
                                            </thead>   
                     
                                        </table>
                                                                     </div>        <div style=" text-align: center;">       <a class="btn btn-lg blue  margin-bottom-5" id="pageSave"> บันทึก/Save
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
                                </div></div>
  @stop
<div class="page-content-wrapper">
               
           
 <div class="col-md-12">
 <div class="portlet light "><div class="portlet-body">
 <div tabindex="-1" class="modal fade in" id="responsive" aria-hidden="true" ><div class="modal-dialog">
                                            <div class="modal-content">
                                      <form id="addData"> 
                                          <div class="modal-dialog">       
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" aria-hidden="true" type="button" data-dismiss="modal"></button>
                                                    <h4 class="modal-title">Responsive &amp; Scrollable</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="slimScrollDiv" style="width: auto; height: auto; overflow: hidden; position: relative;"><div class="scroller" style="width: auto; height: auto; overflow: hidden;" data-initialized="1" data-always-visible="1" data-rail-visible1="1">
                                                       <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="hidden" id="row_id">
                                                                                <input type="hidden" id="RowNum">
                                                                                <input type="hidden" id="application_id" value="{{session('application_id')}}">
                                                                                <input type="hidden" id="app_people_id" >
                                                                                <input class="form-control" id="app_people_name" type="text" placeholder="Enter your name">
                                                                                <label for="form_control_1">ชื่อ/Name</label>
                                                                                <span class="help-block">ชื่อและนามสกุล.</span>
                                                                            </div>
                                                                              <div class="form-group form-md-line-input">
                                                                                <textarea class="form-control"id="app_people_address"  placeholder="Enter more text" rows="3"></textarea>
                                                                                <label for="form_control_1">ที่อยู่</label>
                                                                                <span class="help-block">ที่อยู่.</span>
                                                                            </div>
                                                                              <div class="form-group form-md-line-input">
                                                                                <input class="form-control" id="app_people_phone" type="text" placeholder="Enter your name">
                                                                                <label for="form_control_1">เบอร์โทรศัพท์</label>
                                                                                <span class="help-block">เบอร์โทรศัพท์.</span>
                                                                            </div> 
                                                                              <div class="form-group form-md-line-input">
                                                                                <input class="form-control" id="app_people_position" type="text" placeholder="Enter your name">
                                                                                <label for="form_control_1">ตำแหน่ง</label>
                                                                                <span class="help-block">ตำแหน่ง</span>
                                                                            </div>
                                                                        </div>
                                                                       
                                                                  
                                                        </div>
                                                    </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); border-radius: 7px; top: 0px; width: 7px; height: 300px; right: 1px; display: none; position: absolute; z-index: 99; opacity: 0.4;"></div><div class="slimScrollRail" style="background: rgb(234, 234, 234); border-radius: 7px; top: 0px; width: 7px; height: 100%; right: 1px; display: none; position: absolute; z-index: 90; opacity: 0.2;"></div></div>
                                             
                                                <div class="modal-footer">
                                                    <button class="btn dark " type="button" id="editdel" data-dismiss="modal">Close</button>
                                                    <button class="btn green" type="button" id="editSave" data-dismiss="modal">Save changes</button>
                                                </div>
                                               
                                          </div> </form></div></div>
                                       
 </div></div></div></div>
                </div></div>


 
 


                                            @push('pageJs')
                                            <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
                                            <script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
                                             <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
                                           <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
                                           <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
                                             <script type="application/javascript">
               
$(function() {
      var table = $('#tblpeople').DataTable({
        ajax: '{!! url('apply/peopleData/'.$idApp) !!}',
        columns: [
            { data: 'app_people_name', name: 'app_people_name' },
            { data: 'app_people_phone', name: 'app_people_phone' },            
            { data: 'app_people_position', name: 'app_people_position' },
            {
            targets : -1,
                data: null,
            defaultContent : '<a id="edit" class="btn green" href="#responsive" data-toggle="modal">Edit</a> '
        } ,{                
            targets : -2,
            data: null,
            defaultContent : '<a id="del" class="btn red " data-toggle="modal">Delete</a> '
        }
        ],   
         
    filter: false,
    info: false,
    ordering: false,
    processing: true,
    retrieve: false,
    paging:false
    });    
    
      $('#tblpeople tbody').on( 'click', 'a', function () {
       
         if($(this).attr('id')=="edit"){
          var data = table.row( $(this).parents('tr') ).data();
           
        $('#app_people_id').val(data['app_people_id']);
        $('#app_people_name').val(data['app_people_name']);
        $('#app_people_phone').val(data['app_people_phone']);
        $('#app_people_address').val(data['app_people_address']);
        $('#app_people_position').val(data['app_people_position']);
        $('#row_id').val($(this).parents('tr').index());
        
        
         }else if($(this).attr('id')=="del"){
          table.row( $(this).parents('tr') ).remove(); 
          table.draw();
        }
    } );
    
      $('#editdel').click(function() { cleardata(); });
    
      $('#editSave').click(function() {  
          
       if($('#row_id').val()==''){
       table.row.add( {
        "application_id":  {{$idApp}},
        "app_people_id":   $('#app_people_id').val()  ,
        "app_people_name":    $('#app_people_name').val() ,
        "app_people_phone": $('#app_people_phone').val() ,
        "app_people_address": $('#app_people_address').val() ,
        "app_people_position": $('#app_people_position').val() 
    } ).draw();    
    }else{
         table.row($('#row_id').val()).remove(); 
         table.row.add( {
       
        "application_id":  {{$idApp}},
        "app_people_id":   $('#app_people_id').val()  ,
        "app_people_name":    $('#app_people_name').val() ,
        "app_people_phone": $('#app_people_phone').val() ,
        "app_people_address": $('#app_people_address').val() ,
        "app_people_position": $('#app_people_position').val()
         
    }).draw();    
        }
     cleardata();
  
     });
        $('#pageSave').click(function() {  
 
                var valdata = [];
                table.rows().every(function(){
                valdata.push(this.data());
               
            });
           
  $.ajax({
					type: "POST",
					url: '{!! Route('datatables.savePeopoleRef') !!}',
					data :{ 
                                                values : JSON.stringify(valdata),
                                                bank_id : $('#bank_id').val(),
                                                application_id : {{$idApp}},
                                                _token:     '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                  	window.location.href = '{!! Route('manageMyCourse') !!}';
                                                
					}
				},"json");
                
          });
  
  
  
       });

 function cleardata(){
        $('#app_people_id').val(null);
        $('#app_people_name').val(null);
        $('#app_people_phone').val(null);
        $('#app_people_address').val(null);
        $('#app_people_position').val(null);
        $('#row_id').val(null);
 }
                                          </script>
                                            @endpush



