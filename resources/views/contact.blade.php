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
            <a href="{{url('contact/')}}">{{Lang::get('resource.lbContacts')}}</a>
            <i class="fa fa-circle"></i>
        </li>

    </ul>

</div>
@stop

@section('pagetitle')

@stop



@section('maincontent')


<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="c-content-contact-1 c-opt-1">
    <div class="row" data-auto-height=".c-height">
        <div class="col-lg-7 col-md-6 c-desktop"></div>
        <div class="col-lg-5 col-md-6">
            <div class="c-body">
                <div class="c-section">
                    <h3>{{Lang::get('resource.lbNameContact')}}</h3>
                </div>
                <div class="c-section">
                    <div class="c-content-label uppercase bg-blue">{{Lang::get('resource.lbAddress')}}</div>
                    <p>{!!Lang::get('resource.lbAddress1Contact')!!}<br><br>{!!Lang::get('resource.lbAddress2Contact')!!}</p>
                </div>
                <div class="c-section">
                    <div class="c-content-label uppercase bg-blue">{{Lang::get('resource.lbContacts')}}</div>
                    <p>
                        {{Lang::get('resource.lbTelContact')}}


                         </p>
                </div>

            </div>
        </div>
    </div>
    <div id="gmapbg" class="c-content-contact-1-gmap" style="height: 615px; overflow: hidden;"> </div>
</div>





@stop


@push('pageJs')

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn-qdME6ljUshU0gN9ZeT_cOPVYXvQcBE&callback=initMap&language={{strtoupper(session('locale'))}}&region={{strtoupper(session('locale'))}}"
type="text/javascript"></script>
<script type="application/javascript">
      function initMap() {
        var uluru = {lat: 13.742835, lng: 100.5277266};
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
