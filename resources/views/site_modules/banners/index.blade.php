@extends('layouts.admin.app')

@section('title','Banner List')

@section('content')
<!-- Content Header (Banner header) -->
<section class="content-header">
	<h1> Banners</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Banners</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Banners List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('banners.create')}}"> <i class="fa fa-plus"></i> Add New Banner</a>
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
						<th>Tagline</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($banners->currentPage()==1) ? 1 : ($banners->currentPage()-1)*$banners->perPage()+1 ; @endphp
						@forelse($banners as $banner)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>
								{{ $banner->title }}
							</td>
							<td>
								<img src="{{asset('uploads/banners/'.$banner->image)}}" width="80px">
							</td>
							<td>{{ $banner->order }}</td>
							<td>{{ $banner->tagline }}</td>

							<td>
								@if($banner->status == 1)
								<label class="label label-success">Publish</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<div class="action-button-list">
									<a class="btn btn-sm btn-success" href="{{ route('banners.edit',[$banner->id])}}"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$banner->id}}" data-route="{{route('banners.destroy', $banner->id) }}"> <i class="fa fa-trash"></i></a>
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
						{{$banners->links('vendor.pagination.default')}}
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
			var title = $('#title').val();
			var baseUrl = "<?php echo url('admin/banners') ?>";
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
@endsection
