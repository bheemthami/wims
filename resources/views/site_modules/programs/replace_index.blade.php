<div id="table-wrapper" >
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
			@php $sno = ($programs->currentPage()==1) ? 1 : ($programs->currentPage()-1)*$programs->perPage()+1 ; @endphp
			@forelse($programs as $program)
			<tr>
				<td>{{ $sno++ }}</td>
				<td>{{ $program->title }}</td>
				<td>
					<img src="{{asset('uploads/programs/'.$program->image)}}" width="80px">
				</td>
				<td>{{ $program->order }}</td>
				<td>{!! substr($program->summary,0,100) !!}</td>
				
				<td>
					@if($program->status == 1)
					<label class="label label-success">Publish</label>
					@else
					<label class="label label-default">Draft</label>
					@endif
				</td>
				<td>
					<a class="btn btn-sm btn-primary" href="{{ route('programs.show',[$program->id])}}"><i class="fa fa-eye"></i></a>
					<a class="btn btn-sm btn-success" href="{{ route('programs.edit',[$program->id])}}"><i class="fa fa-edit"></i></a>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$program->id}}" data-route="{{route('programs.destroy', $program->id) }}"> <i class="fa fa-trash"></i></a>

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
			{{$programs->links('vendor.pagination.default')}}
		</ul>
	</div>
</div>