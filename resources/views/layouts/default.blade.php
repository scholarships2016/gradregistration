<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword"
          content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>EGAT BudgetContrl PowerBy CSR</title>

    <!-- Icons -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    @stack('pageCss')
</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-compact'				- Compact Sidebar Navigation (Only icons)

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Footer options
1. '.footer-fixed'						- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
@include('includes.header')
<div class="app-body">
@include('includes.sidebar')
<!-- Main content -->
    <main class="main">
    <!-- Breadcrumb -->
        @yield('breadcrumb')
        @yield('main-content')
    </main>

    @include('includes.aside')
</div>

@include('includes.footer')
<script src="{{asset('js/app.js')}}"></script>
<script type="application/javascript">

    function logout() {
        //Should we use ajax post method
        // More Config at Laravel
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "/logout";
        var tokenInptHidden = document.createElement("input");
        tokenInptHidden.type = 'hidden';
        tokenInptHidden.name = '_token';
        tokenInptHidden.value = '{{csrf_token()}}';
        form.appendChild(tokenInptHidden);
        document.body.appendChild(form);
        form.submit();
    }

</script>
@stack('pageJs')
</body>
</html>