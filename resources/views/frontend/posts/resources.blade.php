@extends('layouts.frontend.app')

@section('title', $category->title)

@section('content')

    <div class="gray-bg pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="primary-color">{{ $category->title }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($posts as $key=>$post)
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="resource-wrapper">
                            <div class="resource-thumb">
                                <a href="{{ route('post-details', $post->slug) }}">
                                    <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="" height="260"
                                        width="370">
                                </a>
                            </div>
                            <div class="resource-content">
                                <h5>
                                    <a href="{{ route('post-details', $post->slug) }}">{{ $post->title }}
                                    </a>
                                </h5>
                                <span class="float-end">{{ date('M j, Y', strtotime($post->date)) }} </span>
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
@endsection
