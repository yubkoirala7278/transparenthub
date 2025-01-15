@extends('backend.layouts.master')
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
                    <a href="" style="color: #2C3E50">Blogs</a>
                </li>
            </ul>
            <a href="{{ route('blogs.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Update Blog</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title font-weight-bold text-center" style="color:#2C3E50">{{$blog->title}}</h4>
                    <div class="text-center mb-4">
                        <img src="{{asset($blog->image)}}" alt="Blog Image" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                    </div>
                    <div class="card-text">
                        {!! $blog->description !!}
                    </div>
                    <div class="mt-4 float-right">
                        <span class="badge badge-pill {{$blog->status === 'active' ? 'badge-success' : 'badge-danger'}}">
                            {{ ucfirst($blog->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    <!-- [ Main Content ] end -->
@endsection
