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
</style>

@section('content')
<div class="col-lg-10">
    <div class="two-thing-align-staff-addstaff">
        <div class="box">
            <h6>Staff Members</h6>
            <h5>Navy Dave</h5>
        </div>
        <div class="box">
            <a href="#" class="t-btn">Add Staff</a>
            <a href="{{ route('admin.calendar') }}" class="t-btn">Back</a>
        </div>
    </div>
    <div class="main-calendar-box main-calendar-box-list">
        <h5>Calendar ( Appointments )</h5>
        <input type="date" placeholder="May 2024">

        <!-- FullCalendar Container -->
        <div id="calendar"></div>
    </div>
@endsection
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           // Initialize the calendar
           var calendarEl = document.getElementById('calendar');

           var calendar = new FullCalendar.Calendar(calendarEl, {
               initialView: 'dayGridMonth', // You can change this to week, day, etc.
               headerToolbar: {
                   left: 'prev,next today',
                   center: 'title',
                   right: 'dayGridMonth,timeGridWeek,timeGridDay'
               },
               events: [
                   // Sample event data
                   {
                       title: 'Appointment 1',
                       start: '2024-09-10T10:30:00',
                       end: '2024-09-10T12:30:00'
                   },
                   {
                       title: 'Appointment 2',
                       start: '2024-09-12T12:00:00'
                   }
               ]
           });

           calendar.render();
       });
   </script>
