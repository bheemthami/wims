<header class="main-header">
    <!-- Logo -->
    <a href="{{ URL::to('admin/dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{{ $settings['setting']->system_short_name }}</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img style="margin-left: 70px; " class="image img-responsive"
                src="{{ asset('uploads/setting/' . $settings['setting']->logo) }}" height="50" width="50"
                alt="LOGO">
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="{{ route('index') }}" target="_blank" class="btn btn-link">
                        Website
                    </a>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#">
                        <span class="hidden-xs"> Academic Year - {{ $settings['setting']->academicYear->year }}
                        </span>
                    </a>
                </li>

                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('uploads/setting/' . $settings['setting']->logo) }}" class="user-image"
                            alt="User Image">

                        <span class="hidden-xs"> {{ Sentinel::getUser()->first_name }}
                            {{ Sentinel::getUser()->last_name }} -
                            @if (Sentinel::getUser()->roles)
                                {{ Sentinel::getUser()->roles[0]->name }}
                            @else
                                Role not assigned yet!
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height: 140px !important;">
                            <img src="{{ asset('uploads/setting/' . $settings['setting']->logo) }}" class="img-circle"
                                alt="User Image">
                            <p>{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-left">
                                <a href="{{ route('change_password.create') }}" class="btn btn-default btn-flat">Change
                                    Password</a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
