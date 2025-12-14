@extends('layouts.frontend.app')

@section('title', 'All Posts')

@section('content')

<div class="course-details-area gray-bg pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="section-title">
                        <div class="section-title-heading mb-20">
                            <h1 class="primary-color">Lists</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <ul class="list-group">
                        @forelse($posts as $key=>$post)
                        <li class="list-group-item mb-2">
                            <div class="post-content-wrapper">
                                <div class="post-serial-number">
                                    <span class="float-right published-date"> <i class="fa fa-calendar"></i> {{ date('M j, Y', strtotime($post->date)) }}</span>
                                </div>
                                <div class="post-content">
                                    <a href="{{route('post-details',$post->slug)}}"> {{ $post->title }} </a>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">NO DATA ! </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <h4>Important Links</h4>
                <ul class="quick-link">
                    @forelse($links as $key=>$link)
                    <li class="quick-link-item">
                        <a href="{{$link->link}}" target="_blank"><i class="fa fa-caret-right"></i> {{ $link->title }} </a>
                    </li>
                    @empty
                    <li class="list-group-item">NO DATA ! </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end news-details-->
@endsection