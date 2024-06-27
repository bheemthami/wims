@extends('layouts.admin.app')
@section('title')
Dahsboard
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Welcome to Dashboard</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	</ol>
</section>

<section class="content">
	@include('admin.admin_home')	
</section>

@stop
