@extends('layouts.frontend.app')

@section('title', $settings ? $settings->office : 'Welcome')

@section('content')
<!-- highlights-start -->
<div id="highlight-row">
  <div class="row highlight d-flex flex-nowrap align-items-center">
    <div class="col-md-2">
      <span>Highlights</span>
    </div>
    <div class="col-md-10">
      <div class="highlight-content d-flex align-items-center">
        <div class="marquee-container" onmouseover="stopMarquee()" onmouseout="startMarquee()">
          <div class="marquee d-flex justify-content-between align-items-center">
            @forelse($data['marquee_recents'] as $recent)
            <span> <a href="{{ route('post-details',$recent->slug) }}" target="_blank"> <i class="fa fa-caret-right"></i> {{$recent->title}} </a> </span>
            @empty
            <span> <i class="fa fa-caret-right"></i>&nbsp;No highlights...</span>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- highlights-end -->

<!-- slider-start -->
<div class="slider-area pos-relative pb-50">
  <div class="slider-active">
    @forelse($data['banners'] as $banner)
    <div class="single-slider slider-height d-flex align-items-end justify-content-center" style="background-image: url('{{ asset("uploads/banners/".$banner->image) }}');">
      <div class="container mb-4">
        <div class="row">
          <div class="col-xl-9 col-md-12">
            <div class="slider-content slider-content-2">
              <h2 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s"><span>{{ $banner->title }}</span></h2>
              <p data-animation="fadeInUp" data-delay=".4s">{{ $banner->tagline }}</p>
              <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span class="btn-text">Welcome</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="single-slider slider-height d-flex align-items-center justify-content-center" style="background-image: url('frontend/img/slider/slider_bg_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 col-md-12">
            <div class="slider-content slider-content-2">
              <h1 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s">Title 1</h1>
              <p data-animation="fadeInUp" data-delay=".4s">Tagline 1</p>
              <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span class="btn-text">Welcome</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="single-slider slider-height d-flex align-items-center justify-content-center" style="background-image: url(frontend/img/slider/2.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 col-md-12 offset-xl-2">
            <div class="slider-content slider-content-2 text-center">
              <h1 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s">Title 2</h1>
              <p data-animation="fadeInUp" data-delay=".4s">tagline 2</p>
              <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span class="btn-text">Welcome</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforelse
  </div>
</div>
<!-- slider-end -->

<!-- about start -->
<div id="about" class="about-area pb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-7 col-lg-7">
        <div class="about-title-section">
          <h1 class="section-header-color">{{$page['about_us'] ? $page['about_us']->title : 'About Us'}}</h1>
          {!! $page['about_us'] ? substr($page['about_us']->description,0,1000) : 'About Us - Description' !!}
          <a href="{{ route('frontend.page',['slug'=>'about-us']) }}" class="read-more-btn btn btn-primary btn-sm text-capitalize">Read more...</a>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5">
        <div class="about-right-img align-items-center">
          <img class="img-fluid img-diagonal-border-radius" src="{{ asset('uploads/pages/'.$page['about_us']->image)}}" alt="About Us" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- about end -->

<!-- posts and facebook page start -->
<div id="posts-and-facebook-page" class="about-area pb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="section-header-color">Our Notice Board </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-7 col-lg-7 mb-20">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-pills post-tabs" id="pills-tab" role="tablist">
            @forelse($categories as $key=>$category)
            <li class="nav-item">
              <a class="nav-link {{ ($key==0) ? 'active' :''}}" id="pills-home-tab" data-toggle="pill" href="#pills-{{$category['slug']}}" role="tab" aria-controls="pills-home" aria-selected="true">{{ucfirst($category['slug'])}} </a>
            </li>

            @empty
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-tabs" role="tab" aria-controls="pills-home" aria-selected="true">tabs </a>
            </li>
            @endforelse
          </ul>
          <div class="tab-content" id="pills-tabContent">

            @forelse($categories as $key=>$cat)
            <div class="tab-pane fade {{ ($key== 0) ? 'show active':''}}" id="pills-{{$cat['slug']}}" role="tabpanel" aria-labelledby="pills-home-tab">
              <ul class="list-group">
                @forelse($cat['posts'] as $post)
                <li class="list-group-item posts-item"><a href="{{route('post-details',$post->slug)}}"> {{ $post->title }} </a>
                  <span class="float-left published-text"><i class="fa fa-calendar me-2"></i>{{ date('M j, Y', strtotime($post->date)) }} </span>
                </li>
                @empty
                <li class="list-group-item">NO DATA</li>
                @endforelse
                <li class="list-group-item">
                  <div class="view-all">
                    <a href="{{ route('all-posts', ['slug'=>$cat['slug']]) }}">View All &rarr;</a>
                  </div>
                </li>
              </ul>
            </div>
            @empty
            <div class="tab-pane fade show active" id="pills-tabs" role="tabpanel" aria-labelledby="pills-home-tab">
              <p class="course-details-overview-para">tabs</p>
            </div>
            @endforelse
          </div>
        </div>
      </div>

      <div class="col-xl-5 col-lg-5">
        @if($embeddings['facebook'])
        <div class="facebook-page-block">
          {!! $embeddings['facebook']->iframe !!}
        </div>
        @else
        <div class="facebook-page-block text-center">
          <p>Not available</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
<!-- posts and facebook page start -->

<!-- program start -->
<div id="programs" class="about-area pb-50">
  @if(count($data['programs']) <= 1) <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="section-header-color">Our Programs</h1>
          </div>
        </div>
      </div>
    </div>

    @forelse($data['programs'] as $program)
    @if(($program->order % 2) != 0)
    <div class="row">
      <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
        <div class="d-flex justify-content-center">
          <img class="img img-responsive img-fluid img-diagonal-border-radius" src="{{ asset('uploads/programs/'.$data['programs'][0]->image)}}" alt="NO IMAGE" width="500px">
        </div>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
        <div class="about-title-section mb-30 mt-30">
          <h1 class="section-header-color">{{$data['programs'][0]->title}}</h1>
          <p>{!! substr($data['programs'][0]->description,0,420) !!}...</p>
          <a href="{{ route('program-details',$data['programs'][0]->slug)}}" class="read-more-btn btn btn-primary text-capitalize">Read more...</a>
        </div>
      </div>
    </div>

    @else
    <div class="row">
      <div class="col-xl-7 col-lg-7">
        <div class="about-title-section mb-30">
          <h1 class="section-header-color">{{$data['programs'][0]->title}}</h1>
          <p>{!! substr($data['programs'][0]->description,0,350) !!}...</p>
          <a href="{{ route('program-details',$data['programs'][0]->title)}}" class="theme-btn blue-bg-border mt-20"><span class="btn-text">more...</span></a>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5">
        <div class="about-right-img mb-30">
          <img src="{{ asset('uploads/programs/'.$data['programs'][0]->image)}}" alt="NO IMAGE" width="420">
        </div>
      </div>
    </div>
    @endif
    @empty
    <div class="row">
      <div class="col-md-12 text-center">
        <p>NO DATA</p>
      </div>
    </div>
    @endforelse
</div>
@else
<div id="programs" class="courses-area courses-bg-height pb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="primary-color">Our Programs</h1>
          </div>
          <div class="section-title-para">
            <p class="gray-color">We offer excellent skill based programs</p>
          </div>
        </div>
      </div>
    </div>
    <div class="courses-list">
      <div class="row">
        @forelse($data['programs'] as $program)
        <div class="col-xl-4 col-lg-4 col-md-6">
          <div class="courses-wrapper mb-30">
            <div class="courses-thumb">
              <a href="{{ route('program-details',$program->slug)}}"><img src="{{ asset('uploads/programs/'.$program->image)}}" alt=" NO IMAGE "></a>
            </div>
            <div class="courses-content courses-content-2 text-center">
              <div class="courses-heading text-center">
                <h1><a href="{{ route('program-details',$program->slug)}}">{{$program->title}}</a></h1>
              </div>
              <div class="courses-icon text-center">
                <div class="courses-single-icon courses-single-icon-2">
                  <span class="ti-user"></span>
                  <span class="seat">Quota</span>
                  <span class="user-number">{{$program->quota}}</span>
                </div>
                <div class="courses-single-icon courses-single-icon-2">
                  <i class="fa fa-clock"></i>
                  <span class="price">Duration</span>
                  <span class="user-number">{{$program->duration}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-xl-12 col-lg-12 col-md-12">
          <p>NO DATA</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endif
</div>
<!-- program end -->


<!-- events start -->
<div id="events" class="events-area events-bg-heigh mb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="section-header-color">Our Events</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="events-list">
      <div class="row">
        @forelse($data['events'] as $event)
        <div class="col-xl-4 col-lg-4 col-md-4">
          <div class="blog-wrapper event-wrapper mb-20">
            <div class="blog-thumb">
              <a href="{{ route('event-details',$event->slug.'?nid='.base64_encode($event->id))}}"><img src="{{ asset('uploads/events/'.$event->image)}}" alt="" height="260" width="370"></a>
              <span class="blog-category">Event</span>
            </div>
            <div class="blog-content">
              <div class="blog-meta">

                @if($event->start_date == $event->end_date)
                <span>{{ date("M j, Y",strtotime($event->start_date)) }} ({{$event->start_time}} - {{ $event->end_time}} )</span>
                @else

                <span>{{ date("M j, Y",strtotime($event->start_date)) }},({{$event->start_time}}) - {{ date("F jS, Y",strtotime($event->start_date)) }}, ( {{ $event->end_time}} )</span>
                @endif

              </div>
              <h5><a href="{{ route('event-details',$event->slug.'?nid='.base64_encode($event->id))}}">{{ $event->title}}</a></h5>
              <p>{!! substr($event->description,0,100) !!}</p>
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
    <div class="row">
      <div class="col-md-12 view-all mt-10">
        <a href="{{ route('all-events') }}">View All &rarr;</a>
      </div>
    </div>
  </div>
</div>
<!-- events end -->

<!-- facilities end -->
<div id="facilities" class="row pb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="section-header-color">Our Facilities </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      @forelse($data['facilities'] as $key=>$facility)
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="d-flex justify-content-center align-items-center">
          <div class="feature-wrapper mb-20 text-center d-flex flex-column justify-content-center">
            <div class="facility-images photo-animate">
              @if($facility->images)
              <img src="{{ asset('uploads/media/'.$facility->images[0]->image)}}" alt="NO IMAGE" class="img img-responsive">
              @else
              <img src="{{ asset('uploads/media/image-6828268854.jpg')}}" alt="NO IMAGE" class="img img-responsive">
              @endif
            </div>
            <div class="facility-hover-content">
              <h5 class="m-0">{{ $facility->title }}</h5>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-xl-12 col-lg-12 col-md-12 text-center">
        <p>NO DATA</p>
      </div>
      @endforelse
    </div>
  </div>
</div>
<!-- facilities end -->

<!-- testimonials start -->
@if(count($data['testimonials']) > 0)
<div class="testimonilas-area pt-70 pb-70">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="primary-color">What Our Students Say</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonilas-list">
      <div class="row testimonilas-active">
        @forelse($data['testimonials'] as $testimonial)
        <div class="col-xl-12">
          <div class="testimonilas-wrapper mb-110">
            <div class="testimonilas-heading d-flex">
              <div class="testimonilas-author-thumb">
                <img src="{{ asset('uploads/testimonials/'.$testimonial->image)}}" alt="" width="45px">
              </div>
              <div class="testimonilas-author-title">
                <h1>{{ $testimonial->statement_by}}</h1>
                <h2>{{ $testimonial->recognition}}</h2>
              </div>
            </div>
            <div class="testimonilas-para">
              <p>{{ $testimonial->statement}}</p>
            </div>
          </div>
        </div>
        @empty
        <div class="col-xl-12 text-center">
          <p>NO DATA</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endif
<!-- testimonials end -->

<!-- map start -->
<div class="pb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="section-header-color">Our Location on Google Map </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12  col-sm-12  col-xs-12">
        <div class="google-map">
          {!! $embeddings['google_map']->iframe !!}
        </div>
      </div>
    </div>
  </div>
</div>
<!-- map end -->

<!-- Modal start-->
@if($data['modal_img'])
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <img class="img img-responsive" src="{{ asset('uploads/posts/'.$data['modal_img']->image)}}" alt="About Us" loading="lazy">
      </div>
      <div class="modal-body">
        {{$data['modal_img']->title}}
      </div>
    </div>
  </div>
</div>
@endif
<!-- Modal end-->


@section('js')
<script>
  var marqueeAnimation;

  function startMarquee() {
    marqueeAnimation = document.querySelector('.marquee').style.animation;
    document.querySelector('.marquee').style.animationPlayState = 'running';
  }

  function stopMarquee() {
    document.querySelector('.marquee').style.animationPlayState = 'paused';
  }

  $(document).ready(() => {
    $('#exampleModal').modal({
      show: true
    });
  })
</script>
@endsection
@stop
