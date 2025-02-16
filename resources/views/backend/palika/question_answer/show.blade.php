@extends('backend.layouts.master')
@section('header-links')
<style>
    .ck-editor__editable {
    min-height: 80px !important;
    /* Set the minimum height */
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
                    <a href="{{ route('palika_qna.index') }}" style="color: #2C3E50">Q&A For {{$palika_qna->palika->name}}</a>
                </li>
            </ul>
            <a href="{{ route('palika_qna.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">{{$palika_qna->question}}</h5>
                </div>
                <div class="card-body">
                    {!!$palika_qna->answer!!}
                </div>
            </div>
        </div>

    </div>
    <!-- [ Main Content ] end -->
@endsection


