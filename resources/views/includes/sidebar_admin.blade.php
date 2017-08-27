<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">

        <!-- BEGIN SIDEBAR MENU for admin -->
        <ul id="admin_menu" class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <li class="nav-item start active open" data-index="10">
                <a href="dashboard_3.html" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>

            </li>
            <li class="nav-item  "data-index="11">
                <a href="todolist.html" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">To-Do List</span>
                    <span class="badge badge-danger">2</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Management</h3>
            </li>
            <li class="nav-item  "data-index="12">
                <a href="manage-curriculum.html" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">จัดการหลักสูตร</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="manage-curriculum.html" class="nav-link ">
                            <span class="title">รายการหลักสูตร</span>
                        </a>
                    </li>

                    <li class="nav-item  ">
                        <a href="form_controls.html" class="nav-link ">
                            <span class="title">กรอกฟอร์มขอเปิดหลักสูตร</span>
                        </a>
                    </li>



                </ul>
            </li>

           <li class=" nav-item  menuitem   "data-index="13">
                <a href="manage-payment-documents.html" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">จัดการข้อมูลการสมัคร</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class=" nav-item  menuitem   ">
                        <a class="nav-link " href="{{url('admin/ManagePay')}}">
                            <span class="title">ปรับปรุงการชำระเงิน และส่งเอกสาร</span>
                        </a>
                    </li>

                    <li class=" nav-item  menuitem   ">
                        <a href="manage-gs03.html" class="nav-link "href="{{url('admin/ManageGS03')}}>
                            <span class="title">ปรับปรุงผู้มีสิทธิ์สอบ (GS03)</span>
                        </a>
                    </li>
                    <li class=" nav-item  menuitem   ">
                        <a href="manage-gs05.html" class="nav-link " href="{{url('admin/ManageGS05')}}>
                            <span class="title">ปรับปรุงผู้มีสิทธิ์เข้าศึกษา (GS05)</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item "data-index="14">
                <a href="่" class="nav-link nav-toggle">
                    <i class="icon-user-follow"></i>
                    <span class="title">เพิ่มผู้สอบได้</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>

            </li>
            <li class="nav-item "data-index="15">
                <a href="" class="nav-link nav-toggle">
                    <i class="icon-check"></i>
                    <span class="title">ออกหนังสือรับรอง</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>

            </li>
            <li class="nav-item  "data-index="16">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">รายงาน</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="components_date_time_pickers.html" class="nav-link ">
                            <span class="title">รายงานการ</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">รายงานการ</span>

                        </a>
                    </li>

                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Settings</h3>
            </li>
            <li class="nav-item  "data-index="17">
                <a href="/admin/setting/applysetting/manage" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">ตั้งค่าการสมัคร</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="/admin/setting/applysetting/manage" class="nav-link ">
                            <span class="title">รายการเปิดรับสมัคร</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="apply-setting-form.html" class="nav-link ">
                            <span class="title">ตั้งค่าการเปิดรับสมัคร</span>
                        </a>
                    </li>


                </ul>
            </li>
            <li class="nav-item  "data-index="18">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">ผู้ใช้งาน</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="manage-applicant.html" class="nav-link ">
                            <span class="title">จัดการผู้สมัคร</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="manage-admin.html" class="nav-link ">
                            <span class="title">จัดการผู้ดูแลระบบ</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item  "data-index="19">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-note"></i>
                    <span class="title">จัดการเนื้อหา</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="form_controls.html" class="nav-link ">
                            <span class="title">ข่าว &amp; ประกาศ</span>
                        </a>
                    </li>

                    <li class="nav-item  ">
                        <a href="form_controls_md.html" class="nav-link ">
                            <span class="title">ขั้นตอนการสมัคร</span>
                        </a>
                    </li>
                  <!--
                    <li class="nav-item  ">
                        <a href="form_controls_md.html" class="nav-link ">
                            <span class="title">ติดต่อเรา</span>
                        </a>
                    </li>
                  -->

                </ul>
            </li>
            <!--
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Master Data Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="form_controls.html" class="nav-link ">
                            <span class="title">กำหนดแหล่งข่าว</span>
                        </a>
                    </li>
            -->

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-wrench"></i>
                    <span class="title">จัดการข้อมูล Master</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="manage-program.html" class="nav-link ">
                            <span class="title">ข้อมูลหลักสูตร</span>
                        </a>
                    </li>



                </ul>
            </li>
            <li class="nav-item  ">
                <a href="report-export-to-reg.html" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">ข้อมูลส่งสำนักทะเบียน</span>
                    <span class="arrow"></span>
                </a>

            </li>

            <li class="nav-item  "data-index="21">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Logs & Stat</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="form_controls_md.html" class="nav-link ">
                            <span class="title">Transactions Logs</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="form_controls.html" class="nav-link ">
                            <span class="title">Google Analytics</span>
                        </a>
                    </li>




                </ul>
            </li>
        </ul>
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
            $selectTag = '<span class="selected"></span>';

            if ($str1.substr($str1.lastIndexOf("/") + 1) == $str2.substr($str2.lastIndexOf("/") + 1) ||($str1.substr($str1.lastIndexOf("/") + 1) =='home' &&$str2.substr($str2.lastIndexOf("/") + 1)=='')) {
                $(this).addClass("active");
                $(this).find('a:first').append($selectTag);
            } else if ($str2.substr($str2.lastIndexOf("/") + 1) == 'register' && $str1.substr($str1.lastIndexOf("/") + 1) == "apply") {
                $(this).addClass("active");
            }
            ;
        });


    };

</script>
