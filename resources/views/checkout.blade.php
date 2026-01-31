@extends('layouts.master')

@section('title', 'Checkout - Electro Master')

@section('content')
    @if(count($cart ?? []) > 0)
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Checkout</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Checkout</li>
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
                @if(session('error'))
                    <div class="col-md-12">
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    </div>
                @endif

                <div class="col-md-7">
                    <!-- Billing Details -->
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Billing Address</h3>
                            </div>
                            @auth
                                @php $user = Auth::user(); @endphp
                            @endauth
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input class="input" type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->name ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input class="input" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="input" type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="input" type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="input" type="text" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input class="input" type="text" id="city" name="city" value="{{ old('city', $user->city ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input class="input" type="text" id="country" name="country" value="{{ old('country', $user->country ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="zip_code">ZIP Code</label>
                                <input class="input" type="text" id="zip_code" name="zip_code" value="{{ old('zip_code', $user->zip_code ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="notes">Order Notes</label>
                                <textarea class="input" id="notes" name="notes" placeholder="Notes about your order">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <!-- /Billing Details -->

                        @guest
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Create Account?</h3>
                            </div>
                            <p>You can create an account after placing your order.</p>
                        </div>
                        @endguest

                        <!-- Order notes -->
                        <div class="order-notes">
                        </div>
                        <!-- /Order notes -->
                </div>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        @foreach($cart as $item)
                        <div class="order-products">
                            <div class="order-col">
                                <div>{{ $item['quantity'] }}x {{ $item['name'] }}</div>
                                <div>${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                            </div>
                        </div>
                        @endforeach
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">${{ number_format($total, 2) }}</strong></div>
                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-1" value="bank_transfer" checked>
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-2" value="cheque">
                            <label for="payment-2">
                                <span></span>
                                Cheque Payment
                            </label>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-3" value="paypal">
                            <label for="payment-3">
                                <span></span>
                                PayPal
                            </label>
                        </div>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div>
                    <button type="submit" class="primary-btn order-submit">Place Order</button>
                </div>
                </form>
                <!-- /Order Details -->
            </div>
        </div>
    </div>
    <!-- /SECTION -->
    @else
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <p>Your cart is empty. <a href="{{ route('store') }}">Continue shopping</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
