@extends('frontend.layouts.master')

@section('content')
    <main class="wrapper-contain bg-light">
        <div class="container py-5">
            <div class="row d-flex align-item-center" style="row-gap: 20px">
                <!-- Checkout Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="mb-4 fw-semibold text-dark">Contact Information</h4>

                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('checkout.products') }}">
                                @csrf
                                <input type="hidden" name="payment_method" id="payment_method" value="cod">
                                <!-- Default to Cash on Delivery -->
                                <div class="row g-3">
                                    <!-- Email Input -->
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="your@email.com" name="email" value="{{ old('email', $customerDetail->email ?? '') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <!-- Shipping Address -->
                                    <div class="col-12 mt-4">
                                        <h5 class="fw-semibold text-dark mb-3">Shipping Address</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="first_name"
                                                    value="{{ old('first_name', $customerDetail->first_name ?? '') }}">
                                                @if ($errors->has('first_name'))
                                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="Last name"
                                                    name="last_name"
                                                    value="{{ old('last_name', $customerDetail->last_name ?? '') }}">
                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <input type="text" class="form-control" placeholder="Phone Number"
                                                    name="phone_number"
                                                    value="{{ old('phone_number', $customerDetail->phone_number ?? '') }}">
                                                @if ($errors->has('phone_number'))
                                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <input type="text" class="form-control" placeholder="Street address"
                                                    name="street_address"
                                                    value="{{ old('street_address', $customerDetail->street_address ?? '') }}">
                                                @if ($errors->has('street_address'))
                                                    <span class="text-danger">{{ $errors->first('street_address') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="City" name="city"
                                                    value="{{ old('city', $customerDetail->city ?? '') }}">
                                                @if ($errors->has('city'))
                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-select" name="state">
                                                    <option value="">State</option>
                                                    <option value="Bagmati" {{ old('state', $customerDetail->state ?? '') == 'Bagmati' ? 'selected' : '' }}>Bagmati</option>
                                                    <option value="Koshi" {{ old('state', $customerDetail->state ?? '') == 'Koshi' ? 'selected' : '' }}>Koshi</option>
                                                    <option value="Madhesh" {{ old('state', $customerDetail->state ?? '') == 'Madhesh' ? 'selected' : '' }}>Madhesh</option>
                                                </select>
                                                @if ($errors->has('state'))
                                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="ZIP Code"
                                                    name="zip" value="{{ old('zip', $customerDetail->zip ?? '') }}">
                                                @if ($errors->has('zip'))
                                                    <span class="text-danger">{{ $errors->first('zip') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Coupon Code -->
                                    <div class="col-12 mt-4">
                                        <h5 class="fw-semibold text-dark mb-3">Coupon Code</h5>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="text" class="form-control" placeholder="Coupon Code">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Section -->
                                    <div class="col-12 mt-4">
                                        <h5 class="fw-semibold text-dark mb-3">Payment Method</h5>
                                        <div class="accordion" id="paymentMethods">
                                            <!-- COD -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#cod"
                                                        onclick="setPaymentMethod('cod')">
                                                        <i class="fa-solid fa-sack-dollar me-2"></i> Cash On Delivery
                                                    </button>
                                                </h2>
                                                <div id="cod" class="accordion-collapse collapse show"
                                                    data-bs-parent="#paymentMethods">
                                                    <div class="accordion-body">
                                                        <button class="btn btn-outline-primary w-100" type="submit">
                                                            Continue With Cash On Delivery
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Credit Card -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#creditCard"
                                                        onclick="setPaymentMethod('credit_card')">
                                                        <i class="far fa-credit-card me-2"></i> Credit/Debit Card
                                                    </button>
                                                </h2>
                                                <div id="creditCard" class="accordion-collapse collapse"
                                                    data-bs-parent="#paymentMethods">
                                                    <div class="accordion-body">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Card Number" name="card_number">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"
                                                                    placeholder="MM/YY" name="expiry_date">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"
                                                                    placeholder="CVV" name="cvv">
                                                            </div>
                                                            <div class="col-12">
                                                                <button class="btn btn-outline-primary w-100"
                                                                    type="submit">
                                                                    Continue
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PayPal -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#paypal"
                                                        onclick="setPaymentMethod('paypal')">
                                                        <i class="fab fa-paypal me-2"></i> PayPal
                                                    </button>
                                                </h2>
                                                <div id="paypal" class="accordion-collapse collapse"
                                                    data-bs-parent="#paymentMethods">
                                                    <div class="accordion-body">
                                                        <button class="btn btn-outline-primary w-100" type="submit">
                                                            Continue with PayPal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                        <div class="card-body p-4">
                            <h5 class="fw-semibold mb-4">Order Summary</h5>

                            <!-- Product List -->
                            @if (count($cartsProducts) > 0)
                                @php
                                    $subtotal = 0; // Initialize subtotal
                                @endphp
                                @foreach ($cartsProducts as $cartProduct)
                                    @php
                                        $productTotal = $cartProduct->product->price * $cartProduct->cart_count;
                                        $subtotal += $productTotal; // Add to subtotal
                                    @endphp
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset($cartProduct->product->feature_image) }}" alt="Product"
                                                class="rounded-2" width="60" loading="lazy">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $cartProduct->product->name }}</h6>
                                            <small class="text-muted">Qty: {{ $cartProduct->cart_count }}</small>
                                        </div>
                                        <div class="text-end text-nowrap">Rs. {{ number_format($productTotal, 2) }}</div>
                                    </div>
                                @endforeach
                            @endif

                            <!-- Price Breakdown -->
                            <div class="list-group list-group-flush">
                                <!-- Subtotal -->
                                <div class="list-group-item d-flex justify-content-between bg-transparent px-0">
                                    <span>Subtotal</span>
                                    <span>Rs. {{ number_format($subtotal, 2) }}</span>
                                </div>

                                <!-- Shipping -->
                                <div class="list-group-item d-flex justify-content-between bg-transparent px-0">
                                    <span>Shipping</span>
                                    <span>Rs. 100.00</span>
                                </div>

                                <!-- Total -->
                                <div
                                    class="list-group-item d-flex justify-content-between bg-transparent px-0 fw-semibold">
                                    <span>Total</span>
                                    <span>Rs. {{ number_format($subtotal + 100, 2) }}</span>
                                </div>
                            </div>

                            <!-- Security Info -->
                            <div class="mt-4 text-center">
                                <small class="text-muted d-block mb-2">
                                    <i class="fas fa-lock me-1"></i> Secure checkout
                                </small>
                                <div class="d-flex justify-content-center gap-2">
                                    <img src="https://img.icons8.com/color/48/000000/visa.png" width="40">
                                    <img src="https://img.icons8.com/color/48/000000/mastercard.png" width="40">
                                    <img src="https://img.icons8.com/color/48/000000/amex.png" width="40">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('custom-css')
    <style>
        .step-title {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #86b7fe;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(13, 110, 253, 0.05);
            color: #0d6efd;
        }
    </style>
@endsection

@push('script')
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        // Add credit card input formatting
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
        });
        // JavaScript to Set Payment Method
        function setPaymentMethod(method) {
            document.getElementById('payment_method').value = method;
        }
    </script>
@endpush
