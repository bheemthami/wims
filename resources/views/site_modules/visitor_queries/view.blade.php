@extends('layouts.admin.app')

@section('title', 'Visitor Query > View details')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('visitor-queries.index') }}">Visitor Queries</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-danger" href="{{ route('visitor-queries.index') }}">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="box-body">
                <fieldset class="fieldset-border">
                    <legend class="legend-border">Query Details</legend>
                    <div class="row-auto">
                        <div class="col-md-12">
                            <p> <strong> Year: </strong>{{ $visitor_query->academicYear->year }} </p>
                        </div>
                        <div class="col-md-12">
                            <p> <strong> Name:- </strong>{{ $visitor_query->name }} </p>
                        </div>

                        <div class="col-md-12">
                            <p> <strong> Email: </strong>{{ $visitor_query->email }} </p>
                        </div>

                        <div class="col-md-12">
                            <p> <strong> Subject: </strong>{{ $visitor_query->subject }} </p>
                        </div>
                        <div class="col-md-12">
                            <h5> <strong> Message: </strong></h5>
                            <p>{!! $visitor_query->message !!} </p>
                        </div>

                        <div class="col-md-12">
                            @if ($visitor_query->status == 0)
                                <label class="btn btn-sm btn-warning">New Query</label>
                            @else
                                <label class="btn btn-sm btn-success">Viewed</label>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"
                                    data-id="{{ $visitor_query->id }}"
                                    data-route="{{ route('visitor-queries.destroy', $visitor_query->id) }}">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
