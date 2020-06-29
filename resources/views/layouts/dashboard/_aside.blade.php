<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link bg-primary">
        <img src="{{ asset('dashboard/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">موقع تجاري</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{url('image/admin_images/admin_photo/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::guard('admin')->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        @if(Session::get('page')=="dashboard")
                            <?php $active = "active" ;?>
                        @else
                            <?php $active = "" ;?>
                        @endif
                        <a href="{{url('admin/dashboard')}}" class="nav-link {{$active}}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                الصفحة الرئيسية
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                    @if(Session::get('page')=="settings" || Session::get('page')=="update-admin-details")
                        <?php $menu_open = "menu-open" ;?>
                    @else
                        <?php $menu_open = "" ;?>
                    @endif

                    <li class="nav-item has-treeview {{$menu_open}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                                اعدادات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Session::get('page')=="settings")
                                <?php $active = "active" ;?>
                            @else
                                <?php $active = "" ;?>
                            @endif
                            <li class="nav-item">
                                <a href="{{url('admin/settings')}}" class="nav-link {{$active}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>تغير كلمة المرور</p>
                                </a>
                            </li>
                                @if(Session::get('page')=="update-admin-details")
                                    <?php $active = "active" ;?>
                                @else
                                    <?php $active = "" ;?>
                                @endif
                            <li class="nav-item">
                                <a href="{{url('admin/update-admin-details')}}" class="nav-link {{$active}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>تغير بيانات المدير</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        @if(Session::get('page')=="sections")
                            <?php $active = "active" ;?>
                        @else
                            <?php $active = "" ;?>
                        @endif
                        <a href="{{url('admin/sections')}}" class="nav-link {{$active}}">
                            <i class="nav-icon fa fa-address-book"></i>
                            <p>
                               الأقسام
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        @if(Session::get('page')=="categories")
                            <?php $active = "active" ;?>
                        @else
                            <?php $active = "" ;?>
                        @endif
                        <a href="{{url('admin/categories')}}" class="nav-link {{$active}}">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>
                             الأصناف
                            </p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="{{url('admin/logout')}}" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                               تسجيل خروج
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
