@extends('layouts.admin.app')

@section('title','Posts')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Posts</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Posts</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Post List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('posts.create')}}"> <i class="fa fa-plus"></i> Add New Post</a>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="filteration">

				<div class="col-md-2">
					<label for="first_name"> Title </label>
					<div class="form-group">
						<input id="title" name="title" class="form-control" placeholder="title">
					</div>
				</div>

				<div class="col-md-2">
					<label for="first_name"> Academic Year </label>
					<div class="form-group">
						{!! Form::select('academic_year_id',$yearOptions,$setting->academic_year_id,['class'=>'form-control','id'=>'academic_year_id']) !!}
					</div>
				</div>

				<div class="col-md-2">
					<label for="first_name"> Post Category </label>
					<div class="form-group">
						{!! Form::select('post_category_id',$postCategoryOptions,null,['class'=>'form-control','id'=>'post_category_id']) !!}
					</div>
				</div>

				<div class="col-md-2">
					<label for="status"> Status </label>
					<div class="form-group">
						{!! Form::select('status',$statusOptions,$setting->status,['class'=>'form-control','id'=>'status']) !!}
					</div>
				</div>

				<div class="col-md-2">
					<label for="status"> Show on popup </label>
					<div class="form-group">
						{!! Form::select('show_on_modal',[null=>'--select--',1=>'YES', 0=>'NO'],$setting->show_on_modal,['class'=>'form-control','id'=>'show_on_modal']) !!}
					</div>
				</div>

				<div class="col-md-2">
					<label for="dob"> Filter</label>
					<div class="form-group">
						<button id="search-button" class="btn btn-sm btn-success" type="button"> <i class="fa fa-search"></i></button>
						<button id="clear-button" class="btn btn-sm btn-danger" type="button"> <i class="fa fa-eraser"></i></button>
					</div>
				</div>
			</div>
			<div id="table-wrapper">
				<table class="table table-bordered table-striped">
					<thead>
						<th>S.No.</th>
						<th>Category</th>
						<th>Title</th>
						<th>Image</th>
						<th>Published on</th>
						<th>Status</th>
						<th>Show on popup</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($posts->currentPage()==1) ? 1 : ($posts->currentPage()-1)*$posts->perPage()+1 ; @endphp
						@forelse($posts as $post)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>{{ $post->postCategory->title }}</td>
							<td>
								{{ $post->title }}
							</td>
							<td>
								<img src="{{asset('uploads/posts/'.$post->image)}}" width="80px" alt="No image">
							</td>
							<td>{{ $post->date }}</td>
							<td>
								@if($post->status === 1)
								<label class="label label-success">Published</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								@if($post->show_on_modal === 1)
								<label class="label label-success">Yes</label>
								@else
								<label class="label label-default">No</label>
								@endif
							</td>
							<td>
								<div class="action-button-list">
									<a class="btn btn-sm btn-primary" href="{{ route('posts.show',[$post->id])}}"><i class="fa fa-eye"></i></a>
									<a class="btn btn-sm btn-success" href="{{ route('posts.edit',[$post->id])}}"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$post->id}}" data-route="{{route('posts.destroy', $post->id) }}"> <i class="fa fa-trash"></i></a>
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
						{{$posts->links('vendor.pagination.default')}}
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box -->
</section>
@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('#search-button').click(function() {
			$('#custom-loader').modal('show');
			var title = $('#title').val();
			var academic_year_id = $('#academic_year_id').val();
			var post_category_id = $('#post_category_id').val();
			var status = $('#status').val();
			var showOnModal = $('#show_on_modal').val();
			var baseUrl = "<?php echo url('admin/posts') ?>";
			$.ajax({
				url: baseUrl,
				data: {
					title,
					academic_year_id,
					post_category_id,
					status,
					show_on_modal: showOnModal
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
			$('#academic_year_id').val('');
			$('#post_category_id').val('');
			$('#status').val('');
			$('#show_on_modal').val('');
		});
	});
</script>
@endsection
