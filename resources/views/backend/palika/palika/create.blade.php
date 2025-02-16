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
                    <a href="{{ route('palika.index') }}" style="color: #2C3E50">Municipality</a>
                </li>
            </ul>
            <a href="{{ route('palika.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Create New Municipality</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('palika.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Municipality Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Municipality Name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="population" class="font-weight-bold">Municipality Population</label>
                            <input type="text" class="form-control" id="population" name="population"
                                placeholder="Enter Municipality Population" value="{{ old('population') }}">
                            @if ($errors->has('population'))
                                <span class="text-danger">{{ $errors->first('population') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="total_area" class="font-weight-bold">Municipality Area(sq.km)</label>
                            <input type="text" class="form-control" id="total_area" name="total_area"
                                placeholder="Enter Municipality Total Area" value="{{ old('total_area') }}">
                            @if ($errors->has('total_area'))
                                <span class="text-danger">{{ $errors->first('total_area') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="district_id" class="font-weight-bold">District</label>
                            <select class="custom-select" name="district_id" id="district_id">
                                <option selected disabled>Selete District</option>
                                @if (count($districts) > 0)
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('district_id'))
                                <span class="text-danger">{{ $errors->first('district_id') }}</span>
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
