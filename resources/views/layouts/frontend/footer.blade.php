<!-- footer start -->
<footer id="Contact">
    <div class="footer-area primary-bg pt-70">
        <div class="container">
            <div class="footer-top pb-35">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget mb-30">
                            <div class="footer-logo">
                                <img src="{{ asset('uploads/setting/'.$settings['setting']->logo) }}" alt="LOGO" height="100px">
                            </div>
                            <div class="footer-para">
                                <p>{{ $settings['about_us'] ? substr($settings['about_us']->summary,0,100) : 'About Company' }} </p>
                            </div>
                            <div class="footer-socila-icon">
                                <span>Follow Us</span>
                                <div class="footer-social-icon-list">
                                    <ul>
                                        @forelse($settings['header_links'] as $hlink)
                                        @if(strtolower($hlink->title) == 'facebook')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-facebook"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'twitter')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-twitter-alt"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'dribble')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-dribbble"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'google')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-google"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'pinterest')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-pinterest"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'linkedin')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-linkedin"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'instagram')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-instagram"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'tiktok')
                                        <li><a href="{{ $hlink->link }}"><span class="fa ti-dribbbleble"></span></a></li>
                                        @endif
                                        @if(strtolower($hlink->title) == 'youtube')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-youtube"></span></a></li>
                                        @endif
                                        @empty
                                        <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget mb-30">
                            <div class="footer-heading">
                                <h1>Quick Links</h1>
                            </div>
                            <div class="footer-menu clearfix">
                                <ul>
                                    @forelse($settings['links'] as $link)
                                    <li><a href="{{ $link->link }}" target="_blank"> <i class="fa fa-caret-right"></i> {{ $link->title }}</a></li>
                                    @empty
                                   <li>NO DATA</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 d-lg-none d-xl-block col-md-6">
                        <div class="footer-widget mb-30">
                            <div class="footer-heading">
                                <h1>Recent Post</h1>
                            </div>
                            @forelse($settings['recents'] as $recent)
                            <div class="recent-post d-flex mb-25">
                                <div class="recent-post-thumb">
                                    <img src="{{ asset('uploads/posts/'.$recent->image) }}" alt="" width="50px">
                                </div>
                                <div class="recent-post-text">
                                    <p>{{ $recent->title }}</p>
                                    <div class="footer-time">
                                        <span class="ti-time"></span>
                                        <span class="footer-published-time">{{ date('F j, Y', strtotime($recent->date)) }}</span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="recent-post d-flex mb-25">
                                <p>NO DATA</p>
                            </div>
                           
                            @endforelse
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4  col-md-6">
                        <div class="footer-widget mb-30">
                            <div class="footer-heading">
                                <h1>Contact Us</h1>
                            </div>
                            <div class="footer-contact-list">
                                <div class="single-footer-contact-info">
                                    <span class="ti-headphone "></span>
                                    <span class="footer-contact-list-text">{{ $settings['setting']->phone}}</span>
                                </div>
                                <div class="single-footer-contact-info">
                                    <span class="ti-email "></span>
                                    <span class="footer-contact-list-text">{{$settings['setting']->email}}</span>
                                </div>
                                <div class="single-footer-contact-info">
                                    <span class="ti-location-pin"></span>
                                    <span class="footer-contact-list-text">{{ $settings['setting']->office_address}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="right-reserved">© Copyright <strong>{{$settings['setting']->office}}</strong> All Rights Reserved</div>
                    <div class="col-md-6" id="dd-by">Designed & Developed By : BKT </div>
                </div>
            </div>
        </div>
    </div>
</footer>
    <!-- footer end -->