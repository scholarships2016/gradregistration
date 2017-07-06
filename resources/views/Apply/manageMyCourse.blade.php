@extends('layouts.default')

@push('pageCss')

 <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/invoice.min.css')}}" rel="stylesheet" type="text/css">
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
            <span>สมัคร</span>
        </li>
        <li>
            <span>วิธีการสมัคร</span>
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
    <h1 class="page-title"> Graduate Student Registration</h1>
    
@stop
 

@section('maincontent')
   
<div class="invoice">
                            <div class="row invoice-logo">
                                <div class="col-xs-6 invoice-logo-space">
                                    <img class="img-responsive" alt="" src="../assets/pages/media/invoice/walmart.png"> </div>
                                <div class="col-xs-6">
                                    <p> #5652256 / 28 Feb 2013
                                        <span class="muted"> Consectetuer adipiscing elit </span>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-4">
                                    <h3>Client:</h3>
                                    <ul class="list-unstyled">
                                        <li> John Doe </li>
                                        <li> Mr Nilson Otto </li>
                                        <li> FoodMaster Ltd </li>
                                        <li> Madrid </li>
                                        <li> Spain </li>
                                        <li> 1982 OOP </li>
                                    </ul>
                                </div>
                                <div class="col-xs-4">
                                    <h3>About:</h3>
                                    <ul class="list-unstyled">
                                        <li> Drem psum dolor sit amet </li>
                                        <li> Laoreet dolore magna </li>
                                        <li> Consectetuer adipiscing elit </li>
                                        <li> Magna aliquam tincidunt erat volutpat </li>
                                        <li> Olor sit amet adipiscing eli </li>
                                        <li> Laoreet dolore magna </li>
                                    </ul>
                                </div>
                                <div class="col-xs-4 invoice-payment">
                                    <h3>Payment Details:</h3>
                                    <ul class="list-unstyled">
                                        <li>
                                            <strong>V.A.T Reg #:</strong> 542554(DEMO)78 </li>
                                        <li>
                                            <strong>Account Name:</strong> FoodMaster Ltd </li>
                                        <li>
                                            <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                                        <li>
                                            <strong>Account Name:</strong> FoodMaster Ltd </li>
                                        <li>
                                            <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Item </th>
                                                <th class="hidden-xs"> Description </th>
                                                <th class="hidden-xs"> Quantity </th>
                                                <th class="hidden-xs"> Unit Cost </th>
                                                <th> Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> 1 </td>
                                                <td> Hardware </td>
                                                <td class="hidden-xs"> Server hardware purchase </td>
                                                <td class="hidden-xs"> 32 </td>
                                                <td class="hidden-xs"> $75 </td>
                                                <td> $2152 </td>
                                            </tr>
                                            <tr>
                                                <td> 2 </td>
                                                <td> Furniture </td>
                                                <td class="hidden-xs"> Office furniture purchase </td>
                                                <td class="hidden-xs"> 15 </td>
                                                <td class="hidden-xs"> $169 </td>
                                                <td> $4169 </td>
                                            </tr>
                                            <tr>
                                                <td> 3 </td>
                                                <td> Foods </td>
                                                <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                                <td class="hidden-xs"> 69 </td>
                                                <td class="hidden-xs"> $49 </td>
                                                <td> $1260 </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="well">
                                        <address>
                                            <strong>Loop, Inc.</strong>
                                            <br> 795 Park Ave, Suite 120
                                            <br> San Francisco, CA 94107
                                            <br>
                                            <abbr title="Phone">P:</abbr> (234) 145-1810 </address>
                                        <address>
                                            <strong>Full Name</strong>
                                            <br>
                                            <a href="mailto:#"> first.last@email.com </a>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-xs-8 invoice-block">
                                    <ul class="list-unstyled amounts">
                                        <li>
                                            <strong>Sub - Total amount:</strong> $9265 </li>
                                        <li>
                                            <strong>Discount:</strong> 12.9% </li>
                                        <li>
                                            <strong>VAT:</strong> ----- </li>
                                        <li>
                                            <strong>Grand Total:</strong> $12489 </li>
                                    </ul>
                                    <br>
                                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a class="btn btn-lg green hidden-print margin-bottom-5"> Submit Your Invoice
                                        <i class="fa fa-check"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                                                                          @stop


                                                                          @push('pageJs')
                                                                          <script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
                                                                          <script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
                                                                          <script type="application/javascript">
                                                                             
                                                                          </script>
                                                                          @endpush
                                                                          
                                                                          @extends('layouts.default')