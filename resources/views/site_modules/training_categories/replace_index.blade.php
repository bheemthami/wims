<div id="table-wrapper" >
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
			@php $sno = ($training_categories->currentPage()==1) ? 1 : ($training_categories->currentPage()-1)*$training_categories->perPage()+1 ; @endphp
			@forelse($training_categories as $training_category)
			<tr>
				<td>{{ $sno++ }}</td>
				<td>
					{{ $training_category->title }}
				</td>
				<td>
					<img src="{{asset('uploads/training_categories/'.$training_category->image)}}" width="80px">
				</td>
				<td>{{ $training_category->order }}</td>
				
				<td>
					@if($training_category->status == 1)
					<label class="label label-success">Publish</label>
					@else
					<label class="label label-default">Draft</label>
					@endif
				</td>
				<td>
					<a class="btn btn-sm btn-success" href="{{ route('training-categories.edit',[$training_category->id])}}"><i class="fa fa-edit"></i></a>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$training_category->id}}" data-route="{{route('training-categories.destroy', $training_category->id) }}"> <i class="fa fa-trash"></i></a>

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
			{{$training_categories->links('vendor.pagination.default')}}
		</ul>
	</div>
</div>