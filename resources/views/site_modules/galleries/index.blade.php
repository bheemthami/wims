@extends('layouts.admin.app')

@section('title','Galleries')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Galleries</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Galleries</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Gallery List</h3>
			<div class="box-tools pull-right">
				<a class="btn btn-sm btn-success" href="{{ route('galleries.create')}}"> <i class="fa fa-plus"></i> Add New Gallery</a>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="filteration">

				<div class="col-md-3">
					<label for="first_name"> Title  </label>
					<div class="form-group">
						<input id="title" name="title" class="form-control" placeholder="title">
					</div>
				</div>
				
				<div class="col-md-3">
					<label for="first_name"> Academic Year  </label>
					<div class="form-group">
						{!! Form::select('academic_year_id',$data['year_options'],$setting->academic_year_id,['class'=>'form-control','id'=>'academic_year_id']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="first_name">  Type </label>
					<div class="form-group">
						{!! Form::select('type',$data['type_options'],null,['class'=>'form-control','id'=>'type']) !!}
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
			<div id="table-wrapper" >
				<table class="table table-bordered table-striped">
					<thead>
						<th>S.No.</th>
						<th>Type</th>
						<th>Title</th>
						<th>Media</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						@php $sno = ($galleries->currentPage()==1) ? 1 : ($galleries->currentPage()-1)*$galleries->perPage()+1 ; @endphp
						@forelse($galleries as $gallery)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>{{ $gallery->type }}</td>
							<td>
								{{ $gallery ? $gallery->title : 'Title'  }}
							</td>
							<td>
								@if($gallery->type == 'image')

								@if(count($gallery->images) > 0)
								<img src="{{asset('uploads/galleries/'.$gallery->images[0]->image)}}" width="80px" alt="No image">
								@else
								NO IMAGE
								@endif
								@else
								<a class="btn btn-sm btn-primary" href="#"><i class="fa fa-eye"></i></a>
								@endif
							</td>
							<td>{{ $gallery->date }}</td>							
							<td>
								@if($gallery->status == 1)
								<label class="label label-success">Published</label>
								@else
								<label class="label label-default">Draft</label>
								@endif
							</td>
							<td>
								<a class="btn btn-sm btn-primary" href="{{ route('galleries.show',[$gallery->id])}}"><i class="fa fa-eye"></i></a>
								<a class="btn btn-sm btn-success" href="{{ route('galleries.edit',[$gallery->id])}}"><i class="fa fa-edit"></i></a>
								<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$gallery->id}}" data-route="{{route('galleries.destroy', $gallery->id) }}"> <i class="fa fa-trash"></i></a>

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
						{{$galleries->links('vendor.pagination.default')}}
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
	$(document).ready(function(){
		$('#search-button').click(function(){
			var title = $('#title').val();
			var academic_year_id = $('#academic_year_id').val();
			var type = $('#type').val();
			var baseUrl = "<?php echo url('admin/galleries')?>";
			$.ajax({
				url : baseUrl,
				data : {'title':title,'academic_year_id':academic_year_id,'type':type},
				success:function(response){
					$(document).find('#table-wrapper').html(response);
				}
			});
		});

		$('#clear-button').click(function(){
			$('#title').val('');
			$('#academic_year_id').val('');
		});
	});
</script>
@endsection
