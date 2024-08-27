@extends('guest.layouts.main')
<style>
     header .header-nav ul li a.contact-active::after{
        opacity: 100%;
    }
</style>
@section('content')
<section class="contact-us-sec-01">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text text-center">
                    <h2>Get In  <span>Touch</span> </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="text-box">
                    <img src="assets/images/timer.png" alt="">
                    <ul>
                        <li>Monday : 09 : 00 AM - 08 : 00 PM </li>
                        <li>Tuesday : 09 : 00 AM - 08 : 00 PM  </li>
                        <li>Wednesday : CLOSED</li>
                        <li>Thursday : 09 : 00 AM - 08 : 00 PM  </li>
                        <li>Friday : 09 : 00 AM - 08 : 00 PM  </li>
                        <li>Saturday : 09 : 00 AM - 08 : 00 PM  </li>
                        <li>Sunday : 09 : 00 AM - 08 : 00 PM  </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="text-box">
                    <img src="assets/images/map.png" alt="">
                    <ul>
                        <li><a href="#">3728 E Welton Lane, Gilbert,<br> Arizona 85295 </a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="text-box">
                    <img src="assets/images/phone-img.png" alt="">
                    <ul>
                        <li>Telephone : <a href="tel:+1 4802384724">+1(480) 238-4724</a></li>
                        <li>Email Address :<br> <a href="mailto:navydavegolf@gmail.com">navydavegolf@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="contact-us-sec-02">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="text">
                    <h3>Contact Us</h3>
                    <h2>Have  <span>Questions?</span> <br> Get in Touch!</h2>
                    <form action="">
                        <input type="text" placeholder="Full Name *">
                        <input type="email" placeholder="Email Address *">
                        <input type="text" placeholder="Subject *">
                        <textarea placeholder="Message *"></textarea>
                        <button>Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="iframe-map-box">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1685.782160306272!2d-0.4842474926859999!3d53.30644344780103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48785ea1c9fe7731%3A0xf84ab5086f7db55c!2sWelton%2C%20Lincoln%2C%20UK!5e0!3m2!1sen!2s!4v1724452231619!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection