@extends('layouts.admin.app')
@section('title', 'Role > Edit')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Role</h1>
        <ol class="breadcrumb">
            <li> <a href="{{ route('dashboard') }}"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li> <a href="{{ route('roles.index') }}">Role</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>
                <div class="box-tools pull-right">
                    <p style="color:red;">Fileds with (*) are compulsory.</p>
                </div>
            </div>
            <div class="box-body">
                {{ html()->modelForm($role, 'PATCH', route('roles.update', $role->id))->open() }}
                @include('admin.roles.partial.form')
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
@endsection
