@extends('backend.layouts.master')
@section('header-links')
    {{-- flat picker for calender --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    <!-- [ Main Content ] start -->
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-house" style="color: #2C3E50"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.orders') }}" style="color: #2C3E50">Orders</a>
                </li>
            </ul>
            <a href="{{ route('admin.orders') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top: none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Order Details #{{ $order->slug }}</h5>
                </div>
                <div class="card-body">
                    <!-- Order Status Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1">Order Date: {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            <p class="mb-0">Payment Status:
                                <span
                                    class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-danger' }}">
                                    {{ $order->payment_status == 'not_paid' ? 'Not Paid' : 'Paid' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <p class="mb-1">Order Status:
                                <span class="badge order-status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            @if ($order->shipped_date)
                                <p class="mb-0">Shipped Date: {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="row" style="row-gap: 20px">
                                <div class="col-12">
                                    <div class="border p-3 mb-3">
                                        <h6 class="font-weight-bold text-uppercase text-muted mb-3">Shipping Information
                                        </h6>
                                        <p class="mb-1 font-weight-bold">{{ $order->first_name }} {{ $order->last_name }}
                                        </p>
                                        <p class="mb-1">{{ $order->street_address }}</p>
                                        <p class="mb-1">{{ $order->city }}, {{ $order->state }} {{ $order->zip }}
                                        </p>
                                        <p class="mb-1">Phone: {{ $order->phone_number }}</p>
                                        <p class="mb-0">Email: {{ $order->email }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="border p-3 ">
                                        <h6 class="font-weight-bold text-uppercase text-muted mb-3">Payment Information</h6>
                                        <p class="mb-1">Payment Method: Cash On Delivery</p>
                                        <!-- Update based on your payment methods -->
                                        {{-- <p class="mb-1">Transaction ID: XXXX-XXXX-XXXX-1234</p> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="border p-3">
                                <h6 class="font-weight-bold text-uppercase text-muted mb-3">Order Status</h6>
                                <form action="{{ route('admin.update.status', $order->slug) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option value="pending"
                                                {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            {{-- <option value="shipped"
                                                {{ old('status', $order->status) == 'shipped' ? 'selected' : '' }}>Shipped
                                            </option> --}}
                                            <option value="delivered"
                                                {{ old('status', $order->status) == 'delivered' ? 'selected' : '' }}>
                                                Delivered
                                            </option>
                                            <option value="cancelled"
                                                {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="shipped_date">Shipped Date</label>
                                        <input type="text" name="shipped_date" id="shipped_date" name="datetime"
                                            class="form-control" placeholder="Select date and time"
                                            value="{{ old('shipped_date', $order->shipped_date) }}">
                                        @error('shipped_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="subit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items Table -->
                <div class="table-responsive mb-4 card-body">
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
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product->sku ?? 'N/A' }}</td>
                                    <td class="text-center">${{ $item->product->price }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-right">${{ $item->product->price * $item->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
    <!-- [ Main Content ] end -->
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#shipped_date", {
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endpush
