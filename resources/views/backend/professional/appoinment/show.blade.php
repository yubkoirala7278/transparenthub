@extends('backend.layouts.master')
@section('content')
    <!-- [ Main Content ] start -->
    <div>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-house" style="color: #2C3E50"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('appoinment.index') }}" style="color: #2C3E50">Appoinment</a>
                </li>
            </ul>
        </div>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header  text-center" style="background-color: #2C3E50">
                    <h4 class="mb-0 text-light" >Appointment Details</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">First Name</h6>
                            <p class="fw-bold">{{ $appoinment->first_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Last Name</h6>
                            <p class="fw-bold">{{ $appoinment->last_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Email Address</h6>
                            <p class="fw-bold">{{ $appoinment->email_address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Phone Number</h6>
                            <p class="fw-bold">{{ $appoinment->phone_number }}</p>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-muted">Appointment Date</h6>
                            <p class="fw-bold">
                                {{ \Carbon\Carbon::parse($appoinment->schedule->date)->format('F j, Y') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Time Slot</h6>
                            <p class="fw-bold">
                                {{ \Carbon\Carbon::parse($appoinment->schedule->start_time)->format('h:i A') }} -
                                {{ \Carbon\Carbon::parse($appoinment->schedule->end_time)->format('h:i A') }}
                            </p>
                        </div>
                        @if ($appoinment->visit_reason)
                            <div class="col-md-12">
                                <h6 class="text-muted">Visit Reason</h6>
                                <p class="fw-bold">{{ $appoinment->visit_reason }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('appoinment.index') }}" class="btn btn-secondary">Back to Appointments</a>
                </div>
            </div>
        </div>



    </div>
    <!-- [ Main Content ] end -->
@endsection
