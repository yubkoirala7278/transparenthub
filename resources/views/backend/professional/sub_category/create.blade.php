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
                    <a href="{{ route('professional_sub_category.index') }}" style="color: #2C3E50">Sub Category</a>
                </li>
            </ul>
            <a href="{{ route('professional_sub_category.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Create New Sub Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('professional_sub_category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Sub Category Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Sub Category Name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">Category</label>
                            <select class="custom-select" name="category_id" id="category_id">
                                <option selected disabled>Selete Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status" class="font-weight-bold">Status</label>
                            <div class="d-flex align-items-center" style="gap: 20px">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                        value="active" {{ old('status', 'active') === 'active' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                        value="inactive" {{ old('status') === 'inactive' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- [ Main Content ] end -->
@endsection
