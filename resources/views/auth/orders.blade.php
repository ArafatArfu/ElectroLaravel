@extends('layouts.master')

@section('title', 'My Orders - Electro Master')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">My Orders</li>
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
                            <li><a href="{{ route('profile') }}">Profile</a></li>
                            <li class="active"><a href="{{ route('profile.orders') }}">My Orders</a></li>
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
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">My Orders</h3>
                        </div>
                        
                        @if(count($orders) > 0)
                            <table class="shopping-cart-table table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @switch($order->status)
                                                @case('pending')
                                                    <span class="label label-warning">Pending</span>
                                                    @break
                                                @case('processing')
                                                    <span class="label label-info">Processing</span>
                                                    @break
                                                @case('shipped')
                                                    <span class="label label-primary">Shipped</span>
                                                    @break
                                                @case('delivered')
                                                    <span class="label label-success">Delivered</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="label label-danger">Cancelled</span>
                                                    @break
                                                @default
                                                    <span class="label label-default">{{ ucfirst($order->status) }}</span>
                                            @endswitch
                                        </td>
                                        <td>${{ number_format($order->total, 2) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <div class="text-center">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p>You haven't placed any orders yet.</p>
                                <a href="{{ route('store') }}" class="btn btn-primary">Start Shopping</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->
@endsection
