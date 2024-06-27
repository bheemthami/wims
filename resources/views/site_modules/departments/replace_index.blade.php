<div id="table-wrapper" >
	<table class="table table-bordered table-striped">
		<thead>
			<th>S.No.</th>
			<th>Title</th>
			<th>Order</th>
			<th>Status</th>
			<th>Action</th>
		</thead>
		<tbody>
			@php $sno = ($departments->currentPage()==1) ? 1 : ($departments->currentPage()-1)*$departments->perPage()+1 ; @endphp
			@forelse($departments as $department)
			<tr>
				<td>{{ $sno++ }}</td>
				<td>
					{{ $department->title }}
				</td>
				<td>{{ $department->order }}</td>
				
				<td>
					@if($department->status == 1)
					<label class="label label-success">Publish</label>
					@else
					<label class="label label-default">Draft</label>
					@endif
				</td>
				<td>
					<a class="btn btn-sm btn-success" href="{{ route('departments.edit',[$department->id])}}"><i class="fa fa-edit"></i></a>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$department->id}}" data-route="{{route('departments.destroy', $department->id) }}"> <i class="fa fa-trash"></i></a>

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
			{{$departments->links('vendor.pagination.default')}}
		</ul>
	</div>
</div>