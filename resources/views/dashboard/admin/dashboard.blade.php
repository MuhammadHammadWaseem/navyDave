@extends('dashboard.layouts.master')

<style>
      .main-box-navy .left-all-links ul li a.dashboard-active, .main-box-navy .left-all-links ul li a:hover {
    background-color: white;
    font-weight: 600;
  }

  .main-box-navy .left-all-links ul li a.dashboard-active span,.main-box-navy .left-all-links ul li a:hover span {
    background-color: #2CC374;
  }

  .main-box-navy .left-all-links ul li a.dashboard-active span img,.main-box-navy .left-all-links ul li a:hover span img {
    filter: invert(0) hue-rotate(465deg) brightness(10.5);
  }
</style>

@section('content')
    <div class="col-lg-10">
        <div class="welcome-and-user-name">
            <h6>Welcome Back,</h6>
            <h5>Admin</h5>
        </div>
        <div class="maindashboard-box">
            <div class="four-things-align">
                <div class="box">
                    <div class="text">
                        <h6>Revenue</h6>
                        <div class="price-box">
                            <h5>$3,250</h5>
                            <h6>+55%</h6>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="{{ asset('./assets/images/dashboard-img-01.png') }}" alt="">
                    </div>
                </div>
                <div class="box">
                    <div class="text">
                        <h6>Approved Appointments</h6>
                        <div class="price-box">
                            <h5>12</h5>
                            <h6>+5%</h6>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="{{ asset('./assets/images/dashboard-img-02.png') }}" alt="">
                    </div>
                </div>
                <div class="box">
                    <div class="text">
                        <h6>Appointments</h6>
                        <div class="price-box price-box-in-minus">
                            <h5>14</h5>
                            <h6>-14%</h6>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="{{ asset('./assets/images/dashboard-img-03.png') }}" alt="">
                    </div>
                </div>
                <div class="box">
                    <div class="text">
                        <h6>Pending Appointments</h6>
                        <div class="price-box">
                            <h5>02</h5>
                        </div>
                    </div>
                    <div class="img-box img-box-gray">
                        <img src="{{ asset('./assets/images/dashboard-img-03.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="main-table-box">
            <h3>Appointments</h3>
            <table>
                <tr>
                    <th>User</th>
                    <th>Date & Time</th>
                    <th>STATUS</th>
                    <th>Day</th>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-01.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Esthera Jackson</h5>
                                <h6>esthera@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="paid-text">Paid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="person-box">
                            <div class="box">
                                <img src="{{ asset('./assets/images/person-02.png') }}" alt="">
                            </div>
                            <div class="box">
                                <h5>Alexa Liras</h5>
                                <h6>alexa@simmmple.com</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="date-time-box">
                            <h5>09 : 00 AM - 11 : 00 AM</h5>
                            <h6>14/06/21</h6>
                        </div>
                    </td>
                    <td>
                        <div class="paid-unpaid-box">
                            <p class="unpaid-text">Unpaid</p>
                        </div>
                    </td>
                    <td>
                        <div class="day-box">
                            <p>Monday</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
