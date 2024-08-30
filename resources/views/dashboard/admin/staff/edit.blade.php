@extends('dashboard.layouts.master')
@section('content')
    {{-- <form action=" {{ route('dashboard.admin.staff.update', $staff->id) }}" method="post" enctype="multipart/form-data"> --}}
    <div class="col-lg-10">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="two-things-align" bis_skin_checked="1">
            <h5>{{ $staff->user->name }}</h5>
        </div>

        {{-- <form action="{{ route('admin.staff.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <img src="{{ Storage::url($staff->image) }}" alt="" height="200" width="200">
                <input type="file" name="image" class="form-control mt-3" placeholder="Upload Image" value="">
            </div>
            <div class="form-group">
                <input type="text" name="first_name" class="form-control" placeholder="First Name"
                    value="{{ $staff->user->name }}">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address"
                    value="{{ $staff->user->email }}">
            </div>
            <div class="form-group">
                <input type="tel" name="phone" class="form-control" placeholder="Phone"
                    value="{{ $staff->user->phone }}">
            </div>
            <div class="form-group">
                <select name="service_id" class="form-control">
                    <option value="" disabled>Services</option>
                    <option value="{{ $staff->service_id == 1 ? '1' : '' }}">Service 01</option>
                    <option value="{{ $staff->service_id == 2 ? '2' : '' }}">Service 02</option>
                </select>
            </div>
            <div class="form-group">
                <select name="status" class="form-control">

                    <option disabled>Status</option>
                    <option value="{{ $staff->status == 'Active' ? 'selected' : 'Active' }}">Active</option>
                    <option value="{{ $staff->status == 'In Active' ? 'selected' : 'Active' }}">In Active</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="notes" class="form-control" placeholder="Note" cols="5" rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick=")" id="createStaff">Update</button>
            </div>
        </form> --}}

        <form action="{{ route('admin.staff.update', $staff->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $staff->id }}">
            <div class="form-group">
                <img src="{{ Storage::url($staff->image) }}" alt="" height="200" width="200">
                <input type="file" name="image" class="form-control mt-3" placeholder="Upload Image">
            </div>
            <div class="form-group">
                <input type="text" name="first_name" class="form-control" placeholder="First Name"
                    value="{{ $staff->user->name }}">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address"
                    value="{{ $staff->user->email }}">
            </div>
            <div class="form-group">
                <input type="tel" name="phone" class="form-control" placeholder="Phone"
                    value="{{ $staff->user->phone }}">
            </div>
            <div class="form-group">
                <select name="service_id" class="form-control">
                    <option value="" disabled>Services</option>
                    <option value="1" {{ $staff->service_id == 1 ? 'selected' : '' }}>Service 01</option>
                    <option value="2" {{ $staff->service_id == 2 ? 'selected' : '' }}>Service 02</option>
                </select>
            </div>
            <div class="form-group">
                <select name="status" class="form-control">
                    <option disabled>Status</option>
                    <option value="Active" {{ $staff->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="In Active" {{ $staff->status == 'In Active' ? 'selected' : '' }}>In Active</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="notes" class="form-control" placeholder="Note" cols="5" rows="5">{{ $staff->notes }}</textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>
@endsection
