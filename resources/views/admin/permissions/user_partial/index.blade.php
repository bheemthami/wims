@extends('layouts.admin.app')
@section('content')
@section('title')
    Users
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Users</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-sm btn-success" href="{{ route('users.create') }}"> <i class="fa fa-plus"></i> Add User</a>
            <div class="box-tools pull-right">
                <p style="color:red;">Fileds with (*) are compulsory.</p>
            </div>
        </div>
        <div class="box-body">
            <div id="replaceTable ">
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                        <th>S.No.</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php $sno = 1*$users->currentPage(); @endphp
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $sno++ }}</td>
                                <td>
                                    <label class="label label-success">
                                        @foreach ($user->role as $role)
                                            {{ $role->name }}
                                            @if (count($user->role) > 1)
                                                <span>,</span>
                                            @endif
                                        @endforeach
                                    </label>
                                </td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="action-button-list">
                                        <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            data-id="{{ $user->id }}"
                                            data-route="{{ route('users.destroy', $user->id) }}"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
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
                {{ $users->links('vendor.pagination.default') }}
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
            url: '{{ url('admin/academic-years') }}',
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
