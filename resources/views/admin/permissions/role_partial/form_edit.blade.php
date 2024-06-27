<div class="row">
	<div class="col-md-12">
		<h3 class="box-title"> <input type="checkbox" name="" id="grant_all"> <span class="label label-success">Grant all permissions</span>  </h3>
	</div>

	<div class="col-md-12">
		<h3 class="box-title"> Permissions</h3>
		<ul class="list-group ">
			@forelse($lists['modules'] as $key3 => $module)

			@if(!$module['actions'])
			<li class="list-group-item">
				<h3 class="box-title">
					
					<input type="checkbox" class="modules" id="modules-{{$key3}}" name="permissions[{{ $module['module']}}]"> {{$module['module']}} 
					
				</h3>
			</li>
			@else

			<li class="list-group-item"> 
				<h3 class="box-title"><input type="checkbox" class="modules" name="" id="modules-{{$key3}}">  &nbsp;{{$module['module']}}</h3>
				<ul class="nav">
					@foreach($module['actions']  as $key4 => $action)
					<li>
						@if(array_key_exists(Str::slug($module['module']).'.'.Str::slug($action),$existing_permissions))
						<input type="checkbox" class="actions-{{$key3}} mod-actions" id="action-{{$key4}}-{{$key3}}" name="permissions[{{ $module['module']}}][{{$action}}]" checked> {{ $action }}
						@else

						<input type="checkbox" class="actions-{{$key3}} mod-actions" id="action-{{$key4}}-{{$key3}}" name="permissions[{{ $module['module']}}][{{$action}}]"> {{ $action }}

						@endif
					</li>
					@endforeach
				</ul>
			</li>
			@endif
			@empty
			<li class="list-group-item">
				Module not found
			</li>
			@endforelse
		</ul>
	</div>
</div>

