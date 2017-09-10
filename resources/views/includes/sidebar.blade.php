<div class="page-sidebar-wrapper">
  <!-- BEGIN SIDEBAR for applicant -->
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU for admin -->
    @if(session('user_tyep')) @if(session('user_tyep')->user_type=='Staff')

    <ul class="page-sidebar-menu  page-header-fixed " style="padding-top: 20px" data-slide-speed="200" data-auto-scroll="true" data-keep-expanded="false">
      <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
          <span></span>
        </div>
      </li>
      <!--
            <li class=" nav-item  menuitem  start active open" data-index="10">
                <a href="dashboard_3.html" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>

            </li>
          -->
      <li class="nav-item  menuitem  start open active" data-index="11">
        <a href="{{url('admin/toDoList')}}" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">To-Do List</span>

                    <span class="badge badge-danger">2</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
      </li>
      <li class="heading">
        <h3 class="uppercase">Management</h3>
      </li>
      <li class=" nav-item  menuitem   " data-index="12">
        <a href="{{url('admin/management/curriculum/manage')}}" class="nav-link nav-toggle">
                    <i class="fa fa-book"></i>
                    <span class="title">จัดการหลักสูตร</span>
                    <span class="arrow"></span>
                </a>
        <ul class="sub-menu">
          <li class=" nav-item  menuitem   ">
            <a href="{{url('admin/management/curriculum/manage')}}" class="nav-link ">
                            <span class="title">รายการหลักสูตร</span>
                        </a>
          </li>

          <li class=" nav-item  menuitem   ">
            <a href="{{url('admin/management/curriculum/add')}}" class="nav-link ">
                            <span class="title">กรอกฟอร์มขอเปิดหลักสูตร</span>
                        </a>
          </li>



        </ul>
      </li>

      <li class=" nav-item  menuitem   " data-index="13">
        <a href="{{url('admin/ManagePay')}}" class="nav-link nav-toggle">
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
            <a class="nav-link " href="{{url('admin/ManageGS03')}}">
                            <span class="title">ปรับปรุงผู้มีสิทธิ์สอบ (GS03)</span>
                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a class="nav-link " href="{{url('admin/ManageGS05')}}">
                            <span class="title">ปรับปรุงผู้มีสิทธิ์เข้าศึกษา (GS05)</span>
                        </a>
          </li>
        </ul>
      </li>
      <li class=" nav-item  menuitem  " data-index="14">
        <a href="่" class="nav-link nav-toggle">
                    <i class="icon-user-follow"></i>
                    <span class="title">เพิ่มผู้สอบได้</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>

      </li>
    
      <li class=" nav-item  menuitem   " data-index="16">
        <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">รายงาน</span>
                    <span class="arrow"></span>
                </a>
        <ul class="sub-menu">
          <li class=" nav-item  menuitem   ">
            <a href="components_date_time_pickers.html" class="nav-link ">
                            <span class="title">สรุปยอดการชำระเงิน</span>
                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ผู้สมัครเข้าศึกษา (GS01)</span>

                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">สรุปยอดผู้สมัครเข้าศึกษา </span>

                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ผู้สมัครที่ส่งเอกสารแล้ว</span>

                        </a>
          </li>

          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ผู้สมัครเข้าศึกษา (GS03)</span>

                        </a>
          </li>

          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ผู้มีสิทธิ์เข้าศึกษา (GS05)</span>

                        </a>
          </li>

          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ผู้มีสิทธิ์เข้าศึกษา แบบ บ.21</span>

                        </a>
          </li>

          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ผู้สอบได้มากกว่า 1 สาขาขึ้นไป</span>

                        </a>
          </li>


          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">คะแนนภาษาอังกฤษ</span>

                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ผู้สมัครชาวต่างชาติ  </span>

                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">แหล่งข่าว</span>

                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ความสนใจรับทุน </span>

                        </a>
          </li>

          <li class=" nav-item  menuitem   ">
            <a href="components_color_pickers.html" class="nav-link ">
                            <span class="title">ความพึงพอใจการใช้งานระบบ  </span>

                        </a>
          </li>
        </ul>
      </li>
      <li class="heading">
        <h3 class="uppercase">Settings</h3>
      </li>
      <li class=" nav-item  menuitem   " data-index="17">
        <a href="{{url('admin/setting/applysetting/manage')}}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">ตั้งค่าการสมัคร</span>
                    <span class="arrow"></span>
                </a>
        <ul class="sub-menu">
          <li class=" nav-item  menuitem   ">
            <a href="{{url('admin/setting/applysetting/manage')}}" class="nav-link ">
                            <span class="title">รายการเปิดรับสมัคร</span>
                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="{{url('admin/setting/applysetting/add')}}" class="nav-link ">
                            <span class="title">ตั้งค่าการเปิดรับสมัคร</span>
                        </a>
          </li>


        </ul>
      </li>
      <li class=" nav-item  menuitem   " data-index="18">
        <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">ผู้ใช้งาน</span>
                    <span class="arrow"></span>
                </a>
        <ul class="sub-menu">
          <li class=" nav-item  menuitem   ">
            <a href="{{url('admin/setting/applicantManage/manage')}}" class="nav-link ">
                            <span class="title">จัดการผู้สมัคร</span>
                        </a>
          </li>
          <li class=" nav-item  menuitem   ">
            <a href="{{url('admin/setting/adminManage/manage')}}" class="nav-link ">
                            <span class="title">จัดการผู้ดูแลระบบ</span>
                        </a>
          </li>

        </ul>
      </li>
      <li class=" nav-item  menuitem   " data-index="19">
        <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-note"></i>
                    <span class="title">จัดการเนื้อหา</span>
                    <span class="arrow"></span>
                </a>
        <ul class="sub-menu">
          <li class=" nav-item  menuitem   ">
            <a href="form_controls.html" class="nav-link ">
                            <span class="title">ข่าว &amp; ประกาศ</span>
                        </a>
          </li>

          <li class=" nav-item  menuitem   ">
            <a href="form_controls_md.html" class="nav-link ">
                            <span class="title">ขั้นตอนการสมัคร</span>
                        </a>
          </li>
          <!--
                    <li class=" nav-item  menuitem   ">
                        <a href="form_controls_md.html" class="nav-link ">
                            <span class="title">ถามตอบ</span>
                        </a>
                    </li>
                    <li class=" nav-item  menuitem   ">
                        <a href="form_controls_md.html" class="nav-link ">
                            <span class="title">ติดต่อเรา</span>
                        </a>
                    </li>
                  -->

        </ul>
      </li>
      <li class="nav-item " data-index="20">
        <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-wrench"></i>
                    <span class="title">จัดการข้อมูล Master</span>
                    <span class="arrow"></span>
                </a>
        <ul class="sub-menu">
          <li class="nav-item  ">
            <a href="{{url('admin/setting/masterInfo/courseManage')}}" class="nav-link ">
                            <span class="title">ข้อมูลหลักสูตร</span>
                        </a>
          </li>



        </ul>
      </li>
      <li class="nav-item  " data-index="21">
        <a href="report-export-to-reg.html" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">ข้อมูลส่งสำนักทะเบียน</span>
                    <span class="arrow"></span>
                </a>

      </li>

      <li class="nav-item  " data-index="22">
        <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-line-chart"></i>
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
            <a href="https://analytics.google.com/analytics/web/" target="_bank" class="nav-link ">
                            <span class="title">Google Analytics</span>
                        </a>
          </li>




        </ul>
      </li>
    </ul>

    @endif @endif
    <!-- END SIDEBAR MENU  admin-->
    <!-- BEGIN SIDEBAR MENU for applicant -->

    @if(!session('user_tyep') || (session('user_tyep')->user_type=='applicant'))

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

      <li class=" nav-item    start menuitem active open" data-index="1">
        <a class="nav-link nav-toggle" href="{{url('home/')}}">
                    <i class="icon-home"></i>
                    <span class="title">{{Lang::get('resource.lbMHome')}}</span>

                    <span class="arrow"></span>
                </a>
      </li>

      @if(!session('user_id'))
      <li class=" nav-item    menuitem" data-index="2">
        <a class="nav-link nav-toggle" href="{{url('apply/register/')}}">
                    <i class="icon-book-open"></i>
                    <span class="title">{{Lang::get('resource.lbMCurriculum')}}</span>
                    <span class="arrow"></span>
                </a>

      </li>
      @endif @if(session('user_id'))
      <li class=" nav-item    menuitem" data-index="7">
        <a class="nav-link nav-toggle" href="{{url('apply/manageMyCourse/')}}">
                    <i class="icon-briefcase"></i>
                    <span class="title">{{Lang::get('resource.lbManageCouse')}}</span>
                    <span class="arrow"></span>
                </a>

      </li>

      <li class=" nav-item  menuitem   menuitem " data-index="3">
        <a class="nav-link  nav-toggle" href="{{url('apply')}}">
                    <i class="icon-book-open"></i>
                    <span class="title">{{Lang::get('resource.lbMCurriculumLogedin')}}</span>
                    <span class="arrow"></span>
                </a>
      </li>
      @endif
      <li class=" nav-item    menuitem " data-index="4">
        <a class="nav-link nav-toggle" href="{{url('faq/')}}">
                    <i class="icon-question"></i>
                    <span class="title">{{Lang::get('resource.lbMFAQs')}}</span>
                    <span class="arrow"></span>
                </a>

      </li>
      <li class=" nav-item    menuitem " data-index="5">
        <a class="nav-link nav-toggle" href="{{url('download/')}}">
                    <i class="icon-cloud-download"></i>
                    <span class="title">{{Lang::get('resource.lbMDownlods')}}</span>
                    <span class="arrow"></span>
                </a>

      </li>
      <li class=" nav-item     menuitem " data-index="6">
        <a class="nav-link nav-toggle" href="{{url('contact/')}}">
                    <i class="icon-pointer"></i>
                    <span class="title">{{Lang::get('resource.lbMContactsUs')}}</span>
                    <span class="arrow"></span>
                </a>

      </li>
    </ul>

    @endif
    <!-- END SIDEBAR MENU -->
  </div>

</div>
<script>
  window.onload = function() {
    $('.menuitem').each(function(index, item) {
      $(this).removeClass("active");
      $str1 = $(this).find('a:first').attr('href');
      $str2 = window.location.pathname;
      $selectTag = '<span class="selected"></span>';

      if ($str1.substr($str1.lastIndexOf("/") + 1) == $str2.substr($str2.lastIndexOf("/") + 1) || ($str1.substr($str1.lastIndexOf("/") + 1) == 'home' && $str2.substr($str2.lastIndexOf("/") + 1) == '')) {
        $(this).addClass("active");
        $(this).find('a:first').append($selectTag);
      } else if ($str2.substr($str2.lastIndexOf("/") + 1) == 'register' && $str1.substr($str1.lastIndexOf("/") + 1) == "apply") {
        $(this).addClass("active");
      };
    });


  };
</script>
