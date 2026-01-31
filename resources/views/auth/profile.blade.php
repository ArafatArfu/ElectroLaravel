@extends('layouts.master')

@section('title', 'My Profile - Electro Master')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">My Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">My Account</h3>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="{{ route('profile') }}">Profile</a></li>
                            <li><a href="{{ route('profile.orders') }}">My Orders</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link" style="padding: 0; color: inherit;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-9">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Profile Info -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Profile Information</h3>
                        </div>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input class="input" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input class="input" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input class="input" type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="input" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                            </div>
                            <button type="submit" class="primary-btn">Update Profile</button>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="billing-details" style="margin-top: 30px;">
                        <div class="section-title">
                            <h3 class="title">Change Password</h3>
                        </div>
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input class="input" type="password" id="current_password" name="current_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input class="input" type="password" id="new_password" name="new_password" required minlength="8">
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input class="input" type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="primary-btn">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->
@endsection
