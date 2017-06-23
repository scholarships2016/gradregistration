@extends('layouts.default')

@push('pageCss')
<style type="text/css">

</style>
@endpush

@section('pagebar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Blank Page</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Page Layouts</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                        data-toggle="dropdown"> Actions
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="#">
                            <i class="icon-bell"></i> Action</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-shield"></i> Another action</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-user"></i> Something else here</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <i class="icon-bag"></i> Separated link</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop

@section('pagetitle')
    <h1 class="page-title"> Blank Page Layout
        <small>blank page layout</small>
    </h1>
@stop



@section('maincontent')
    <div class="note note-info">
        <p> A black page template with a minimal dependency assets to use as a base for any custom page you
            create </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            HelloWorld
        </div>
    </div>
@stop


@push('pageJs')
<script type="application/javascript">
    $(document).ready(function () {
        alert("IamReady");
    });
</script>
@endpush