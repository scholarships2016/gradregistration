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

    <form class="login-form" action="{{ url('/login')}}" method="post">    
        {{csrf_field()}}
        <h3 class="form-title">Login to your account     </h3>


        <div class="alert al                                       ert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any e-mail and password.     </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">E-Mail</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" pattern="[^ @]*@[^ @]*" type="text" autocomplete="off" placeholder="E-Mail"
                       name="stu_email"/></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                       placeholder="Password" name="stu_password"/></div>
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
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="{{route('rePassLoginApplicant')}}" method="post">
        {{csrf_field()}}
        <h3>Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" pattern="[^ @]*@[^ @]*" type="text" autocomplete="off" placeholder="Email"
                       name="stu_email"/></div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn red btn-outline">Back</button>
            <button type="submit" class="btn green pull-right"> Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="{{route('registerApplicant')}}" method="post">
        {{csrf_field()}}
        <h3>Sign Up</h3>
        <p> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Citizen/Passport</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Citizen/Passport" name="stu_citizen_card"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Title</label>
            <select name="name_title_id" id="name_title_id" placeholder="Title" class="select2 form-control">
                <option value=""></option>
                @if($titles)
                @foreach($titles as $key => $title)
                <option value="{{$title->name_title_id}}">{{$title->name_title}}</option> 
                @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">First-Name</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="First-Name" name="stu_first_name"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Last-Name</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Last-Name" name="stu_last_name"/>
            </div>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" pattern="[^ @]*@[^ @]*" placeholder="Email" name="stu_email"/></div>
        </div>

        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Phone</label>
            <div class="input-icon">
                <i class="fa fa-phone"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Phone" name="stu_phone"/></div>
        </div>



        <p> Enter your password below: </p>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                       id="register_password" placeholder="Password" name="stu_password"/></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                           placeholder="Re-type Your Password" name="rpassword"/></div>
            </div>
        </div>

        <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn red btn-outline"> Back</button>
            <button type="submit" id="register-submit-btn" class="btn green pull-right"> Sign Up</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
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