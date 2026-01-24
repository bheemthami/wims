@extends('layouts.admin.app')

@section('title', 'Event > View details')

@section('content')
    <!-- Content Header (Event header) -->
    <section class="content-header">
        <h1> Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('events.index') }}">Events</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('events.edit', [$event->id]) }}"><i
                            class="fa fa-edit"></i></a>

                    <a class="btn btn-sm btn-danger" href="{{ route('events.index') }}"><i class="fa fa-times"></i></a>

                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body">
                <fieldset class="fieldset-border">
                    <legend class="legend-border">details</legend>
                    <div class="col-md-12">
                        <h4 class="box-title">Title:</h4>
                        <p>{{ $event->title }} </p>
                    </div>

                    <div class="col-md-12">
                        <h4 class="box-title">Description:</h4>
                        <p>{!! $event->description !!} </p>
                    </div>

                    <div class="col-md-12">
                        <h4 class="box-title">Image:</h4>
                        @if ($event->image)
                            <img src="{{ asset('uploads/events/' . $event->image) }}" width="200px">
                        @else
                            <strong>No image</strong>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <h4 class="box-title">Attachment:</h4>
                        @if ($event->attachment)
                            <a href ="{{ asset('uploads/events/' . $event->attachment) }}" target="_blank"><i
                                    class="fa fa-eye"></i> view</a>
                        @else
                            <strong>No attachment</strong>
                        @endif
                    </div>

                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Event date time Details</legend>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p><strong>Start Date: </strong> {{ date('Y-m-d', strtotime($event->start_date)) }},
                                {{ $event->start_time }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>End Date: </strong> {{ date('Y-m-d', strtotime($event->end_date)) }},
                                {{ $event->end_time }}</p>
                        </div>

                        <div class="col-md-6">
                            <p><strong>Speaker of the events:</strong> {{ $event->speaker ? $event->speaker : '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Remarks:</strong> {{ $event->remarks ? $event->remarks : '-' }}</p>
                        </div>
                    </div>

                </fieldset>

                <fieldset class="fieldset-border">
                    <legend class="legend-border">Website Options</legend>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p><strong>Publish status: </strong> <label for=""
                                    class="label label-{{ $event->status == 1 ? 'success' : 'warning' }}">
                                    {{ $event->status == 1 ? 'Published' : 'Draft' }} </label> </p>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
