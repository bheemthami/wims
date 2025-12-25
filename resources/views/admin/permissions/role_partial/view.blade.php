@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pull pull-left">
                    <ul class="breadcrumb">
                        <li> <a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li> <a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="active">View Permissions</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Given Permissions to <strong>Role - </strong> <span class="badge">{{ $role->name }}</span> <a
                                class="btn btn-sm btn-info" href="{{ route('edit.role.permissions', $role->id) }}"><i
                                    class="fa fa-pencil"></i> Edit </a>

                            <a class="btn btn-sm btn-danger" href="{{ route('roles.index') }}"><i
                                    class="fa fa-arrow-left"></i> Back </a>
                        </h3>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="box-title"> Permissions</h3>
                                    <ul class="list-group ">
                                        @forelse($lists['modules'] as $key3 => $module)
                                            @if (!$module['actions'])
                                                <li class="list-group-item">
                                                    <h3 class="box-title">

                                                        <input type="checkbox" class="modules"
                                                            id="modules-{{ $key3 }}"
                                                            name="permissions[{{ $module['module'] }}]">
                                                        {{ $module['module'] }}

                                                    </h3>
                                                </li>
                                            @else
                                                <li class="list-group-item">
                                                    <h3 class="box-title"><input type="checkbox" class="modules"
                                                            name="" id="modules-{{ $key3 }}">
                                                        &nbsp;{{ $module['module'] }}</h3>
                                                    <ul class="nav">
                                                        @foreach ($module['actions'] as $key4 => $action)
                                                            <li>
                                                                @if (array_key_exists(Str::slug($module['module']) . '.' . Str::slug($action), $existing_permissions))
                                                                    <input type="checkbox"
                                                                        class="actions-{{ $key3 }} mod-actions"
                                                                        id="action-{{ $key4 }}-{{ $key3 }}"
                                                                        name="permissions[{{ $module['module'] }}][{{ $action }}]"
                                                                        checked> {{ $action }}
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
