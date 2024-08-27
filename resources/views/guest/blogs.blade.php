@extends('guest.layouts.main')
<style>
    header .header-nav ul li a.blog-active::after {
        opacity: 100%;

    }
</style>
@section('content')
    <section class="blog-sec-01">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text text-center">
                        <h2>Blogs </h2>
                    </div>
                </div>
            </div>
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
