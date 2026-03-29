@extends('layouts.admin.app')
@section('title', 'Role Permissions > Show')
@section('content')
    <section class="content-header">
        <h1>Role Permissions</h1>
        <ol class="breadcrumb">
            <li> <a href="{{ route('dashboard') }}"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li> <a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="active">View Permissions</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Show <span class="fw-bold">{{ $role->name }}</span> Role Permissions</h3>
                <div class="box-tools pull-right action-button-list">
                    <a class="btn btn-sm btn-info" href="{{ route('edit.role.permissions', $role->id) }}">
                        <i class="fa fa-pencil me-2"></i>Edit
                    </a>
                    <a class="btn btn-sm btn-danger" href="{{ route('roles.index') }}">
                        <i class="fa fa-times me-2"></i> Back</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row-auto">
                    @forelse($lists['modules'] as $key3 => $module)
                        @if ($module['is_active'])
                            <div class="col-md-4">
                                <div
                                    class="module-permission d-flex flex-column align-items-stretch  mb-4 border border-success rounded p-3">
                                    <div class="d-flex align-items-center gap-2 fs-4 mb-4">
                                        <input type="checkbox" class="modules m-0" name=""
                                            id="modules-{{ $key3 }}">
                                        <label for="modules-{{ $key3 }}" class="m-0">
                                            {{ Str::ucfirst($module['module']) }}
                                        </label>
                                    </div>
                                    <div class="d-flex flex-wrap gap-4 align-items-start ms-4">
                                        @foreach ($module['actions'] as $key4 => $action)
                                            <span class="d-flex gap-2 align-items-center">
                                                @if (array_key_exists(Str::slug($module['module']) . '.' . Str::slug($action), $existing_permissions))
                                                    <input type="checkbox"
                                                        class="actions-{{ $key3 }} mod-actions m-0"
                                                        id="action-{{ $key4 }}-{{ $key3 }}"
                                                        name="permissions[{{ $module['module'] }}][{{ $action }}]"
                                                        checked> {{ Str::ucfirst($action) }}
                                                @else
                                                    <input type="checkbox"
                                                        class="actions-{{ $key3 }} mod-actions m-0"
                                                        id="action-{{ $key4 }}-{{ $key3 }}"
                                                        name="permissions[{{ $module['module'] }}][{{ $action }}]">
                                                    {{ Str::ucfirst($action) }}
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
        </div>
    </section>
@endsection
