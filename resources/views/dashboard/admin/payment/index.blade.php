@extends('dashboard.layouts.master')

@section('content')
<div class="col-lg-10">
    <div class="main-calendar-box main-calendar-box-list customers-box">
       <div class="two-things-align">
        <h5>Payments</h5>
       </div>
        <div class="three-things-align">
            <div class="main-search-form">
                <form action="">
                    <div class="form-align-box">
                        <div class="input-box">
                            <input type="date" placeholder="Transaction Date">
                        </div>
                        <div class="select-box">
                            <select name="staff-member" id="staff-member">
                                <option value="staff-member">Staff Member</option>
                                <option value="staff-member-01">staff-member-01</option>
                                <option value="staff-member-02">staff-member-02</option>
                                <option value="staff-member-03">staff-member-03</option>
                              </select>
                        </div>
                        <div class="select-box">
                            <select name="Services" id="Services">
                                <option value="Services">Services</option>
                                <option value="Services-01">Services-01</option>
                                <option value="Services-02">Services-02</option>
                                <option value="Services-03">Services-03</option>
                              </select>
                        </div>
                        <div class="select-box">
                            <select name="Payment Status" id="Payment Status">
                                <option value="Payment Status">Payment Status</option>
                                <option value="Payment Status-01">Payment Status-01</option>
                                <option value="Payment Status-02">Payment Status-02</option>
                                <option value="Payment Status-03">Payment Status-03</option>
                              </select>
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Customer Name">
                        </div>
                        <div class="two-btns-align">
                            <a href="#" class="t-btn">Apply Filters</a>
                            <a href="#" class="t-btn t-btn-gray">Export List</a>
                            <a href="#" class="t-btn t-btn-gray">Reset</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="main-table-box main-table-box-list">
        <table>
            <tr>
                <th>User</th>
                <th>Services + Instructor</th>
                <th>Method</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Appointments At</th>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
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
                        <h5>Golf Coaching Session</h5>
                        <h6>By Navy Dave</h6>
                    </div>
                </td>
                <td>
                    <div class="day-box">
                        <p>Mannual ( By Admin )</p>
                    </div>
                </td>
                <td>$0.00</td>
                <td><div class="select-box table-select">
                    <select name="Paid" id="Paid">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                </div>
            </td>
            <td>June 27, 2024 7:49 pm</td>
            </tr>
        </table>
    </div>
    <div class="pagination-box">
        <ul>
            <li><a href="#">&lt;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">...</a></li>
            <li><a href="#">9</a></li>
            <li><a href="#">10</a></li>
            <li><a href="#">&gt;</a></li>
        </ul>
    </div>
</div>

@endsection
