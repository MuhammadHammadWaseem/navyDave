<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('./assets/images/favicon.png') }}" type="favicon.png" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('./assets/css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/adminStyle.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    {{-- DataTable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

</head>

<body>

    <header>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ Storage::url($settings[0]->logo) }}" alt="Logo">
                        </a>
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
                                    <a href="{{ route('logout') }}"><i class="fa fa-user"
                                            aria-hidden="true"></i>Logout</a>
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
                            @if (auth()->user()->hasRole('admin'))
                                <li><a href="{{ route('admin.dashboard') }}" class="dashboard-active"><span><img
                                                src="{{ asset('./assets/images/Dashboard.png') }}"
                                                alt=""></span>Dashboard</a></li>
                                <li><a href="{{ route('admin.profile') }}" class="profile-active"><span><img
                                                src="{{ asset('./assets/images/Profile.png') }}"
                                                alt=""></span>Profile</a></li>
                                <li><a href="{{ route('admin.calendar') }}" class="calendar-active"><span><img
                                                src="{{ asset('./assets/images/Calendar.png') }}"
                                                alt=""></span>Calendar</a></li>
                                <li><a href="{{ route('admin.appointment') }}" class="appointment-active"><span><img
                                                src="{{ asset('./assets/images/appointment.png') }}"
                                                alt=""></span>Appointments</a></li>
                                <li><a href="{{ route('admin.blog') }}" class="blog-active"><span><img
                                                src="{{ asset('./assets/images/blog.png') }}"
                                                alt=""></span>Blogs</a></li>
                                <li><a href="{{ route('admin.payment') }}" class="payment-active"><span><img
                                                src="{{ asset('./assets/images/Payments.png') }}"
                                                alt=""></span>Payments</a></li>
                                <li><a href="{{ route('admin.service') }}" class="service-active"><span><img
                                                src="{{ asset('./assets/images/Services.png') }}"
                                                alt=""></span>Services</a></li>
                                <li><a href="{{ route('admin.service.assign') }}"
                                        class="service-assign-active"><span><img
                                                src="{{ asset('./assets/images/service-assign.png') }}"
                                                alt=""></span>Services Assign</a></li>
                                <li><a href="{{ route('admin.slot') }}" class="slots-active"><span><img
                                                src="{{ asset('./assets/images/appointment-slot.png') }}"
                                                alt=""></span>Appointment Slots</a></li>

                                {{-- <li><a href="{{ route('admin.customer') }}" class="customer-active"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Customers</a></li> --}}
                                <li><a href="{{ route('admin.staff') }}" class="staff-active"><span><img
                                                src="{{ asset('./assets/images/staff.png') }}"
                                                alt=""></span>Staff Members</a></li>
                                <li><a href="{{ route('admin.community') }}" class="community-active"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Community</a></li>
                                <li><a href="{{ route('admin.setting') }}" class="setting-active"><span><img
                                                src="{{ asset('./assets/images/setting.png') }}"
                                                alt=""></span>Setting</a></li>
                            @endif
                            @if (auth()->user()->hasRole('user'))
                                <li><a href="{{ route('user.dashboard') }}" class="dashboard-active"><span><img
                                                src="{{ asset('./assets/images/Dashboard.png') }}"
                                                alt=""></span>Dashboard</a></li>
                                <li><a href="{{ route('user.profile') }} " class="profile-active"><span><img
                                                src="{{ asset('./assets/images/Profile.png') }}"
                                                alt=""></span>Profile</a></li>
                                <li><a href="{{ route('user.calendar') }}" class="calendar-active"><span><img
                                                src="{{ asset('./assets/images/Calendar.png') }}"
                                                alt=""></span>Calendar</a></li>
                                <li><a href="{{ route('user.appointment') }}" class="appointment-active"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Appointments</a></li>
                                <li><a href="{{ route('user.staff') }}" class="staff-active"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Staff Members</a></li>


                                <li><a href="{{ route('user.community') }}"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Community</a></li>
                            @endif

                            @if (auth()->user()->hasRole('staff'))
                                <li><a href="{{ route('staff.dashboard') }}" class="dashboard-active"><span><img
                                                src="{{ asset('./assets/images/Dashboard.png') }}"
                                                alt=""></span>Dashboard</a></li>
                                <li><a href="{{ route('staff.profile') }}" class="profile-active"><span><img
                                                src="{{ asset('./assets/images/Profile.png') }}"
                                                alt=""></span>Profile</a></li>
                                <li><a href="{{ route('staff.calendar') }}" class="calendar-active"><span><img
                                                src="{{ asset('./assets/images/Calendar.png') }}"
                                                alt=""></span>Calendar</a></li>
                                <li><a href="{{ route('staff.appointment') }}" class="appointment-active"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Appointments</a></li>
                                <li><a href="{{ route('staff.community') }}" class="community-active"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Community</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>
    </section>



    <script src="{{ asset('./assets/js/wow-animate.js') }}"></script>
    <script src="{{ asset('./assets/js/lib.js') }}"></script>
    <script src=" {{ asset('./assets/js/custom.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- Custom JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>

    {{-- Toaster --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Include select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>



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
    </script>
</body>

</html>
