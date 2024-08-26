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
    <div class="main-calendar-box">
        <h5>Calendar ( Appointments )</h5>
        <input type="date" placeholder="May 2024">
        <table>
            <tr>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday    </th>
                <th>Friday  </th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>
            <tr>
                <td>
                    <div class="data-table-content-box">
                        <span>01</span>
                        <div class="green-box">
                            <h5>Jhon Dalton</h5>
                            <h6>(9 : 00 AM - 11 :  00 AM)</h6>
                        </div>
                        <div class="green-box gray-box">
                            <h5>Jhon Dalton</h5>
                            <h6>(9 : 00 AM - 11 :  00 AM)</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>02</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>03</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>04</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>05</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>06</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>07</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="data-table-content-box">
                        <span>08</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>09</span>
                        <div class="green-box">
                            <h5>Jhon Dalton</h5>
                            <h6>(9 : 00 AM - 11 :  00 AM)</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>10</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>11</span>
                        <div class="green-box gray-box">
                            <h5>Jhon Dalton</h5>
                            <h6>(9 : 00 AM - 11 :  00 AM)</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>12</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>13</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>14</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="data-table-content-box">
                        <span>15</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>16</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>17</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>18</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>19</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>20</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>21</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="data-table-content-box">
                        <span>22</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>23</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>24</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>25</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>26</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>27</span>
                    </div>
                </td>
                <td>
                    <div class="data-table-content-box">
                        <span>28</span>
                        <div class="green-box">
                            <h5>Jhon Dalton</h5>
                            <h6>(9 : 00 AM - 11 :  00 AM)</h6>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
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
