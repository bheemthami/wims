<!DOCTYPE html>
<html>
@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.header_scripts')
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"> 
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <section class="content">
       @yield('content')
     </section>         
   </div>
   @include('layouts.admin.footer') 
 </div>
 <!-- ./wrapper -->
 @include('layouts.admin.footer_scripts')
</body>
</html>
