@extends('dashboard.layouts.master')
<style>
    .main-box-navy .left-all-links ul li a.staff-active,
    .main-box-navy .left-all-links ul li a:hover {
        background-color: white;
        font-weight: 600;
    }

    .main-box-navy .left-all-links ul li a.staff-active span,
    .main-box-navy .left-all-links ul li a:hover span {
        background-color: #2CC374;
    }

    .main-box-navy .left-all-links ul li a.staff-active span img,
    .main-box-navy .left-all-links ul li a:hover span img {
        filter: invert(0) hue-rotate(465deg) brightness(10.5);
    }
</style>
@section('content')
    <div class="col-lg-10">
        <div class="main-calendar-box main-calendar-box-list customers-box">
            <div class="two-things-align" bis_skin_checked="1">
                <h5>Staff Members</h5>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add Staff
                </button>
            </div>
            <div class="three-things-align services-box">
                <div class="main-search-form">
                    <form action="">
                        <div class="form-align-box">
                            <div class="box">
                                <div class="input-box">
                                    <input type="text" placeholder="Service Name">
                                </div>
                                <div class="select-box">
                                    <select name="Service Category" id="Service Category">
                                        <option value="Service Category">Service Category</option>
                                        <option value="Service Category-01">Service Category-01</option>
                                        <option value="Service Category-02">Service Category-02</option>
                                        <option value="Service Category-03">Service Category-03</option>
                                    </select>
                                </div>
                            </div>
                            <div class="two-btns-align">
                                <a href="#" class="t-btn">Search Serivce</a>
                                <a href="#" class="t-btn t-btn-gray">Export List</a>
                                <a href="#" class="t-btn t-btn-gray">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="main-table-box main-table-box-list services-table">
            <table>
                <thead>
                    <tr>
                        <th>
                            <div class="align-box">
                                <div class="input-box-check">
                                    <input type="checkbox">
                                </div>
                                <p>ID</p>
                            </div>
                        </th>
                        <th>Image</th>
                        <th>Service</th>
                        <th>Staff Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be inserted here -->
                </tbody>
            </table>
        </div>
        <div class="pagination-box">
            <ul>
                <!-- Pagination links will be dynamically inserted here -->
            </ul>
        </div>

    </div>


    <!-- Modal Structure -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="saveStaff" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Staff Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="image" class="form-control" placeholder="Upload Image">
                        </div>
                        <div class="form-group">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <select name="service_id" class="form-control">
                                <option value="">Services</option>
                                <option value="1">Service 01</option>
                                <option value="2">Service 02</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="">Status</option>
                                <option value="Active">Active</option>
                                <option value="In Active">In Active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="notes" class="form-control" placeholder="Note" cols="5" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="saveStaff()" id="createStaff">Add
                            Staff</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ensure that the modal is cleaned up correctly when it's hidden
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('.modal-backdrop').remove(); // Remove the backdrop
            $('body').removeClass('modal-open'); // Remove the modal-open class from the body
        });
    });




    function saveStaff() {

        var saveStaff = $("#saveStaff");

        var formData = new FormData(saveStaff[0]);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('admin.staff.store') }}",
            type: "POST",
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Server response:', response);
                if (response.success) {
                    $('#exampleModal').modal('hide');
                    $('#saveStaff').trigger('reset');
                    saveStaff.reset();
                } else {
                    console.log('Failed to add staff. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', xhr.responseText);
                alert('An error occurred. Please try again.');
            }
        });
    }

    $.ajax({
        url: "{{ route('admin.staff.show') }}",
        type: "GET",
        dataType: "json",
        success: function(response) {
            console.log('Server response:', response);

            if (response.data) {
                populateTable(response.data);
                updatePagination(response);
            } else {
                console.error('No data found in response.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            alert('An error occurred while fetching the data.');
        }
    });

    function updatePagination(response) {
        const paginationBox = document.querySelector('.pagination-box ul');
        paginationBox.innerHTML = ''; // Clear existing pagination links

        const {
            current_page,
            last_page,
            prev_page_url,
            next_page_url
        } = response;

        // Previous Page Link
        if (prev_page_url) {
            paginationBox.innerHTML += `<li><a href="${prev_page_url}">&lt;</a></li>`;
        } else {
            paginationBox.innerHTML += `<li><a href="#" class="disabled">&lt;</a></li>`;
        }

        // Page Numbers
        for (let i = 1; i <= last_page; i++) {
            if (i === current_page) {
                paginationBox.innerHTML += `<li><a href="#" class="active">${i}</a></li>`;
            } else {
                paginationBox.innerHTML += `<li><a href="#" data-page="${i}">${i}</a></li>`;
            }
        }

        // Next Page Link
        if (next_page_url) {
            paginationBox.innerHTML += `<li><a href="${next_page_url}">&gt;</a></li>`;
        } else {
            paginationBox.innerHTML += `<li><a href="#" class="disabled">&gt;</a></li>`;
        }

        // Add event listeners for pagination links
        paginationBox.querySelectorAll('a[data-page]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                fetchPage(page);
            });
        });
    }

    function fetchPage(page) {
        $.ajax({
            url: `{{ route('admin.staff.show') }}?page=${page}`,
            type: "GET",
            dataType: "json",
            success: function(response) {
                console.log('Page response:', response);
                if (response.data) {
                    populateTable(response.data);
                    updatePagination(response);
                } else {
                    console.error('No data found in response.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                alert('An error occurred while fetching the data.');
            }
        });
    }


    function populateTable(data) {
        const tableBody = document.querySelector('.services-table table tbody');
        tableBody.innerHTML = ''; // Clear existing rows

        data.forEach(item => {
            const row = document.createElement('tr');

            row.innerHTML = `
            <td>
                <div class="align-box">
                    <div class="input-box-check">
                        <input type="checkbox">
                    </div>
                    <p>${item.id}</p>
                </div>
            </td>
            <td><img src="{{ asset('storage/') }}/${item.image}" alt="Staff Image" style="width: 100px; height: auto;"></td>
            <td>${item.service_id}</td>
            <td>${item.user.name}</td>
            <td>${item.user.email}</td>
            <td>${item.user.phone ? item.user.phone : 'N/A'}</td>
            <td>${item.status}</td>
            <td>
                <div class="action-box">
                    <ul>
                        <li><a href="${item.id}"><img src="{{ asset('assets/images/pencil.png') }}" alt=""></a></li>
                        <li><a href="${item.id}"><img src="{{ asset('assets/images/delete.png') }}" alt=""></a></li>
                    </ul>
                </div>
            </td>
        `;
            tableBody.appendChild(row);
        });
    }
</script>
