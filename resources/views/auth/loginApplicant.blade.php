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
        <h3 class="form-title">{{Lang::get('resource.lbLoginToptic')}}     </h3>


        <div class="alert al                                       ert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any e-mail and password.     </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginEmail')}}</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" pattern="[^ @]*@[^ @]*" type="text" autocomplete="off" placeholder="{{Lang::get('resource.lbLoginEmail')}}"
                      id="stu_email" name="stu_email"/></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginSignupPassword')}}</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                       placeholder="{{Lang::get('resource.lbLoginSignupPassword')}}" id="stu_password" name="stu_password"/></div>
        </div>
        <div class="formm-group">
          <div class="g-recaptcha" data-sitekey="6LdTciwUAAAAAIghJhuM4wf8Dnzc-eadlLikCWiR"  data-callback="recaptchaCallback"></div>
          <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">

        </div>
        <div class="form-actions">

            <button type="submit" class="btn green pull-right"> {{Lang::get('resource.lbLoginButton')}}</button>
        </div>
        <div class="forget-password">
            <h4>{{Lang::get('resource.lbLoginForgetPassword')}}</h4>
            <p>  <button type="button" class="btn btn-circle red-pink btn-outline  "  id="forget-password">{{Lang::get('resource.lbLoginForgetPasswordButton')}}</button>
                {{Lang::get('resource.lbLoginForgetPasswordButtonDesc')}} </p>
        </div>
        <div class="create-account">
            <p> {{Lang::get('resource.lbLoginRegisterToptic')}}&nbsp;

                <a href="javascript:;" class="btn btn-circle btn-lg red-pink" id="register-btn"><span class="icon-user-follow"> </span> {{Lang::get('resource.lbLoginRegisterButton')}}

                                                                        </a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="{{route('rePassLoginApplicant')}}" method="post">
        {{csrf_field()}}
        <h3>{{Lang::get('resource.lbLoginForgetPassword')}}</h3>
        <p> {{Lang::get('resource.lbLoginForgetPasswordDesc')}} </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" pattern="[^ @]*@[^ @]*" type="text" autocomplete="off" placeholder="{{Lang::get('resource.lbLoginEmail')}}"
                      id="stu_email" name="stu_email"/></div>
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
        <h3>{{Lang::get('resource.lbLoginSignup')}} </h3>
        <h4> {{Lang::get('resource.lbLoginSignupDesc')}}  </h4>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginSignupCitizen')}} </label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="{{Lang::get('resource.lbLoginSignupCitizen')}}" id="stu_citizen_card" name="stu_citizen_card"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{Lang::get('resource.lbLoginSignupNameTitle')}}</label>
            <select name="name_title_id" id="name_title_id" placeholder="{{Lang::get('resource.lbLoginSignupNameTitle')}}" class="select2 form-control">
                <option value="">--Select--</option>
                @if($titles)
                @foreach($titles as $key => $title)
                <option value="{{$title->name_title_id}}">{{$title->name_title.' - '.$title->name_title_en}}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginSignupFirstname')}}</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" onkeyup="return this.value = this.value.toUpperCase()" type="text" placeholder="{{Lang::get('resource.lbLoginSignupFirstname')}}" id="stu_first_name_en" name="stu_first_name_en"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginSignupLastname')}}</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" onkeyup="return this.value = this.value.toUpperCase()" type="text" placeholder="{{Lang::get('resource.lbLoginSignupLastname')}}" id="stu_last_name_en" name="stu_last_name_en"/>
            </div>
        </div>


        <div class="form-group" style="border-bottom: 1px dotted #eee;padding-bottom:20px;">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginSignupTel')}}</label>
            <div class="input-icon">
                <i class="fa fa-phone"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="{{Lang::get('resource.lbLoginSignupTel')}}" id="stu_phone" name="stu_phone"/></div>
        </div>



        <h4> {{Lang::get('resource.lbLoginSignupLogin')}} </h4>
 <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginEmail')}}</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" pattern="[^ @]*@[^ @]*" placeholder="{{Lang::get('resource.lbLoginEmail')}}" id="stud_email" name="stu_email"/></div>
        </div>
        <div class="form-group">
            <label class="control-label ">{{Lang::get('resource.lbLoginSignupPasswordDesc')}}</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                       id="register_password" placeholder="{{Lang::get('resource.lbLoginSignupPassword')}}" id="stu_password" name="stu_password"/></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{Lang::get('resource.lbLoginSignupPasswordReType')}}</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                           placeholder="{{Lang::get('resource.lbLoginSignupPasswordReType')}}" id="rpassword" name="rpassword"/></div>
            </div>
        </div>
        <div class="formm-group">
          <div class="g-recaptcha" data-sitekey="6LdTciwUAAAAAIghJhuM4wf8Dnzc-eadlLikCWiR"></div>
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
<div class="copyright"> {{Lang::get('resource.lbLoginCopyright')}}</div>
<!-- END COPYRIGHT -->
@stop


@push('pagelevelplugin')
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
@endpush

@push('pageJs')
<script src="{{asset('assets/pages/scripts/login-4.js')}}"></script>

<script type="application/javascript">
function recaptchaCallback() {
  $('#hiddenRecaptcha').valid();
};
</script>
@endpush
