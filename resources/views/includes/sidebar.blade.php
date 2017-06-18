<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{Url('/home')}}"><i class="icon-speedometer"></i> Dashboard <span
                            class="badge badge-info">NEW</span></a>
            </li>
            <li class="divider"></li>
            <li class="nav-title">
                Stakeholder [STKH]
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{Url('stakeholder')}}"><i class="icon-chart"></i>Overview</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#"><i class="icon-note"></i>Register</a>--}}
            {{--</li>--}}
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-organization"></i>กลุ่มหลัก</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url('stakeholder/group/search')}}" target="_top"><i
                                    class="icon-magnifier"></i>
                            ค้นหา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url('stakeholder/group/add')}}" target="_top"><i
                                    class="icon-plus"></i>
                            เพิ่ม</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-organization"></i>กลุ่มย่อย</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url('stakeholder/subgroup/search')}}" target="_top"><i
                                    class="icon-magnifier"></i>
                            ค้นหา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url('stakeholder/subgroup/add')}}" target="_top"><i
                                    class="icon-plus"></i>
                            เพิ่ม</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-book-open"></i>รายละเอียด</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url('stakeholder/detail/search')}}" target="_top"><i
                                    class="icon-magnifier"></i>
                            ค้นหา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url('stakeholder/detail/add')}}" target="_top"><i
                                    class="icon-plus"></i>
                            เพิ่ม</a>
                    </li>
                </ul>
            </li>
            {{--<li class="nav-item nav-dropdown">--}}
            {{--<a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-organization"></i>[STKH] Detail</a>--}}
            {{--<ul class="nav-dropdown-items">--}}
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{Url('stakeholder/group/add')}}" target="_top"><i--}}
            {{--class="icon-plus"></i>--}}
            {{--Add</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}


            <li class="divider"></li>
            <li class="nav-title">
                CSR Project
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-docs"></i>การสนับสนุน</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_top">
                            <i class="icon-magnifier"></i>
                            ค้นหา
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Url('csrproject/appreq/add')}}" target="_top"><i
                                    class="icon-plus"></i>
                            เพิ่ม
                        </a>
                    </li>
                </ul>
            </li>


            {{--<li class="divider"></li>--}}
            {{--<li class="nav-title">--}}
            {{--Account--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{Url('account/profile/view')}}"><i class="icon-user"></i> Profile</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="{{Url('account/setting')}}"><i class="icon-wrench"></i> Setting</a>--}}
            {{--</li>--}}


                <li class="divider"></li>
                <li class="nav-title">
                    Admin
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>ผู้ใช้งาน</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{Url('admin/user/search')}}" target="_top"><i
                                        class="icon-magnifier"></i>
                                ค้นหา</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Url('admin/user/add')}}" target="_top"><i
                                        class="icon-plus"></i>
                                เพิ่ม</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-link"></i>บทบาท</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{Url('admin/role/search')}}" target="_top"><i
                                        class="icon-magnifier"></i>
                                ค้นหา</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Url('admin/role/add')}}" target="_top"><i
                                        class="icon-plus"></i>
                                เพิ่ม</a>
                        </li>
                    </ul>
                </li>



                <li class="divider"></li>
                <li class="nav-title">
                    System
                </li>
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{Url('system/setting')}}"><i class="icon-wrench"></i> Setting</a>--}}
                {{--</li>--}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-folder"></i>โมดูลและการเข้าถึง</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{Url('system/module/search')}}" target="_top"><i
                                        class="icon-magnifier"></i>
                                ค้นหา</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Url('system/module/add')}}" target="_top"><i
                                        class="icon-plus"></i>
                                เพิ่ม</a>
                        </li>
                    </ul>
                </li>

        </ul>
    </nav>
</div>