  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      {{--<div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('uploads/setting/'.$settings['setting']->logo)}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <a href="#"><i class="fa fa-group"></i> {{ user()->name }}</a>
      </div>
      </div>--}}
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="color: #f39c12 !important;"> <a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>{{$settings['setting']->system_short_name }} DASHBOARD</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @if(Sentinel::hasAccess('academic-years.index'))
            <li><a href="{{ route('academic-years.index') }}"><i class="fa fa-university"></i> <span>Academic Years</span></a></li>
            @endif

            @if(Sentinel::hasAccess('settings.index'))
            <li><a href="{{ route('settings.index') }}"><i class="fa fa-cog"></i> <span>Site Settings</span></a></li>
            @endif

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @if(Sentinel::hasAccess('roles.index'))
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-group"></i> Roles</a></li>
            @endif

            @if(Sentinel::hasAccess('users.index'))
            <li><a href="{{ route('users.index') }}"><i class="fa fa-user-circle-o"></i> Users</a></li>
            @endif

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-black-tie"></i> <span>People Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @if(Sentinel::hasAccess('departments.index'))
            <li><a href="{{ route('departments.index') }}"><i class="fa fa-university"></i> <span>Departments</span></a></li>
            @endif

            @if(Sentinel::hasAccess('designations.index'))
            <li><a href="{{ route('designations.index') }}"><i class="fa fa-users"></i> <span>Designations</span></a></li>
            @endif

            @if(Sentinel::hasAccess('officials.index'))
            <li><a href="{{ route('officials.index') }}"><i class="fa fa-black-tie"></i> <span>Officials</span></a></li>
            @endif

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Modules Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @if(Sentinel::hasAccess('document-types.index'))
            <li><a href="{{ route('document-types.index') }}"><i class="fa fa-file"></i> <span>Document Types</span></a></li>
            @endif

            @if(Sentinel::hasAccess('training-categories.index'))
            <li><a href="{{ route('training-categories.index') }}"><i class="fa fa-list-alt"></i> <span>Training Categories</span></a></li>
            @endif

            @if(Sentinel::hasAccess('training-types.index'))
            <li><a href="{{ route('training-types.index') }}"><i class="fa fa-list-alt"></i> <span>Training Types</span></a></li>
            @endif

            @if(Sentinel::hasAccess('post-categories.index'))
            <li><a href="{{ route('post-categories.index') }}"><i class="fa fa-sticky-note-o"></i> <span>Post Categories</span></a></li>
            @endif

          </ul>
        </li>

        @if(Sentinel::hasAccess('posts.index'))
        <li><a href="{{ route('posts.index') }}"><i class="fa fa-edit"></i> <span>Posts</span></a></li>
        @endif

        @if(Sentinel::hasAccess('events.index'))
        <li><a href="{{ route('events.index') }}"><i class="fa fa-calendar-o"></i> <span>Events</span></a></li>
        @endif

        @if(Sentinel::hasAccess('documents.index'))
        <li><a href="{{ route('documents.index') }}"><i class="fa fa-file"></i> <span>Publications</span></a></li>
        @endif

        @if(Sentinel::hasAccess('trainings.index'))
        <li><a href="{{ route('trainings.index') }}"><i class="fa fa-list-alt"></i> <span>Trainings</span></a></li>
        @endif

        @if(Sentinel::hasAccess('programs.index'))
        <li><a href="{{ route('programs.index') }}"><i class="fa fa-graduation-cap"></i> <span>Programs</span></a></li>
        @endif

        @if(Sentinel::hasAccess('facilities.index'))
        <li><a href="{{ route('facilities.index') }}"><i class="fa fa-building"></i> <span>Facilities</span></a></li>
        @endif

        @if(Sentinel::hasAccess('pages.index'))
        <li><a href="{{ route('pages.index') }}"><i class="fa fa-file-text-o"></i> <span>Pages</span></a></li>
        @endif

        @if(Sentinel::hasAccess('banners.index'))
        <li><a href="{{ route('banners.index') }}"><i class="fa fa-image"></i> <span>Banners</span></a></li>
        @endif

        @if(Sentinel::hasAccess('embeddings.index'))
        <li><a href="{{ route('embeddings.index') }}"><i class="fa fa-file-code-o"></i> <span>Embeddings</span></a></li>
        @endif

        @if(Sentinel::hasAccess('galleries.index'))
        <li><a href="{{ route('galleries.index') }}"><i class="fa fa-folder"></i> <span>Galleries</span></a></li>
        @endif

        @if(Sentinel::hasAccess('testimonials.index'))
        <li><a href="{{ route('testimonials.index') }}"><i class="fa fa-quote-left"></i> <span>Testimonials</span></a></li>
        @endif

        @if(Sentinel::hasAccess('quick-links.index'))
        <li><a href="{{ route('quick-links.index') }}"><i class="fa fa-external-link"></i> <span>Quick Links</span></a></li>
        @endif


        @if(Sentinel::hasAccess('visitor-queries.index'))
        <li><a href="{{ route('visitor_queries.index') }}"><i class="fa fa-question"></i> <span>Visitor Queries</span></a></li>
        @endif

      </ul>
    </section>
  </aside>
