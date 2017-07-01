<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
@include('includes.head2')
<!-- END HEAD -->

<body class=" login">
@yield('maincontent')
<!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/ie8.fix.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/js.cookie.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
@stack('pagelevelplugin')
<!-- END PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.min.js')}}"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-101641288-1', 'auto');
    ga('send', 'pageview');
    
</script>
<script>
    $(document).ready(function () {
        //Alert Message
        @include('includes.toastr')
    })
</script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@stack('pageJs')
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>