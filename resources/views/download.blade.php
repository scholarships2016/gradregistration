@extends('layouts.default')

@push('pageCss')
<link id="style_color" href="../assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css">
<link href="../assets/pages/css/contact.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
.page-content{max-height: 750px;}
</style>
@endpush

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('faq/')}}">{{Lang::get('resource.lbMDownlods')}}</a>
            <i class="fa fa-circle"></i>
        </li>

    </ul>
  
</div>
@stop

@section('pagetitle')

@stop



@section('maincontent')
 <div class="note note-info">
                            <p>{{Lang::get('resource.lbMDownlods')}} </p>
                        </div>

 <div class="row">
                          <div class="col-md-12">
                            <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <i class="fa fa-briefcase"></i> File Name </th>
                                                        <th class="hidden-xs">
                                                            <i class="fa fa-question"></i> Descrition </th>
                                                        <th>
                                                            <i class="fa fa-bookmark"></i> Size </th>
                                                        <th>
<i class="fa fa-bookmark"></i> Download </th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"> Pixel Ltd </a>
                                                        </td>
                                                        <td class="hidden-xs"> Server hardware purchase </td>
                                                        <td> 52560.10$
                                                            <span class="label label-success label-sm"> Paid </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"> Smart House </a>
                                                        </td>
                                                        <td class="hidden-xs"> Office furniture purchase </td>
                                                        <td> 5760.00$
                                                            <span class="label label-warning label-sm"> Pending </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"> FoodMaster Ltd </a>
                                                        </td>
                                                        <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                                        <td> 12400.00$
                                                            <span class="label label-success label-sm"> Paid </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"> WaterPure Ltd </a>
                                                        </td>
                                                        <td class="hidden-xs"> Payment for Jan 2013 </td>
                                                        <td> 610.50$
                                                            <span class="label label-danger label-sm"> Overdue </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"> Pixel Ltd </a>
                                                        </td>
                                                        <td class="hidden-xs"> Server hardware purchase </td>
                                                        <td> 52560.10$
                                                            <span class="label label-success label-sm"> Paid </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"> Smart House </a>
                                                        </td>
                                                        <td class="hidden-xs"> Office furniture purchase </td>
                                                        <td> 5760.00$
                                                            <span class="label label-warning label-sm"> Pending </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"> FoodMaster Ltd </a>
                                                        </td>
                                                        <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                                        <td> 12400.00$
                                                            <span class="label label-success label-sm"> Paid </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                              </div>
                        </div>

@stop


@push('pageJs')

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn-qdME6ljUshU0gN9ZeT_cOPVYXvQcBE&callback=initMap&language={{strtoupper(session('locale'))}}&region={{strtoupper(session('locale'))}}"
type="text/javascript"></script>
<script type="application/javascript">
      function initMap() {
        var uluru = {lat: 13.73841, lng: 100.52826};
        var map = new google.maps.Map(document.getElementById('gmapbg'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }  
</script>
@endpush