@extends('backend.layouts.master')

@section('header-links')
    <style>
        .profile .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .profile img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .social-links a {
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0 8px;
        }

        .social-links a:hover {
            transform: translateY(-3px);
        }

        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 25px;
        }

        .nav-tabs .nav-link.active {
            border-bottom: 3px solid #007bff;
            color: #007bff;
            background: transparent;
        }

        .profile-details .row {
            padding: 12px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .profile-details .row:last-child {
            border-bottom: none;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .profile .card-body {
                padding: 1.5rem;
            }

            .nav-tabs .nav-link {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .profile-details .col-md-4 {
                margin-bottom: 5px;
            }
        }
    </style>
@endsection

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
                    <a href="{{ route('profile.index') }}" style="color: #2C3E50">Profile</a>
                </li>
            </ul>
        </div>
        {{-- test --}}
        <section class="section profile mt-4">
            <div class="container">
                <div class="row">
                    <!-- Profile Card -->
                    <div class="col-lg-4">
                        <div class="card shadow-lg mb-4">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="{{ asset($profile->professional->profile_image??'backend/images/admin.jpg') }}" alt="Profile"
                                        class="rounded-circle" loading="lazy">
                                </div>
                                <h2 class="mb-1 font-weight-bold">{{ $profile->name }}</h2>
                                @if ($profile->hasRole('professional'))
                                    <h5 class="text-muted mb-3">
                                        {{ $profile->professional->category->name }} •
                                        {{ $profile->professional->subCategory->name }}
                                    </h5>
                                @endif
                                <div class="social-links d-flex justify-content-center">
                                    <a href="#" class="text-primary"><i class="fab fa-twitter fa-lg"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-facebook fa-lg"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-instagram fa-lg"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-linkedin fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="col-lg-8">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#profile-overview">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#profile-edit">Edit Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#change-password">Password</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- Overview Tab -->
                                    <div class="tab-pane fade show active" id="profile-overview">
                                        <h5 class="card-title text-primary mb-4">Profile Details</h5>
                                        <div class="profile-details">
                                            <div class="row">
                                                <div class="col-md-4 font-weight-bold">Full Name</div>
                                                <div class="col-md-8">{{ $profile->name }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 font-weight-bold">Email Address</div>
                                                <div class="col-md-8">{{ $profile->email }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 font-weight-bold">Status</div>
                                                <div class="col-md-8">{{ $profile->status }}</div>
                                            </div>
                                            @if ($profile->hasRole('professional'))
                                                <div class="row">
                                                    <div class="col-md-4 font-weight-bold">Category</div>
                                                    <div class="col-md-8">{{ $profile->professional->category->name }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 font-weight-bold">Sub Category</div>
                                                    <div class="col-md-8">{{ $profile->professional->subCategory->name }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 font-weight-bold">Phone Number</div>
                                                    <div class="col-md-8">{{ $profile->professional->phone_number }}</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4 font-weight-bold">Experience Year</div>
                                                    <div class="col-md-8">{{ $profile->professional->experience_years }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 font-weight-bold">Location</div>
                                                    <div class="col-md-8">{{ $profile->professional->location }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 font-weight-bold">Rating</div>
                                                    <div class="col-md-8">{{ $profile->professional->rating }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 font-weight-bold">Bio</div>
                                                    <div class="col-md-8">{{ $profile->professional->bio }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Edit Profile Tab -->
                                    <div class="tab-pane fade" id="profile-edit">
                                        <form id="profileForm" method="POST" action="{{ route('profile.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group row mb-4">
                                                <label class="col-md-4 col-form-label">Full Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ old('name', $profile->name) }}">
                                                    <span class="text-danger error-text"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">Email Address</label>
                                                <div class="col-md-8">
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ old('email', $profile->email) }}">
                                                    <span class="text-danger error-text"></span>
                                                </div>
                                            </div>
                                            
                                            @if ($profile->hasRole('professional'))
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Phone Number</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="phone_number"
                                                            value="{{ old('phone_number', $profile->professional->phone_number) }}">
                                                        <span class="text-danger error-text"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Profile Image</label>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="profile_image">
                                                        <span class="text-danger error-text"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Experience</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control"
                                                            name="experience_years"
                                                            value="{{ old('experience_years', $profile->professional->experience_years) }}">
                                                        <span class="text-danger error-text"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Location</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="location"
                                                            value="{{ old('location', $profile->professional->location) }}">
                                                        <span class="text-danger error-text"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Bio</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" rows="5" name="bio">{{ old('bio', $profile->professional->bio) }}</textarea>
                                                        <span class="text-danger error-text"></span>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-primary px-5 py-2">Save
                                                    Changes</button>
                                            </div>
                                        </form>


                                    </div>

                                    <!-- Password Tab -->
                                    <div class="tab-pane fade" id="change-password">
                                        <form id="changePasswordForm" method="POST"
                                            action="{{ route('password.update') }}">
                                            @csrf

                                            <div class="form-group row mb-4">
                                                <label class="col-md-4 col-form-label">Current Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control shadow-sm"
                                                        name="current_password" placeholder="**********" autocomplete="new-password">
                                                    <span class="text-danger error-text"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">New Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="**********">
                                                    <span class="text-danger error-text"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">Re-enter New Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" placeholder="**********">
                                                    <span class="text-danger error-text"></span>
                                                </div>
                                            </div>

                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-primary px-5 py-2">Update
                                                    Password</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end test --}}



    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // =========update profile=============
            $('#profileForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                $('.error-text').text(''); // Clear previous error messages

                $.ajax({
                    url: "{{ route('profile.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        $('button[type="submit"]').prop('disabled', false);
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('[name="' + key + '"]').next('.error-text').text(
                                    value[0]);
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong. Please try again.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                });
            });
            // =======end of updating profile==========

            // =========change password===============
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                $('.error-text').text(''); // Clear previous error messages

                $.ajax({
                    url: "{{ route('password.edit') }}", // Update with your actual route
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            $('#changePasswordForm')[0].reset(); // Reset form fields
                        });
                    },
                    error: function(xhr) {
                        $('button[type="submit"]').prop('disabled', false);
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('[name="' + key + '"]').next('.error-text').text(
                                    value[0]);
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong. Please try again.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                });
            });
            // =======end of changing password==========
        });
    </script>
@endpush
