<div id="table-wrapper" >
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
					<a class="btn btn-sm btn-success" href="{{ route('banners.edit',[$banner->id])}}"><i class="fa fa-edit"></i></a>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$banner->id}}" data-route="{{route('banners.destroy', $banner->id) }}"> <i class="fa fa-trash"></i></a>

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