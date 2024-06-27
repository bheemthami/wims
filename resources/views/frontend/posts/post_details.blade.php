@extends('layouts.frontend.app')

@section('title', $post ? $post->title : '-')

@section('content')

<div class="course-details-area gray-bg pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="blog-wrapper blog-list blog-details blue-blog mb-50">
                    <div class="blog-thumb mb-35">

                        @if($post->image)
                        <img src="{{ asset('uploads/posts/'.$post->image)}}" alt="">
                        <span class="blog-text-offer">{{ $post->postCategory->title }}</span>
                        @endif
                    </div>
                    <div class="blog-content news-content">
                        <div class="blog-meta news-meta">
                            <span>{{ date("F jS, Y",strtotime($post->date)) }}</span>
                        </div>
                        <h5>{{ $post->title }}</h5>
                        <p>{!! $post->description !!}</p>

                        @if($post->summary)
                        <blockquote class="blockquote">
                            <p class="mb-0">{{ $post ? $post->summary : 'summary'}}</p>
                        </blockquote>
                        @endif

                        <div class="blog-wrapper-footer">
                            <div class="news-wrapper-tags">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="new-post-tag">
                                            <span>Tags:</span>
                                            <a href="#">Business,</a>
                                            <a href="#">Finance,</a>
                                            <a href="#">Banking,</a>
                                            <a href="#">SEO</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="new-post-tag news-share-icon text-left text-md-right">
                                            <span>Share</span>
                                            <a href="#">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a class="twitter" href="#">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a class="dribble" href="#">
                                                <i class="fab fa-dribbble"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <h4>
                                            <a href="{{ route('post-details',$not->slug.'?nid='.base64_encode($not->id))}}">{{ $not->title }}</a>
                                        </h4>
                                        <div class="widget-advisors-name">
                                            <span>Date : <span class="f-500">{{ date("F jS, Y",strtotime($post->date)) }}</span></span>
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
        <!-- end news-details-->
        <!-- subscribe start -->
        <div class="subscribe-area">
            <div class="container">
                <div class="subscribe-box">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12">
                            <div class="row justify-content-between">
                                <div class="col-xl-6 col-lg-7 col-md-8">
                                    <div class="subscribe-text">
                                        <h1>Subscribe</h1>
                                        <span>Enter your email and get latest updates and offers subscribe us</span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-4 justify-content-end">
                                    <div class="email-submit-form">
                                        <div class="subscribe-form">
                                            <form action="#">
                                                <input placeholder="Enter your email" type="email">
                                                <i class="fas fa-long-arrow-alt-right"></i>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- subscribe end -->
    </div>

    @endsection