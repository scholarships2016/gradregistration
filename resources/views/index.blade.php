@extends('layouts.default')

@push('pageCss')
<link href="{{asset('css/toastr.css')}}" rel="stylesheet">
<style type="text/css">

</style>
@endpush

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@stop

@section('main-content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            {{--{{dd($this->session)}}--}}
            Gameeee TEsttt
{{--            {{dd(Session::get('moduleAuths'))}}--}}
        </div>
    </div>
@stop


@push('pageJs')
<script src="{{asset('js/toastr.js')}}"></script>
<script type="application/javascript">
    $(document).ready(function () {
        @include('includes.toastr')
    });
</script>
@endpush