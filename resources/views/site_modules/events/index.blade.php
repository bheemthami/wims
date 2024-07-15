@extends('layouts.admin.app')

@section('title','Event List')

@section('content')
<!-- Content Header (Event header) -->
<section class="content-header">
	<h1> Events</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Events</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Events List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('events.create')}}"> <i class="fa fa-plus"></i> Add New Event</a>
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="filteration">
				<div class="col-md-3">
					<label for="first_name"> Title </label>
					<div class="form-group">
						<input id="title" name="title" class="form-control" placeholder="title">
					</div>
				</div>

				<div class="col-md-3">
					<label for="dob"> Filter</label>
					<div class="form-group">
						<button id="search-button" class="btn btn-sm btn-success" type="button"> <i class="fa fa-search"></i> search</button>
						<button id="clear-button" class="btn btn-sm btn-danger" type="button"> <i class="fa fa-eraser"></i> clear</button>
					</div>
				</div>
			</div>
			<div id="table-wrapper">
				<table class="table table-bordered table-striped">
					<thead>
						<th>S.No.</th>
						<th>Title</th>
						<th>Banner</th>
						<th>Date</th>
						<th>Speaker</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($events->currentPage()==1) ? 1 : ($events->currentPage()-1)*$events->perPage()+1 ; @endphp
						@forelse($events as $event)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>
								{{ $event->title }}
							</td>
							<td>
								<img src="{{asset('uploads/events/'.$event->image)}}" width="80px">
							</td>
							<td>
								{{ date('Y-m-d',strtotime($event->start_time)) }}, {{ $event->start_time}} -
								{{ date('Y-m-d',strtotime($event->end_time)) }}, {{ $event->end_time}}
							</td>
							<td>{{ $event->speaker ? $event->speaker : '-'}}</td>

							<td>
								@if($event->status == 1)
								<label class="label label-success">Published</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<div class="action-button-list">
									<a class="btn btn-sm btn-primary" href="{{ route('events.show',[$event->id])}}"><i class="fa fa-eye"></i></a>
									<a class="btn btn-sm btn-success" href="{{ route('events.edit',[$event->id])}}"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$event->id}}" data-route="{{route('events.destroy', $event->id) }}"> <i class="fa fa-trash"></i></a>
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
						{{$events->links('vendor.pagination.default')}}
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box -->
</section>
<script>
	$(document).ready(function() {
		$('#dob').nepaliDatePicker();
	});
</script>

<script>
	$(document).ready(function() {
		$('#search-button').click(function() {
			var title = $('#title').val();
			var baseUrl = "<?php echo url('admin/events') ?>";
			$.ajax({
				url: baseUrl,
				data: {
					'title': title
				},
				success: function(response) {
					$(document).find('#table-wrapper').html(response);
				}
			});
		});

		$('#clear-button').click(function() {
			$('#title').val('');
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#dob').nepaliDatePicker();
	});
</script>
@endsection
