@extends('layouts.admin.app')

@section('title','Facility List')

@section('content')
<!-- Content Header (Facility header) -->
<section class="content-header">
	<h1> Facilities</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Facilities</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"> List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('facilities.create')}}"> <i class="fa fa-plus"></i> Add New Facility</a>
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
						<th>Image</th>
						<th>Order</th>
						<th>Summary</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($facilities->currentPage()==1) ? 1 : ($facilities->currentPage()-1)*$facilities->perPage()+1 ; @endphp
						@forelse($facilities as $facility)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>
								{{ $facility->title }}
							</td>
							<td>
								<img src="{{asset('uploads/media/'.$facility->images[0]->image)}}" width="80px">
							</td>
							<td>{{ $facility->order }}</td>
							<td>{!! substr($facility->summary,0,100) !!}</td>

							<td>
								@if($facility->status == 1)
								<label class="label label-success">Published</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<div class="action-button-list">
									<a class="btn btn-sm btn-primary" href="{{ route('facilities.show',[$facility->id])}}"><i class="fa fa-eye"></i></a>
									<a class="btn btn-sm btn-success" href="{{ route('facilities.edit',[$facility->id])}}"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$facility->id}}" data-route="{{route('facilities.destroy', $facility->id) }}"> <i class="fa fa-trash"></i></a>
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
						{{$facilities->links('vendor.pagination.default')}}
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
			$('#custom-loader').modal('show');
			var title = $('#title').val();
			var baseUrl = "<?php echo url('admin/facilities') ?>";
			$.ajax({
				url: baseUrl,
				data: {
					'title': title
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
