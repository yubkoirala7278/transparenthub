@extends('frontend.layouts.master')
@section('custom-css')
    <style>
        .order-status-pending {
            background-color: #ffc107;
            color: #000;
        }

        .order-status-shipped {
            background-color: #17a2b8;
            color: #fff;
        }

        .order-status-delivered {
            background-color: #28a745;
            color: #fff;
        }

        .order-status-cancelled {
            background-color: #dc3545;
            color: #fff;
        }

        .table thead th {
            border-bottom: 2px solid #e3e6f0;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .bg-light {
            background-color: #f8f9fc !important;
        }
    </style>
@endsection

@section('content')
    <main class="wrapper-contain bg-light pt-3">
        <div class="container">
            <h2>My Order Details</h2>
            <div class="card shadow" style="border-top: none;">
                <div class="card-header p-3" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Order Details: #{{ $order->slug }}</h5>
                </div>
                <div class="card-body p-3">
                    <!-- Order Status Section -->
                    <div class="row mb-4 d-flex align-items-center" style="row-gap: 10px">
                        <div class="col-md-4">
                            <p class="mb-1">Order Date: {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            <p class="mb-0">Payment Status:
                                <span
                                    class="badge {{ $order->payment_status == 'paid' ? 'text-bg-success' : 'text-bg-danger' }}">
                                    {{ $order->payment_status == 'not_paid' ? 'Not Paid' : 'Paid' }}
                                </span>
                            </p>

                        </div>
                        <div class="col-md-4 text-md-center">
                            <p class="mb-1">Order Status:
                                <span class="badge order-status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>

                        </div>
                        <div class="col-md-4 text-md-end">
                            <form id="cancelOrderForm" action="{{ route('orders.cancel', $order->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            @if ($order->status == 'pending')
                                <button class="btn btn-danger rounded-pill" onclick="confirmCancel()">Cancel Order</button>
                            @endif
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="border p-3 mb-3">
                                <h6 class="font-weight-bold text-uppercase text-muted mb-3">Shipping Information
                                </h6>
                                <p class="mb-1 font-weight-bold">{{ $order->first_name }}
                                    {{ $order->last_name }}
                                </p>
                                <p class="mb-1">{{ $order->street_address }}</p>
                                <p class="mb-1">{{ $order->city }}, {{ $order->state }}
                                    {{ $order->zip }}
                                </p>
                                <p class="mb-1">Phone: {{ $order->phone_number }}</p>
                                <p class="mb-0">Email: {{ $order->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border p-3 ">
                                <h6 class="font-weight-bold text-uppercase text-muted mb-3">Payment Information
                                </h6>
                                <p class="mb-1">Payment Method: Cash On Delivery</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Order Items Table -->
                            <div class="table-responsive mb-4 card-body pt-2 px-0">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->order_items as $item)
                                            <tr>
                                                <td style="min-width: 400px">{{ $item->product_name }}</td>
                                                <td>{{ $item->product->sku ?? 'N/A' }}</td>
                                                <td class="text-center">${{ $item->product->price }}</td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-right">${{ $item->product->price * $item->qty }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Order Summary -->
                            <div class="row card-body">
                                <div class="col-md-5 ml-auto">
                                    <div class="border p-3 bg-light">
                                        <h6 class="font-weight-bold text-uppercase text-muted mb-3">Order Summary</h6>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal:</span>
                                            <span>${{ $order->sub_total }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Shipping:</span>
                                            <span>${{ $order->shipping_charge }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Coupon Discount:</span>
                                            <span class="text-danger">-${{ $order->coupon_discount }}</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="font-weight-bold">Total:</span>
                                            <span class="font-weight-bold">${{ $order->total_charge }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    {{-- sweet alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCancel() {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to cancel this order?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, cancel it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancelOrderForm').submit();
                }
            });
        }
    </script>
@endpush
