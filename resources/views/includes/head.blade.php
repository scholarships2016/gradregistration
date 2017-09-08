<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Online Registration - Graduate School Chulalongkorn University</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>

    <meta name="author" content="chula" />
    <meta name="title" content="ขอต้อนรับสู่ ระบบรับสมัครเข้าศึกษา บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย" />
    <meta name="description" content="ระบบรับสมัครเข้าศึกษาระดับบัณฑิตศึกษา บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย" />
    <meta name="keywords" content="บัณฑิตวิทยาลัย, จุฬาลงกรณ์มหาวิทยาลัย, สมัครเข้าศึกษา, สมัครเรียน, บัณฑิตศึกษา, หลักสูตรภาษาไทย, หลักสูตรนานาชาติ" />
    <meta property="og:title" content="ขอต้อนรับสู่ ระบบรับสมัครเข้าศึกษา บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="ระบบรับสมัครเข้าศึกษาระดับบัณฑิตศึกษา บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <!--
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
        -->
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
          type="text/css">
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
          type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/global/css/components-md.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css"
          id="style_color">
    <link href="{{asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css">
    <!-- END THEME LAYOUT STYLES -->
    <link href="{{asset('favicon.ico')}}" rel="shortcut icon">
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>

    @stack('pageCss')
    <!-- BEGIN CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
    <!-- END CUSTOM STYLES -->
</head>
<!-- END HEAD -->
