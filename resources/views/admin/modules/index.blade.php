@extends('layouts.admin.app')

@section('title','Module List')

@section('content')
<!-- Content Header (Module header) -->
<section class="content-header">
	<h1> Modules</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Modules</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Modules List</h3>
			
		</div>
		<div class="box-body table-responsive">
			modules goess here...
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection