@extends('layouts.admin.app')

@section('title','Event > Create')

@section('content')
<!-- Content Header (Event header) -->
<section class="content-header">
	<h1> Events</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('events.index') }}"> Events</a></li>
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
				<label class="labellabel-danger">Fields with * are compulsory.</label>
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<form id="page-form" method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				@include('site_modules.events.partial.form')
				<div class="form-inline">
					<div class="pull pull-right">
						<div class="form-group">
							<button class="btn btn-success pull-right" type="submit">Submit</button>
						</div>
						<div class="form-group">
							<a class="btn btn-danger pull-right" href="{{ route('events.index') }}">Cancel</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

@endsection

@section('css')
<link rel="stylesheet" href ="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}"></link>
<link rel="stylesheet" href ="{{ asset('adminlte/bower_components/datepicker/bootstrap-timepicker.min.css')}}"></link>
@endsection

@section('js')
<script src="{{ asset('plugins/ckeditor5/ckeditor.js')}}"></script>
<script src="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/timepicker/bootstrap-datepicker.min.js')}}"></script>

<script>
	ClassicEditor
	.create( document.querySelector( '#editor' ),{
		ckfinder:{
			uploadUrl:"{{ route('ckeditor.upload').'?_token='.csrf_token() }}"
		}
	} ,{
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );
</script>

<script>
	$(document).ready(function(){
		$('#start_date').datepicker({
			"format": 'yyyy-mm-dd'
		}).datepicker("setDate",'now');;

	});
</script>

<script>
	$(document).ready(function(){
		$('#end_date').datepicker({
			"format": 'yyyy-mm-dd'
		}).datepicker("setDate",'now');;

	});
</script>

<script type="text/javascript">

	 //Timepicker
	$('.timepicker').timepicker({
		showInputs: false
	})
</script>



@endsection