@extends('dashboard.layouts.master')
<style>
    .main-box-navy .left-all-links ul li a.profile-active, .main-box-navy .left-all-links ul li a:hover {
  background-color: white;
  font-weight: 600;
}

.main-box-navy .left-all-links ul li a.profile-active span,.main-box-navy .left-all-links ul li a:hover span {
  background-color: #2CC374;
}

.main-box-navy .left-all-links ul li a.profile-active span img,.main-box-navy .left-all-links ul li a:hover span img {
  filter: invert(0) hue-rotate(465deg) brightness(10.5);
}
</style>
@section('content')
<div class="col-lg-10">
    <div class="main-calendar-box main-calendar-box-list customers-box">
        <div class="main-table-box main-table-box-list services-table">
            @if ($errors->count() > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="text">
                {{-- {{ dd($user) }} --}}
                <h2>{{ $user->name }}</h2>
            </div>
            <div class="form-box">
                <form action="profile/update/{{ $user->id }}" method="POST">
                    @csrf
                    <input type="text" placeholder="Full Name" value="{{ $user->name }}" name="name">
                    <input type="email" placeholder="Type Your Email" value="{{ $user->email }}" name="email">
                    <input type="tel" placeholder="Type Your Phone Number"
                        value="{{ $user->phone ? $user->phone : '' }}" name="phone">
                    <input type="text" placeholder="Address" value="{{ $user->address ? $user->address : '' }}"
                        name="address">
                    <input type="text" placeholder="City" value="{{ $user->city ? $user->city : '' }}"
                        name="city">
                    <input type="text" placeholder="Change Password" name="password">
                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
