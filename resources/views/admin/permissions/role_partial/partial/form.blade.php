<div class="box-body no-padding">
    <div class="row-auto">
        <div class="col-md-12">
            <div class="d-flex  align-items-center gap-2 mb-4 border border-info rounded p-3">
                <input type="checkbox" name="" id="grant_all" class="m-0">
                <label for="grant_all" class="m-0 fs-3">
                    Grant All Permissions
                </label>
            </div>
        </div>
    </div>
    <div class="row-auto">
        @forelse($lists['modules'] as $key3 => $module)
            @if ($module['is_active'])
                <div class="col-md-4">
                    <div
                        class="module-permission d-flex flex-column align-items-stretch  mb-4 border border-success rounded p-3">
                        <div class="d-flex align-items-center gap-2 fs-4 mb-4">
                            <input type="checkbox" class="modules m-0" name="" id="modules-{{ $key3 }}">
                            <label for="modules-{{ $key3 }}" class="m-0">
                                {{ Str::ucfirst($module['module']) }}
                            </label>
                        </div>
                        <div class="d-flex flex-wrap gap-4 align-items-start ms-4">
                            @foreach ($module['actions'] as $key4 => $action)
                                <span class="d-flex gap-2 align-items-center">
                                    @if (array_key_exists(Str::slug($module['module']) . '.' . Str::slug($action), $existing_permissions))
                                        <input type="checkbox" class="actions-{{ $key3 }} mod-actions m-0"
                                            id="action-{{ $key4 }}-{{ $key3 }}"
                                            name="permissions[{{ $module['module'] }}][{{ $action }}]" checked>
                                        <label for="action-{{ $key4 }}-{{ $key3 }}"
                                            class="m-0 fw-normal">{{ Str::ucfirst($action) }}</label>
                                    @else
                                        <input type="checkbox" class="actions-{{ $key3 }} mod-actions m-0"
                                            id="action-{{ $key4 }}-{{ $key3 }}"
                                            name="permissions[{{ $module['module'] }}][{{ $action }}]">
                                        <label for="action-{{ $key4 }}-{{ $key3 }}"
                                            class="m-0 fw-normal">{{ Str::ucfirst($action) }}</label>
                                    @endif
                                </span>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endif
        @empty
            <div class="col-md-4">
                Module not found
            </div>
        @endforelse
    </div>
</div>
<div class="clearfix"></div>
