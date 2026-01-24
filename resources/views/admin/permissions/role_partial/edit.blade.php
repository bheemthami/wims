@extends('layouts.admin.app')
@section('title', 'Role Permissions> Edit')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Roles</h1>
        <ol class="breadcrumb">
            <li> <a href="{{ route('dashboard') }}"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li> <a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit <span class="fw-bold">{{ $role->name }}</span> Role Permissions</h3>
            </div>
            <div class="box-body">
                {{ html()->modelForm($role, 'PATCH', route('update.role.permissions', $role->id))->id('role-permissions-form')->open() }}
                @include('admin.permissions.role_partial.partial.form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="action-button-list">
                            <button class="btn btn-success pull-right" type="submit">Submit</button>
                            <a class="btn btn-danger pull-right" href="{{ route('roles.index') }}">Cancel</a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.modules').change(function(event) {
                event.stopImmediatePropagation();
                var mod_id = $(this).attr('id').split('-')[1];
                if ($('#modules-' + mod_id).prop('checked')) {
                    var children = $(document).find('.actions-' + mod_id).each(function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    var children = $(document).find('.actions-' + mod_id).each(function() {
                        $(this).prop('checked', false);
                    });
                }
            });

            $('.mod-actions').change(function(event) {
                event.stopImmediatePropagation();
                var mod_id = $(this).attr('id').split('-')[2];
                var child_id = $(this).attr('id').split('-')[1];

                if ($('.actions-' + mod_id + ':checkbox:checked').length > 0) {
                    $(document).find('#modules-' + mod_id).prop('checked', true);
                } else {
                    $(document).find('#modules-' + mod_id).prop('checked', false);
                }
            });


            $('.parents').change(function(event) {
                event.stopImmediatePropagation();
                var mod_id = $(this).attr('id').split('-')[1];
                console.log(mod_id)
                if ($('#parents-' + mod_id).prop('checked')) {
                    var children = $(document).find('.child-' + mod_id).each(function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    var children = $(document).find('.child-' + mod_id).each(function() {
                        $(this).prop('checked', false);
                    });
                }
            });

            $('.child-actions').change(function(event) {
                event.stopImmediatePropagation();
                var mod_id = $(this).attr('id').split('-')[2];
                var child_id = $(this).attr('id').split('-')[1];

                if ($('.child-' + mod_id + ':checkbox:checked').length > 0) {
                    $(document).find('#parents-' + mod_id).prop('checked', true);
                } else {
                    $(document).find('#parents-' + mod_id).prop('checked', false);
                }
            });

            $('#grant_all').change(function(event) {
                event.stopImmediatePropagation();
                if ($(this).prop('checked')) {
                    $(document).find('input:checkbox').prop('checked', true);
                } else {
                    $(document).find('input:checkbox').prop('checked', false);
                }
            });

        });
    </script>
@endsection
