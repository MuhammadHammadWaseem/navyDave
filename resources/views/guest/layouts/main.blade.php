<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAVY DAVE GOLF</title>
    <link rel="icon" href="{{ asset('/assets/images/favicon.png') }}" type="favicon.png" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('/assets/css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>

<body>
    <!-- javascript:void(0) -->

    <!-- <h1 class="wow fadeInRight" data-wow-duration="3s">hello</h1> -->

    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{ asset('/assets/images/header-logo.png') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header-nav">
                        <ul>
                            <li><a href="{{ route('home') }}" class="home-active">Home</a></li>
                            <li><a href="{{ route('about') }}" class="about-active">About</a></li>
                            <li><a href="{{ route('pricing') }}" class="pricing-active">Pricings</a></li>
                            <li><a href="{{ route('appointment') }}" class="appointment-active">Appointments</a></li>
                            <li><a href="{{ route('contact') }}" class="contact-active">Contact Us</a></li>
                            <li><a href="{{ route('login') }}">login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header-cart-search">
                        <ul>
                            <li><a href="#"><img src="{{ asset('/assets/images/shopping-cart.png') }}"
                                        alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('/assets/images/search-icon.png') }}"
                                        alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('/assets/images/person-user.png') }}"
                                        alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="main-footer-logo">
                        <a href="index.html"> <img src="{{ asset('/assets/images/header-logo.png') }}"
                                alt=""></a>
                    </div>
                    <div class="links-email-number">
                        <ul>
                            <li><a href="tel:+1 (480) 238-4724">+1 (480) 238-4724</a></li>
                            <li><a href="mailto:navydavegolf@gmail.com">navydavegolf@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="heading-footer">
                        <h6>Quick Links</h6>
                    </div>
                    <div class="footer-links">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="pricings.html">Pricings</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="Appointment(P1).html">Appointments</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                            <li><a href="blogs.html">Blogs</a></li>
                            <li><a href="faqs.html">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="heading-footer">
                        <h6>Subscribe</h6>
                    </div>
                    <div class="footer-email-submit">
                        <form action="">
                            <input type="email" placeholder="Get product updates" required>
                            <button><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row footer-btm-line">
                <div class="col-lg-4 col-md-4">
                    <div class="socail-icons">
                        <ul>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="copy-right">
                        <p>Copyright 2024</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="site-copy-right">
                        <p>All rights reserved by <a href="index.html">NAVY DAVE GOLF</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>





    <script src="{{ asset('/assets/js/wow-animate.js') }}"></script>
    <script src="{{ asset('/assets/js/lib.js') }}"></script>
    <script src="{{ asset('/assets/js/custom.js') }}"></script>
    <!-- Update jQuery to a newer version -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Slick Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script type="text/javascript">
        $(document).on('ready', function() {

            wow = new WOW({
                animateClass: 'animated',
                offset: 100,
                callback: function(box) {
                    console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                }
            });

            wow.init();


        });
        $(document).ready(function() {
            $('.testi-slider').slick({

                autoplay: true,
                

            });
        });
    </script>


</body>

</html>
