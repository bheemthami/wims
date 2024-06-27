@extends('layouts.frontend.app')

@section('title', 'Events')

@section('content')

<div class="course-details-area gray-bg pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-md-8 offset-md-2">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Our Latest Events</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($topEvents as $event)
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="blog-wrapper mb-30">
                    <div class="blog-thumb mb-25">
                        <a href="{{ route('event-details',$event->slug.'nid='.base64_encode($event->id))}}"><img src="{{ asset('uploads/events/'.$event->image)}}" alt="" height="260" width="370"></a>
                        <span class="blog-category">Event</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            @if($event->start_date == $event->end_date)
                            <span>{{ date("F j, Y",strtotime($event->start_date)) }} ({{ $event->start_time}} - {{$event->end_time}})</span>
                            @else
                            <span>{{ date("F j, Y",strtotime($event->start_date)) }} - {{ date("F j, Y",strtotime($event->end_date)) }}</span>
                            @endif

                        </div>
                        <h5><a href="news_details.html">{{ $event->title}}</a></h5>
                        <p>{!! substr($event->description,0,100) !!}</p>
                        <div class="read-more-btn">
                            <a href="{{ route('event-details',$event->slug.'?nid='.base64_encode($event->id))}}">
                                Read more...
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @empty

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="blog-wrapper mb-30">
                    <div class="blog-thumb mb-25">
                        <a href="#"><img src="frontend/img/blog/blog_thumb_1.jpg" alt=""></a>
                        <span class="blog-category">Event</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span>Auguest 25, 2018</span>
                        </div>
                        <h5><a href="#">Dummy data</a></h5>
                        <p>Belis nisl adipiscing sapien sed malesu diame lacus eget erat Cras mollis scele.</p>
                        <div class="read-more-btn">
                            <button>Read more</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse

            <div class="sidebar-rc-post">
                <ul>
                    @forelse($events as $not)

                    <li>
                        <div class="sidebar-rc-post-main-area d-flex mb-20">
                            <div class="rc-post-content">
                                <h4>
                                    <a href="{{ route('event-details',$not->slug.'?nid='.base64_encode($not->id))}}">{{ $not->title }}</a>
                                </h4>
                                <div class="widget-advisors-name">
                                    <span>Date : <span class="f-500">{{ date("F jS, Y",strtotime($not->date)) }}</span></span>
                                </div>
                            </div>
                        </div>
                    </li>
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
<!-- end events-details-->
@endsection