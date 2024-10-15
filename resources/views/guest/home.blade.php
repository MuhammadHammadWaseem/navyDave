@extends('guest.layouts.main')
<style>
    header .header-nav ul li a.home-active::after {
        opacity: 100%;

    }
</style>
@section('content')
    <section class="hero-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text">
                        <h1>Your <span>Swing</span>, Our<br> Mission </h1>
                        <p>Customized Golf Instruction To Improve Your Swing & Better Your Game</p>
                        <a href="{{ route('appointment') }}" class="t-btn">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-img">
            <img src="assets/images/hero-main-img.png" alt="">
        </div>
    </section>

    <section class="home-sec-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="text">
                        <h3>Unleash Naval Precision</h3>
                        <h2>Let’s Find Your <span>Swing</span></h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="text">
                        <p>NavyDaveGolf is here to help guide you to your best golf. On every professional tour, there are
                            100’s of different swings!</p>
                        <p>Navy Dave uses his unique approach to help you find the best version of you.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="swing-box">
                        <img src="assets/images/home-sec-01-img-01.png" alt="">
                        <h6>Mental Game<br> Mastery</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="swing-box">
                        <img src="assets/images/home-sec-01-img-02.png" alt="">
                        <h6>On-Course<br> Strategy Sessions</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="swing-box">
                        <img src="assets/images/home-sec-01-img-03.png" alt="">
                        <h6>Personalized<br> Swing Analysis</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="swing-box">
                        <img src="assets/images/home-sec-01-img-04.png" alt="">
                        <h6>Customized<br> Training Programs</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-sec-02">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="main-img">
                        <img src="assets/images/home-sec-02-img.png" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="text">
                        <h3>Navy Dave Golf</h3>
                        <h2>Meet <span> Navy Dave</span></h2>
                        <p>Navy Dave, with 30 years of golf experience, believes in cultivating your unique 'perfect swing'.
                            In his state-of-the-art studio, he offers personalized instruction emphasizing your individual
                            style and strengths to ensure you play your best golf.</p>
                        <div class="two-thing-aline">
                            <div class="btn-box">
                                <a href="{{ route('about') }}" class="t-btn">Learn More</a>
                            </div>
                            <div class="video-btn-box">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <img src="assets/images/video-icon.png" alt=""> Video Presentation
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="home-sec-03">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text text-center">
                        <h3>Precision In Every Stroke</h3>
                        <h2>Welcome To Navy <span>Dave's Swing</span> Academy</h2>
                        <img src="assets/images/home-sec-03-img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="home-sec-02 home-sec-04">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <div class="text">
                        <h3>Training Scheduled</h3>
                        <h2>Tailored <span> Approach</span></h2>
                        <p>Your goals, are OUR goals! Not everyone is trying to win the Masters. You may not even be worried
                            about winning your club title. If you’re here, you do want to play better! NavyDaveGolf is here
                            to help you to your specific goal!</p>
                        <div class="two-thing-aline">
                            <div class="btn-box">
                                <a href="{{ route('contact') }}" class="t-btn">Schedule Meeting</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="main-img">
                        <img src="assets/images/home-sec-04-img.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="home-sec-02 home-sec-04 home-sec-05">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="main-img">
                        <img src="assets/images/home-sec-05-img.png" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="text">
                        <h3>Navy Dave Golf</h3>
                        <h2>What Makes Me <span> Different</span></h2>
                        <p>There is no perfect swing. My experience in this game has taught me that. We don’t believe in a
                            singular approach. While in the Navy, I earned the qualification of Master Training Specialist.
                            It’s a fancy way to say I know 537 different ways to make a lightbulb turn on. Together, we will
                            work with your strengths to make your bulb the brightest!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-sec-06">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text text-center">
                        <h3>Navy Dave Golf</h3>
                        <h2>Students Said <span> About </span> Me</h2>
                    </div>
                </div>
            </div>
            <div class="row testi-slider">
                <div class="col-lg-4 col-md-6">
                    <div class="testi-img-box">
                        <div class="person-heading">
                            <img src="assets/images/person-01.png" alt="">
                            <h5>Hannah Schmitt</h5>
                            <h6>Lead designer</h6>
                            <img src="assets/images/testi-inverted-comas.png" alt="">
                        </div>
                        <div class="person-comment">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci
                                lectus maecenas. Suspendisse sed magna eget nibh in turpis. Consequat duis diam lacus arcu.
                                Faucibus venenatis felis id augue sit cursus pellentesque enim</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-img-box">
                        <div class="person-heading">
                            <img src="assets/images/person-02.png" alt="">
                            <h5>Hannah Schmitt</h5>
                            <h6>Lead designer</h6>
                            <img src="assets/images/testi-inverted-comas.png" alt="">
                        </div>
                        <div class="person-comment">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci
                                lectus maecenas. Suspendisse sed magna eget nibh in turpis. Consequat duis diam lacus arcu.
                                Faucibus venenatis felis id augue sit cursus pellentesque enim</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-img-box">
                        <div class="person-heading">
                            <img src="assets/images/person-03.png" alt="">
                            <h5>Hannah Schmitt</h5>
                            <h6>Lead designer</h6>
                            <img src="assets/images/testi-inverted-comas.png" alt="">
                        </div>
                        <div class="person-comment">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci
                                lectus maecenas. Suspendisse sed magna eget nibh in turpis. Consequat duis diam lacus arcu.
                                Faucibus venenatis felis id augue sit cursus pellentesque enim</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-img-box">
                        <div class="person-heading">
                            <img src="assets/images/person-03.png" alt="">
                            <h5>Hannah Schmitt</h5>
                            <h6>Lead designer</h6>
                            <img src="assets/images/testi-inverted-comas.png" alt="">
                        </div>
                        <div class="person-comment">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci
                                lectus maecenas. Suspendisse sed magna eget nibh in turpis. Consequat duis diam lacus arcu.
                                Faucibus venenatis felis id augue sit cursus pellentesque enim</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="home-sec-02 home-sec-07">
        <div class="container">
            <div class="row ">
                <div class="col-lg-5 col-md-12">
                    @foreach ($services->take(1) as $s)
                        <div class="pricing-box">
                            <div class="pricing-box-content">
                                <h4>{{ $s->name }}</h4>
                                <h5>${{ $s->price }}</h5>
                                <p>{{ \Illuminate\Support\Str::limit($s->description, 71) }}</p>
                            </div>
                            <div class="sessions-box">
                                <p><img src="{{ asset('assets/images/timer.png') }}" alt=""
                                        style="filter: invert(48%) sepia(48%) saturate(1225%) hue-rotate(83deg) brightness(92%) contrast(93%);">
                                    {{ $s->duration }} {{ $s->type_duration }}</p>
                                    <p>{{ $s->slots }} @if($s->slots > 1) Slots @else Slot @endif</p>
                                <a href="{{ route('appointment') }}" class="t-btn">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="text">
                        <h3>Exclusive Offers</h3>
                        <h2>Get Your <span> Package </span> Now </h2>
                        <p>All lesson packages include a “before and after” video, showing you your progress from where you
                            started to where you are now.</p>
                        <div class="two-thing-aline">
                            <div class="btn-box">
                                <a href="{{ route('pricing') }}" class="t-btn new">View All Packages <img
                                        src="assets/images/right-arrow.png" alt=""> </a>
                            </div>
                        </div>
                    </div>
                    @foreach ($services->take(2)->skip(1) as $s)
                        <div class="pricing-box hot">
                            <div class="pricing-box-content ">
                                <h4>{{ $s->name }}</h4>
                                <h5>${{ $s->price }}</h5>
                                {{-- <p>{{ $s->description }}</p> --}}
                                <p>{{ \Illuminate\Support\Str::limit($s->description, 71) }}</p>

                                <div class="hot-box">
                                    <img class="star" src="{{ asset('assets/images/hot-star.png') }}" alt="">
                                    <p>HOT</p>
                                </div>
                            </div>
                            <div class="sessions-box">
                                <p><img src="{{ asset('assets/images/timer.png') }}" alt=""
                                        style="filter: invert(48%) sepia(48%) saturate(1225%) hue-rotate(83deg) brightness(92%) contrast(93%);">
                                    {{ $s->duration }} {{ $s->type_duration }}</p>
                                    <p>{{ $s->slots }} @if($s->slots > 1) Slots @else Slot @endif</p>
                                <a href="{{ route('appointment') }}" class="t-btn">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endsection
