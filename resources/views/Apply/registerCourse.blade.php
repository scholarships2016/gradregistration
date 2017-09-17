@extends('layouts.default')

@push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/search.min.css')}}" rel="stylesheet" type="text/css">

<style type="text/css">

</style>
@endpush

@section('pagebar')
@php ($count=1)
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
            <span>{{Lang::get('resource.lbConfirmApply')}}</span>
        </li>
    </ul>
    {{--<div class="page-tool    bar">--}}
    {{--<div class="btn-group pull-right">--}}
    {{--<butto    n type="button" class="btn green btn-sm btn-outline dropdown-toggle"--}}
    {{--data-toggl    e="dropdown"> Actions--}}
    {{--<i class="fa f    a-angle-down"></i>--}}
    {{--</button>--}}
        {{--<ul clas    s="dropdown-menu pull-right" role="menu">--}}
        {{--<li>--}}
        {{--<a href="#">-    -}}
        {{--<i cl    ass="icon-bell"></i> Action</    a>--}}
                {{--                                            </li>--}}
                    {{--                <li>--}}
                                            {{--<a href="#">--}}
        {{--<i class="icon-shield"></i> Another action</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="#">--}}
                {{--<i class="ico                n-user"></i> Something else h                ere</a>--}}
                {{--</li>--}}
                    {{--                <li class="divider"></li>--}}
                    {{--<li>--}}
                                             {{--<a href="#">--}}
                                            {{--<i class="icon-bag"></i> Separated link</a>--}}
                {{--</li>--}}
                {{--</ul>--}                }
                                     {{--</div>--}}
                  {{--</div>--}}
    </div>
@stop
@section('pagetitle')
    <h1 class="page-title"> {{Lang::get('resource.lbConfirmApply')}}</h1>

    <div class="m-heading-1 border-yellow-lemon m-bordered">
      <h3>
        <span class="item">
          <span aria-hidden="true" class="icon-info"></span> {{Lang::get('resource.lbConfirmInstructions')}}
        </span>
      </h3>
    </div>
@stop

@section('maincontent')
   <div class="page-container">
{{csrf_field()}}


<div class="page-sidebar-wrapper">
 <div class="search-page search-content-2">

   <div class="row">
     <div class="col-md-12">
           <div class="note note-pink">
               <span class="badge badge-info">{{$count++}}</span>  {{Lang::get('resource.lbConfirmPaymentBank')}}
           </div>

       </div>
   </div>
   <div class="row">
     <div class="form-group">
          <label class="col-md-1  col-md-offset-1 control-label">{{Lang::get('resource.lbConfirmPaymentBank-1')}} </label>
          <div class="col-md-3">
            <select id="bank_id" class="form-control">
              <option value="">-- Select --</option>
                @foreach ($banks as $bank)
                <option value="{{$bank->bank_id}}" {{ $Datas->bank_id == $bank->bank_id ? 'selected="selected"' : '' }}>{{ (session('locale')=='th'?$bank->bank_name:$bank->bank_name_en)}}</option>
                @endforeach
            </select>
          </div>
      </div>

   </div>
<br/>

   @foreach ($Qus as $Q)
     @if($Q->additional_question !="")
   <div class="row" style="display:block;">
     <div class="col-md-12">
       <div class="note note-pink">
         <span class="badge badge-info">{{$count++}}</span>   {{Lang::get('resource.lbQuestionAsk')}}
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <i class="icon-question"></i>
                                                                     {!!$Q->additional_question !!}

      </div>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
      <div class="form-group form-md-line-input form-md-floating-label has-success">
          <textarea class="form-control" name="additional_answer" id="additional_answer" rows="3"></textarea>
          <label for="form_control_1">{{Lang::get('resource.lbAnswer')}}</label>
          <span class="help-block">{{Lang::get('resource.lbAnswer')}}...</span>
      </div>
    </div>
  </div>
  @endif
@endforeach




<div class="row">
  <div class="col-md-12">
    <div class="search-container ">
      <div class="row">
        <div class="col-md-12">
          <div class="note note-pink">
            <span class="badge badge-info">{{$count++}}</span> {{Lang::get('resource.lbConfirmReferencePerson')}}
         </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-11 col-md-offset-1">
           <a href="#responsive" class="btn btn-circle green btn-outline sbold uppercase" data-toggle="modal">
           <i class="fa fa-plus"></i> {{Lang::get('resource.btnConfirmAddReferencePerson')}}
         </a>
           <div class="table" style="margin-top:10px;">
             <table id="tblpeople" class="table table-striped table-bordered table-advance table-hover">
                 <thead>
                   <tr>
                       <th>
                           <i class="fa fa-user"></i> {{Lang::get('resource.lbConfirmTableReferencePersonFullname')}} </th>

                       <th class="hidden-xs">
                           <i class="fa fa-mortar-board"></i> {{Lang::get('resource.lbConfirmTableReferencePersonPosition')}} </th>
                           <th class="hidden-xs">
                               <i class="fa fa-home"></i> {{Lang::get('resource.lbConfirmTableReferencePersonContactAddr')}} </th>
                       <th>
                           <i class="fa fa-phone"></i> {{Lang::get('resource.lbConfirmTableReferencePersonTel')}} </th>
                       <th> </th><th> </th>
                   </tr>
               </thead>
           </table>
          </div>
          </div>
        </div>


    </div>
  </div>
</div>

 <div tabindex="-1" class="modal fade in" id="responsive" aria-hidden="true" ><div class="modal-dialog">
                                            <div class="modal-content">
                                      <form id="addData">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" aria-hidden="true" type="button" data-dismiss="modal"></button>
                                                    <h4 class="modal-title">Reference Person Information</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="slimScrollDiv" style="width: auto; height: auto; overflow: hidden; position: relative;"><div class="scroller" style="width: auto; height: auto; overflow: hidden;" data-initialized="1" data-always-visible="1" data-rail-visible1="1">
                                                       <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="hidden" id="row_id">
                                                                                <input type="hidden" id="RowNum">
                                                                                <input type="hidden" id="application_id" value="{{session('application_id')}}">
                                                                                <input type="hidden" id="app_people_id" >
                                                                                <input class="form-control" id="app_people_name" type="text" placeholder="Enter Fullname">
                                                                                <label for="form_control_1">{{Lang::get('resource.lbConfirmTableReferencePersonFullname')}}</label>
                                                                                <span class="help-block">{{Lang::get('resource.lbConfirmTableReferencePersonFullname')}}</span>
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                              <input class="form-control" id="app_people_position" type="text" placeholder="Enter Position">
                                                                              <label for="form_control_1">{{Lang::get('resource.lbConfirmTableReferencePersonPosition')}}</label>
                                                                              <span class="help-block">{{Lang::get('resource.lbConfirmTableReferencePersonPosition')}}</span>
                                                                          </div>
                                                                              <div class="form-group form-md-line-input">
                                                                                <textarea class="form-control"id="app_people_address"  placeholder="Enter Address" rows="3"></textarea>
                                                                                <label for="form_control_1">{{Lang::get('resource.lbConfirmTableReferencePersonContactAddr')}}</label>
                                                                                <span class="help-block">{{Lang::get('resource.lbConfirmTableReferencePersonContactAddr')}}</span>
                                                                            </div>
                                                                              <div class="form-group form-md-line-input">
                                                                                <input class="form-control" id="app_people_phone" type="text" placeholder="Enter Telephone Number">
                                                                                <label for="form_control_1">{{Lang::get('resource.lbConfirmTableReferencePersonTel')}}</label>
                                                                                <span class="help-block">{{Lang::get('resource.lbConfirmTableReferencePersonTel')}}</span>
                                                                            </div>

                                                                        </div>


                                                        </div>
                                                    </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); border-radius: 7px; top: 0px; width: 7px; height: 300px; right: 1px; display: none; position: absolute; z-index: 99; opacity: 0.4;"></div><div class="slimScrollRail" style="background: rgb(234, 234, 234); border-radius: 7px; top: 0px; width: 7px; height: 100%; right: 1px; display: none; position: absolute; z-index: 90; opacity: 0.2;"></div></div>





                                                <div class="modal-footer">
                                                    <button class="btn dark " type="button" id="editdel" data-dismiss="modal">Close</button>
                                                    <button class="btn green" type="button" id="editSave" data-dismiss="modal">Save changes</button>
                                                </div>

                                          </div> </form></div></div>

 </div></div>




    @if($Sats==null)
      <div class="row">
        <div class="col-md-12">
          <div class="search-container ">
            <div class="row">
              <div class="col-md-12">
                <div class="note note-pink">
                  <span class="badge badge-info">{{$count++}}</span> {{Lang::get('resource.lbConfirmTSurveyTopic')}}


               </div>
               </div>
             </div>

             <div class="row">
               <div class="col-md-11 col-md-offset-1">
                   <div style=" text-align: center;">
                   <div class="md-radio-inline">
                     <label class="col-md-2 control-label" for="form_control_1">{{Lang::get('resource.lbConfirmTSurveyLevel')}}</label>

                   <div class="md-radio">
                   <input type="radio" id="radio1" value="1" name="radioB" class="md-radiobtn">
                   <label for="radio1">
                   <span class="inc"></span>
                   <span class="check"></span>
                   <span class="box"></span> {{Lang::get('resource.lbConfirmTSurveyLevel1')}}</label>
                   </div>
                                     <div class="md-radio">
                   <input type="radio" id="radio2"  value="2"  name="radioB" class="md-radiobtn">
                   <label for="radio2">
                   <span class="inc"></span>
                   <span class="check"></span>
                   <span class="box"></span> {{Lang::get('resource.lbConfirmTSurveyLevel2')}} </label>
                   </div>
                                     <div class="md-radio">
                   <input type="radio" id="radio3"  value="3"  name="radioB" checked class="md-radiobtn">
                   <label for="radio3">
                   <span class="inc"></span>
                   <span class="check"></span>
                   <span class="box"></span> {{Lang::get('resource.lbConfirmTSurveyLevel3')}} </label>
                   </div>
                                     <div class="md-radio">
                   <input type="radio" id="radio4" value="4"  name="radioB" class="md-radiobtn">
                   <label for="radio4">
                   <span class="inc"></span>
                   <span class="check"></span>
                   <span class="box"></span> {{Lang::get('resource.lbConfirmTSurveyLevel4')}} </label>
                   </div>
                                     <div class="md-radio">
                   <input type="radio" id="radio5"  value="5"  name="radioB" class="md-radiobtn">
                   <label for="radio5">
                   <span class="inc"></span>
                   <span class="check"></span>
                   <span class="box"></span> {{Lang::get('resource.lbConfirmTSurveyLevel5')}}  </label>
                   </div>
                   <br><br>

                   <div class="form-group form-md-line-input has-success">
                   <label class="col-md-2 control-label" for="form_control_1">{{Lang::get('resource.lbConfirmTSurveySugestion')}}</label>
                   <div class="col-md-10">
                   <input type="text" class="form-control" id="txtSug" name="txtSug" placeholder="">
                   <div class="form-control-focus"> </div>
                   </div>
                   </div>
                   </div>


                   </div>
               </div>
             </div>


          </div>
      </div>
    </div>


    @endif
         <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="search-container ">
                                                            <ul>
                                                                 <li class="search-item-header">
                                                                       <div class="row" style=" text-align: center;  ">
                                                                           <a class="btn btn-lg blue  margin-bottom-5" id="pageSave"> {{Lang::get('resource.lbSave')}}
                                      <i class="fa fa-check"></i>
                                    </a>
                                  <a class="btn btn-lg grey-steel  margin-bottom-5" href="{{url('application/manageMyCourse/')}}">  {{Lang::get('resource.lbCancel')}}
                                        <i class="fa fa-times"></i>
                                    </a>
                                                                       </div>  </li>
                                                            </ul></div></div></div>

                                            </div>
                                </div>
   </div>



  @stop




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
              { data: 'app_people_position', name: 'app_people_position' },
            { data: 'app_people_address', name: 'app_people_address' },
            { data: 'app_people_phone', name: 'app_people_phone' },

            {
            targets : -1,
                data: null,
            defaultContent : '<a id="edit" class="btn blue" href="#responsive" data-toggle="modal"><i class="fa fa-pencil"></i>Edit</a> '
        } ,{
            targets : -2,
            data: null,
            defaultContent : '<a id="del" class="btn red " data-toggle="modal"><i class="fa fa-trash"></i>Delete</a> '
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

               if(valdata.length > 0 && $("#bank_id option:selected").index()>0){
                             $.ajax({
					type: "POST",
					url: '{!! Route('datatables.savePeopoleRef') !!}',
					data :{
                                                values : JSON.stringify(valdata),
                                                bank_id : $('#bank_id').val(),
                                                SATI_SUGGESTION  : $('#txtSug').val(),
                                                SATI_LEVEL   :$('input[name=radioB]:checked').val(),
                                                additional_answer :$('#additional_answer').val(),
                                                application_id : {{$idApp}},
                                                _token:     '{{ csrf_token() }}'
                                               } ,
					success : function(data){
                                        toastr.success('ดำเนินการเรียบร้อย');
                                 	window.location.href = '{!! Route('manageMyCourse') !!}';

					}
				},"json");
                                }else{
                              toastr.warning('plz,Reference Person Information Or Bank?');
                        }

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
