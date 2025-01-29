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
                    <a href="{{ route('news.index') }}" style="color: #2C3E50">News</a>
                </li>
            </ul>
            <a href="{{ route('news.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">News</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title font-weight-bold text-center" style="color:#2C3E50">{{ $news->title }} {{ optional($news->news_sources)->name ? '(' . optional($news->news_sources)->name . ')' : '' }}
                    </h4>
                    {{-- <div class="text-center mb-4">
                        <img src="{{ asset($news->image) }}" alt="News Image" class="img-fluid rounded"
                            style="max-height: 300px; object-fit: cover;">
                    </div> --}}
                    <div class="card-text">
                        {!! $news->description !!}
                    </div>
                    <div class="card-text">
                        <span class="badge badge-info">
                            {{ $news->news_categories->name }}
                        </span>
                        @if ($news->rss)
                            <span class="badge badge-secondary">
                                {{ $news->rss }}
                            </span>
                        @endif

                    </div>
                    <div class="mt-4 float-right">
                        <span class="badge badge-pill {{ $news->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($news->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- [ Main Content ] end -->
@endsection
