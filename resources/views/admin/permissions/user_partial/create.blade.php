@extends('layouts.admin.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Users</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{route('users.index')}}"> Users</a></li>
		<li class="active">Create</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Create</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">

			<form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				@include('admin.user.partial.form')
				<div class="form-inline">
					<div class="pull pull-right">
						<div class="form-group">
							<button class="btn btn-success pull-right" type="submit">Submit</button>
						</div>
						<div class="form-group">
							<a class="btn btn-danger pull-right" href="{{ route('users.index') }}">Cancel</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection