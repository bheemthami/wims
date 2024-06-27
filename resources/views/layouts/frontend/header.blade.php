
<!-- header-start -->
<header id="home">
    <div class="header-area">
        <!-- header-top -->
        <div class="header-top primary-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="header-contact-info d-flex">
                            <div class="header-contact header-contact-phone">
                                <span class="ti-headphone"></span>
                                <p class="phone-number">{{$settings['setting']->phone}}</p>
                            </div>
                            <div class="header-contact header-contact-email">
                                <span class="ti-email"></span>
                                <p class="email-name">{{$settings['setting']->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="header-social-icon-list">
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
                                <li>
                                    <a href="{{ route('login')}}"> <i class="fa fa-user-circle"></i> Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end header-top -->
        <!-- header-bottom -->
        <div class="header-bottom-area header-sticky" style="transition: .6s;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-1 col-lg-1 col-md-6 col-6">
                        <div class="logo">
                            <a href="{{ route('index')}}">
                                <img src="{{ asset('uploads/setting/'.$settings['setting']->local_logo)}}" alt="LOGO"
                                width="250px">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-11 col-lg-11 col-md-6 col-6">
                        <div class="main-menu f-right">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li>
                                        <a href="{{ route('index')}}"> <i class="fa fa-home"></i> Home <i class="fa fa-angle-down"></i> </a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="{{ route('about-us')}}">About Us</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('frontend.page',['slug'=>'message-from-chairman'])}}">Message from Chairman</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('frontend.page',['slug'=>'message-from-principal'])}}">Message from Principal</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('programs') }}">Programs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('trainings') }}">Trainings</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faculties')}}">Faculties</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('facilities')}}">Facilities</a>
                                    </li>
                                    <li>
                                        <a href="#">Gallery <i class="fa fa-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="{{ route('photo-gallery')}}">Photo Gallary</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('video-gallery')}}">Video Gallery</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="{{route('publications')}}">Publications</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact-us')}}">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end header-bottom -->
    </div>
</header>
    <!-- header-end -->