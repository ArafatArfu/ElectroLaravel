@extends('layouts.master')

@section('title', 'Order Confirmed - Electro Master')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Order Confirmed</li>
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
                <div class="col-md-8 col-md-offset-2">
                    <div class="billing-details">
                        <div class="section-title text-center">
                            <h3 class="title">Thank You for Your Order!</h3>
                        </div>
                        
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="text-center">
                            <i class="fa fa-check-circle" style="font-size: 64px; color: #28a745; margin: 20px 0;"></i>
                            <p>Your order #{{ $order->id }} has been placed successfully.</p>
                            <p>We've sent a confirmation email to <strong>{{ $order->email }}</strong></p>
                        </div>

                        <div class="order-summary" style="margin-top: 30px;">
                            <div class="order-col">
                                <div><strong>Order Details</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach($order->items as $item)
                                <div class="order-col">
                                    <div>{{ $item->quantity }}x {{ $item->product_name }}</div>
                                    <div>${{ number_format($item->product_price * $item->quantity, 2) }}</div>
                                </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div>Shipping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">${{ number_format($order->total, 2) }}</strong></div>
                            </div>
                        </div>

                        <div class="text-center" style="margin-top: 30px;">
                            <a href="{{ route('home') }}" class="primary-btn">Continue Shopping</a>
                            @auth
                            <a href="{{ route('profile.orders') }}" class="btn btn-default" style="margin-left: 10px;">View My Orders</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->
@endsection
