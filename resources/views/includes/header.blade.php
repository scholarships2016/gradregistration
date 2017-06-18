<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
    <a class="navbar-brand" href="#"></a>
    <ul class="nav navbar-nav hidden-md-down">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        {{--<li class="nav-item hidden-md-down">--}}
            {{--<a class="nav-link" href="#"><i class="icon-bell"></i><span--}}
                        {{--class="badge badge-pill badge-danger">5</span></a>--}}
        {{--</li>--}}
        {{--<li class="nav-item hidden-md-down">--}}
            {{--<a class="nav-link" href="#"><i class="icon-list"></i></a>--}}
        {{--</li>--}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('img/avatars/6.jpg')}}" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="hidden-md-down">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                {{--<div class="dropdown-header text-center">--}}
                    {{--<strong>Account</strong>--}}
                {{--</div>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> - </a>--}}
              {{----}}
                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>

                {{--<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>--}}
                <div class="divider"></div>
                <a class="dropdown-item" href="#" onclick="logout()"><i class="fa fa-lock"></i> Logout</a>
            </div>
        </li>
        <li class="nav-item hidden-md-down">
            {{--<a class="nav-link navbar-toggler aside-menu-toggler" href="#">☰</a>--}}
        </li>
    </ul>
</header>
