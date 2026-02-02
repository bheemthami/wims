@extends('layouts.admin.app')

@section('title', 'Profile > Edit')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Profile</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                {{ html()->modelForm($profile, 'PATCH', route('profile.update', $profile->id))->open() }}
                @include('admin.profile.user.partial.edit_form')
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull pull-right">
                            <div class="action-button-list">
                                <button class="btn btn-success pull-right" type="submit">Submit</button>
                                <a class="btn btn-danger pull-right" href="{{ route('profile.index') }}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>

@endsection
