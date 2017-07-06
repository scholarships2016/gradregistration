<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu  page-header-fixed " style="padding-top: 20px" data-slide-speed="200" data-auto-scroll="true" data-keep-expanded="false">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

            <li class="nav-item start menuitem" data-index="1">
                <a class="nav-link nav-toggle" href="{{url('home/')}}">
                    <i class="icon-home"></i>
                    <span class="title">{{Lang::get('resource.lbMHome')}}</span>
                 
                    <span class="arrow"></span> 
                </a>                                
            </li>



            <li class="nav-item menuitem"  data-index="2">
                <a class="nav-link nav-toggle" href="{{url('apply/register/')}}">
                    <i class="icon-bulb"></i>
                    <span class="title">{{Lang::get('resource.lbMCurriculum')}}</span>
                    <span class="arrow"></span>
                </a>

            </li>
            <li class="nav-item  menuitem "   data-index="3">
                <a class="nav-link  nav-toggle" href="{{url('apply')}}">
                    <i class="icon-briefcase"></i>
                    <span class="title">{{Lang::get('resource.lbMApply')}}</span>
                    <span class="arrow"></span>
                </a>

            </li>
            <li class="nav-item menuitem "  data-index="4">
                <a class="nav-link nav-toggle" href="{{url('faq/')}}">
                    <i class="icon-wallet"></i>
                    <span class="title">{{Lang::get('resource.lbMFAQs')}}</span>
                    <span class="arrow"></span>
                </a>

            </li>
            <li class="nav-item menuitem "   data-index="5">
                <a class="nav-link nav-toggle" href="{{url('download/')}}">
                    <i class="icon-bar-chart"></i>
                    <span class="title">{{Lang::get('resource.lbMDownlods')}}</span>
                    <span class="arrow"></span>
                </a>

            </li>
            <li class="nav-item  menuitem "  data-index="6">
                <a class="nav-link nav-toggle" href="{{url('contact/')}}">
                    <i class="icon-pointer"></i>
                    <span class="title">{{Lang::get('resource.lbMContactsUs')}}</span>
                    <span class="arrow"></span>
                </a>

            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>

    <!-- END SIDEBAR -->
</div>
<script>
    window.onload = function () {
        $('.menuitem').each(function (index, item) {
            $(this).removeClass("active");
            $str1 = $(this).find('a:first').attr('href');
            $str2 = window.location.pathname;
            $selectTag ='<span class="selected"></span>';
            if($str1.substr($str1.lastIndexOf("/") + 1) == $str2.substr($str2.lastIndexOf("/") + 1)){
            $(this).addClass("active");
        $(this).find('a:first').append($selectTag);
            };
        });


    };

</script>