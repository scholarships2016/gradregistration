@extends('layouts.default')

@push('pageCss')
<link id="style_color" href="../assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css">
<link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css">
 <link href="../assets/pages/css/about.min.css" rel="stylesheet" type="text/css">
<style type="text/css">

</style>
@endpush

@section('pagebar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('home/')}}">{{Lang::get('resource.lbMHome')}}</a>
                <i class="fa fa-circle"></i>
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
     
@stop



@section('maincontent')
     
                        <h1 class="page-title"> Admin Dashboard
                            <small>statistics, charts, recent events and reports</small>
                        </h1>
                      

                        <div class="row margin-bottom-40">
                            <!-- Start Left Panel -->
                            <div class="col-md-8">
                                <div class="row margin-bottom-40 about-header">
                                    <div class="col-md-12">
                                        <h1>Welcome to</h1>
                                        <h2>Graduate School Admission System</h2>
                                        <button class="btn btn-danger" type="button">JOIN US TODAY</button>
                                    </div>
                                </div>
                                <div class="row margin-bottom-40">
                                    <div class="col-lg-12">
                                        <div class="portlet light about-text">
                                            <h4>
                                                <i class="fa fa-check icon-info"></i>News/Update</h4>
                                            <p class="margin-top-20"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                                                lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et
                                                iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                                        <li>
                                                            <i class="fa fa-check"></i> Nam liber tempor cum soluta </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Lorem ipsum dolor sit amet </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-6">
                                                    <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                                        <li>
                                                            <i class="fa fa-check"></i> Nam liber tempor cum soluta </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Lorem ipsum dolor sit amet </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="about-quote">
                                                <h3>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh</h3>
                                                <p class="about-author">Tom Hardy, 2015</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row margin-bottom-40">
                                    <div class="col-lg-12">
                                        <div class="portlet light about-text">
                                            <h4>
                                                <i class="fa fa-check icon-info"></i>News/Update</h4>
                                            <p class="margin-top-20"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                                                lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et
                                                iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                                        <li>
                                                            <i class="fa fa-check"></i> Nam liber tempor cum soluta </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Lorem ipsum dolor sit amet </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-6">
                                                    <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                                        <li>
                                                            <i class="fa fa-check"></i> Nam liber tempor cum soluta </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Lorem ipsum dolor sit amet </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        <li>
                                                            <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="about-quote">
                                                <h3>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh</h3>
                                                <p class="about-author">Tom Hardy, 2015</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Left Panel -->
                            <!-- Start Right Panel -->
                            <div class="col-md-4">
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="card-icon">
                                                <i class="icon-user-follow font-red-sunglo theme-font"></i>
                                            </div>
                                            <div class="card-title">
                                                <span>Apply Now</span>
                                            </div>
                                            <div class="card-desc">
                                                <span> The best way to find yourself is
                                                    <br> to lose yourself in the service of others </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-bottom-20"><a href="{{url('login')}}">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="card-icon">
                                                <i class="icon-trophy font-green-haze theme-font"></i>
                                            </div>
                                            <div class="card-title">
                                                <span>Login &amp; Check Status</span>
                                            </div>
                                            <div class="card-desc">
                                                <span> The best way to find yourself is
                                                    <br> to lose yourself in the service of others </span>
                                            </div>
                                        </div>
                                    </div></a>
                                        </div>
                                    <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="card-icon">
                                                <i class="icon-basket font-purple-wisteria theme-font"></i>
                                            </div>
                                            <div class="card-title">
                                                <span>Registration</span>
                                            </div>
                                            <div class="card-desc">
                                                <span> The best way to find yourself is
                                                    <br> to lose yourself in the service of others </span>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                    <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="card-icon">
                                                <i class="icon-layers font-blue theme-font"></i>
                                            </div>
                                            <div class="card-title">
                                                <span>Contact Us</span>
                                            </div>
                                            <div class="card-desc">
                                                <span> The best way to find yourself is
                                                    <br> to lose yourself in the service of others </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Right Panel -->
                        </div>


 
@stop


@push('pageJs')
<script type="application/javascript">
    $(document).ready(function () {
        alert("IamReady");
    });
</script>
@endpush