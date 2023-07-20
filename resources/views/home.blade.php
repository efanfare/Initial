@extends('layouts.app', ['title' => 'Home', 'bodyClass' => ''])
@section('content')
    <!-- HEADER SECTION BEGIN -->
    <header class="header" id="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="header-inner">
                        <nav class="navbar container">
                            <div class="burger" id="burger">
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                            </div>
                            <div class="menu" id="menu">
                                <ul class="menu-inner">
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Holidays</a></li>
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Occasions</a></li>
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Family Events</a>
                                    </li>
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Sports Teams</a>
                                    </li>
                                    <li>
                                        <div class="ftb-subscribe-btn hide-btn-desktop">

                                            @if (Auth::check())
                                                <a href="{{ route('user.dashboard') }}"
                                                    class="btn btn-primary">Dashboard</a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ URL::to('/') }}" class="brand"><img src="{{ asset('images/logo.png') }}"
                                    alt="image" class="img-fluid"></a>
                            <div class="ftb-subscribe-btn hide-btn-mobile">
                                @if (Auth::check())
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                @endif
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- HEADER SECTION END -->
    <!-- BANNER SECTION BEGIN -->
    <section class="banner-sec-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                    <div class="banner-sec-content">
                        <h1>Let's Make <span class="break-line">a scene</span> <span class="text-stroke">together</span>
                        </h1>
                        <div class="banner-cont-btn">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                    <div class="banner-sec-img">
                        <img src="{{ asset('images/bg-right-img.png') }}" alt="image" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="design-top-left">
                <img src="{{ asset('images/des1.png') }}" alt="image" class="img-fluid">
            </div>
            <div class="design-bottom-right">
                <img src="{{ asset('images/des1.png') }}" alt="image" class="img-fluid">
            </div>
            <div class="design-top-right">
                <img src="{{ asset('images/des2.png') }}" alt="image" class="img-fluid">
            </div>
            <div class="design-bottom-left">
                <img src="{{ asset('images/des4.png') }}" alt="image" class="img-fluid">
            </div>
        </div>
    </section>
    <!-- BANNER SECTION END -->
    <!-- ABOUTUS SECTION BEGIN -->
    <section class="aboutus-sec-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="aboutus-img-box">
                        <img src="{{ asset('images/aboutus-img.png') }}" alt="image" class="img-fluid">
                        <div class="aboutus-img-des">
                            <img src="{{ asset('images/aboutus-des.png') }}" alt="image" class="img-fluid">
                        </div>
                        <div class="aboutus-img-ellipsis">
                            <img src="{{ asset('images/aboutus-ellipsis.png') }}" alt="image" class="img-fluid">
                        </div>
                        <div class="clickable-box">
                            <ul>
                                <li><a href="javascript:void(0)"><img src="{{ asset('images/edit1.png') }}" alt="image"
                                            class="img-fluid"> </a></li>
                                <li><a href="javascript:void(0)"><img src="{{ asset('images/edit2.png') }}" alt="image"
                                            class="img-fluid"> </a></li>
                                <li><a href="javascript:void(0)"><img src="{{ asset('images/edit3.png') }}" alt="image"
                                            class="img-fluid"></a></li>
                                <li><a href="javascript:void(0)"><img src="{{ asset('images/edit4.png') }}"
                                            alt="image" class="img-fluid"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="aboutus-content">
                        <h6>About us</h6>
                        <h2>Efanfare Is The Place To Make A Scene You Decorate With Friends And Families And Leave Messages
                            For All To See!</h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout. </p>
                        <ul>
                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> no google ads on subscription
                            </li>
                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> Create custom background</li>
                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> Easy to use</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUTUS SECTION END -->
    <!-- HOW EFANFARE SECTION WORK BEGIN -->
    <section class="efanfare-sec-work">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                    <div class="enfanfare-work-content">
                        <h6>Work process</h6>
                        <h2>How efanfare work</h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout.</p>
                        <div class="efan-work-btn">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="work-box">
                                <div class="work-box-flex">
                                    <span><img src="{{ asset('images/work1.png') }}" alt="image"
                                            class="img-fluid"></span>
                                    <div class="work-box-text">
                                        <h3>Step 1</h3>
                                    </div>
                                </div>
                                <h4>Host a Scene</h4>
                                <p>Pick a background or upload your own</p>
                            </div>
                            <div class="work-box mobile-box-hide">
                                <div class="work-box-flex">
                                    <span><img src="{{ asset('images/work2.png') }}" alt="image"
                                            class="img-fluid"></span>
                                    <div class="work-box-text">
                                        <h3>Step 3</h3>
                                    </div>
                                </div>
                                <h4>Invite Guests</h4>
                                <p>Invite others to decorate and add messages</p>
                            </div>
                            <div class="work-box mobile-box-show">
                                <div class="work-box-flex">
                                    <span><img src="{{ asset('images/work3.png') }}" alt="image"
                                            class="img-fluid"></span>
                                    <div class="work-box-text">
                                        <h3>Step 2</h3>
                                    </div>
                                </div>
                                <h4>Pick Decorations</h4>
                                <p>Select items for guests to add to the scene</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="right-boxes">
                                <div class="work-box mobile-box-hide">
                                    <div class="work-box-flex">
                                        <span><img src="{{ asset('images/work3.png') }}" alt="image"
                                                class="img-fluid"></span>
                                        <div class="work-box-text">
                                            <h3>Step 2</h3>
                                        </div>
                                    </div>
                                    <h4>Pick Decorations</h4>
                                    <p>Select items for guests to add to the scene</p>
                                </div>
                                <div class="work-box mobile-box-show">
                                    <div class="work-box-flex">
                                        <span><img src="{{ asset('images/work2.png') }}" alt="image"
                                                class="img-fluid"></span>
                                        <div class="work-box-text">
                                            <h3>Step 3</h3>
                                        </div>
                                    </div>
                                    <h4>Invite Guests</h4>
                                    <p>Invite others to decorate and add messages</p>
                                </div>
                                <div class="work-box">
                                    <div class="work-box-flex">
                                        <span><img src="{{ asset('images/work4.png') }}" alt="image"
                                                class="img-fluid"></span>
                                        <div class="work-box-text">
                                            <h3>Step 4</h3>
                                        </div>
                                    </div>
                                    <h4>Decorate</h4>
                                    <p>Invite others to decorate and add messages</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HOW EFANFARE SECTION WORK END -->
    <!-- SCENE GALLERY SECTION BEGIN -->
    <section class="scene-gallery-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="scene-gall-hd">
                        <h2>Scene gallery</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="list-gallery">
                        <ul>
                            <li><span>11223k</span> Created Scenes</li>
                            <li><span>128k</span> Happy customers</li>
                        </ul>
                    </div>
                    <div class="img-borderline">
                        <img src="{{ asset('images/cr1.png') }}" alt="image" class="img-fluid">
                        <div class="img-box-border">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="img-shadow-design">
                        <div class="gallery-rightside img-borderline">
                            <img src="{{ asset('images/cr2.png') }}" alt="image" class="img-fluid">
                            <div class="img-box-border img-box-border-right">
                            </div>
                        </div>
                        <div class="right-path-des">
                            <img src="{{ asset('images/cr2-des.png') }}" alt="image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grayscale-row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="gallery-row-text">
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout.</p>
                        <div class="gallery-img-btn">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Get started</a>
                        </div>
                        <div class="gal-img-des">
                            <img src="{{ asset('images/sd-des.png') }}" alt="image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="gal-img img-borderline">
                        <img src="{{ asset('images/cr3.png') }}" alt="image" class="img-fluid">
                        <div class="img-box-border img-shape">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SCENE GALLERY SECTION END -->
    <!-- CHOOSE PLAN SECTION BEGIN -->
    <section class="choose-plan-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="choose-plan-hd">
                    <h6>Choose a plan</h6>
                    <h2>Select efanfare plans</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="plan-tab-boxes">
                        <div class="tabs one">
                            <div class="active_box"></div>
                            <div class="tab tab-one" data-attr="tab_one">Monthly</div>
                            <div class="tab tab-two" data-attr="tab_two">
                                Yearly
                                <div class="tab-box-design">
                                    <div class="save-amount-img">
                                        <img src="{{ asset('images/plan-arrow.png') }}" alt="image"
                                            class="img-fluid">
                                    </div>
                                    <div class="save-amount">
                                        <span>save 20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                            <div class="tabs_content one">
                                <div attr="tab_one" class="active">
                                    <div class="row">
                                        @foreach ($packages as $package)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="plan-price-box">
                                                    <div class="price-amount-flex">
                                                        <div class="price-amount-img">
                                                            <span><img src="images/plan-price-img.png" alt="image"
                                                                    class="img-fluid"></span>
                                                        </div>
                                                        <div class="plan-price-content">
                                                            @if ($package->id !== 1)
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span> ${{ $package->price_monthly }} <small>
                                                                        ${{ $package->price_monthly }}</small></span>
                                                            @else
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span>Free <small>$0.00</small></span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="plan-box-listing">
                                                        <ul>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                google ads</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                {{ $package->scene_limit_monthly }} limited scenes</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                Upload {{ $package->item_limit_monthly }} custom item</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                Free
                                                                hand use</li>
                                                        </ul>
                                                    </div>
                                                    <div class="get-started-btn">
                                                        @if ($package->id !== 1)
                                                            @if (auth()->user()->package_id === $package->id && auth()->user()->package_interval === 'monthly')
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @else
                                                                <a href="{{ route('plans.show', ['package' => $package->id, 'interval' => 'monthly']) }}"
                                                                    class="btn btn-primary">
                                                                    Get started
                                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if (auth()->user()->package_id === $package->id)
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div attr="tab_two">
                                    <div class="row">
                                        @foreach ($packages as $package)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="plan-price-box">
                                                    <div class="price-amount-flex">
                                                        <div class="price-amount-img">
                                                            <span><img src="images/plan-price-img.png" alt="image"
                                                                    class="img-fluid"></span>
                                                        </div>
                                                        <div class="plan-price-content">
                                                            @if ($package->id !== 1)
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span> ${{ $package->price_yearly }} <small>
                                                                        ${{ $package->price_yearly }}</small></span>
                                                            @else
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span>Free <small>$0.00</small></span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="plan-box-listing">
                                                        <ul>
                                                            @if ($package->id !== 1)
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                    google ads</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->scene_limit_yearly }} limited scenes</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Upload {{ $package->item_limit_yearly }} custom item
                                                                </li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Free
                                                                    hand use</li>
                                                            @else
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                    google ads</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->scene_limit_monthly }} limited scenes</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Upload {{ $package->item_limit_monthly }} custom item
                                                                </li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Free
                                                                    hand use</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="get-started-btn">
                                                        @if ($package->id !== 1)
                                                            @if (auth()->user()->package_id === $package->id && auth()->user()->package_interval === 'yearly')
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @else
                                                                <a href="{{ route('plans.show', ['package' => $package->id, 'interval' => 'yearly']) }}"
                                                                    class="btn btn-primary">
                                                                    Get started
                                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if (auth()->user()->package_id === $package->id)
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="tabs_content one">
                                <div attr="tab_one">
                                    <div class="row">
                                        @foreach ($packages as $package)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="plan-price-box">
                                                    <div class="price-amount-flex">
                                                        <div class="price-amount-img">
                                                            <span><img src="images/plan-price-img.png" alt="image"
                                                                    class="img-fluid"></span>
                                                        </div>
                                                        <div class="plan-price-content">
                                                            @if ($package->id !== 1)
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span> ${{ $package->price_monthly }} <small>
                                                                        ${{ $package->price_monthly }}</small></span>
                                                            @else
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span>Free <small>$0.00</small></span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="plan-box-listing">
                                                        <ul>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                google ads</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                {{ $package->scene_limit_monthly }} limited scenes</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                Upload {{ $package->item_limit_monthly }} custom item</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                Free
                                                                hand use</li>
                                                        </ul>
                                                    </div>
                                                    <div class="get-started-btn">

                                                        <a href="{{ route('plans.show', ['package' => $package->id, 'interval' => 'monthly']) }}"
                                                            class="btn btn-primary">
                                                            Get started
                                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div attr="tab_two">
                                    <div class="row">
                                        @foreach ($packages as $package)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="plan-price-box">
                                                    <div class="price-amount-flex">
                                                        <div class="price-amount-img">
                                                            <span><img src="images/plan-price-img.png" alt="image"
                                                                    class="img-fluid"></span>
                                                        </div>
                                                        <div class="plan-price-content">
                                                            @if ($package->id !== 1)
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span> ${{ $package->price_yearly }} <small>
                                                                        ${{ $package->price_yearly }}</small></span>
                                                            @else
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span>Free <small>$0.00</small></span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="plan-box-listing">
                                                        <ul>
                                                            @if ($package->id !== 1)
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                    google ads</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->scene_limit_yearly }} limited scenes</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Upload {{ $package->item_limit_yearly }} custom item
                                                                </li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Free
                                                                    hand use</li>
                                                            @else
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                    google ads</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->scene_limit_monthly }} limited scenes</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Upload {{ $package->item_limit_monthly }} custom item
                                                                </li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Free
                                                                    hand use</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="get-started-btn">
                                                        <a href="{{ route('plans.show', ['package' => $package->id, 'interval' => 'yearly']) }}"
                                                            class="btn btn-primary">
                                                            Get started
                                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
    </section>
    <!-- CHOOSE PLAN SECTION END -->
@endsection
@section('scripts')
    @parent
@endsection
