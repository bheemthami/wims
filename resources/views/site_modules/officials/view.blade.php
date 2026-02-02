@extends('layouts.admin.app')

@section('title', 'View details')

@section('content')
    <!-- Content Header (Official header) -->
    <section class="content-header">
        <h1> Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('officials.index') }}">Officials</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('officials.edit', $official->id) }}"><i
                            class="fa fa-edit"></i></a>
                    <a class="btn btn-sm btn-danger" href="{{ route('officials.index') }}"><i class="fa fa-times"></i></a>
                </div>
            </div>

            <div class="box-body">
                <fieldset class="fieldset-border">
                    <legend class="legend-border">Office Details</legend>
                    <div class="row-auto">
                        <div class="col-md-4">
                            <p><strong> Joining Academic Year: </strong><label
                                    class="label label-success">{{ $official->academicYear->year }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Department: </strong><label
                                    class="label label-success">{{ $official->department->title }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Designation: </strong><label
                                    class="label label-success">{{ $official->designation->name }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Designation: </strong><label
                                    class="label label-success">{{ $official->designation->name }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Joining date: </strong> {{ $official->joining_date }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Leaving date: </strong> {{ $official->leaving_date }}</p>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Personal Details</legend>
                    <div class="row-auto">
                        <div class="col-md-4">
                            <img class="img-responsive" src="{{ asset('uploads/officials/' . $official->image) }}"
                                width="80px" alt="Image">
                        </div>
                    </div>

                    <div class="row-auto">
                        <div class="col-md-4">
                            <p><strong> Name: </strong><label class="label label-success">{{ $official->first_name }}
                                    {{ $official->middle_name }} {{ $official->last_name }}</label> <span
                                    class="badge">{{ $official->working_status ? 'Working' : 'Not working' }}</span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>DOB: </strong> {{ $official->dob }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Gender: </strong> {{ $official->gender }}</p>
                        </div>
                    </div>

                    <div class="row-auto">
                        <div class="col-md-4">
                            <p><strong> Address: </strong>{{ $official->municipality }}
                                {{ $official->localLevelType->name }} - {{ $official->ward_no }},
                                {{ $official->district }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Mobile: </strong> {{ $official->mobile }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Email: </strong> {{ $official->email }}</p>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Academic Details</legend>
                    <div class="row-auto">
                        <div class="col-md-4">
                            <p><strong> Degree: </strong>{{ $official->degree ? $official->degree : '-' }} </p>
                        </div>
                    </div>
                    <div class="row-auto">
                        <div class="col-md-4">
                            <p><strong> Address: </strong>{{ $official->municipality }}
                                {{ $official->localLevelType->type_name }} - {{ $official->ward_no }},
                                {{ $official->district }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Mobile: </strong> {{ $official->mobile }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong> Email: </strong> {{ $official->email }}</p>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Website Options</legend>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <p><strong> Display Order: </strong><label
                                        class="label label-success">{{ $official->order }}</label></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Publish status: </strong> <label
                                        class="label label-{{ $official->status == 1 ? 'success' : 'info' }}">{{ $official->status == 1 ? 'Published' : 'Draft' }}
                                    </label></p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
