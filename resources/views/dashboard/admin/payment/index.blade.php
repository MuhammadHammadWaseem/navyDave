@extends('dashboard.layouts.master')

<style>
    .main-box-navy .left-all-links ul li a.payment-active,
    .main-box-navy .left-all-links ul li a:hover {
        background-color: white;
        font-weight: 600;
    }

    .main-box-navy .left-all-links ul li a.payment-active span,
    .main-box-navy .left-all-links ul li a:hover span {
        background-color: #2CC374;
    }

    .main-box-navy .left-all-links ul li a.payment-active span img,
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
        <div class="main-calendar-box main-calendar-box-list customers-box">
            <div class="two-things-align">
                <h5>Payments</h5>
            </div>
        </div>
        <div class="main-table-box main-table-box-list">
            <table id="Table1">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Staff Member</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Appointment On</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($appointments as $payment)
                        <tr>
                            <td>{{ $payment->created_at }}</td>
                            <td>{{ $payment->first_name }} {{ $payment->last_name }}</td>
                            <td>{{ $payment->staff->user->name }}</td>
                            <td>{{ $payment->service->name }}</td>
                            <td>{{ $payment->payment->status }}</td>
                            <td>{{ number_format($payment->payment->amount / 100, 2) }}</td>
                            <td>{{ $payment->appointment_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#Table1").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'Copy Data',
                        className: 't-btn'
                    },
                    {
                        extend: 'csv',
                        text: 'Export to CSV',
                        className: 't-btn'
                    },
                    {
                        extend: 'excel',
                        text: 'Export to Excel',
                        className: 't-btn'
                    },
                    {
                        extend: 'pdf',
                        text: 'Export to PDF',
                        className: 't-btn'
                    },
                    {
                        extend: 'print',
                        text: 'Print Table',
                        className: 't-btn'
                    }
                ],
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
