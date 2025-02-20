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
                    <a href="{{ route('professional.index') }}" style="color: #2C3E50">Professional</a>
                </li>
            </ul>
            <a href="{{ route('professional.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Create New Professional</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('professional.update', $professional->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Personal Information --}}
                        <div class="card shadow-lg mb-4">
                            <div class="card-header" style="background-color: #1365AF">
                                <h5 class="mb-0  text-white">Personal Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Full Name" value="{{ old('name', $professional->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email" value="{{ old('email', $professional->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="font-weight-bold">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Enter Password" autocomplete="new-password">
                                                <div class="input-group-append">
                                                    <span class="input-group-text toggle-password" data-target="password"
                                                        style="cursor: pointer;">
                                                        <i class="fa fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="font-weight-bold">Confirm
                                                Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Re-Enter Password"
                                                    autocomplete="new-password">
                                                <div class="input-group-append">
                                                    <span class="input-group-text toggle-password"
                                                        data-target="password_confirmation" style="cursor: pointer;">
                                                        <i class="fa fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contact & Bio --}}
                        <div class="card shadow-lg mb-4">
                            <div class="card-header" style="background-color: #1365AF">
                                <h5 class="mb-0 text-white">Contact & Bio</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="phone_number" class="font-weight-bold">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        placeholder="Enter Phone Number"
                                        value="{{ old('phone_number', $professional->professional->phone_number) }}">
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bio" class="font-weight-bold">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Enter a short bio">{{ old('bio', $professional->professional->bio) }}</textarea>
                                    @error('bio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Professional Details --}}
                        <div class="card shadow-lg mb-4">
                            <div class="card-header" style="background-color: #1365AF">
                                <h5 class="mb-0 text-white">Professional Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="experience_years" class="font-weight-bold">Experience
                                                (Years)</label>
                                            <input type="number" class="form-control" id="experience_years"
                                                name="experience_years" step="0.1" min="0"
                                                value="{{ old('experience_years', $professional->professional->experience_years) }}">
                                            @error('experience_years')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location" class="font-weight-bold">Location</label>
                                            <input type="text" class="form-control" id="location" name="location"
                                                placeholder="Enter Location"
                                                value="{{ old('location', $professional->professional->location) }}">
                                            @error('location')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="font-weight-bold">Status</label>
                                    <div class="d-flex align-items-center" style="gap: 20px">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="active"
                                                value="active"
                                                {{ old('status', $professional->status) === 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="active">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="inactive"
                                                value="inactive"
                                                {{ old('status', $professional->status) === 'inactive' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="rating" class="font-weight-bold">Rating</label>
                                    <input type="number" class="form-control" id="rating" name="rating"
                                        step="0.1" min="0" max="5"
                                        value="{{ old('rating', $professional->professional->rating) }}">
                                    @error('rating')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id" class="font-weight-bold">Category</label>
                                            <select class="form-control" id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $professional->professional->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_category_id" class="font-weight-bold">Subcategory</label>
                                            <select class="form-control" id="sub_category_id" name="sub_category_id">
                                                <option value="">Select Subcategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ old('sub_category_id', $professional->professional->sub_category_id) == $subcategory->id ? 'selected' : '' }}>
                                                        {{ $subcategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sub_category_id'))
                                                <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Profile Image --}}
                        <div class="card shadow-lg mb-4">
                            <div class="card-header" style="background-color: #1365AF">
                                <h5 class="mb-0 text-white">Profile Image</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="profile_image" class="font-weight-bold">Upload Image</label>
                                    <input type="file" class="form-control-file" id="profile_image"
                                        name="profile_image">
                                    @error('profile_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Submit & Reset --}}
                        <div class="text-right">
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
        $(document).ready(function() {
            var selectedCategory = $('#category_id').val();
            var selectedSubCategory = "{{ old('sub_category_id', $professional->professional->sub_category_id) }}";

            // Function to fetch subcategories based on the selected category
            function fetchSubCategories(categoryId, selectedSubCategory) {
                $('#sub_category_id').html('<option value="">Select Subcategory</option>'); // Reset subcategories

                if (categoryId) {
                    $.ajax({
                        url: "{{ route('get.subcategories', '') }}/" +
                        categoryId, // AJAX call to get subcategories
                        type: "GET",
                        success: function(data) {
                            $.each(data, function(key, value) {
                                var isSelected = (value.id == selectedSubCategory) ?
                                    'selected' :
                                    ''; // Check if subcategory matches the selected value
                                $('#sub_category_id').append('<option value="' + value.id +
                                    '" ' + isSelected + '>' + value.name + '</option>');
                            });
                        }
                    });
                }
            }

            // Fetch subcategories when category is changed
            $('#category_id').change(function() {
                var categoryId = $(this).val();
                fetchSubCategories(categoryId, ''); // Reset subcategory selection
            });

            // Fetch subcategories when page loads (if editing)
            if (selectedCategory) {
                fetchSubCategories(selectedCategory,
                selectedSubCategory); // Pre-select subcategory based on the professional's data
            }
        });
    </script>
@endpush
