<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('assets/css/lib.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminStyle.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
</head>

<body>

    <header>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        @if (auth()->check())
                            <a
                                href="
                                @if (auth()->user()->hasRole('admin')) {{ route('admin.dashboard') }} 
                                @elseif (auth()->user()->hasRole('user')) 
                                    {{ route('user.dashboard') }} 
                                @elseif (auth()->user()->hasRole('staff')) 
                                    {{ route('staff.dashboard') }} @endif">
                                <img src="{{ Storage::url($settings[0]->logo ?? '') }}" alt="Logo">
                            </a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header-two-things-align">
                        <div class="page-relation-box">
                            <div class="align-box">
                                <p>Pages</p>
                                <p>
                                    @if (auth()->check())
                                        @if (auth()->user()->hasRole('admin'))
                                            {{ ucfirst(request()->path()) }}
                                        @elseif (auth()->user()->hasRole('user'))
                                            {{ ucfirst(request()->path()) }}
                                        @elseif (auth()->user()->hasRole('staff'))
                                            {{ ucfirst(request()->path()) }}
                                        @endif
                                    @else
                                        Guest Dashboard
                                    @endif
                                </p>
                            </div>
                            <div class="page-name">
                                <h6>
                                    @if (auth()->check())
                                        @if (auth()->user()->hasRole('admin'))
                                            Admin Dashboard
                                        @elseif (auth()->user()->hasRole('user'))
                                            User Dashboard
                                        @elseif (auth()->user()->hasRole('staff'))
                                            Staff Dashboard
                                        @endif
                                    @else
                                        Guest Dashboard
                                    @endif
                                </h6>
                            </div>
                        </div>

                        <div class="input-box-other-details">
                            <div class="logout-setting-bell-all align-items-center">
                                <div class="logout-box">
                                    <div class="notification-box-main">
                                        <a href="javascript:void(0)" id="notificationLink-box">
                                            <i class="fa fa-bell" aria-hidden="true"></i> Notifications
                                        </a>
                                        <span id="notificationCount-box">{{ $notifications->count() }}</span>
                                    </div>

                                    <div id="notification-box" style="display: none;">
                                        <div class="main-heading">
                                            <h6>New notifications</h6>
                                        </div>
                                        @if ($notifications->count() > 0)
                                            <div class="new-notfication-box" id="new-notfication-box">
                                                @foreach ($notifications as $notification)
                                                    <a href="#">
                                                        <h5>{{ $notification->data['title'] }}</h5>
                                                        <p>{{ $notification->data['message'] }}</p>
                                                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="no-notification-box">
                                                <i class="fa fa-bell-slash" aria-hidden="true"></i>
                                                - No new notifications -
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('home') }}"><i class="fa fa-globe" aria-hidden="true"></i>Visit
                                        Site</a>
                                    <a href="{{ route('logout') }}"><i class="fa fa-user"
                                            aria-hidden="true"></i>Logout</a>
                                    @if (auth()->user()->hasRole('admin'))
                                        <a href="{{ route('admin.setting') }}"><i class="fa fa-cog"
                                                aria-hidden="true"></i> Settings</a>
                                    @endif
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
                                <li><a href="{{ route('admin.staff') }}" class="staff-active"><span><img
                                                src="{{ asset('./assets/images/staff.png') }}"
                                                alt=""></span>Staff Members</a></li>
                                <li><a href="{{ route('admin.community') }}" class="community-active"><span><img
                                                src="{{ asset('./assets/images/Customers.png') }}"
                                                alt=""></span>Community</a></li>
                                <li><a href="{{ route('admin.blog') }}" class="blog-active"><span><img
                                                src="{{ asset('./assets/images/blog.png') }}"
                                                alt=""></span>Blogs</a></li>
                                <li><a href="{{ route('admin.subscribers') }}" class="subscribers-active"><span><img
                                                src="{{ asset('./assets/images/Profile.png') }}"
                                                alt=""></span>Subscribers</a></li>
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>



    <script>
        $(document).ready(function() {

            Pusher.logToConsole = false;

            var pusher = new Pusher('3af0341c542582fe2550', {
                cluster: "ap2",
                encrypted: false,
                useTls: true,
            });

            var channel = pusher.subscribe('post-notification-channel');

            channel.bind('post-notification', function(data) {
                $.ajax({
                    url: "{{ route('user.get-notification') }}",
                    type: "GET",
                    success: function(response) {
                        $("#notificationCount-box").text(response.count);
                        $("#new-notfication-box").empty();

                        response.notifications.forEach(function(notification) {
                            console.log(notification);
                            $("#new-notfication-box").append(
                                `<a href="#">
                                    <h5>${notification.data['title']}</h5>
                                    <p>${notification.data['message']}</p>
                                    <p>${timeAgo(notification.created_at)}</p>
                                </a>`
                            );
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Function to calculate time ago
            function timeAgo(timestamp) {
                const now = new Date();
                const date = new Date(timestamp);
                const seconds = Math.floor((now - date) / 1000);

                let interval = Math.floor(seconds / 31536000);
                if (interval > 1) return `${interval} years ago`;
                interval = Math.floor(seconds / 2592000); // 30 days
                if (interval > 1) return `${interval} months ago`;
                interval = Math.floor(seconds / 86400); // 1 day
                if (interval > 1) return `${interval} days ago`;
                interval = Math.floor(seconds / 3600); // 1 hour
                if (interval > 1) return `${interval} hours ago`;
                interval = Math.floor(seconds / 60); // 1 minute
                if (interval > 1) return `${interval} minutes ago`;
                return `${seconds} seconds ago`;
            }


            // Toggle the notification box when the anchor is clicked
            $('#notificationLink-box').on('click', function(e) {
                e.preventDefault();
                $('#notification-box').toggle();
            });

            // Hide the notification box when clicking outside of it
            $(document).on('click', function(e) {
                var target = $(e.target);
                if (!target.closest('#notification-box').length && !target.closest('#notificationLink-box')
                    .length) {
                    $('#notification-box').hide();
                }
            });
        });
    </script>
</body>

</html>
