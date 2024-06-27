@extends('layouts.frontend.app')

@section('title', 'Video Gallery')

@section('content')

<div class="course-details-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Video Gallery</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($videos as  $video)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <!-- <div class="col-xl-12">
                    <div class="video-wrapper text-center">
                        <div class="video-content"> -->
                            <a class="popup-video btn-text btn-block" href="{{ $video->link ? $video->link : '#' }}">
                                <img src="frontend/img/video/play_icon.png" alt="">
                            </a>
                            <p> <strong> {{ $video->title }} </strong></p>
                            <p> <strong> Published On - {{ $video->date }} </strong></p>
                       <!--  </div>
                    </div>
                </div> -->
            </div>
            @empty
            <div class="video-item">
                <p>NO DATA</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection