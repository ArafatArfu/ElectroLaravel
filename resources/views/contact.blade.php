@extends('layouts.master')

@section('title', 'Contact Us - Electro Master')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Contact</li>
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
                <!-- Contact Info -->
                <div class="col-md-6">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Contact Information</h3>
                        </div>
                        <div class="contact-info">
                            <p><i class="fa fa-map-marker"></i> 1734 Stonecoal Road, Chicago, IL 60607</p>
                            <p><i class="fa fa-phone"></i> +021-95-51-84</p>
                            <p><i class="fa fa-envelope"></i> email@email.com</p>
                            <p><i class="fa fa-clock-o"></i> Mon-Sat: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-md-6">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Send us a Message</h3>
                        </div>
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input class="input" type="text" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input class="input" type="email" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input class="input" type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="input" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="primary-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->
@endsection
