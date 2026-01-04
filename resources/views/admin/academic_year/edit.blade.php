@extends('layouts.admin.app')

@section('title', 'Year > Edit')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Year</h1>
        <ol class="breadcrumb">
            <li> <a href="{{ route('dashboard') }}"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li> <a href="{{ url('admin/academic-years') }}">Year</a></li>
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
                {{ html()->modelForm($academic_year, 'PATCH', route('academic-years.update', $academic_year->id))->open() }}
                @include('admin.academic_year.partial.form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">Submit</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="{{ url('admin/academic-years') }}">Cancel</a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
@endsection
