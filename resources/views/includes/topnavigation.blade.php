<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
        <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
        @if(session('locale'))

            <li class="dropdown dropdown-language">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                   data-close-others="true" aria-expanded="false">
                    <img alt="" src="{{url('/assets/global/img/flags/'.session('locale').'.png')}}">
                    <span class="langname"> {{strtoupper(session('locale'))}} </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    @foreach(config('app.languages') as $lang)
                        <li>
                            <a href="/language?lang={{ $lang }}">
                                <img alt=""
                                     src="{{url('/assets/global/img/flags/'.$lang.'.png')}}"> {{ strtoupper($lang) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

        @endif
        @if(!session('user_id'))
            <li class="dropdown dropdown-quick-sidebar-toggler">
                <a href="{{url('\login')}}" class="dropdown-toggle">
                    <span aria-hidden="true"
                          class="glyphicon glyphicon-user"></span>{{Lang::get('resource.lbHeaderLogin')}}
                </a>
            </li>
        @endif
        @if(session('user_id'))

            @if(session('user_type')->user_type == 'Admin' ||
            session('user_type')->user_type == 'GradStaff' ||
            session('user_type')->user_type == 'FacStaff')
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true" aria-expanded="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-default" id="noticeAmt1"></span>
                    </a>
                    <ul class="dropdown-menu" id="noticeItems">
                        <li class="external">
                            <h3>
                                <span class="bold" id="noticeAmt2"></span>
                                การแจ้งเตือน
                            </h3>
                            <a href="{{route('admin.backoffice.showToDoListPage')}}">ดูทั้งหมด</a>
                        </li>
                        <li>
                            <div class="slimScrollDiv"
                                 style="position: relative; overflow: hidden; width: auto; max-height: 250px;">
                                <ul id="noticeList" class="dropdown-menu-list scroller"
                                    style="max-height: 250px; overflow: hidden; width: auto;"
                                    data-handle-color="#637283" data-initialized="1">
                                </ul>
                                <div class="slimScrollBar"
                                     style="background: rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div>
                                <div class="slimScrollRail"
                                     style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
                            </div>
                        </li>
                    </ul>
                </li>
            @else
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <i class="icon-bell"></i>
                        <span id="regHeadsum" name="regHeadsum" class="badge badge-default">  </span>
                    </a>
                    <ul class="dropdown-menu">
                        @if(session('user_id'))
                            <li class="external">
                                <h3>
                                    <span class="bold"><label id="regHeadsum2"
                                                              name="regHeadsum2"></label> pending</span>
                                    notifications
                                </h3>
                            </li>
                        @endif
                        <li>
                            <ul id="regHead" name="regHead" class="dropdown-menu-list scroller" style="height: 250px;"
                                data-handle-color="#637283">
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif

        <!-- END NOTIFICATION DROPDOWN -->
            <!-- BEGIN INBOX DROPDOWN -->


            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                   data-close-others="true">
                    <img alt="" class="img-circle" id='userimg'
                         src="{{   (session('stu_img'))?route('profile.getProfileImg',['applicant_id' => Crypt::encrypt(session('Applicant')->applicant_id) ]):url('/assets/layouts/layout/img/avatar.png')}}"/>
                    <span class="username username-hide-on-mobile">  {{ session('first_name').' '.session('last_name')  }} </span>
                    <i class="fa fa-angle-down"></i>
                </a>

                @if(!session('user_type') || (session('user_type')->user_type=='applicant'))
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{route('profile.showProfilePage')}}">
                                <i class="icon-user"></i> {{Lang::get('resource.lbMProfile')}} </a>
                        </li>
                        <li class="divider"></li>

                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="icon-key"></i> {{Lang::get('resource.lbMLogout')}} </a>
                        </li>
                    </ul>
                @endif

                @if(session('user_type'))
                    @if(session('user_type')->user_type == 'Admin' ||
                                           session('user_type')->user_type == 'GradStaff' ||
                                           session('user_type')->user_type == 'FacStaff')
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{url('admin/setting/adminManage/edit/'.session('user_id'))}}">
                                    <i class="icon-user"></i> {{Lang::get('resource.lbMProfile')}} </a>
                            </li>
                            <li class="divider"></li>

                            <li>
                                <a href="{{ url('/admin/logout') }}">
                                    <i class="icon-key"></i> {{Lang::get('resource.lbMLogout')}} </a>
                            </li>
                        </ul>
                    @endif
                @endif

            </li>
            <!-- END USER LOGIN DROPDOWN -->
        @endif

    </ul>
</div>

<script>
    @if(session('user_id'))
$.ajax({
        type: "GET",
        url: '{!! Route('showRegisHead') !!}',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function (data) {
            $('#regHead').html(data['val']);
            $('#regHeadsum2').html(data['cot']);
            $('#regHeadsum').html(data['cot']);


        }
    });



    @endif
</script>
