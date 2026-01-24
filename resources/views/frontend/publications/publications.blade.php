@extends('layouts.frontend.app')

@section('title', 'Publications')

@section('content')

    <div class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="primary-color">Our Publications</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-10 col-lg-10 offset-xl-1 offset-lg-1">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-pills post-tabs" id="pills-tab" role="tablist">
                            @forelse($categories as $key=>$category)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="pills-home-tab"
                                        data-toggle="pill" href="#pills-{{ $category['slug'] }}" role="tab"
                                        aria-controls="pills-home" aria-selected="true">{{ ucfirst($category['title']) }}
                                    </a>
                                </li>
                            @empty
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-tabs"
                                        role="tab" aria-controls="pills-home" aria-selected="true">tabs </a>
                                </li>
                            @endforelse
                        </ul>
                        <div class="tab-content" id="pills-tabContent">

                            @forelse($categories as $key=>$cat)
                                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                    id="pills-{{ $cat['slug'] }}" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <ul class="list-group">
                                        @forelse($cat['downloads'] as $download)
                                            <li class="list-group-item">
                                                <a href="{{ route('publications.details', $download->slug) }}">
                                                    {{ $download->title }}
                                                </a>
                                                <span class="text-secondary ms-2">
                                                    {{ date('M j, Y', strtotime($download->date)) }}
                                                </span>

                                                @if ($download->image || $download->attachment)
                                                    <span class="float-right">
                                                        <a class=" btn-sm btn-warning"
                                                            href="{{ url('/download', $download->image ? $download->image : $download->attachment) }}">Download
                                                            <i class="fa fa-download"></i></a>
                                                    </span>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="list-group-item">NO DATA</li>
                                        @endforelse
                                    </ul>
                                </div>
                            @empty
                                <div class="tab-pane fade show active" id="pills-tabs" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <p class="course-details-overview-para">tabs</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
