<header id="home">
    <div class="header-area">
        <div class="header-top primary-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="header-contact-info d-flex">
                            <div class="header-contact header-contact-phone">
                                <span class="ti-mobile"></span>
                                <p class="phone-number">{{ $settings['setting']->phone }}</p>
                            </div>
                            <div class="header-contact header-contact-email">
                                <span class="ti-email"></span>
                                <p class="email-name">{{ $settings['setting']->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="header-social-icon-list">
                            <ul>
                                @forelse($settings['header_links'] as $hlink)
                                    @if (strtolower($hlink->title) == 'facebook')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-facebook"></span></a></li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'twitter')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-twitter-alt"></span></a></li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'dribble')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-dribbble"></span></a></li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'google')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-google"></span></a></li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'pinterest')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-pinterest"></span></a></li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'linkedin')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-linkedin"></span></a></li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'instagram')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-instagram"></span></a></li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'tiktok')
                                        <li><a href="{{ $hlink->link }}"><span class="fa ti-dribbbleble"></span></a>
                                        </li>
                                    @endif
                                    @if (strtolower($hlink->title) == 'youtube')
                                        <li><a href="{{ $hlink->link }}"><span class="ti-youtube"></span></a></li>
                                    @endif
                                @empty
                                    <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                @endforelse
                                <li>
                                    <a href="{{ route('login') }}"> <i class="fa fa-user-circle"></i> Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.frontend.menu')
    </div>
</header>
