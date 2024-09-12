@extends('dashboard.layouts.master')

<style>
    .main-box-navy .left-all-links ul li a.calendar-active,
    .main-box-navy .left-all-links ul li a:hover {
        background-color: white;
        font-weight: 600;
    }

    .main-box-navy .left-all-links ul li a.calendar-active span,
    .main-box-navy .left-all-links ul li a:hover span {
        background-color: #2CC374;
    }

    .main-box-navy .left-all-links ul li a.calendar-active span img,
    .main-box-navy .left-all-links ul li a:hover span img {
        filter: invert(0) hue-rotate(465deg) brightness(10.5);
    }

    /* Legend styling */
    .legend {
        margin-top: 20px;
    }

    .legend span {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 5px;
        border-radius: 3px;
    }

    .pending-color {
        background-color: #ffc107; /* Yellow for pending */
    }

    .confirmed-color {
        background-color: #28a745; /* Green for confirmed */
    }

    .canceled-color {
        background-color: #dc3545; /* Red for canceled */
    }

    .completed-color {
        background-color: #17a2b8; /* Light blue for completed */
    }
</style>

@section('content')
    <div class="col-lg-10">
        <!-- Calendar Section -->
        <div class="main-calendar-box main-calendar-box-list">
            <h5>Calendar (Appointments)</h5>
        </div>

        <div class="main-table-box main-table-box-list">
            <div id="calendar"></div>
        </div>

        <!-- Legend Section -->
        <div class="legend">
            <h6>Legend:</h6>
            <p>
                <span class="pending-color"></span> Pending &nbsp;
                <span class="confirmed-color"></span> Confirmed &nbsp;
                <span class="canceled-color"></span> Canceled &nbsp;
                <span class="completed-color"></span> Completed
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the calendar
            var calendarEl = document.getElementById('calendar');
            var appointments = @json($appointments); // Load your appointments from the backend

            // Function to map status to color
            function getStatusColor(status) {
                switch (status) {
                    case 'pending':
                        return {
                            backgroundColor: '#ffc107', // Yellow for pending
                            borderColor: '#ffc107',
                            textColor: 'black'
                        };
                    case 'confirmed':
                        return {
                            backgroundColor: '#28a745', // Green for confirmed
                            borderColor: '#28a745',
                            textColor: 'white'
                        };
                    case 'canceled':
                        return {
                            backgroundColor: '#dc3545', // Red for canceled
                            borderColor: '#dc3545',
                            textColor: 'white'
                        };
                    case 'completed':
                        return {
                            backgroundColor: '#17a2b8', // Light blue for completed
                            borderColor: '#17a2b8',
                            textColor: 'white'
                        };
                    default:
                        return {
                            backgroundColor: '#2CC374', // Default color
                            borderColor: '#2CC374',
                            textColor: 'white'
                        };
                }
            }

            // Create the events array for FullCalendar
            var events = appointments.map(function(appointment) {
                var statusColors = getStatusColor(appointment.status);

                return {
                    title: appointment.first_name + ' ' + appointment.last_name,
                    start: appointment.appointment_date,
                    backgroundColor: statusColors.backgroundColor,
                    borderColor: statusColors.borderColor,
                    textColor: statusColors.textColor
                };
            });

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                },
                events: events // Add the events data
            });

            calendar.render();
        });
    </script>
@endsection
