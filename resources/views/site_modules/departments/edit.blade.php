@extends('layouts.admin.app')

@section('title','Departments > Edit')

@section('content')

<!-- Content Header (Departments header) -->
<section class="content-header">
	<h1> Departmentss</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('departments.index') }}"> Departmentss</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Edit</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			{!! Form::model($department,['route'=>['departments.update',$department->id],'method'=>'PATCH','enctype'=>'multipart/form-data']) !!}
			{{ csrf_field() }}
			@include('site_modules.departments.partial.edit_form')
			<div class="form-inline">
				<div class="pull pull-right">
					<div class="form-group">
						<button class="btn btn-success pull-right" type="submit">Submit</button>
					</div>
					<div class="form-group">
						<a class="btn btn-danger pull-right" href="{{ route('departments.index') }}">Cancel</a>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</section>
@endsection