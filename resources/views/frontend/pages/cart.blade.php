@extends('frontend.layouts.master')
@section('custom-css')
    <!-- Custom CSS for Cart Page -->
    <style>
        .cart-item-img {
            width: 80px;
            height: auto;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
        }

        .btn-quantity {
            width: 30px;
        }

        .cart-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        /* Center the empty cart message */
        #empty-cart {
            text-align: center;
            padding: 50px 0;
        }

        @media (max-width: 767px) {
            .cart-item-img {
                width: 60px;
            }

            .quantity-input {
                width: 40px;
            }
        }
    </style>
@endsection

@section('content')
    <main class="wrapper-contain">
        <div class="container">
            <h2 class="my-4">Shopping Cart</h2>
            @if ($cartItems->isEmpty())
                <!-- If there are no items on page load, show this message -->
                <div id="empty-cart">
                    <h4>Your cart is empty!</h4>
                    <a href="{{ route('shop') }}" class="btn mt-3 text-white rounded-0"
                        style="background-color:#136FBF">Continue Shopping</a>
                </div>
            @else
                <!-- Wrap the cart content so we can hide it via JavaScript if the cart becomes empty -->
                <div id="cart-content">
                    <div class="row">
                        <!-- Cart Items Table -->
                        <div class="col-lg-8 ">
                            <div class="table-responsive">
                                <table class="table table-bordered cart-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th style="width: 150px;">Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr data-id="{{ $item->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center" style="min-width: 400px">
                                                        <img src="{{ asset($item->product->feature_image) }}"
                                                            alt="Product Image" class="cart-item-img me-2">
                                                        <div>
                                                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                            <small>SKU: {{ $item->product->sku }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Store the actual price in a data attribute -->
                                                <td class="unit-price text-nowrap" data-price="{{ $item->product->price }}">
                                                    Rs. {{ number_format($item->product->price, 2) }}
                                                </td>
                                                <td>
                                                    <div class="input-group flex-nowrap">
                                                        <button class="btn btn-outline-secondary btn-quantity decrease"
                                                            type="button" data-id="{{ $item->id }}">-</button>
                                                        <input type="text" class="form-control quantity-input"
                                                            value="{{ $item->cart_count }}" data-id="{{ $item->id }}"
                                                            readonly style="min-width: 50px">
                                                        <button class="btn btn-outline-secondary btn-quantity increase"
                                                            type="button" data-id="{{ $item->id }}">+</button>
                                                    </div>
                                                </td>
                                                <td class="item-total  text-nowrap">
                                                    Rs. {{ number_format($item->product->price * $item->cart_count, 2) }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm remove-item"
                                                        data-id="{{ $item->id }}">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Cart Summary -->
                        <div class="col-lg-4">
                            <div class="cart-summary">
                                <h5>Cart Summary</h5>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Sub Total:</span>
                                    <span id="sub-total">
                                        Rs.
                                        {{ number_format($cartItems->sum(function ($item) {return $item->product->price * $item->cart_count;}),2) }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>Shipping Cost:</span>
                                    <span id="shipping-cost">Rs. 100.00</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total Amount:</strong>
                                    <strong id="total-amount">
                                        Rs.
                                        {{ number_format($cartItems->sum(function ($item) {return $item->product->price * $item->cart_count;}) + 100,2) }}
                                    </strong>
                                </div>
                                <a href="{{route('checkout')}}" class="btn btn-block mt-3 w-100 text-white rounded-0"
                                    style="background-color: #136FBF">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hidden empty cart message container -->
                <div id="empty-cart" style="display: none;">
                    <h4>Your cart is empty!</h4>
                    <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Continue Shopping</a>
                </div>
            @endif
        </div>
    </main>
@endsection

@push('script')
    <!-- jQuery for AJAX functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // Helper function to format a number as currency with commas and two decimals.
            function formatCurrency(amount) {
                return 'Rs. ' + parseFloat(amount).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            // Function to update totals on the UI using the data-price attribute
            function updateTotals() {
                let subTotal = 0;
                $('tbody tr').each(function() {
                    let price = parseFloat($(this).find('.unit-price').data('price'));
                    let qty = parseInt($(this).find('input.quantity-input').val());
                    let total = price * qty;
                    $(this).find('td.item-total').text(formatCurrency(total));
                    subTotal += total;
                });
                $('#sub-total').text(formatCurrency(subTotal));
                let shipping = 100; // Fixed shipping cost
                let totalAmount = subTotal + shipping;
                $('#total-amount').text(formatCurrency(totalAmount));
            }

            // Set up AJAX with CSRF token (Laravel requirement)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Increase quantity
            $(document).on('click', '.increase', function() {
                let itemId = $(this).data('id');
                let inputField = $('input.quantity-input[data-id="' + itemId + '"]');
                let currentQty = parseInt(inputField.val());
                let newQty = currentQty + 1;

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'POST',
                    data: {
                        id: itemId,
                        quantity: newQty
                    },
                    success: function(response) {
                        if (response.success) {
                            inputField.val(newQty);
                            $('#navCartCount').text(response.cart_count).show();
                            updateTotals();
                            // Update navbar cart count
                            updateNavbarCartCount(response.cartCount);
                        } else {
                            alert(response.message || 'Unable to update quantity.');
                        }
                    },
                    error: function() {
                        alert('Error updating quantity.');
                    }
                });
            });

            // Decrease quantity
            $(document).on('click', '.decrease', function() {
                let itemId = $(this).data('id');
                let inputField = $('input.quantity-input[data-id="' + itemId + '"]');
                let currentQty = parseInt(inputField.val());
                if (currentQty > 1) {
                    let newQty = currentQty - 1;
                    $.ajax({
                        url: '{{ route('cart.update') }}',
                        method: 'POST',
                        data: {
                            id: itemId,
                            quantity: newQty
                        },
                        success: function(response) {
                            if (response.success) {
                                inputField.val(newQty);
                                updateTotals();
                                // Update navbar cart count
                                updateNavbarCartCount(response.cartCount);
                            } else {
                                alert(response.message || 'Unable to update quantity.');
                            }
                        },
                        error: function() {
                            alert('Error updating quantity.');
                        }
                    });
                }
            });

            // Remove item example
            $(document).on('click', '.remove-item', function() {
                let itemId = $(this).data('id');
                let row = $(this).closest('tr');

                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: 'POST',
                    data: {
                        id: itemId
                    },
                    success: function(response) {
                        if (response.success) {
                            row.fadeOut(300, function() {
                                $(this).remove();
                                updateTotals();

                                // Update navbar cart count
                                updateNavbarCartCount(response.cartCount);

                                if ($('tbody tr').length === 0) {
                                    $('#cart-content').fadeOut(300, function() {
                                        $('#empty-cart').fadeIn(300);
                                    });
                                }
                            });
                        } else {
                            alert(response.message || 'Unable to remove item.');
                        }
                    },
                    error: function() {
                        alert('Error removing item.');
                    }
                });
            });
            // Function to update the navbar cart count
            function updateNavbarCartCount(count) {
                let $navCartCount = $('#navCartCount');
                if (parseInt(count) > 0 || count === '100+') {
                    $navCartCount.text(count);
                    $navCartCount.show();
                } else {
                    $navCartCount.hide();
                }
            }
        });
    </script>
@endpush
