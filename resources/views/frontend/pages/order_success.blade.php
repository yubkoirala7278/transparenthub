@extends('frontend.layouts.master')

@section('content')
<main class="wrapper-contain bg-light py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <!-- Success Icon -->
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                                class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.08 0l4-4a.75.75 0 1 0-1.08-1.06L7.5 9.44 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z" />
                            </svg>
                        </div>
                        <!-- Title -->
                        <h1 class="display-5 fw-bold mb-3">Order Placed Successfully!</h1>
                        <!-- Message -->
                        <p class="lead mb-4">
                            Thank you for your purchase. Your order has been processed and a confirmation email has been sent to you.
                        </p>
                        <hr>
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('shop') }}" class="btn  btn-lg text-light" style="background-color: #126EC0">
                                Continue Shopping
                            </a>
                            <a href="{{route('my-order')}}" class="btn btn-outline-secondary btn-lg">
                                View My Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

