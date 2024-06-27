<div id="table-wrapper" >
	<table class="table table-bordered table-striped">
		<thead>
			<th>S.No.</th>
			<th>Type</th>
			<th>Title</th>
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
					{{ $gallery->title }}
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