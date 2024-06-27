@extends('layouts.frontend.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="course-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title mb-50 text-center">
                    <div class="section-title-heading mb-20">
                        <h1 class="primary-color">Photo Gallery</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($photos as $photo)
            <div class="col-md-4">
                <div class="courses-wrapper courses-wrapper-3 mb-30">
                    <div class="courses-thumb photo-animate">
                        <a href="{{ route('photo-gallery-details',$photo->slug)}}">
                            <img src="{{ asset('uploads/galleries/'.$photo->images[0]->image)}}" alt="{{$photo->title}}" width ="370px" height ="230px">
                        </a>
                    </div>
                    <div class="photo-gallery-title">
                        <a href="{{ route('photo-gallery-details',$photo->slug)}}"> {{ $photo->title }} <span class="badge badge-warning">{{ count($photo->images)}} Photos</span> </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                NO DATA
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection