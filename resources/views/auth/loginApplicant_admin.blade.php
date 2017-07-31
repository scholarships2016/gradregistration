@extends('layouts.default2')

@section('maincontent')
<!-- BEGIN LOGO -->


<div class=    "logo">
    <a href="index.html">
        <img src="../assets/pages/img/logo-big.png" alt=""/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->

    <form class="login-form" action="{{ url('/login_admin')}}" method="post">    
        {{csrf_field()}}
        <h3 class="form-title">Login to your account     </h3>


        <div class="alert al                                       ert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any e-mail and password.     </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">User-Name</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix"   type="text" autocomplete="off" placeholder="Username"
                       name="user_name"/></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                       placeholder="Password" name="user_password"/></div>
        </div>
        <div class="form-actions">

            <button type="submit" class="btn green pull-right"> Login</button>
        </div>
        <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p> no worries, click
                <a href="javascript:;" id="forget-password"> here </a> to reset your password. </p>
        </div>
        <div class="create-account">
            <p> Don't have an account yet ?&nbsp;
                <a href="javascript:;" id="register-btn"> Create an account </a>
            </p>
        </div>
    </form>
    
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> 2014 &copy; Metronic - Admin Dashboard Template.</div>
<!-- END COPYRIGHT -->
@stop


@push('pagelevelplugin')
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}"></script>
@endpush

@push('pageJs')
<script src="{{asset('assets/pages/scripts/login-4.min.js')}}"></script>
<script type="application/javascript">
</script>
@endpush