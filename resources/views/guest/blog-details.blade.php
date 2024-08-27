@extends('guest.layouts.main')
<style>
    header .header-nav ul li a.about-active::after {
        opacity: 100%;

    }
</style>
@section('content')
    <section class="blog-sec-01 blog-sec-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text text-center">
                        <h2>Title Here </h2>
                    </div>
                    <div class="main-blog-details-img">
                        <img src="{{ asset('./assets/images/blog-detail-main-img.png') }}" alt="">
                    </div>
                    <div class="main-blog-detail-box">
                        <div class="text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley of type and scrambled it to make a type specimen book. It has survived not only five
                                centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                passages, and more recently with desktop publishing software like Aldus PageMaker including
                                versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                    <div class="two-boxes-align">
                        <div class="box">
                            <div class="text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="main-img-blog-single">
                                <img src="{{ asset('./assets/images/blog-detail-main-img.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                            and more recently with desktop publishing software like Aldus PageMaker including versions of
                            Lorem Ipsum.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us-sec-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="text">
                        <h3>Contact Us</h3>
                        <h2>Have <span>Questions?</span> <br> Get in Touch!</h2>
                        <form action="">
                            <input type="text" placeholder="Full Name *">
                            <input type="email" placeholder="Email Address *">
                            <input type="text" placeholder="Subject *">
                            <textarea placeholder="Message *"></textarea>
                            <button>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="blog-sec-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="main-blog-box">
                        <a href="{{ route('blog-details') }}">
                            <img src="{{ asset('./assets/images/main-blg-img.png') }}" alt="">
                            <div class="content">
                                <h4>Title</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s....</p>
                                <h6>Category</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="main-blog-box">
                        <a href="{{ route('blog-details') }}">
                            <img src="{{ asset('./assets/images/main-blg-img.png') }}" alt="">
                            <div class="content">
                                <h4>Title</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s....</p>
                                <h6>Category</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="main-blog-box">
                        <a href="{{ route('blog-details') }}">
                            <img src="{{ asset('./assets/images/main-blg-img.png') }}" alt="">
                            <div class="content">
                                <h4>Title</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s....</p>
                                <h6>Category</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="main-blog-box">
                        <a href="{{ route('blog-details') }}">
                            <img src="{{ asset('./assets/images/main-blg-img.png') }}" alt="">
                            <div class="content">
                                <h4>Title</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s....</p>
                                <h6>Category</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
