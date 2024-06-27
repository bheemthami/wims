@extends('layouts.admin.app')

@section('title','Settings > Edit')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Settings
	</h1>
	<ol class="breadcrumb">
		<li> <a href="{{ route('dashboard') }}"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li> <a href="{{ route('settings.index') }}"> <i class="fa fa-cog"></i> Setting</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Default Settings</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		{!! Form::model($setting,['route'=>['settings.update',$setting->id],'method'=>'patch','files'=>true]) !!}
		{{ csrf_field() }}
		@include('admin.setting.partial.form')
		<div class="form-inline">
			<div class="pull pull-right">
				<div class="form-group">
					<button class="btn btn-success pull-right" type="submit">Submit</button>
				</div>
				<div class="form-group">
					<a class="btn btn-danger pull-right" href="{{ route('settings.index')}}">Cancel</a>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('#doi').nepaliDatePicker();
	});

	$(document).ready(function(){
		$('#sid').nepaliDatePicker();
	});

	$(document).ready(function(){
		$('#resultDate').nepaliDatePicker();
	});
</script>
@endsection
