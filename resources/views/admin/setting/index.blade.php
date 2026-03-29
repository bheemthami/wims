@extends('layouts.admin.app')

@section('title', 'Settings')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Settings</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>

    <!-- Main content -->
    <div class="content">
        <div class="row-auto">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Default Settings</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <label class="col-md-4">Current Year</label>
                            <div class="col-md-8">{{ $setting->academicYear->year }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Office/Institute</label>
                            <div class="col-md-8">{{ $setting->office }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Office/Institute Address</label>
                            <div class="col-md-8">{{ $setting->office_address }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Municipality</label>
                            <div class="col-md-8">{{ $setting->municipality }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Province Name</label>
                            <div class="col-md-8">{{ $setting->province_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">District Name</label>
                            <div class="col-md-8">{{ $setting->district_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Phone</label>
                            <div class="col-md-8">{{ $setting->phone }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Email</label>
                            <div class="col-md-8">{{ $setting->email }}</div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-primary btn-sm" href="{{ route('settings.edit', $setting->id) }}"> <i
                                class="fa fa-edit"></i> Edit Setting</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">System Settings</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <label class="col-md-4">Logo</label>
                            <div class="col-md-8">
                                <img class="image img-responsive" src="{{ asset('uploads/setting/' . $setting->logo) }}"
                                    height="100" width="100" alt="LOGO" style="border: 1px solid green;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Website main Logo</label>
                            <div class="col-md-8">
                                <img class="image img-responsive"
                                    src="{{ asset('uploads/setting/' . $setting->local_logo) }}" height="100"
                                    width="100" alt="LOCAL LOGO" style="border: 1px solid green;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Favicon</label>
                            <div class="col-md-8">
                                <img class="image img-responsive" src="{{ asset('uploads/setting/' . $setting->favicon) }}"
                                    height="100" width="100" alt="Favicon" style="border: 1px solid green;">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4">system Name</label>
                            <div class="col-md-8">{{ $setting->system_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">System Short Name</label>
                            <div class="col-md-8">{{ $setting->system_short_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Tag Line</label>
                            <div class="col-md-8">{{ $setting->tag_line }}</div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-primary btn-sm" href="{{ route('settings.edit', $setting->id) }}"> <i
                                class="fa fa-edit"></i> Edit Setting</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
