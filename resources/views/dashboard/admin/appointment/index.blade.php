    @extends('dashboard.layouts.master')
    <style>
        .main-box-navy .left-all-links ul li a.appointment-active,
        .main-box-navy .left-all-links ul li a:hover {
            background-color: white;
            font-weight: 600;
        }

        .main-box-navy .left-all-links ul li a.appointment-active span,
        .main-box-navy .left-all-links ul li a:hover span {
            background-color: #2CC374;
        }

        .main-box-navy .left-all-links ul li a.appointment-active span img,
        .main-box-navy .left-all-links ul li a:hover span img {
            filter: invert(0) hue-rotate(465deg) brightness(10.5);
        }

        .dt-buttons {
            margin-bottom: 15px;
        }

        .dt-buttons button.dt-button {
            background-color: #48bb78 !important;
            font-size: 14px !important;
            color: white !important;
            padding: 10px 20px !important;
            border-radius: 15px !important;
            transition: .3s !important;
            border: none !important;
        }

        .dt-buttons button.dt-button:hover {
            background-color: black !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            height: 40px !important;
            border: 1px solid #00000040 !important;
            border-radius: 15px !important;
            padding: 10px !important;
            font-size: 12px !important;
            color: #CACACA !important;
            background-color: white !important;
            max-width: 250px !important;
            width: 250px !important;
            padding-left: 30px !important;
        }
    </style>
    @section('content')
        <div class="col-lg-10">
            <div class="main-calendar-box main-calendar-box-list customers-box mt-0 mb-0">
                <div class="two-things-align">
                    <h5> Appointments</h5>
                </div>
            </div>
            <div class="main-table-box main-table-box-list services-table">
                <table class="table table-striped" id="Table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Category</th>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="Table">
                        <!-- Rows will be inserted here using Ajax -->
                    </tbody>
                </table>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function formatTime(timeString) {
                const [hour, minute] = timeString.split(':');
                let hours = parseInt(hour);
                let ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12 || 12; // convert 24-hour format to 12-hour format
                return `${hours}:${minute} ${ampm}`;
            }

            function getData() {
                $.ajax({
                    url: "{{ route('admin.appointment.index') }}",
                    type: "get",
                    success: function(response) {
                        $("#Table").empty();
                        response.forEach(element => {
                            $('#Table').append(`
                                <tr>
                                    <td>${element.id}</td>
                                    <td>${element.first_name + ' ' + element.last_name}</td>
                                    <td>${element.email}</td>
                                    <td>${element.service.name}</td>
                                    <td>${element.service.category.name}</td>
                                    <td>${element.slot.available_on}</td>
                                    <td>${element.appointment_date}</td>
                                    <td>${formatTime(element.slot.available_from) + ' - ' + formatTime(element.slot.available_to)}</td>
                                    <td>$${element.price}</td>
                                    <td>${element.status}</td>
                                    <td>
                                        <div class="action-box">
                                            <ul>
                                                <li><a href="#"><img src="{{ asset('assets/images/pencil.png') }}" alt=""></a>
                                                </li>
                                                <li><a href="#"><img src="{{ asset('assets/images/delete.png') }}" alt=""></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                `);
                        })
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            $(document).ready(function() {
                getData();

                setTimeout(function() {
                    $("#Table1").DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copy',
                                text: 'Copy Data',
                                className: 't-btn' // Only use your custom class
                            },
                            {
                                extend: 'csv',
                                text: 'Export to CSV',
                                className: 't-btn' // Only use your custom class
                            },
                            {
                                extend: 'excel',
                                text: 'Export to Excel',
                                className: 't-btn' // Only use your custom class
                            },
                            {
                                extend: 'pdf',
                                text: 'Export to PDF',
                                className: 't-btn' // Only use your custom class
                            },
                            {
                                extend: 'print',
                                text: 'Print Table',
                                className: 't-btn' // Only use your custom class
                            }
                        ]
                    });
                }, 1000);


            });
        </script>
    @endsection
