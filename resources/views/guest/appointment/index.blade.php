@extends('guest.layouts.main')
<style>
     header .header-nav ul li a.appointment-active::after{
        opacity: 100%;
    }
</style>
@section('content')
    <section class="hero-banner other-pages-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text">
                        <h1><span>Book </span> An <br> Appointment </h1>
                        <a href="#" class="t-btn">My Appointments / Packages</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-img">
            <img src="{{ asset('assets/images/Appointment ( P 1 ).png') }}" alt="">
        </div>
    </section>


    <section class="appointment-sec-01">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-steps-form">
                        <ul>
                            <li><a href="{{ route('appointment') }}" class="active-services">
                                    <div class="svg-box">
                                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M41.6667 6.25H8.33341C7.22835 6.25 6.16854 6.68899 5.38714 7.47039C4.60573 8.25179 4.16675 9.3116 4.16675 10.4167V18.75C4.16675 19.8551 4.60573 20.9149 5.38714 21.6963C6.16854 22.4777 7.22835 22.9167 8.33341 22.9167H41.6667C42.7718 22.9167 43.8316 22.4777 44.613 21.6963C45.3944 20.9149 45.8334 19.8551 45.8334 18.75V10.4167C45.8334 9.3116 45.3944 8.25179 44.613 7.47039C43.8316 6.68899 42.7718 6.25 41.6667 6.25ZM8.33341 18.75V10.4167H41.6667V18.75H8.33341ZM41.6667 27.0833H8.33341C7.22835 27.0833 6.16854 27.5223 5.38714 28.3037C4.60573 29.0851 4.16675 30.1449 4.16675 31.25V39.5833C4.16675 40.6884 4.60573 41.7482 5.38714 42.5296C6.16854 43.311 7.22835 43.75 8.33341 43.75H41.6667C42.7718 43.75 43.8316 43.311 44.613 42.5296C45.3944 41.7482 45.8334 40.6884 45.8334 39.5833V31.25C45.8334 30.1449 45.3944 29.0851 44.613 28.3037C43.8316 27.5223 42.7718 27.0833 41.6667 27.0833ZM8.33341 39.5833V31.25H41.6667V39.5833H8.33341Z"
                                                fill="#3A3A3A" />
                                            <path
                                                d="M35.4167 12.5H39.5834V16.6667H35.4167V12.5ZM29.1667 12.5H33.3334V16.6667H29.1667V12.5ZM35.4167 33.3333H39.5834V37.5H35.4167V33.3333ZM29.1667 33.3333H33.3334V37.5H29.1667V33.3333Z"
                                                fill="#3A3A3A" />
                                        </svg>
                                    </div>
                                    <p>Service</p>
                                </a>
                            </li>
                            <li><a href="appointment/p1">
                                    <div class="svg-box">
                                        <svg width="51" height="50" viewBox="0 0 51 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M35.0916 23.0166C36.3605 20.8543 36.9084 18.3444 36.6562 15.85C36.2833 12.1333 34.2083 8.84789 30.8166 6.59998L28.5145 10.0708C30.8458 11.6166 32.2645 13.8187 32.5104 16.2666C32.6237 17.4043 32.4821 18.553 32.0958 19.6291C31.7094 20.7052 31.0881 21.6817 30.277 22.4875L27.7937 24.9708L31.1645 25.9604C39.9812 28.5437 40.0833 37.4104 40.0833 37.5H44.25C44.25 33.7729 42.2583 26.4896 35.0916 23.0166Z"
                                                fill="#7A7A7A" />
                                            <path
                                                d="M20.2917 25C24.8876 25 28.6251 21.2625 28.6251 16.6667C28.6251 12.0709 24.8876 8.33337 20.2917 8.33337C15.6959 8.33337 11.9584 12.0709 11.9584 16.6667C11.9584 21.2625 15.6959 25 20.2917 25ZM20.2917 12.5C22.5897 12.5 24.4584 14.3688 24.4584 16.6667C24.4584 18.9646 22.5897 20.8334 20.2917 20.8334C17.9938 20.8334 16.1251 18.9646 16.1251 16.6667C16.1251 14.3688 17.9938 12.5 20.2917 12.5ZM23.4167 27.0834H17.1667C10.273 27.0834 4.66675 32.6896 4.66675 39.5834V41.6667H8.83341V39.5834C8.83341 34.9875 12.5709 31.25 17.1667 31.25H23.4167C28.0126 31.25 31.7501 34.9875 31.7501 39.5834V41.6667H35.9167V39.5834C35.9167 32.6896 30.3105 27.0834 23.4167 27.0834Z"
                                                fill="#7A7A7A" />
                                        </svg>
                                    </div>
                                    <p>Staff</p>
                                </a>
                            </li>
                            <li><a href="appointment/p2">
                                    <div class="svg-box">
                                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.5833 22.9166H18.7499V27.0833H14.5833V22.9166ZM14.5833 31.25H18.7499V35.4166H14.5833V31.25ZM22.9166 22.9166H27.0833V27.0833H22.9166V22.9166ZM22.9166 31.25H27.0833V35.4166H22.9166V31.25ZM31.2499 22.9166H35.4166V27.0833H31.2499V22.9166ZM31.2499 31.25H35.4166V35.4166H31.2499V31.25Z"
                                                fill="#7A7A7A" />
                                            <path
                                                d="M10.4167 45.8333H39.5833C41.8812 45.8333 43.75 43.9645 43.75 41.6666V12.5C43.75 10.202 41.8812 8.33329 39.5833 8.33329H35.4167V4.16663H31.25V8.33329H18.75V4.16663H14.5833V8.33329H10.4167C8.11875 8.33329 6.25 10.202 6.25 12.5V41.6666C6.25 43.9645 8.11875 45.8333 10.4167 45.8333ZM39.5833 16.6666L39.5854 41.6666H10.4167V16.6666H39.5833Z"
                                                fill="#7A7A7A" />
                                        </svg>
                                    </div>
                                    <p>Date & Time</p>
                                </a>
                            </li>
                            <li><a href="appointment/p3">
                                    <div class="svg-box">
                                        <svg width="51" height="50" viewBox="0 0 51 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M41.9645 17.8875C41.8657 17.6613 41.7275 17.4546 41.5562 17.277L29.0562 4.77704C28.8786 4.60576 28.6719 4.46748 28.4458 4.36871C28.3833 4.33954 28.3166 4.32288 28.2499 4.29996C28.0756 4.24064 27.8941 4.20491 27.7103 4.19371C27.6666 4.18954 27.627 4.16663 27.5833 4.16663H12.9999C10.702 4.16663 8.83325 6.03538 8.83325 8.33329V41.6666C8.83325 43.9645 10.702 45.8333 12.9999 45.8333H37.9999C40.2978 45.8333 42.1666 43.9645 42.1666 41.6666V18.75C42.1666 18.7062 42.1437 18.6666 42.1395 18.6208C42.1293 18.4369 42.0936 18.2553 42.0333 18.0812C42.0124 18.0145 41.9937 17.95 41.9645 17.8875ZM35.0541 16.6666H29.6666V11.2791L35.0541 16.6666ZM12.9999 41.6666V8.33329H25.4999V18.75C25.4999 19.3025 25.7194 19.8324 26.1101 20.2231C26.5008 20.6138 27.0307 20.8333 27.5833 20.8333H37.9999L38.0041 41.6666H12.9999Z"
                                                fill="#7A7A7A" />
                                            <path
                                                d="M17.1667 25H33.8334V29.1666H17.1667V25ZM17.1667 33.3333H33.8334V37.5H17.1667V33.3333ZM17.1667 16.6666H21.3334V20.8333H17.1667V16.6666Z"
                                                fill="#7A7A7A" />
                                        </svg>
                                    </div>
                                    <p>Basic Details</p>
                                </a>
                            </li>
                            <li><a href="appointment/p4">
                                    <div class="svg-box">
                                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.9873 28.6291L14.8686 36.1708L30.7352 18.0374L27.5977 15.2958L14.2977 30.4958L7.5123 25.3166L4.9873 28.6291ZM45.3186 18.0374L42.1811 15.2958L28.9123 30.4604L27.3436 29.2062L24.7394 32.4604L29.4206 36.2062L45.3186 18.0374Z"
                                                fill="#7A7A7A" />
                                        </svg>
                                    </div>
                                    <p>Schedule</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="text">
                        <h3>Category</h3>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">All </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Category Name - 01</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Category Name - 02</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Category Name - 03</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="main-check-box-click">
                                <div class="input-radio-box">
                                    <input type="radio" id="html" name="fav_language" value="HTML" checked>
                                    <label for="html">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="main-check-box-click">
                                <div class="input-radio-box">
                                    <input type="radio" id="html" name="fav_language" value="HTML" checked>
                                    <label for="html">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="main-check-box-click">
                                <div class="input-radio-box">
                                    <input type="radio" id="html" name="fav_language" value="HTML" checked>
                                    <label for="html">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            <div class="main-check-box-click">
                                <div class="input-radio-box">
                                    <input type="radio" id="html" name="fav_language" value="HTML" checked>
                                    <label for="html">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="input-radio-box">
                                    <input type="radio" id="html-01" name="fav_language" value="HTML-01">
                                    <label for="html-01">
                                        <div class="main-label-content">
                                            <div class="img-box">
                                                <img src="assets/images/input-radio-img.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <h4>Golf Coaching Session</h4>
                                                <p>Duration <b>: 2 Hours</b> </p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="two-btns-align">
                        <a href="#" class="t-btn"> Save & Continue</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
