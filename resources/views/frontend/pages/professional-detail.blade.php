@extends('frontend.layouts.master')
@section('content')
    <section class="professional-detail container mt-5">
        <div class="row gy-4">
            <!-- Professional Information -->
            <div class="col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-center gap-3">
                            <img src="{{ asset($professional->professional->profile_image) }}" alt="Professional Image"
                                class="img-fluid rounded" style="max-height: 100px; object-fit: cover;">
                            <div class="w-100">
                                <h2 class="mb-0">{{ $professional->name }}</h2>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <div class="rating">
                                        @php
                                            $rating = round($professional->professional->rating, 1);
                                            $fullStars = floor($rating);
                                            $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                                            $emptyStars = 5 - ($fullStars + $halfStar);
                                        @endphp

                                        {{-- Full Stars --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @endfor

                                        {{-- Half Star --}}
                                        @if ($halfStar)
                                            <i class="fa-solid fa-star-half-stroke text-warning"></i>
                                        @endif

                                        {{-- Empty Stars --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @endfor
                                    </div>
                                    <small class="fw-semibold">
                                        {{ $rating }} / 5 <span
                                            class="text-muted">({{ $professional->professional->rating_count }}
                                            ratings)</span>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div
                            class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
                            <p class="mb-0">
                                <strong class="fs-5">Position:</strong>
                                {{ $professional->professional->category->name }}
                                ({{ $professional->professional->subCategory->name }})
                            </p>
                            <div class="d-flex align-items-center gap-2">
                                <span class="small">Share:</span>
                                <a href="#" class="btn btn-outline-primary btn-sm"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="btn btn-outline-success btn-sm"><i
                                        class="fa-brands fa-viber"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="#" class="btn btn-outline-warning btn-sm"><i
                                        class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5 class="fw-bold">About {{ $professional->name }}</h5>
                            <p>{{ $professional->professional->bio }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointment Booking Form -->
            <div class="col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Book an Appointment</h4>

                        @if ($availableSchedules->isNotEmpty())
                            <form action="{{ route('appointment.book') }}" method="POST">
                                @csrf
                                <!-- Hidden Professional ID -->
                                <input type="hidden" name="professional_id" value="{{ $professional->id }}">
                                <div class="row" style="row-gap: 20px">
                                    <!--First Name -->
                                    <div class="col-12 col-lg-6">
                                        <label for="first_name" class="form-label">
                                            First Name
                                        </label>
                                        <input type="text" name="first_name" id="first_name" class="form-control"
                                            placeholder="Enter First Name" value="{{old('first_name')}}"></input>
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <!--Last Name -->
                                    <div class="col-12 col-lg-6">
                                        <label for="last_name" class="form-label">
                                            Last Name
                                        </label>
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                            placeholder="Enter Last Name" value="{{old('last_name')}}"></input>
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                    <!--Phone Number -->
                                    <div class="col-12 col-lg-6">
                                        <label for="phone_number" class="form-label">
                                            Phone Number
                                        </label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            placeholder="Enter Phone Number" value="{{old('phone_number')}}"></input>
                                        @if ($errors->has('phone_number'))
                                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>
                                    <!--Email Address -->
                                    <div class="col-12 col-lg-6">
                                        <label for="email_address" class="form-label">
                                            Email Address
                                        </label>
                                        <input type="email" name="email_address" id="email_address" class="form-control"
                                            placeholder="Enter Email Address" value="{{old('email_address')}}"></input>
                                        @if ($errors->has('email_address'))
                                            <span class="text-danger">{{ $errors->first('email_address') }}</span>
                                        @endif
                                    </div>
                                    <!-- Available Schedule Dropdown -->
                                    <div class="col-12">
                                        <label for="schedule_id" class="form-label">Select Appointment Slot</label>
                                        <select name="schedule_id" id="schedule_id" class="form-select">
                                            <option value="" disabled {{ old('schedule_id') ? '' : 'selected' }}>Select an available slot</option>
                                            @foreach ($availableSchedules as $schedule)
                                                <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::parse($schedule->date)->format('M d, Y') }} |
                                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('schedule_id'))
                                            <span class="text-danger">{{ $errors->first('schedule_id') }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Additional Information (Optional) -->
                                    <div class="col-12">
                                        <label for="visit_reason" class="form-label">
                                            Reason for Visit(Optional)
                                        </label>
                                        <textarea name="visit_reason" id="visit_reason" class="form-control" rows="3"
                                            placeholder="Enter visit reason">{{old('visit_reason')}}</textarea>
                                        @if ($errors->has('visit_reason'))
                                            <span class="text-danger">{{ $errors->first('visit_reason') }}</span>
                                        @endif
                                    </div>
                                    {{-- submit form --}}
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">Book Appointment</button>
                                    </div>
                                </div>


                            </form>
                        @else
                            <div class="alert alert-info text-center">
                                No available appointment slots at the moment.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
