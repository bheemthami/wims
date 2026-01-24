@extends('layouts.admin.app')
@section('title', 'Roles')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Roles</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Roles</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('roles.create') }}">
                        <i class="fa fa-plus me-1"></i>
                        Add Role
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div id="replaceTable ">
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Permissions Actions</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @php $sno = 1*$roles->currentPage(); @endphp
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="action-button-list">
                                            @if (!$role->permissions)
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('create.role.permissions', $role->id) }}"><i
                                                        class="fa fa-key me-1"></i> Set Permissions </a>
                                            @endif
                                            @if ($role->permissions && strtolower($role->slug) != \App\Constants\RoleConstant::SUPER_ADMIN)
                                                <a class="btn btn-sm btn-info"
                                                    href="{{ route('show.role.permissions', $role->id) }}"><i
                                                        class="fa fa-eye me-1"></i>
                                                    View</a>
                                                <a class="btn btn-sm btn-info"
                                                    href="{{ route('edit.role.permissions', $role->id) }}"><i
                                                        class="fa fa-pencil me-1"></i> Edit </a>
                                                <a class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#deleteModal" data-id="{{ $role->id }}"
                                                    data-route="{{ route('destroy.role.permissions', $role->id) }}"><i
                                                        class="fa fa-history me-1"></i> Revoke </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if (strtolower($role->slug) != \App\Constants\RoleConstant::SUPER_ADMIN)
                                            <div class="action-button-list">
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('roles.edit', $role->id) }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal" data-id="{{ $role->id }}"
                                                    data-route="{{ route('roles.destroy', $role->id) }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Data not found!!!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $roles->links('vendor.pagination.default') }}
                </ul>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        function paginate(page) {
            loadPaginatedData(page);
        }

        function loadPaginatedData(page = 1, perPage = 1) {
            $.ajax({
                url: '{{ url('admin/roles') }}',
                method: 'GET',
                data: {
                    'page': page,
                    'perPage': perPage
                },
            }).done(function(response) {
                $('#replaceTable').replaceWith(response);
            }).fail(function() {
                alert('Something went wrong, Try again later!!!')
            })
        }
    </script>
@endsection
