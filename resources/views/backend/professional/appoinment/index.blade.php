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
    <div class="table-responsive">
        <table class="table table-hover pt-3 w-100">
            <thead>
                <tr>
                    <th>S.N:</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle">
                @if (count($appoinments) > 0)
                @foreach ($appoinments as $key=>$appoinment)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$appoinment->first_name}}</td>
                    <td>{{$appoinment->last_name}}</td>
                    <td>{{$appoinment->phone_number}}</td>
                    <td>{{$appoinment->email_address}}</td>
                    <td>{{ \Carbon\Carbon::parse($appoinment->schedule->date)->format('F j, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appoinment->schedule->start_time)->format('h:i A') }} -
                        {{ \Carbon\Carbon::parse($appoinment->schedule->end_time)->format('h:i A') }}
                    </td>

                    <td>
                        <a href="" class="btn btn-info rounded-pill text-white btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>


</div>
<!-- [ Main Content ] end -->
@endsection

@push('script')
@endpush