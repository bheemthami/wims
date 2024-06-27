@extends('layouts.frontend.app')

@section('title', $training ? $training->title : '-')

@section('content')

<div class="course-details-area gray-bg pt-100">
    <div class="container">
       <div class="row">
        <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
            <div class="section-title mb-50 text-center">
                <div class="section-title-heading mb-20">
                    <h1 class="primary-color">{{ $training->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="single-course-details-area mb-30">
                <div class="course-details-thumb">
                    <img src="{{ asset('uploads/trainings/'.$training->image)}}" alt="NO IMAGE">
                </div>
                <div class="single-course-details white-bg">
                    <div class="course-details-tabs">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#indroduction" role="tab" aria-controls="pills-home" aria-selected="true">Indroduction </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-seats-tab" data-toggle="pill" href="#pills-seats" role="tab" aria-controls="pills-seats" aria-selected="false">Total seats</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pills-duration-tab" data-toggle="pill" href="#pills-duration" role="tab" aria-controls="pills-duration" aria-selected="false">Duration </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pills-eligibility-tab" data-toggle="pill" href="#pills-eligibility" role="tab" aria-controls="pills-eligibility" aria-selected="false">Eligibility</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="indroduction" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="course-details-overview-top">
                                    <p class="course-details-overview-para">{!!$training->description!!}</p>
                                </div>
                                <div class="course-details-overview-bottom d-flex justify-content-between mt-25">
                                    <div class="course-overview-info-left">
                                        <div class="course-overview-info-advisor mt-10">
                                            <span class="gray-color">Advisor : <span class="primary-color">-</span></span>
                                        </div>
                                        <div class="course-overview-student-lecture mt-10">
                                            <span class="gray-color">Students : <span class="primary-color">-</span></span>
                                            <span class="student-lecture-number gray-color">Lectures: <span class="primary-color">-</span></span>
                                        </div>
                                        <div class="course-overview-time-delay mt-10">
                                            <span class="gray-color">Duration : <span class="primary-color">-</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-seats" role="tabpanel" aria-labelledby="pills-seats-tab">
                                <p class="course-details-curiculum-para">- {{ $training->quota}}</p>
                            </div>

                            <div class="tab-pane fade" id="pills-duration" role="tabpanel" aria-labelledby="pills-duration-tab">
                                <p class="course-details-curiculum-para">- {{ $training->duration}}</p>
                            </div>

                            <div class="tab-pane fade" id="pills-eligibility" role="tabpanel" aria-labelledby="pills-eligibility-tab">
                                <p class="course-details-curiculum-para">- {{ $training->eligibility}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="courses-details-sidebar-area">

                <div class="widget mb-40 widget-padding white-bg">
                    <h4 class="widget-title">Trainings</h4>
                    <div class="widget-link">
                        <ul class="sidebar-link">
                            @forelse($trainings as $training)
                            <li>
                                <a href="{{ route('training-details',$training->slug)}}">{{ $training->title }}</a>
                                <span>{{$training->quota}}</span>
                            </li>
                            @empty
                            <li>
                                <a href="#">Title</a>
                                <span>quota</span>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="widget mb-40 widget-padding white-bg">
                    <h4 class="widget-title">Programs</h4>
                    <div class="widget-link">
                        <ul class="sidebar-link">
                            @forelse($programs as $prog)
                            <li>
                                <a href="{{route('program-details',$prog->slug)}}">{{ $prog->title }}</a>
                                <span>{{$prog->quota}}</span>
                            </li>
                            @empty
                            <li>
                                <a href="#">Program Title</a>
                                <span>quota</span>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

@endsection