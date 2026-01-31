@extends('layouts.master')

@section('title', 'Shopping Cart - Electro Master')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Cart</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                @if(count($cart) > 0)
                <form id="cart-form" class="clearfix">
                    <div class="col-md-12">
                        <div class="order-summary clearfix">
                            <div class="section-title">
                                <h3 class="title">Shopping Cart</h3>
                            </div>
                            <table class="shopping-cart-table table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th></th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $item)
                                    <tr>
                                        <td class="thumb">
                                            <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                        </td>
                                        <td class="details">
                                            <a href="{{ route('product.show', $item['slug']) }}">{{ $item['name'] }}</a>
                                        </td>
                                        <td class="price">${{ number_format($item['price'], 2) }}</td>
                                        <td class="qty">
                                            <input class="input" type="number" value="{{ $item['quantity'] }}" min="1" data-id="{{ $id }}">
                                        </td>
                                        <td class="total">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        <td class="text-right">
                                            <button class="main-btn icon-btn remove-item" data-id="{{ $id }}"><i class="fa fa-close"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>SUBTOTAL</th>
                                        <th colspan="2" class="sub-total">${{ number_format($total, 2) }}</th>
                                    </tr>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>SHIPING</th>
                                        <td colspan="2">Free Shipping</td>
                                    </tr>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>TOTAL</th>
                                        <th colspan="2" class="total-price">${{ number_format($total, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="pull-right">
                                <a href="{{ route('cart.clear') }}" class="main-btn" onclick="return confirm('Are you sure you want to clear the cart?')">Clear Cart</a>
                                <a href="{{ route('checkout') }}" class="primary-btn">Checkout</a>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p>Your cart is empty. <a href="{{ route('store') }}">Continue shopping</a></p>
                    </div>
                </div>
                @endif
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
@endsection

@section('js')
<script>
$(document).ready(function() {
    // Update quantity
    $('.qty input').change(function() {
        var id = $(this).data('id');
        var quantity = $(this).val();
        
        if (quantity < 1) {
            quantity = 1;
            $(this).val(1);
        }
        
        $.ajax({
            url: '{{ route('cart.update') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: id,
                quantity: quantity
            },
            success: function(response) {
                location.reload();
            }
        });
    });
    
    // Remove item
    $('.remove-item').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            url: '{{ route('cart.remove') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: id
            },
            success: function(response) {
                location.reload();
            }
        });
    });
});
</script>
@endsection
