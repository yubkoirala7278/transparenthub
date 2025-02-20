@extends('backend.layouts.master')
@section('header-links')
    <style>
        .ck-editor__editable {
            min-height: 80px !important;
            /* Set the minimum height */
        }

        .professional-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .professional-card:hover {
            transform: translateY(-5px);
        }

        .profile-gradient {
            background: linear-gradient(135deg, #2C3E50 0%, #3498db 100%);
        }

        .profile-img {
            border: 4px solid white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .detail-item {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
        }

        .detail-icon {
            width: 35px;
            height: 35px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: #2C3E50;
        }

        .bio-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
        }

        .rating-stars {
            color: #ffc107;
            font-size: 1.1rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .category-badge {
            background: #e9ecef;
            color: #495057;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
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
                    <a href="{{ route('professional.index') }}" style="color: #2C3E50">Professional</a>
                </li>
            </ul>
            <a href="{{ route('professional.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
            <div class="card professional-card">
                <div class="card-header profile-gradient py-4">
                    <div class="text-center">
                        <img src="{{ asset($professional->professional->profile_image) }}" alt="Profile Image"
                            class="profile-img rounded-circle shadow" width="140" height="140">
                    </div>
                </div>

                <div class="card-body px-4 pt-0">
                    <div class="text-center mt-4">
                        <h3 class="font-weight-bold mb-1">{{ $professional->name }}</h3>
                        <div class="category-badge mb-3">
                            {{ $professional->professional->category->name }} • {{ $professional->professional->subCategory->name }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3 border-0 shadow">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">EMAIL</small>
                                        <div class="font-weight-bold">{{ $professional->email }}</div>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">EXPERIENCE</small>
                                        <div class="font-weight-bold">{{ $professional->professional->experience_years }} Years</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3 border-0 shadow">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">LOCATION</small>
                                        <div class="font-weight-bold">{{ $professional->professional->location }}</div>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">RATING</small>
                                        <div class="font-weight-bold rating-stars">
                                            {{ str_repeat('★', floor($professional->professional->rating)) }}{{ $professional->professional->rating - floor($professional->professional->rating) ? '½' : '' }}
                                            ({{ $professional->professional->rating }}/5)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bio-section mt-4">
                        <h6 class="font-weight-bold text-uppercase mb-3 text-primary">
                            <i class="fas fa-user-circle mr-2"></i>Professional Bio
                        </h6>
                        <p class="text-muted mb-0">{{ $professional->professional->bio }}</p>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded">
                                <span class="text-muted">Status:</span>
                                <span
                                    class="status-badge {{ $professional->status == 'active' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                    {{ ucfirst($professional->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded">
                                <span class="text-muted">Phone:</span>
                                <span class="font-weight-bold">{{ $professional->professional->phone_number }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
