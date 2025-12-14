@extends('layouts.frontend.app')

@section('title', 'Video Gallery')

@section('content')

<div class="pt-50 pb-50">
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
            @forelse($videos as $video)
            <div class="col-md-6 col-sm-12">
                <div class="iframe-container">
                    <iframe width="560" height="315" src="{{$video->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            @empty
            <div class="video-item">
                <p>NO DATA</p>
            </div>
            @endforelse

        </div>
    </div>
    @endsection