@extends('layouts.frontend.app')

@section('title', $event ? $event->title : '-')

@section('content')

<div class="course-details-area gray-bg pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="blog-wrapper blog-list blog-details blue-blog mb-50 padding-20">
                    <div class="blog-thumb mb-35">
                        @if($event->image)
                        <img src="{{ asset('uploads/events/'.$event->image)}}" alt="">
                        <span class="blog-text-offer">Event</span>
                        @endif
                    </div>
                    <div class="event-detail">
                        <h5>{{ $event->title }}</h5>
                        <div class="blog-meta news-meta mb-10">
                            @if($event->start_date == $event->end_date)
                            <span>{{ date("M j, Y",strtotime($event->start_date)) }} ({{$event->start_time}} - {{ $event->end_time}} )</span>
                            @else

                            <span>{{ date("M j, Y",strtotime($event->start_date)) }},({{$event->start_time}}) - {{ date("F jS, Y",strtotime($event->start_date)) }}, ( {{ $event->end_time}} )</span>
                            @endif
                        </div>
                        <p>{!! $event->description !!}</p>
                        @if($event->summary)
                        <blockquote class="blockquote">
                            <p class="mb-0">{{ $event ? $event->summary : 'summary'}}</p>
                        </blockquote>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="widget mb-40 widget-padding white-bg">
                    <h4 class="widget-title">Recent Events</h4>
                    <div class="sidebar-rc-post">
                        <ul>
                            @forelse($events as $not)

                            @if($not->id != $event->id)
                            <li>
                                <div class="sidebar-rc-post-main-area d-flex mb-20">
                                    <div class="rc-post-content">
                                        <h5>
                                            <a href="{{ route('event-details',$not->slug.'?nid='.base64_encode($not->id))}}">{{ $not->title }}</a>
                                        </h5>
                                        <div class="widget-advisors-name">
                                            <span>Date :<span class="f-500">{{ date("M j, Y",strtotime($event->created_at)) }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @empty
                            <li>
                                <div class="sidebar-rc-post-main-area d-flex mb-20">
                                    <div class="rc-post-thumb">
                                        <a href="course_details.html">
                                            <img src="img/courses/rcourses_thumb02.png" alt="">
                                        </a>
                                    </div>
                                    <div class="rc-post-content">
                                        <h4>
                                            <a href="course_details.html">title</a>
                                        </h4>
                                        <div class="widget-advisors-name">
                                            <span>Date : <span class="f-500">Y-m-d</span></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
