<table class="table table-responsive table-bordered table-striped">
	<thead>
		<th>S.No.</th>
		<th>Name</th>
		<th>Ward No.</th>
		<th>Image</th>
		<th>Actions</th>
	</thead>
	<tbody>
		@php $sno = 1; @endphp
		@forelse($wards as $ward)
		<tr>	
			<td>{{ $sno++ }}</td>
			<td>{{ ucfirst($ward->name) }}</td>
			<td>{{ $ward->ward_no }}</td>
			<td>
				<img src="{{ asset('uploads/ward').'/'.$ward->image }}" width="70" height="70" alt="Image Not Found">
			</td>
			<td>
				<button class="btn btn-primary"><i class="fa fa-eye"></i></button>
				<button class="btn btn-success"><i class="fa fa-edit"></i></button>
				<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
			</td>
		</tr>
		@empty
		<tr>	
			<td colspan="5">Data not found!!!</td>
		</tr>
		@endforelse
	</tbody>
</table>
<nav>
	<ul class="pager">
		<li>{{$wards->links('vendor.pagination.default')}}</li>
	</ul>
</nav>