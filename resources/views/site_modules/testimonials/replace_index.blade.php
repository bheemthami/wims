<div id="table-wrapper" >
	<table class="table table-bordered table-striped">
		<thead>
			<th>S.No.</th>
			<th>Statement By</th>
			<th>Image</th>
			<th>Statement</th>
			<th>Order</th>
			<th>Status</th>
			<th>Action</th>
		</thead>
		<tbody>
			@php $sno = ($testimonials->currentPage()==1) ? 1 : ($testimonials->currentPage()-1)*$testimonials->perPage()+1 ; @endphp
			@forelse($testimonials as $testimonial)
			<tr>
				<td>{{ $sno++ }}</td>
				<td>
					{{ $testimonial->statement_by }}
				</td>
				<td>
					<img src="{{asset('uploads/testimonials/'.$testimonial->image)}}" width="80px">

					<td>{{ substr($testimonial->statement,0,50) }}</td></td>
					<td>{{ $testimonial->order }}</td>

					<td>
						@if($testimonial->status == 1)
						<label class="label label-success">Publish</label>
						@else
						<label class="label label-default">Draft</label>
						@endif
					</td>
					<td>
						<a class="btn btn-sm btn-primary" href="{{ route('testimonials.show',[$testimonial->id])}}"><i class="fa fa-eye"></i></a>
						<a class="btn btn-sm btn-success" href="{{ route('testimonials.edit',[$testimonial->id])}}"><i class="fa fa-edit"></i></a>
						<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$testimonial->id}}" data-route="{{route('testimonials.destroy', $testimonial->id) }}"> <i class="fa fa-trash"></i></a>

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
				{{$testimonials->links('vendor.pagination.default')}}
			</ul>
		</div>
	</div>