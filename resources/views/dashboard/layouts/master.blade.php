<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('./assets/images/favicon.png') }}" type="favicon.png" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('./assets/css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

</head>
<body>

    <header>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{ asset('./assets/images/header-logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header-two-things-align">
                        <div class="page-relation-box">
                            <div class="align-box">
                                <p>Pages</p>
                                <p>Dashboard</p>
                            </div>
                            <div class="page-name">
                                <h6>Dashboard</h6>
                            </div>
                        </div>
                        <div class="input-box-other-details">
                            <div class="search-box">
                                <form action="">
                                    <input type="search" placeholder="Type here...">
                                    <button><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <div class="logout-setting-bell-all">
                                <div class="logout-box">
                                    <a href="{{ route('admin.logout') }}"><i class="fa fa-user" aria-hidden="true"></i>Logout</a>
                                </div>
                                <div class="setting-box">
                                    <a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
                                </div>
                                <div class="bell-notification-box">
                                    <a href="#"><i class="fa fa-bell" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="main-box-navy">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-2">
                    <div class="left-all-links">
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}" class="dashboard-active"><span><img src="{{ asset('./assets/images/Dashboard.png') }}" alt=""></span>Dashboard</a></li>
                            <li><a href="calendar.html"><span><img src="{{ asset('./assets/images/Calendar.png') }}" alt=""></span>Calendar</a></li>
                            <li><a href="#"><span><img src="{{ asset('./assets/images/Payments.png') }}" alt=""></span>Payments</a></li>
                            <li><a href="#"><span><img src="{{ asset('./assets/images/Services.png') }}" alt=""></span>Services</a></li>
                            <li><a href="#"><span><img src="{{ asset('./assets/images/Customers.png') }}" alt=""></span>Customers</a></li>
                            <li><a href="#"><span><img src="{{ asset('./assets/images/Customers.png') }}" alt=""></span>Staff Members</a></li>
                            <li><a href="#"><span><img src="{{ asset('./assets/images/Customers.png') }}" alt=""></span>Community</a></li>
                        </ul>
                    </div>
                </div>
                
                @yield('content')
                
            </div>
        </div>
    </section>

    

    <script src="assets/js/wow-animate.js"></script>
    <script src="assets/js/lib.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <script type="text/javascript">
        $(document).on('ready', function () {




            wow = new WOW(
                {
                    animateClass: 'animated',
                    offset: 100,
                    callback: function (box) {
                        console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                    }
                }
            );

            wow.init();


        });

    </script>
    
</body>
</html>