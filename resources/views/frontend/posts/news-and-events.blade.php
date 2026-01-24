@extends('layouts.frontend.app')

@section('title', 'News & Events')

@section('content')

    <div class="course-details-area gray-bg pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="primary-color">News & Events</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="events-list">
                    <div class="row">
                        @forelse($posts as $key=>$post)
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="event-wrapper">
                                    <div class="blog-thumb">
                                        <a
                                            href="{{ route('news-and-events.details', $post->slug . '?nid=' . base64_encode($post->id)) }}">
                                            <img src="{{ asset('uploads/posts/' . $post->image) }}" alt=""
                                                height="260" width="370">
                                        </a>
                                    </div>
                                    <div class="event-content">
                                        <h5>
                                            <a href="{{ route('news-and-events.details', $post->slug) }}">{{ $post->title }}
                                            </a>
                                        </h5>
                                        <div>
                                            {!! substr($post->description, 0, 100) !!}...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-xl-12 col-lg-12 text-center">
                                <p>NO DATA</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
