@extends('layouts.frontend.app')

@section('title', $post ? $post->title : 'Post Title')

@section('content')

<div class="course-details-area gray-bg">
    <div class="container gray-bg pt-50 pb-50">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="blog-content news-content white-bg mb-20">
                    <h5 class="text-primary mb-20">{{ $post->title }}</h5>
                    <div>{!! $post->description !!}</div>
                    <div class="blog-meta news-meta post-wrapper">
                        <span>{{ date("M j, Y",strtotime($post->date)) }} </span>
                        <a class="text-link" href="{{url('/download-posts',($post->image ? $post->image : $post->attachment))}}">Download <i class="fa fa-download"></i></a>
                    </div>
                    @if($post->summary)
                    <blockquote class="blockquote">
                        <p class="mb-0">{{ $post ? $post->summary : 'summary'}}</p>
                    </blockquote>
                    @endif
                </div>
                @if($post && $post->image)
                <div class="blog-thumb">
                    <img src="{{ asset('uploads/posts/'.$post->image)}}" alt="{{ $post->title }}">
                    <span class="blog-text-offer">{{ $post->postCategory->title }}</span>
                </div>
                @endif
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="widget mb-40 widget-padding white-bg">
                    <h4 class="widget-title">Recent Posts</h4>
                    <div class="sidebar-rc-post">
                        <ul>
                            @forelse($posts as $not)
                            @if($not->id != $post->id)
                            <li>
                                <div class="sidebar-rc-post-main-area d-flex mb-20">
                                    <div class="rc-post-content">
                                        <h5>
                                            <a href="{{ route('post-details',$not->slug.'?nid='.base64_encode($not->id))}}">{{ $not->title }}</a>
                                        </h5>
                                        <div class="widget-advisors-name">
                                            <span>Date : <span class="f-500">{{ date("M j, Y",strtotime($post->date)) }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @empty
                            <li>
                                No Data Available
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection