@extends('layouts.admin.app')

@section('title','Official > List')

@section('content')
<!-- Content Header (Official header) -->
<section class="content-header">
	<h1> Officials</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Officials</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Officials List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('officials.create')}}"> <i class="fa fa-users"></i> Add New Official</a>
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="filteration">
				<div class="col-md-2">
					<label for="name">Department</label>
					{!! Form::select('department_id',$data['department_options'],null,['class'=>'form-control','id'=>'department_id']) !!}
				</div>
				<div class="col-md-2">
					<label for="name">Working Status</label>
					{!! Form::select('working_status',$data['working_status_options'],null,['class'=>'form-control','id'=>'working_status']) !!}
				</div>

				<div class="col-md-2">
					<label for="name">Is Teaching Official</label>
					{!! Form::select('is_teaching_official',$data['working_status_options'],null,['class'=>'form-control','id'=>'is_teaching_official']) !!}
				</div>

				<div class="col-md-2">
					<label for="name">Is published</label>
					{!! Form::select('status',$data['publish_options'],null,['class'=>'form-control','id'=>'status']) !!}
				</div>

				<div class="col-md-2">
					<label for="first_name"> First Name </label>
					<div class="form-group">
						<input id="first_name" name="first_name" class="form-control" placeholder="Enter first name">
					</div>
				</div>

				<div class="col-md-2">
					<label for="dob"> Filter</label>
					<div class="form-group">
						<button id="search-button" class="btn btn-sm btn-success" type="button"> <i class="fa fa-filter"></i> Filter</button>
						<button id="clear-button" class="btn btn-sm btn-danger" type="button"> <i class="fa fa-eraser"></i> clear</button>
					</div>
				</div>
			</div>
			<div id="table-wrapper">
				<table class="table table-bordered table-striped">
					<thead>
						<th>S.No.</th>
						<th>Department</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Is working</th>
						<th>Is Published</th>
						<th>Order</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($officials->currentPage()==1) ? 1 : ($officials->currentPage()-1)*$officials->perPage()+1 ; @endphp
						@forelse($officials as $official)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>{{ $official->department->title}}</td>
							<td>
								{{ strtoupper($official->first_name)}}
								{{ strtoupper(($official->middle_name) ? $official->middle_name :'')}}
								{{ strtoupper($official->last_name)}}
							</td>
							<td>{{ ucwords($official->mobile)}}</td>

							<td>
								@if($official->working_status == 1)
								<label class="label label-success">YES</label>
								@else
								<label class="label label-default">NO</label>
								@endif
							</td>

							<td>
								@if($official->status == 1)
								<label class="label label-success">Published</label>
								@else
								<label class="label label-danger">Draft</label>
								@endif
							</td>

							<td>{{ $official->order }}</td>
							<td>
								<div class="action-button-list">
									<a class="btn btn-sm btn-primary" href="{{ route('officials.show',[$official->id])}}"><i class="fa fa-eye"></i></a>
									<a class="btn btn-sm btn-success" href="{{ route('officials.edit',[$official->id])}}"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$official->id}}" data-route="{{route('officials.destroy', $official->id) }}"> <i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="8"> Not found!!!</td>
						</tr>
						@endforelse

					</tbody>
				</table>


				<!-- /.box-body -->
				<div class="box-footer clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						{{$officials->links('vendor.pagination.default')}}
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box -->
</section>

<script>
	$(document).ready(function() {
		$('#search-button').click(function() {
			$('#custom-loader').modal('show');
			var first_name = $('#first_name').val();
			var department_id = $('#department_id').val();
			var working_status = $('#working_status').val();
			var is_teaching_official = $('#is_teaching_official').val();
			var status = $('#status').val();
			var baseUrl = "<?php echo url('admin/officials') ?>";
			$.ajax({
				url: baseUrl,
				data: {
					'first_name': first_name,
					'department_id': department_id,
					'working_status': working_status,
					'is_teaching_official': is_teaching_official,
					'status': status
				},
				success: function(response) {
					$(document).find('#table-wrapper').html(response);
					$('#custom-loader').modal('hide');
				},
				error: function() {
					$('#custom-loader').modal('hide');
					toastr.error("Oops something sent wrong. Try again later!");
				}
			});
		});

		$('#clear-button').click(function() {
			$('#first_name').val('');
			$('#department_id').val('');
			$('#working_status').val('');
			$('#is_teaching_official').val('');
			$('#status').val('');
		});
	});
</script>
@endsection
