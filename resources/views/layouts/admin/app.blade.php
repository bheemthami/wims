<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">
@include('layouts.admin.head')
@include('layouts.admin.header_scripts')
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('layouts.admin.header')
		@include('layouts.admin.sidebar') 
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Main content -->
			@yield('content')
		</div>
		@include('layouts.admin.footer') 
	</div>
	@include('include.deleteModal')
	<!-- ./wrapper -->
	@include('layouts.admin.footer_scripts')
</body>
</html>
