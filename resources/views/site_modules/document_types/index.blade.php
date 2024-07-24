@extends('layouts.admin.app')

@section('title','Document Type List')

@section('content')
<!-- Content Header (Document Type header) -->
<section class="content-header">
	<h1> Document Types</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Document Types</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Document Types List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('document-types.create')}}"> <i class="fa fa-plus"></i> Add New Document Type</a>
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
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($document_types->currentPage()==1) ? 1 : ($document_types->currentPage()-1)*$document_types->perPage()+1 ; @endphp
						@forelse($document_types as $document_type)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>
								{{ $document_type->title }}
							</td>
							<td>
								<img src="{{asset('uploads/document_types/'.$document_type->image)}}" width="80px">
							</td>
							<td>{{ $document_type->order }}</td>

							<td>
								@if($document_type->status == 1)
								<label class="label label-success">Publish</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<div class="action-button-list">
									<a class="btn btn-sm btn-success" href="{{ route('document-types.edit',[$document_type->id])}}"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$document_type->id}}" data-route="{{route('document-types.destroy', $document_type->id) }}"> <i class="fa fa-trash"></i></a>
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
						{{$document_types->links('vendor.pagination.default')}}
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
			var title = $('#title').val();
			var baseUrl = "<?php echo url('admin/document-types') ?>";
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
@endsection
