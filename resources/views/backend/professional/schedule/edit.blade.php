@extends('backend.layouts.master')

@section('header-links')
    <!-- Include Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                    <a href="{{ route('professional_schedule.index') }}" style="color: #2C3E50">Professional Schedule</a>
                </li>
            </ul>
            <a href="{{ route('professional_schedule.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Update Schedules</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('professional_schedule.update', $schedule->slug) }}" method="POST">
                        @csrf
                        @method('put')

                        {{-- Schedule Date --}}
                        <div class="form-group">
                            <label for="date" class="font-weight-bold">Date</label>
                            <input type="text" class="form-control" id="date" name="date"
                                value="{{ old('date', $schedule->date) }}" placeholder="YYYY-MM-DD">
                            @if ($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                        </div>

                        {{-- Schedule Start Time --}}
                        <div class="form-group">
                            <label for="start_time" class="font-weight-bold">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                                value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}">
                            @if ($errors->has('start_time'))
                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                            @endif
                        </div>

                        {{-- Schedule End Time --}}
                        <div class="form-group">
                            <label for="end_time" class="font-weight-bold">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time"
                                value="{{ old('start_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}">
                            @if ($errors->has('end_time'))
                                <span class="text-danger">{{ $errors->first('end_time') }}</span>
                            @endif
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">Status</label>
                            <div class="d-flex align-items-center" style="gap: 20px">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="available"
                                        value="available"
                                        {{ old('status', $schedule->status) === 'available' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="available">Available</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="booked"
                                        value="booked"
                                        {{ old('status', $schedule->status) === 'booked' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="booked">Booked</label>
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>

                        {{-- Submit & Reset Buttons --}}
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

@push('script')
    <script>
        flatpickr("#date", {
            dateFormat: "Y-m-d", // Ensures correct YYYY-MM-DD format
            allowInput: false, // Prevents manual input
        });
    </script>
@endpush
