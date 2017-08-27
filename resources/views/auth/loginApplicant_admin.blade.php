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
        <h3 class="form-title">เข้าสู่ระบบ สำหรับผู้ดูแลระบบ    </h3>
        <div class="alert alert-info display">
            <button class="close" data-close="alert"></button>
            <i class="icon-info"></i> <span> กรอกรหัสผู้ใช้ และรหัสผ่าน ชุดเดียวกับ Chula Web Mail     </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">รหัสผู้ใช้</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" id="user_name"  type="text" autocomplete="off" placeholder="กรอกรหัสผู้ใช้"
                       name="user_name"/></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">รหัสผ่าน</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                       placeholder="กรอกรหัสผ่าน" id="user_password" name="user_password"/></div>
        </div>
        <div class="formm-group">
          <div class="g-recaptcha" data-sitekey="6LdTciwUAAAAAIghJhuM4wf8Dnzc-eadlLikCWiR"  data-callback="recaptchaCallback"></div>
          <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">

        </div>
        <div class="form-actions">
            <button type="submit" class="btn green pull-right"> เข้าสู่ระบบ</button>
        </div>

        <div class="forget-password">
            <h4>กรณีลืมรหัสผ่าน</h4>
            <p>
                <a href="http://www.it.chula.ac.th/" target="_blank" >โปรดติดต่อสำนักบริหารเทคโนโลยีสารสนเทศ </a>  </p>
        </div>
    </form>

</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> 2017 &copy; Graduate School, Chulalongkorn University</div>
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

<script type="application/javascript">



var Login = function () {

	var handleLogin = function() {
		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
							ignore: ".ignore",
	            rules: {
	                user_name: {
	                    required: true
	                },
	                user_password: {
	                    required: true
	                },
									hiddenRecaptcha: {
								                 required: function () {
								                     if (grecaptcha.getResponse() == '') {
								                         return true;
								                     } else {
								                         return false;
								                     }
								                 }
 }
	            },

	            messages: {
	                user_name: {
	                    required: "User is required."
	                },
	                user_password: {
	                    required: "Password is required."
	                },
	                hiddenRecaptcha: {
	                    required: "reCAPTCHA is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                    $('.login-form').submit();
	                }
	                return false;
	            }
	        });
	}




    return {
        //main function to initiate the module
        init: function () {

            handleLogin();

            // init background slide images
		    $.backstretch([
		        "../assets/pages/media/bg/1.jpg",
		        "../assets/pages/media/bg/2.jpg",
		        "../assets/pages/media/bg/3.jpg",
		        "../assets/pages/media/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		    	}
        	);
        }
    };

}();

jQuery(document).ready(function() {
    Login.init();
});

function recaptchaCallback() {
  $('#hiddenRecaptcha').valid();
};
</script>
@endpush
