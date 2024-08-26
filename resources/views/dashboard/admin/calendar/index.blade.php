@extends('dashboard.layouts.master')
<style>
    .main-box-navy .left-all-links ul li a.calendar-active, .main-box-navy .left-all-links ul li a:hover {
  background-color: white;
  font-weight: 600;
}

.main-box-navy .left-all-links ul li a.calendar-active span,.main-box-navy .left-all-links ul li a:hover span {
  background-color: #2CC374;
}

.main-box-navy .left-all-links ul li a.calendar-active span img,.main-box-navy .left-all-links ul li a:hover span img {
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
            </div>
        </div>
        <div class="main-calendar-box main-calendar-box-list">
            <h5>Calendar ( Appointments )</h5>
            <input type="date" placeholder="May 2024">
        </div>
        <div class="main-table-box main-table-box-list">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
                                <img src="assets/images/person-01.png" alt="">
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
                                <img src="assets/images/person-02.png" alt="">
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
