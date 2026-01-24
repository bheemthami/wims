@extends('layouts.frontend.app')

@section('title', $photo->title ? $photo->title : '-')

@section('content')

    <div class="course-details-area pt-50">
        <div class="container mb-70">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="primary-color">{{ $photo->title }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($photo->images as $key => $image)
                    <div class="col-md-3">
                        <div class="photo-galleries">
                            <div class="photo-galleries-item gallery">
                                <a href="{{ asset('uploads/galleries/' . $image->image) }}">
                                    <div class="photo-animate border-1">
                                        <img src="{{ asset('uploads/galleries/' . $image->image) }}"
                                            alt="{{ $image->title }}">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <p>NO</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/pluggins/simplelightbox/dist/simple-lightbox.css') }}?v2.14.0">
@endsection

@section('js')
    <script src="{{ asset('frontend/pluggins/simplelightbox/dist/simple-lightbox.js') }}?v2.14.0"></script>

    <script>
        (function() {
            var $gallery = new SimpleLightbox('.gallery a', {});
        })();
    </script>
@endsection
